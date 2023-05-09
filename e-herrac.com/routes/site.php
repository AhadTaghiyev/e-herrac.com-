<?php

use Illuminate\Support\Facades\Route;

// Home page route
Route::get('/', HomeController::class)->name('home');

//Category route
Route::get('catalog/{category}', CategoryController::class)->where('category','^[a-zA-Z0-9-_\/]+$')->name('category');

//Advertisement route
Route::get('advertisement/{category}/{advertisement}', AdvertisementController::class)->where('category','^[a-zA-Z0-9-_\/]+$')->name('advertisement');

//Page routes
Route::get('page/{page}', PageController::class)->name('page');

//Form submit route
Route::post('form/{action}', function($action) {
    return app()->call('App\Http\Controllers\Site\FormController@'.$action);
})->name('form.submit');

