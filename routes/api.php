<?php

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

Route::resource('drivers', \App\Http\Controllers\DriverController::class)->except('create', 'edit');
Route::resource('shipment-statuses', \App\Http\Controllers\ShipmentStatusController::class)->except('create', 'edit');
Route::resource('shipments', \App\Http\Controllers\ShipmentController::class)->except('create', 'edit', 'destroy');

Route::post('shipments/{shipment}/bids', [\App\Http\Controllers\BidController::class, 'store']);
Route::post('shipments/{shipment}/bids/retract', [\App\Http\Controllers\BidController::class, 'retract']);
Route::post('shipments/{shipment}/bids/accept', [\App\Http\Controllers\BidController::class, 'accept']);
