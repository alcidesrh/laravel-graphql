<?php

use App\Models\PriceMinute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\ParkingController;

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
Route::resource('car-type', CarTypeController::class)->only([
    'store', 'update', 'destroy',
]);

Route::resource('parking', ParkingController::class)->only([
    'store', 'update', 'show', 'destroy', 'index'
]);

Route::post('price', function (Request $request) {
    if($price = $request->price){
        return PriceMinute::updateOrCreate([],['price' => $price]);
    }
    return false;
});
