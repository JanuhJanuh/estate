<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property; // Property Model

class ApartmentController extends Controller
{
    public function Apartments()
    {
        $apartments = Property::with('images')->get();
        return view('apartments', compact('apartments'));
    }


}
