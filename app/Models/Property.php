<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table ='_property';
    protected $fillabe = [
        'PName',
         'Address',
          'Units'
        ];
     protected $guarded = [];

    use HasFactory;
}
