<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oder extends Model
{
    use HasFactory;
    protected $table = 'oders';
    public function users(){
        return $this->hasMany(User::class,'user_id','id');
    }
    public function products(){
        return $this->hasMany(Product::class,'product_id', 'id');
    }
}
