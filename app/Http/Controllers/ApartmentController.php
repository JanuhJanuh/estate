<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property; // Assuming you have an Apartment model

class ApartmentController extends Controller
{
    public function Apartments()
    {
        $apartments = Property::all();
        return view('apartments', compact('apartments'));
    }
}


