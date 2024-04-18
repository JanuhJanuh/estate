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

        return redirect('/login');
    }

    public function AddProperty(){
        return view('admin.addproperty');
    }
    public function SaveProperty(Request $request){
        $request->validate([
            'PName' => 'required',
            'Address' => 'required',
            'Units' => 'required',
        ]);

        property::create([
            'PName'=>$request->PName,
            'Address' =>$request->Address,
            'Units' =>$request->Units,
        ]);
        return redirect()->route('admin.property');


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
        //return view('admin.property');

    }


}

?>
