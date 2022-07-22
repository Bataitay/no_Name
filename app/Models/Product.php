<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nameVi', 'nameEn', 'quantity', 'description', 'price', 'category_id', 'supplier_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    // public function users(){
    //     return $this->hasMany(Product::class,'product_id', 'id');
    // }
}
