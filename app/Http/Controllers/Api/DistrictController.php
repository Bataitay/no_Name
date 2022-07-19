<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    public function get_districts_by_province_id($province_id){
        $districts = DB::table('districts')->where('province_id',$province_id)->get();
        return response()->json($districts, 200);
    }
}
