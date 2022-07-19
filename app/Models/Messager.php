<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messager extends Model
{
    use HasFactory;
    protected $table = 'messager';
    protected $fillable = ['user_id', 'messager','receiver_id','is_seen'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
