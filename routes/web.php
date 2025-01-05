<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourierController;

Route::resource('couriers', CourierController::class);

Route::get('/', function () {
    return redirect('/couriers');
});
