<?php

use App\Models\Depense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\BoatController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItineraryController;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\ReservationController;

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

Route::redirect('/', '/login');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('depenses', DepenseController::class);
    Route::resource('itineraries', ItineraryController::class);
    Route::resource('travels', TravelController::class);
    Route::resource('checkouts', CheckoutController::class);
    Route::resource('places', PlaceController::class);
    Route::resource('counters', CounterController::class);
    Route::resource('boats', BoatController::class);
    Route::resource('reservations', ReservationController::class);
    Route::put('/travels/{id}/canceled', [TravelController::class, 'canceled'])
        ->name('travels.canceled');
    Route::get('/travels/{id}/manifest', [TravelController::class, 'manifest'])
        ->name('travels.manifest');
    Route::get('/travels/{id}/busmanifest', [TravelController::class, 'busmanifest'])
        ->name('travels.busmanifest');
    Route::get('checkoutopeneds', [CheckoutController::class, 'opened'])
        ->name('checkouts.opened');
    Route::get('checkouts/{id}/openedit', [CheckoutController::class, 'openedit'])
        ->name('checkouts.openedit');
    Route::get('checkouts/{id}/{by}/check', [CheckoutController::class, 'check'])
        ->name('checkouts.check');
    Route::put('checkouts/{id}/updateopen', [CheckoutController::class, 'updateopen'])
        ->name('checkoutopens.update');

    Route::get('checkoutcloseds', [CheckoutController::class, 'closed'])
        ->name('checkouts.closed');
    Route::put('checkouts/{id}/close', [CheckoutController::class, 'close'])
        ->name('checkouts.close');
    Route::put('checkouts/{id}/updateclose', [CheckoutController::class, 'updateclose'])
        ->name('checkoutcloses.update');
    Route::get('checkouts/{id}/closeform', [CheckoutController::class, 'closeform'])
        ->name('checkoutcloses.closeform');
    Route::get('checkouts/{id}/show', [CheckoutController::class, 'show'])
        ->name('checkouts.show');
    Route::get('/travels/{id}/postpone', [TravelController::class, 'postpone'])
        ->name('travels.postpone');
    Route::put('/travels/{id}/postponevalidate', [TravelController::class, 'postponevalidate'])
        ->name('travels.postponevalidate');
    Route::get('/reservations/{id}/editPaid', [ReservationController::class, 'editPaid'])
        ->name('reservations.editPaid');;
    Route::put('/reservations/{id}/paid', [ReservationController::class, 'paid'])
        ->name('reservations.paid');
    Route::put('/reservations/{id}/canceled', [ReservationController::class, 'canceled'])
        ->name('reservations.canceled');
    Route::put('/depenses/{id}/action', [DepenseController::class, 'action'])
        ->name('depenses.action');
    Route::get('/dashboard', [DashboardController::class, 'getLastCheckouts'])
        ->name('dashboard.show');
    Route::get('/dashboard/recette', [DashboardController::class, 'getRecette'])
        ->name('dashboard.recette');
    Route::get('/dashboard/decalage', [DashboardController::class, 'getDecalage'])
        ->name('dashboard.decalage');
    Route::get('/dashboard/annulation', [DashboardController::class, 'getAnnulation'])
        ->name('dashboard.annulation');
    Route::get('/dashboard/depense', [DashboardController::class, 'getDepense'])
        ->name('dashboard.depense');
    Route::get('/dashboard/countclient', [DashboardController::class, 'getCountClient'])
        ->name('dashboard.countclient');
    Route::get('/dashboard/graphone', [DashboardController::class, 'getGraphOne'])
        ->name('dashboard.graphone');
    Route::get('/dashboard/graphtwo', [DashboardController::class, 'getGraphTwo'])
        ->name('dashboard.graphtwo');
    Route::get('/placedisponible', [ReservationController::class, 'getEnablePlaceTravel']);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/voyages', [ReservationController::class, 'getTravelsItinerary'])->middleware('auth');
Route::get('generate-pdf', [PDFController::class, 'generatePDF'])
    ->name('generate.pdf');
Route::get('/reservations/{id}/print', [ReservationController::class, 'print'])
    ->name('reservations.print');
