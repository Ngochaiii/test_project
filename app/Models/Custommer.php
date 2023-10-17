<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custommer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'phone',
       'city', 'district',  'specific_address', 'status'
   ];
   const STATUS_DISABLE = 0;
   const STATUS_CANCEL = 2;
    const STATUS_ENABLE = 1;
    const STATUSES_ARR = [
        self::STATUS_DISABLE,
        self::STATUS_ENABLE,
        self::STATUS_CANCEL
    ];

    const STATUSES = [
        self::STATUS_ENABLE => 'Đã gửi mail',
        self::STATUS_DISABLE => 'Chưa gửi mail',
        self::STATUS_CANCEL => 'Hủy liên lạc'
    ];
    public function getStatusNameAttribute()
    {
        return self::STATUSES[$this->status];
    }
}
