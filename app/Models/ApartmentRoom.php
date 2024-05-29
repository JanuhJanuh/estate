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
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
