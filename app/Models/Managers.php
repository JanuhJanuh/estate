<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Managers extends Model
{
    protected $table = 'Managers';
    protected $fillable = [
        'Name',
        'IDNumber',
        'DOB',
        'Gender',
        'PhoneNo',
        'Email',
        'Image',
        'Address',
        'Role',
        'Password',
    ];
    protected $guarded = [];
    protected $primaryKey = 'ID';

    use HasFactory;

    public function property()
    {
        return $this->hasOne(Property::class); // Assuming Property is your property model
    }
}
