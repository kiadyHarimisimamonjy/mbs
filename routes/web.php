<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoatController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TravelController;
use Illuminate\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('layouts.test', ['name' => 'James']);
});
*/
Route::redirect('/','/login');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('itineraries', ItineraryController::class);
    Route::resource('travels', TravelController::class);
    Route::resource('places', PlaceController::class);
    Route::resource('counters', CounterController::class);
    Route::resource('boats', BoatController::class);
    Route::resource('reservations', ReservationController::class);
    Route::get('/reservations/{id}/editPaid', [ReservationController::class, 'editPaid'])
    ->name('reservations.editPaid');;
    Route::put('/reservations/{id}/paid', [ReservationController::class, 'paid'])
    ->name('reservations.paid');;
    Route::get('/placedisponible', [ReservationController::class, 'getEnablePlaceTravel']);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/voyages', [ReservationController::class, 'getTravelsItinerary'])->middleware('auth');
