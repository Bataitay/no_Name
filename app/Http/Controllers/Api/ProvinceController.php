<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProvinceController extends Controller
{
    public function get_provinces()
    {
        $districts = DB::table('provinces')->get();

        return response()->json($districts, 200);
    }
}
