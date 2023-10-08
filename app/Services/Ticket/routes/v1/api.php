<?php

/*
|--------------------------------------------------------------------------
| Service - API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for this service.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Services\Ticket\Http\Controllers\V1\BookingController;
use App\Services\Ticket\Http\Controllers\V1\PlanController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::controller(PlanController::class)
        ->prefix('plans')
        ->group(function () {
            Route::match(['post', 'get'], '/departure-cities', 'getDepartureCities');
            Route::match(['post', 'get'], '/arrival-cities', 'getArrivalCities');
            Route::match(['post', 'get'], '/terminals', 'getTerminals');
        });

    Route::controller(BookingController::class)
        ->group(function () {
            Route::post('plans/{planId}/book', 'store')
                ->whereNumber('planId')
                ->middleware('plan_exists');

//            Route::delete('bookings/{bookId}', 'delete')
//                ->whereNumber('bookId')
//                ->middleware('booking_exists');

        });
});
