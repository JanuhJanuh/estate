<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Managers;
use App\Models\Property;
use App\Models\ApartmentRoom;
use App\Models\ManageMgr;

class ManagerController extends Controller
{
    public function ManagerDashboard()
    {
        $manager = Auth::guard('manager')->user();
        $allocation = $manager->allocation()->with('property')->first();
        return view('manager.manager_index', compact('manager', 'allocation'));
    }

    public function Managers()
    {
        $managers = Managers::orderBy('id', 'asc')->get();
        return view('admin.management', compact('managers'));
    }

public function ManageApartmentUnits()
{
    $manager = Auth::guard('manager')->user();
    $allocation = $manager->allocation()->with('property')->first();
    $apartment = $allocation ? $allocation->property : null;
    $totalUnits = $apartment ? $apartment->Units : 0;

    return view('manager.manageapartment', compact('manager', 'apartment', 'totalUnits'));
}
// Store The Managers Appartment Management data and array of Images //
public function ManageUnits(Request $request)
{
    $request->validate([
        'room_type' => 'required|string',
        'room_numbers' => 'required|array',
        'room_numbers.*' => 'required|string',
        'charges' => 'required|numeric',
        'room_images_*' => 'nullable|array',
        'room_images_*.file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $manager = Auth::guard('manager')->user();
    $managerAllocation = $manager->allocation()->with('property')->first();

    if (!$managerAllocation || !$managerAllocation->apartment_id) {
        return redirect()->back()->with('error', 'Contact Admin For Assistance.');
    }

    $adminAllocatedUnits = $managerAllocation->property->units;
    $existingUnitsCount = ApartmentRoom::where('apartment_id', $managerAllocation->apartment_id)->count();
    $remainingUnits = $adminAllocatedUnits - $existingUnitsCount;

    print($adminAllocatedUnits);
    exit();


    $requestedUnits = count($request->room_numbers);
    if ($requestedUnits > $remainingUnits) {
        $errorMessage = "Cannot allocate more units than the original allocated units by the admin. Admin Units: $adminAllocatedUnits, Remaining Units: $remainingUnits";
        return redirect()->back()->with('error', $errorMessage);
    }

    foreach ($request->room_numbers as $index => $roomNumber) {
        $images = [];
        if ($request->hasFile("room_images_$index")) {
            foreach ($request->file("room_images_$index") as $file) {
                $path = $file->store('room_images', 'public');
                $images[] = $path;
            }
        }

        ApartmentRoom::create([
            'apartment_id' => $managerAllocation->apartment_id,
            'room_type' => $request->room_type,
            'room_number' => $roomNumber,
            'charges' => $request->charges,
            'images' => json_encode($images),
        ]);
    }

    $successMessage = 'Units Successfully Updated. Remaining Units: ' . $remainingUnits;
    return redirect()->back()->with('success', $successMessage);
}



// Wazi Man MAN //


    public function AddManager()
    {
        return view('admin.addmanager');
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
            'Role' => 'Manager',
            'Password' => Hash::make($request->IDNumber),
        ]);

        if ($manager) {
            return redirect()->route('admin.addmanager')->with('success', 'Manager added successfully! Password: ' . $request->IDNumber);
        } else {
            return redirect()->route('admin.addmanager')->with('error', 'Failed to add manager.');
        }
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
        // Validate the incoming request data
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

        // Create a new allocation record using the validated data
        $allocation = new ManageMgr();
        $allocation->manager_id = $managerid;
        $allocation->apartment_id = $validatedData['apartment_id'];
        $allocation->start_date = $validatedData['start_date'];
        $allocation->salary = $validatedData['salary'];
        $allocation->status = 'Active';
        $allocation->save();

        // Optionally, you can redirect the user or return a response
        return redirect()->back()->with('success', 'Allocation done successfully!');
    }




public function viewManagement($managerid)
{
    try {
        $manager = Managers::findOrFail($managerid);
        $allocation = ManageMgr::where('manager_id', $managerid)->first();
        return view('admin.managerdetails', ['manager' => $manager, 'allocation' => $allocation]);
    } catch (ModelNotFoundException $e) {
        return redirect()->back()->with('error', 'Manager not found');
    }
}



}
