<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\ApartmentRoom;
use App\Models\ApartmentBooking;
use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantController extends Controller
{
    public function tenant_dashboard()
    {
        $tenant = Auth::guard('tenant')->user();
        $booking = $tenant->booking;
        $room = $booking ? $booking->room : null;
        $apartment = $booking ? $booking->apartment : null;
        $entry_date = $booking ? $booking->entry_date : null;

        return view('tenants.tenant_dashboard', compact('tenant', 'apartment', 'room', 'entry_date'));
    }



    public function Tenants()
    {
        $tenants = Tenant::with('booking.room')->get();
        return view('manager.tenants_form', compact('tenants'));
    }

    public function EditTenant($id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('manager.edit_tenant', compact('tenant'));
    }

    public function TenantDetails($id)
    {
        $tenant = Tenant::with(['booking.room', 'apartment'])->findOrFail($id);

        return view('manager.tenant_details', compact('tenant'));
    }

    public function UpdateTenant(Request $request, $id)
    {
        $tenant = Tenant::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'id_number' => 'required|numeric|unique:tenants,IDNumber,' . $id,
            'phone' => 'required|string',
            'phone2' => 'nullable|string',
            'email' => 'required|email',
            'gender' => 'required|string',
            'id_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tenant->Name = $request->name;
        $tenant->IDNumber = $request->id_number;
        $tenant->Phone = $request->phone;
        $tenant->Phone2 = $request->phone2;
        $tenant->Email = $request->email;
        $tenant->Gender = $request->gender;

        if ($request->hasFile('id_image')) {
            // Upload and store the new ID Image
            $imageName = time() . '.' . $request->id_image->extension();
            $request->id_image->move(public_path('tenant_images'), $imageName);
            $tenant->IDImage = $imageName;
        }

        $tenant->save();

        return redirect()->route('manager.tenants_form')->with('success', 'Tenant updated successfully.');
    }

    public function showAllocateRoomForm($tenant_id)
    {
        $tenant = Tenant::findOrFail($tenant_id);
        $manager = auth()->user();

        $apartment = $manager->apartment;
        if (!$apartment) {
            return redirect()->route('manager.tenants')->with('error', 'No apartment associated with the manager.');
        }

        $rooms = $apartment->apartmentRooms()->where('status', 'vacant')->get();

        return view('manager.allocate_form', compact('tenant', 'manager', 'apartment', 'rooms'));
    }

    public function allocateRoom(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:apartment_rooms,id',
            'tenant_id' => 'required|exists:tenants,id',
            'entry_date' => 'required|date|after:today',
        ]);

        $room = ApartmentRoom::findOrFail($request->room_id);
        $tenant = Tenant::findOrFail($request->tenant_id);

        // Check if the tenant is already allocated to a room
        $existingBooking = ApartmentBooking::where('tenant_id', $tenant->id)->first();

        if ($existingBooking) {
            $roomNumber = $existingBooking->room->room_number; // Assuming you have a 'room_number' field in ApartmentRoom model
            return redirect()->back()->with('error', 'Tenant already allocated to room number ' . $roomNumber);
        }

        if ($room->status !== 'vacant') {
            return redirect()->back()->with('error', 'Room is already occupied.');
        }

        // Update room status to 'Occupied'
        $room->status = 'Occupied';
        $room->save();

        ApartmentBooking::create([
            'tenant_id' => $tenant->id,
            'apartment_id' => $room->apartment_id,
            'room_id' => $room->id,
            'status' => 'Active',
            'entry_date' => $request->entry_date,
        ]);

        return redirect()->route('manager.view_tenants')->with('success', 'Room allocated successfully.');
    }






}
