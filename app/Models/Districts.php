<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $fillable = ['name', 'gso_id', 'province_id'];
    public function provinces()
    {
        return $this->belongsTo(Prov::class,'district_id','id');
    }
}
