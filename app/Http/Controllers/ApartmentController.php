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

      public function ShowProperty($Property)
    {
        $property = Property::with(['apartmentRooms.images'])->findOrFail($Property);

        $totalRooms = $property->apartmentRooms->count();
        $vacantRooms = $property->apartmentRooms->where('status', 'vacant')->count();
        $occupiedRooms = $property->apartmentRooms->where('status', 'occupied')->count();
        return view('admin.property_details', compact('property', 'totalRooms', 'vacantRooms', 'occupiedRooms'));
    }



}
