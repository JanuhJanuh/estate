<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Managers;
use App\Models\Property;
use App\Models\ApartmentRoom;
use App\Models\ManageMgr;
use App\Models\Tenant;
use App\Models\RoomImage;
use App\Models\ApartmentBooking;


class ManagerController extends Controller
{
    public function ManagerDashboard()
    {
        $managerId = auth()->user()->id;

        // Fetch the allocation details for the manager
        $allocation = ManageMgr::with(['property.tenants.room'])
            ->where('manager_id', $managerId)
            ->first();

        return view('manager.manager_index', compact('allocation'));
    }


    public function viewApartmentUnits()
    {
        $manager = Auth::guard('manager')->user();
        $managerAllocation = $manager->allocation()->with('property')->first();

        if (!$managerAllocation || !$managerAllocation->apartment_id) {
            return redirect()->back()->with('error', 'Contact Admin For Assistance.');
        }

        $apartmentRooms = ApartmentRoom::where('apartment_id', $managerAllocation->apartment_id)
            ->with('images') // Eager load the images relationship
            ->orderBy('room_type')
            ->get();

        return view('manager.apartmentunits', compact('manager', 'apartmentRooms', 'managerAllocation'));
    }

    public function AddTenantform()
    {
        $manager = Auth::guard('manager')->user();
        if (!$manager) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Fetch the apartment ID from the manage_mgrs table
        $apartmentId = DB::table('manage_mgr')
            ->where('manager_id', $manager->id)
            ->value('apartment_id'); // Retrieve the apartment_id for this manager



        if (!$apartmentId) {
            return redirect()->back()->with('error', 'You are not assigned to any apartment.');
        }

        // Fetch rooms belonging to the manager's assigned apartment and with status 'Vacant'
        $vacantRooms = DB::table('apartment_rooms')
            ->where('apartment_id', $apartmentId)
            ->where('status', 'vacant')
            ->get();
        // Pass the data to the view
        return view('manager.addtenantdetails', compact('vacantRooms'));
    }



    public function SaveTenant(Request $request)
    {
        // Ensure the manager is authenticated
        $manager = Auth::guard('manager')->user();
        if (!$manager) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'id_number' => 'required|unique:tenants,IDNumber',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'gender' => 'required|string',
            'room_id' => 'required|exists:apartment_rooms,id',
            'entry_date' => 'required|date',
            'id_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $tenant = new Tenant();
        $tenant->name = $request->name;
        $tenant->IDNumber = $request->id_number;
        $tenant->password = Hash::make($request->id_number);
        $tenant->phone = $request->phone;
        $tenant->email = $request->email;
        $tenant->gender = $request->gender;
        $tenant->role = 'tenant'; // set Role to Tenant

        if ($request->hasFile('id_image')) {
            $imageName = time() . '.' . $request->id_image->extension(); // get extension $ Generate a unique name
            $request->id_image->move(public_path('tenant_images'), $imageName);
            $tenant->IDImage = $imageName;
        }
        $tenant->save(); // Save tenant record

        // Add booking to the apartment_bookings table
        $booking = new ApartmentBooking();
        $booking->tenant_id = $tenant->id;
        $booking->room_id = $request->room_id;
        $booking->apartment_id = DB::table('manage_mgr')->where('manager_id', $manager->id)->value('apartment_id');
        $booking->entry_date = $request->entry_date;
        $booking->status = 'Active';
        $booking->save();

        // Update room status to 'occupied'
        DB::table('apartment_rooms')
            ->where('id', $request->room_id)
            ->update(['status' => 'occupied']);

        // Redirect back with success message
        return redirect()->route('manager.add_tenant')->with('success', 'Tenant registered and room allocated successfully!');
    }



    public function getRoomNumbers($roomType)
    {
        $manager = Auth::guard('manager')->user();
        $managerAllocation = $manager->allocation()->with('property')->first();

        if (!$managerAllocation || !$managerAllocation->apartment_id) {
            return response()->json([]);
        }

        $roomNumbers = ApartmentRoom::where('apartment_id', $managerAllocation->apartment_id)
            ->where('room_type', $roomType)
            ->pluck('room_number');

        return response()->json($roomNumbers);
    }

    public function ManageApartmentUnits()
    {
        $manager = Auth::guard('manager')->user();
        $allocation = $manager->allocation()->with('property')->first();
        $apartment = $allocation ? $allocation->property : null;
        $totalUnits = $apartment ? $apartment->Units : 0;

        return view('manager.manageapartment', compact('manager', 'apartment', 'totalUnits'));

 }

