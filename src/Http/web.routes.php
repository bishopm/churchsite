<?php

Route::group(['middleware' => ['web']], function () {
    // Authentication for guests
    Route::get('login', ['uses'=>'Bishopm\Churchsite\Http\Controllers\Auth\LoginController@showLoginForm','as'=>'showlogin']);
    Route::post('login', ['uses'=>'Bishopm\Churchsite\Http\Controllers\Auth\LoginController@login','as'=>'login']);
    Route::post('password/email', ['uses'=>'Bishopm\Churchsite\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail','as'=>'sendResetLinkEmail']);
    Route::get('password/reset', ['uses'=>'Bishopm\Churchsite\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm','as'=>'showLinkRequestForm']);
    Route::post('password/reset', ['uses'=>'Bishopm\Churchsite\Http\Controllers\Auth\ResetPasswordController@reset','as'=>'password.reset']);
    Route::get('password/reset/{token}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\Auth\ResetPasswordController@showResetForm','as'=>'showResetForm']);
});

Route::group(['middleware' => 'web'], function () {
    // Logout
    Route::post('logout', ['uses'=>'Bishopm\Churchsite\Http\Controllers\Auth\LoginController@logout','as'=>'logout']);
});
