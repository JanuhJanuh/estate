<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentRoom extends Model
{
    use HasFactory;

    // Explicitly specify the correct table name
    protected $table = 'apartment_rooms';

    // Define the fillable fields
    protected $fillable = [
        'apartment_id',
        'room_type',
        'room_number',
        'charges',
        'status', // Indicates whether the room is Occupied or Vacant
        'amenities',
        'overview',
    ];

    // Define the relationship to the Property model
    public function apartment()
    {
        return $this->belongsTo(Property::class, 'apartment_id');
    }

    // Define the relationship to the RoomImage model
    public function images()
    {
        return $this->hasMany(RoomImage::class, 'apartment_room_id');
    }

    // Accessor for room status
    public function getStatusAttribute($value)
    {
        return ucfirst($value); // Capitalizes the first letter of the status
    }

    // Scope for querying available rooms
    public function scopeAvailable($query)
    {
        return $query->where('status', 'Vacant');
    }

    // Enable timestamps if the table has them
    public $timestamps = true;
}
