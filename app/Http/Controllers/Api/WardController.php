<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WardController extends Controller
{
    public function get_wards_by_district_id($district_id){
        $districts = DB::table('wards')->where('district_id',$district_id)->get();
        return response()->json($districts, 200);
    }
}