    public function ManageUnits(Request $request)
    {
        $request->validate([
            'room_type' => 'required|string',
            'room_numbers' => 'required|array',
            'room_numbers.*' => 'required|string',
            'charges' => 'required|numeric',
            'room_images_*' => 'nullable|array',
            'room_images_*.file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities' => 'nullable|string',
            'overview' => 'nullable|string',
        ]);

        $manager = Auth::guard('manager')->user();
        $managerAllocation = $manager->allocation()->with('property')->first();

        if (!$managerAllocation || !$managerAllocation->apartment_id) {
            return redirect()->back()->with('error', 'Contact Admin For Assistance.');
        }

        $apartment = $managerAllocation->property;
        $adminAllocatedUnits = $apartment->Units;

        $existingUnitsCount = ApartmentRoom::where('apartment_id', $managerAllocation->apartment_id)->count();
        $remainingUnits = $adminAllocatedUnits - $existingUnitsCount;

        $requestedUnits = count($request->room_numbers);
        if ($requestedUnits > $remainingUnits) {
            $errorMessage = "Cannot allocate more units than the original allocated units by the admin. Admin Units: $adminAllocatedUnits, Available Units: $remainingUnits";
            return redirect()->back()->with('error', $errorMessage);
        }

        foreach ($request->room_numbers as $index => $roomNumber) {
            $apartmentRoom = ApartmentRoom::create([
                'apartment_id' => $managerAllocation->apartment_id,
                'room_type' => $request->room_type,
                'room_number' => $roomNumber,
                'charges' => $request->charges,
                'status' => 'vacant',
                'amenities' => $request->amenities,
                'overview' => $request->overview,
            ]);

            if ($request->hasFile("room_images_$index")) {
                foreach ($request->file("room_images_$index") as $file) {
                    $path = $file->store('room_images', 'public');
                    RoomImage::create([
                        'apartment_room_id' => $apartmentRoom->id,
                        'image_path' => $path,
                    ]);
                }
            }
        }

        $CurrentCount = ApartmentRoom::where('apartment_id', $managerAllocation->apartment_id)->count();
        $remainingUnits2 = $adminAllocatedUnits - $CurrentCount;

        $successMessage = 'Units Successfully Updated. Remaining Units: ' . $remainingUnits2;
        return redirect()->back()->with('success', $successMessage);
    }


    public function SaveManager(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'IDNumber' => 'required|unique:managers,IDNumber',
            'DOB' => 'required',
            'Gender' => 'required',
            'PhoneNo' => 'required',
            'Email' => 'required|email',
            'Image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Address' => 'required',
        ]);

        if ($request->hasFile('Image')) {
            $path = $request->file('Image')->store('manager_images', 'public');
        } else {
            return redirect()->route('admin.addmanager')->with('error', 'Image upload failed!');
        }

        $manager = Managers::create([
            'Name' => $request->Name,
            'IDNumber' => $request->IDNumber,
            'DOB' => $request->DOB,
            'Gender' => $request->Gender,
            'PhoneNo' => $request->PhoneNo,
            'Email' => $request->Email,
            'Image' => $path,
            'Address' => $request->Address,
            'Role' => 'manager',
            'Password' => Hash::make($request->IDNumber),
        ]);

        if ($manager) {
            return redirect()->route('admin.addmanager')->with('success', 'Manager added successfully! Password: ' . $request->IDNumber);
        } else {
            return redirect()->route('admin.addmanager')->with('error', 'Failed to add manager.');
        }
    }

    public function Managers()
      {
        $managers = Managers::orderBy('id', 'asc')->get();
        return view('admin.management', compact('managers'));
      }

    public function EditManager($managerid)
    {
        $Manager = Managers::find($managerid);
        return view('admin.editmanager', compact('Manager'));
    }

    public function UpdateManager(Request $request, $managerid)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'PhoneNo' => 'required|string|max:20',
            'IDNumber' => 'required|string|max:20',
            'Email' => 'required|email|max:255',
        ]);

        $Manager = Managers::find($managerid);
        $Manager->Name = $request->input('Name');
        $Manager->IDNumber = $request->input('IDNumber');
        $Manager->PhoneNo = $request->input('PhoneNo');
        $Manager->Email = $request->input('Email');
        $Manager->save();

        return redirect()->route('admin.managers');
    }

    public function AllocateManagerForm($managerid)
    {
        $Manager = Managers::find($managerid);
        $Property = Property::doesntHave('allocation')->get();
        return view('admin.allocate', compact('Manager', 'Property'));
    }

    public function saveAllocateManager(Request $request, $managerid)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'salary' => 'required|numeric|min:0',
            'apartment_id' => 'required|exists:_property,id',
        ]);

        // Check if the manager is already allocated to any apartment
        $existingAllocation = ManageMgr::where('manager_id', $managerid)->exists();

        if ($existingAllocation) {
            return redirect()->back()->with('error', 'Manager is already allocated to an apartment!');
        }

        // Create new allocation
        $allocation = new ManageMgr();
        $allocation->manager_id = $managerid;
        $allocation->apartment_id = $validatedData['apartment_id'];
        $allocation->start_date = $validatedData['start_date'];
        $allocation->salary = $validatedData['salary'];
        $allocation->status = 'Active';
        $allocation->save();

        return redirect()->back()->with('success', 'Allocation done successfully!');
    }


    public function viewManagement($managerid)
    {
        try {
            $manager = Managers::findOrFail($managerid);
            $allocation = ManageMgr::where('manager_id', $managerid)->first();
            return view('admin.managerdetails', ['manager' => $manager, 'allocation' => $allocation]);
        } catch (\Exception $e) {
            return redirect()->route('admin.management')->with('error', 'Manager not found');
        }
    }

    public function DeleteManager($managerid)
    {
        $Manager = Managers::find($managerid);
        $Manager->delete();

        return redirect()->route('admin.managers')->with('success', 'Manager deleted successfully');
    }
}
