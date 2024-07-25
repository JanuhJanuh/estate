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



    public function AddProperty(){
        return view('admin.addproperty');
    }

    public function SaveProperty(Request $request)
    {
        // Validate request data
        $request->validate([
            'PName' => 'required|string|max:255',
            'PropertyType' => 'required|string',
            'Address' => 'required|string|max:255',
            'Description' => 'required|string',
            'Units' => 'required|integer',
            'Images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            // Log the request data
            \Log::info('Request data: ', $request->all());

            // Create new property
            $property = Property::create([
                'PName' => $request->PName,
                'PropertyType' => $request->PropertyType,
                'Address' => $request->Address,
                'Description' => $request->Description,
                'Units' => $request->Units,
            ]);

            // Log the created property
            \Log::info('Property created: ', $property->toArray());

            // Handle image uploads
            if ($request->hasFile('Images')) {
                foreach ($request->file('Images') as $image) {
                    $path = $image->store('property_images', 'public');
                    $property->images()->create(['image_path' => $path]);
                    // Log the uploaded image path
                    \Log::info('Image uploaded: ', ['path' => $path]);
                }
            }

            return redirect()->route('admin.addproperty')->with('success', 'Property saved successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to save property: ' . $e->getMessage());
            return redirect()->route('admin.addproperty')->with('error', 'Failed to save property. Error: ' . $e->getMessage());
        }
    }

    public function Property(){

        $properties = property::orderBy('id','desc')->get();
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


}


// ADD/ MANAGER CARETAKERS    SET ROLES TO AVTIVE, APARTMENT ETC


?>
