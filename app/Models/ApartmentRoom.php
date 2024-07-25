<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'room_type',
        'room_number',
        'charges',
        'status', // Make sure this column is fillable
        'amenities',
        'overview'
    ];

    public function apartment()
    {
        return $this->belongsTo(Property::class, 'apartment_id');
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class, 'apartment_room_id');
    }
}
