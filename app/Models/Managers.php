<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Managers extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'Name', 'IDNumber', 'DOB', 'Gender', 'PhoneNo', 'Email', 'Image', 'Address', 'Role', 'Password',
    ];

    protected $hidden = [
        'Password',
    ];

    protected $casts = [
        'DOB' => 'date',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['Password'] = Hash::make($value);
    }

    public function allocation()
    {
        return $this->hasOne(ManageMgr::class, 'manager_id');
    }

    public function apartment()
    {
        return $this->hasOneThrough(
            Property::class,
            ManageMgr::class,
            'manager_id',
            'id',
            'id',
            'apartment_id'
        );
    }
}
