<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = '_property';
    protected $fillable = ['PName', 'Address', 'Units'];
    protected $guarded = [];

    use HasFactory;

    public function manager()
    {
        return $this->hasOne(Managers::class); //Managers is your manager model
    }
}
