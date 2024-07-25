<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageMgr extends Model
{
    use HasFactory;

    protected $table = 'manage_mgr';

    protected $fillable = [
        'manager_id',
        'apartment_id',
        'start_date',
        'salary',
        'status',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'apartment_id', 'id');
    }


    public function manager()
    {
        return $this->belongsTo(Managers::class, 'manager_id');
    }

    public function apartment()
    {
        return $this->belongsTo(Property::class, 'apartment_id');
    }

}


