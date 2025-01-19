<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;


Route::group(
    ['prefix' => LaravelLocalization::setLocale() ,'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ] ], function(){

    Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
     Route::get('/', 'WelcomeController@index')->name('welcome');

        //users routes
        Route::resource('users', 'UserController');

        //categories routes
        Route::resource('categories', 'CategoryController');

        //products routes
        Route::resource('products', 'ProductController');


        });//end of dashboard group
    });

