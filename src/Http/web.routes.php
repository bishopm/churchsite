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
    
    // Dashboard
    Route::get('admin', ['uses'=>'Bishopm\Churchsite\Http\Controllers\HomeController@admin','as'=>'dashboard']);

    // Blogs
    Route::get('admin/blogs', ['uses'=>'Bishopm\Churchsite\Http\Controllers\BlogsController@index','as'=>'blogs.index']);
    Route::get('admin/blogs/create', ['uses'=>'Bishopm\Churchsite\Http\Controllers\BlogsController@create','as'=>'blogs.create']);
    Route::get('admin/blogs/{id}/edit', ['uses'=>'Bishopm\Churchsite\Http\Controllers\BlogsController@edit','as'=>'blogs.edit']);
    Route::post('admin/blogs', ['uses'=>'Bishopm\Churchsite\Http\Controllers\BlogsController@store','as'=>'blogs.store']);
    Route::put('admin/blogs/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\BlogsController@update','as'=>'blogs.update']);

    // Series
    Route::get('admin/sermons', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SeriesController@index','as'=>'series.index']);
    Route::get('admin/series/create', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SeriesController@create','as'=>'series.create']);
    Route::get('admin/series/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SeriesController@show','as'=>'series.show']);
    Route::get('admin/series/{id}/edit', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SeriesController@edit','as'=>'series.edit']);
    Route::post('admin/series', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SeriesController@store','as'=>'series.store']);
    Route::put('admin/series/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SeriesController@update','as'=>'series.update']);

    // Sermons
    Route::get('admin/series/{series}/sermons/create', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SermonsController@create','as'=>'sermons.create']);
    Route::get('admin/sermons/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SermonsController@show','as'=>'sermons.show']);
    Route::get('admin/sermons/{id}/edit', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SermonsController@edit','as'=>'sermons.edit']);
    Route::post('admin/sermons', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SermonsController@store','as'=>'sermons.store']);
    Route::put('admin/sermons/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SermonsController@update','as'=>'sermons.update']);    
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/{page?}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\WebController@show','as'=>'pages.show']); 
});
