<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id', 'room_number', 'type', 'charges', 'is_allocated',
    ];

    public function apartment()
    {
        return $this->belongsTo(Property::class, 'apartment_id');
    }
    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }

}
