<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $table = "users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'role',
        'module'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    const ROLE_MOD = 0;
    const ROLE_ADMIN = 1;
    const ROLES_ARR = [
        self::ROLE_ADMIN,
        self::ROLE_MOD
    ];
    const ROLES = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_MOD => 'Mod'
    ];

    public function getIsActiveNameAttribute()
    {
        return self::ROLES[$this->role];
    }


    const MODULE_PRODUCT = 2;
    const MODULE_CUSTOMER = 3;
    const MODULE_NOMAL =0;
    const MODULE_ADMIN =1 ;
    const MODULES_ARR = [
        self::MODULE_CUSTOMER,
        self::MODULE_PRODUCT,
        self::MODULE_NOMAL,
        self::MODULE_ADMIN,
    ];
    const MODULES = [
        self::MODULE_CUSTOMER => 'Khách hàng',
        self::MODULE_PRODUCT => 'Sản phẩm',
        self::MODULE_NOMAL => 'Người mới',
        self::MODULE_ADMIN => 'Admin'
    ];

    public function getModuleNameAttribute()
    {
        return self::MODULES[$this->module];
    }
}
