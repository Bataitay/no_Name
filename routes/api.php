<?php

use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\ProvinceController;
use App\Http\Controllers\Api\WardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/get_districts/{province_id}', [DistrictController::class, 'get_districts_by_province_id']);
Route::get('/get_wards/{district_id}', [WardController::class, 'get_wards_by_district_id']);
Route::get('/get_provinces', [ProvinceController::class, 'get_provinces']);
