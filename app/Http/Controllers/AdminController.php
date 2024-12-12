<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Property;


class AdminController extends Controller
{
    public function AdminDashboard(){

        return view('admin/index');
    }

  public function adminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

   public function AddManager(){
    return view('admin.addmanager');
   }

    public function AddProperty(){
        return view('admin.addproperty');
    }
public function SaveProperty(Request $request)
{
    $request->validate([
        'PName' => 'required|string|max:255',
        'PropertyType' => 'required|string',
        'Address' => 'required|string|max:255',
        'Description' => 'required|string',
        'Units' => 'required|integer',
        'Images' => 'required|array',
        'Images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    try {
        // Create the property
        $property = Property::create([
            'PName' => $request->PName,
            'PropertyType' => $request->PropertyType,
            'Address' => $request->Address,
            'Description' => $request->Description,
            'Units' => $request->Units,
        ]);

        // Handle the image uploads
        if ($request->hasFile('Images')) {
            foreach ($request->file('Images') as $image) {
                // Generate a unique file name
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('property_images', $filename, 'public');  // Store in public storage

                // Save the image path to the database
                $property->images()->create(['image_path' => "$filename"]);
            }
        }

        return redirect()->route('admin.addproperty')->with('success', 'Property and images saved successfully!');
    } catch (\Exception $e) {
        \Log::error('Failed to save property: ' . $e->getMessage());
        return redirect()->route('admin.addproperty')->with('error', 'Failed to save property. Error: ' . $e->getMessage());
    }
}

  public function Property()
{
    $properties = Property::with('images')->orderBy('id', 'desc')->get();
    return view('admin.property', compact('properties'));
}

    public function DeleteProperty(Request $request, property $Property){
        $Property->delete();
        return redirect()->route('admin.property');

    }

    public function EditProperty($Property)
    {
        $apartment = property::Find($Property);
        return view('admin.editproperty',compact('apartment'));
    }

    public function Update(Request $request, $id){
        $Property = property::find($id);
        $Property->PName = $request->input('pname');
        $Property->Address = $request->input('address');
        $Property->Units = $request->input('units');

        $Property->save();
        return redirect()->route('admin.property');


    }
    public function AddTenant()
    {
        $apartments = Property::with(['apartmentRooms' => function ($query) {
            $query->where('status', 'Vacant'); // Filter rooms with status 'Vacant'
        }])->get();

        return view('admin.addtenantform', compact('apartments'));
    }

    public function SaveTenantData(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_number' => 'required|numeric|unique:tenants,IDNumber',
            'phone' => 'required|string',
            'email' => 'required|email',
            'gender' => 'required|string',
            'id_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'apartment_id' => 'required|exists:apartments,id',
            'room_id' => 'required|exists:apartmentrooms,id',
            'entry_date' => 'required|date',
        ]);

       

        // Check if tenant with the same ID number already exists
        $existingTenant = Tenant::where('IDNumber', $request->id_number)->first();
        if ($existingTenant) {
            return redirect()->back()->withInput()->with('error', 'Tenant with ID number already exists.');
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Upload and store the ID Image
            $imageName = time() . '.' . $request->id_image->extension();
            $request->id_image->move(public_path('tenant_images'), $imageName);

            // Create a new Tenant instance and save it to the database
            $tenant = Tenant::create([
                'Name' => $request->name,
                'IDNumber' => $request->id_number,
                'Phone' => $request->phone,
                'Gender' => $request->gender,
                'Email' => $request->email,
                'IDImage' => $imageName,
                'password' => Hash::make($request->id_number),
                'role' => 'tenant',
            ]);

            // Save the allocation to the apartmentbooking table
            ApartmentBooking::create([
                'tenant_id' => $tenant->id, // get the tenant id
                'apartment_id' => $request->apartment_id,
                'room_id' => $request->room_id,
                'entry_date' => $request->entry_date,
                'status' => 'Active',
            ]);

            // Update the status of the allocated room to 'Occupied'
            ApartmentRoom::where('id', $request->room_id)
                ->update(['status' => 'Occupied']);

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Tenant registered and room allocated successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            return redirect()->back()->withInput()->with('error', 'Failed to register tenant and allocate room. ' . $e->getMessage());
        }
    }





}

?>
