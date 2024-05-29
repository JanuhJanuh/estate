<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = '_property';
    protected $fillable = ['PName', 'Address', 'Units', 'logo'];

    public function allocation()
    {
        return $this->hasOne(ManageMgr::class, 'apartment_id');
    }
}

