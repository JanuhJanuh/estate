<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageMgr extends Model
{
    use HasFactory;

    protected $table = 'manage_mgr'; // Specify the table name if it differs from the default convention

    // Define fillable attributes if you want to use mass assignment
    protected $fillable = [
        'manager_id',
        'apartment_id',
        'start_date',
        'salary',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'apartment_id', 'id');
    }
}
