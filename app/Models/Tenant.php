<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Tenant extends Authenticatable
{
    protected $fillable = [
        'Name', 'IDNumber', 'Gender', 'Phone', 'Email', 'IDImage', 'password', 'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function room()
    {
        return $this->hasOne(ApartmentBooking::class, 'tenant_id')->with('room');
    }

    public function booking()
    {
        return $this->hasOne(ApartmentBooking::class, 'tenant_id')->with(['room', 'apartment']);
    }


    public function property()
    {
        return $this->hasOneThrough(Property::class, ApartmentBooking::class, 'tenant_id', 'id', 'id', 'apartment_id');
    }

}
