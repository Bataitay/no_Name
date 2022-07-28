<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    // protected $primaryKey = ['id'];
    protected $fillable = ['name', 'email', 'phone', 'address'];
    public function categories(){
        return $this->hasMany(Category::class);
    }
}
