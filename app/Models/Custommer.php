<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custommer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'phone', 'quantity',
       'city', 'district',  'specific_address', 'pro_image'
   ];
}
