<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentBooking extends Model
{
    use HasFactory;

    // Specify the correct table name
    protected $table = 'apartment_booking';

    protected $fillable = [
        'tenant_id',
        'apartment_id',
        'room_id',
        'entry_date',
        'status',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function apartment()
    {
        return $this->belongsTo(Property::class, 'apartment_id');
    }

    public function room()
    {
        return $this->belongsTo(ApartmentRoom::class, 'room_id');
    }

}



