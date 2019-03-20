<?php

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
Route::group(['middleware' => 'maintannace'], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('main');
});

Route::get('maintance',function (){
    if (setting()->maintenance == '1'){
        return redirect()->route('main');
    }
    return view('maintance');
})->name('maintance');