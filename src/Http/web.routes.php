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

Route::group(['middleware' => ['web','auth']], function () {
    // Logout
    Route::post('logout', ['uses'=>'Bishopm\Churchsite\Http\Controllers\Auth\LoginController@logout','as'=>'logout']);

    Route::get('admin', ['uses'=>'Bishopm\Churchsite\Http\Controllers\HomeController@admin','as'=>'dashboard']);

    // Blogs
    Route::get('admin/blogs', ['uses'=>'Bishopm\Churchsite\Http\Controllers\BlogsController@index','as'=>'blogs.index']);
    Route::get('admin/blogs/create', ['uses'=>'Bishopm\Churchsite\Http\Controllers\BlogsController@create','as'=>'blogs.create']);
    Route::get('admin/blogs/{id}/edit', ['uses'=>'Bishopm\Churchsite\Http\Controllers\BlogsController@edit','as'=>'blogs.edit']);
    Route::post('admin/blogs', ['uses'=>'Bishopm\Churchsite\Http\Controllers\BlogsController@store','as'=>'blogs.store']);
    Route::put('admin/blogs/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\BlogsController@update','as'=>'blogs.update']);

    Route::get('/', ['uses'=>'Bishopm\Churchsite\Http\Controllers\HomeController@home','as'=>'home']); 
});