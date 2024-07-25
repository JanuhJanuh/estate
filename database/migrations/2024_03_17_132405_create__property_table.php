<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = '_property';

    protected $fillable = [
        'PName', 'PropertyType', 'Address', 'Description', 'Units',
    ];


    public function allocation()
    {
        return $this->hasOne(ManageMgr::class, 'apartment_id');
    }

    public function images()
    {
        return $this->hasMany(PropertyImages::class);
    }

    public function apartmentRooms()
    {
        return $this->hasMany(ApartmentRoom::class, 'apartment_id');
    }
}
