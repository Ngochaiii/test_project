<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProducts extends Model
{
    use HasFactory;
    protected $primaryKey = 'cate_id';

    protected $fillable = [
        'name',
        'description',
        'logo',
    ];
    public function products()
    {
        return $this->hasMany(Products::class, 'cate_id');
    }
}
