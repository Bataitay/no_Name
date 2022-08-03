<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'customers';
    public $guard = 'customers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'day_of_birth',
        'username',
        'address',
        'gender',
        'province_id',
        'ward_id',
        'district_id',
        'image',
        'phone',
    ];
}
