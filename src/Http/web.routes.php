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

    // Menus
    Route::get('admin/menus', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SitemenusController@index','as'=>'menus.index']);
    Route::get('admin/menus/create', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SitemenusController@create','as'=>'menus.create']);
    Route::get('admin/menus/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SitemenusController@show','as'=>'menus.show']);
    Route::get('admin/menus/{id}/edit', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SitemenusController@edit','as'=>'menus.edit']);
    Route::post('admin/menus', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SitemenusController@store','as'=>'menus.store']);
    Route::put('admin/menus/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\SitemenusController@update','as'=>'menus.update']);

    // Menuitems
    Route::get('admin/menus/{menu}/menuitems', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@index','as'=>'menuitems.index']);
    Route::get('admin/menus/{menu}/menuitems/create', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@create','as'=>'menuitems.create']);
    Route::get('admin/menus/{menu}/menuitems/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@show','as'=>'menuitems.show']);
    Route::get('admin/menus/{menu}/menuitems/{id}/edit', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@edit','as'=>'menuitems.edit']);
    Route::put('admin/menus/{menu}/menuitems/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@update','as'=>'menuitems.update']);
    Route::post('admin/menus/{menu}/menuitems', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@store','as'=>'menuitems.store']);
    Route::post('admin/menus/{menu}/menuitems/update', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@reorder','as'=>'menuitems.reorder']);
    Route::delete('admin/menus/{menu}/menuitems/{menuitem}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\MenuitemsController@destroy','as'=>'menuitems.destroy']);

    // Pages
    Route::get('admin/pages', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagesController@index','as'=>'pages.index']);
    Route::get('admin/pages/create', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagesController@create','as'=>'pages.create']);
    Route::get('admin/pages/{id}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\PagesController@show','as'=>'pages.show']);
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
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/{page?}', ['uses'=>'Bishopm\Churchsite\Http\Controllers\WebController@show','as'=>'pages.show']); 
});
