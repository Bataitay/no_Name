<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['customer_id','payment_method','status','quantity','note','user_id'];
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function customers()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function order_details()
    {
        return $this->hasMany(Order_detail::class);
    }

}
