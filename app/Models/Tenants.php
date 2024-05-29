<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Tenant extends Authenticatable
{
    protected $fillable = [
        'Name', 'IDNumber', 'DOB', 'Gender', 'PhoneNo', 'Email', 'Image', 'Address', 'Role', 'Password',
    ];

    protected $hidden = [
        'Password',
    ];

    protected $casts = [
        'DOB' => 'date',
    ];
}
