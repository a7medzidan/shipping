<?php


use App\Http\Controllers\Customer\{CustomerController,};
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => 'customer', 'middleware' => 'customer'], function () {
    
    
    
    Route::resource('customers',CustomerController::class);
    });
    ?>