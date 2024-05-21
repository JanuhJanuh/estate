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
use App\Models\ManageMgr;


class ManagerController extends Controller
{

    //Apartment Managers CRUD
    public function Managers(){

        $managers = managers::orderBy('id','asc')->get();
        return view('admin.management', compact('managers'));
    }


    public function AddManager(){
        return view('admin.addmanager');
    }

    public function SaveManager(Request $request){
        $request->validate([
            'Name' => 'required',
            'IDNumber' => 'required',
            'DOB' => 'required',
            'Gender' => 'required',
            'PhoneNo' => 'required',
            'Email' => 'required',
            'Image' => 'required',
            'Address' => 'required',

        ]);


        if ($request->hasFile('Image')) {

            $path = $request->file('Image')->store('manager_images', 'public');
        } else {
            $path = null; // Set a default path if no image was uploaded
        };

        $password = 'IDNumber';
        $Role = 'Manager';

        managers::create([
            'Name'=>$request->Name,
            'IDNumber' =>$request->IDNumber,
            'DOB' =>$request->DOB,
            'Gender' =>$request->Gender,
            'PhoneNo' =>$request->PhoneNo,
            'Email' =>$request->Email,
            'Image' =>$path,
            'Address' =>$request->Address,
            'Role' =>$Role,
            'Password' => Hash::make($password),
        ]);


        return redirect()->route('admin.addmanager')->with('success', 'Manager Added successfully!');

}

        public function EditManager($managerid)

        {
        $Manager = managers::Find($managerid);
        return view('admin.editmanager',compact('Manager'));
         }


         public function UpdateManager(Request $request, $managerid){
            $request->validate([
                'Name' => 'required|string|max:255',
                'PhoneNo' => 'required|string|max:20',
                'IDNumber' => 'required|string|max:20',
                'Email' => 'required|email|max:255',
            ]);

            $Manager = managers::find($managerid);
            $Manager->Name = $request->input('Name');
            $Manager->IDNumber = $request->input('IDNumber');
            $Manager->PhoneNo = $request->input('PhoneNo');
            $Manager->Email = $request->input('Email');
            $Manager->save();


            return redirect()->route('admin.managers');
          }

public function AllocateManagerForm( Request $request, $managerid)
{
    $Manager = managers::find($managerid);
    // Assuming you have a Manager model
    $Property = Property::all(); // Assuming you have an Apartment model

    return view('admin.allocate', compact('Manager', 'Property'));



}

public function saveAllocateManager(Request $request, $managerid, $apartmentid)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'start_date' => 'required|date',
        'salary' => 'required|numeric|min:0',
    ]);

    // Check if the manager is already allocated to an apartment
    $existingAllocation = ManageMgr::where('manager_id', $managerid)
        ->where('apartment_id', $apartmentid)
        ->exists();

    if ($existingAllocation) {
        return redirect()->back()->with('error', 'Manager Already allocated to this Apartment!');
    }

    // Create a new allocation record using the validated data
    $allocation = new ManageMgr();
    $allocation->manager_id = $managerid;
    $allocation->apartment_id = $apartmentid;
    $allocation->start_date = $validatedData['start_date'];
    $allocation->salary = $validatedData['salary'];
    $allocation->status = 'Active';
    $allocation->save();


    // Optionally, you can redirect the user or return a response
    return redirect()->back()->with('success', 'Allocation done successfully!');
}


public function viewManagement(Request $request, $managerid) {
    try {
        // Fetch manager details by ID
        $manager = managers::findOrFail($managerid);

        // Fetch allocated apartment and status
        $allocation = ManageMgr::where('manager_id', $managerid)->first();
        //  print($manager);
        //  print($allocation);
        //  exit();

        // Pass manager and allocation data to the view
        return view('admin.managerdetails', ['manager' => $manager, 'allocation' => $allocation]);
    } catch (ModelNotFoundException $e) {
        // Handle manager not found exception
        return response()->back(); // Or return a custom error view
    }
}

    }


