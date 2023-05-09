<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;

Route::middleware(['guest'])->group(function () {
    // Login routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login.post');
});

Route::middleware('auth')->group(function () {

    // Home page routes
    Route::get('/', HomeController::class)->name('home');

    // Select2 input route
    Route::get('select2/{type}', Select2Controller::class)->name('select2');

    //Page routes
    Route::resource('pages', PageController::class);

    //Category routes
    Route::resource('categories', CategoryController::class);

    //Region routes
    Route::resource('regions', RegionController::class);

    //Auction routes
    Route::resource('auctions', AuctionController::class);

    //Advertisement routes
    Route::resource('advertisements', AdvertisementController::class);

    //Slide routes
    Route::resource('slides', SlideController::class);

    //Menu routes
    Route::resource('menus', MenuController::class);

    //Menu item routes
    Route::get('menus/{menu}/order_item', 'MenuController@orderItem')->name('menus.order_item');
    Route::post('menus/{menu}/save_order_item', 'MenuController@saveOrderItem')->name('menus.save_order_item');
    Route::resource('menus.items', MenuItemController::class);

    //Role routes
    Route::resource('roles', RoleController::class);

    //Permission routes
    Route::resource('permissions', PermissionController::class);

    //User routes
    Route::resource('users', UserController::class);

    //Profile routes
    Route::get('profile', 'ProfileController@index')->name('profile');

    // Logout route
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

});
