<?php
Route::prefix('admin')->group(function () {

    Config::set('auth.defines' . 'admin');
    // adminAuth controller
    Route::get('/login','AdminAuthController@login')->name('get-login');
    Route::post('/login','AdminAuthController@postLogin')->name('post-login');

    Route::get('/forgot/password','AdminAuthController@forgetPassword')->name('forgot-password');
    Route::post('/forgot/password','AdminAuthController@forgetPasswordPost')->name('forgot-password-post');

    Route::get('reset/password/{token}', 'AdminAuthController@reset_password');
    Route::post('reset/password/{token}', 'AdminAuthController@reset_password_final');


    Route::group(['middleware' => 'admin:admin'], function () {

        Route::get('/logout','AdminAuthController@logout')->name('logout');
        // admin controller
         Route::get('/', 'AdminController@index')->name('dashboard');

         //setting controller

        Route::get('/setting','SettingController@index')->name('setting');
        Route::put('setting/done/{id}','SettingController@update')->name('post-setting');


        Route::resource('categories','CategoryController');

        Route::resource('news','NewwController');

        Route::post('/upload/{id}','NewwController@upload')->name('upload-image');
    });
});


?>