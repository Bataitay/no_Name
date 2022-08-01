<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

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
