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

    // Images
    Route::post('admin/addimage', ['uses'=>'Bishopm\Churchsite\Http\Controllers\Web\WebController@addimage','as'=>'admin.addimage']);
    Route::post('admin/search', ['uses'=>'Bishopm\Churchsite\Http\Controllers\Web\WebController@search','as'=>'admin.search']);

    // Menuitems
    Route::get('admin/menu', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@index','as'=>'menuitems.index']);
    Route::get('admin/menu/create', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@create','as'=>'menuitems.create']);
    Route::get('admin/menu/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@show','as'=>'menuitems.show']);
    Route::get('admin/menu/{id}/edit', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@edit','as'=>'menuitems.edit']);
    Route::put('admin/menu/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@update','as'=>'menuitems.update']);
    Route::post('admin/menu', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@store','as'=>'menuitems.store']);
    Route::post('admin/menu/update', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@reorder','as'=>'menuitems.reorder']);
    Route::post('admin/menu/delete/{menuitem}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@destroy','as'=>'menuitems.destroy']);

    // Pages
    Route::get('admin/pages', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagesController@index','as'=>'pages.index']);
    Route::get('admin/pages/create', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagesController@create','as'=>'pages.create']);
    Route::get('admin/pages/{id}/edit', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagesController@edit','as'=>'pages.edit']);
    Route::post('admin/pages', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagesController@store','as'=>'pages.store']);
    Route::put('admin/pages/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagesController@update','as'=>'pages.update']);

    // Page widgets
    Route::get('admin/pages/{page}/widgets', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagewidgetsController@index','as'=>'pagewidgets.index']);
    Route::get('admin/pages/{page}/widgets/create', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagewidgetsController@create','as'=>'pagewidgets.create']);
    Route::get('admin/pages/{page}/widgets/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagewidgetsController@show','as'=>'pagewidgets.show']);
    Route::get('admin/pages/{page}/widgets/{id}/edit', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagewidgetsController@edit','as'=>'pagewidgets.edit']);
    Route::post('admin/pages/{page}/widgets/store', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagewidgetsController@store','as'=>'pagewidgets.store']);
    Route::post('admin/pages/{page}/widgets', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagewidgetsController@update','as'=>'pagewidgets.update']);

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

    // Settings
    Route::get('admin/settings', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SettingsController@index','as'=>'settings.index']);
    Route::get('admin/settings/create', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SettingsController@create','as'=>'settings.create']);
    Route::get('admin/settings/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SettingsController@show','as'=>'settings.show']);
    Route::get('admin/settings/{id}/edit', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SettingsController@edit','as'=>'settings.edit']);
    Route::post('admin/settings', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SettingsController@store','as'=>'settings.store']);
    Route::put('admin/settings/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SettingsController@update','as'=>'settings.update']);

    // Themes
    Route::get('admin/themes', ['uses'=>'Bishopm\Churchsite\Http\Controllers\ThemesController@index','as'=>'themes.index']);
    Route::get('admin/themes/create', ['uses'=>'Bishopm\Churchsite\Http\Controllers\ThemesController@create','as'=>'themes.create']);
    Route::get('admin/themes/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\ThemesController@show','as'=>'themes.show']);
    Route::get('admin/themes/{id}/edit', ['uses'=>'Bishopm\Churchsite\Http\Controllers\ThemesController@edit','as'=>'themes.edit']);
    Route::post('admin/themes', ['uses'=>'Bishopm\Churchsite\Http\Controllers\ThemesController@store','as'=>'themes.store']);
    Route::put('admin/themes/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\ThemesController@update','as'=>'themes.update']);

    // Videos
    Route::get('admin/videos', ['uses'=>'Bishopm\Churchsite\Http\Controllers\VideosController@index','as'=>'videos.index']);
    Route::get('admin/videos/create', ['uses'=>'Bishopm\Churchsite\Http\Controllers\VideosController@create','as'=>'videos.create']);
    Route::get('admin/videos/{id}/edit', ['uses'=>'Bishopm\Churchsite\Http\Controllers\VideosController@edit','as'=>'videos.edit']);
    Route::post('admin/videos', ['uses'=>'Bishopm\Churchsite\Http\Controllers\VideosController@store','as'=>'videos.store']);
    Route::put('admin/videos/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\VideosController@update','as'=>'videos.update']);
});

Route::group(['middleware' => ['web']], function () {
    Route::get('blog/{slug}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\BlogsController@show','as'=>'blogs.show']);
    Route::get('live', ['uses'=>'Bishopm\Churchsite\Http\Controllers\VideosController@live','as'=>'site.live']);
    Route::get('meetingroom', ['uses'=>'Bishopm\Churchsite\Http\Controllers\VideosController@jitsi','as'=>'site.jitsi']);
    Route::get('/people/{person}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\WebController@people','as'=>'site.people']);
    Route::get('/subject/{subject}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\WebController@subject','as'=>'site.subject']);
    Route::get('/{page?}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\WebController@show','as'=>'site.show']);
});
