<?php
Route::group(['middleware' => ['api']], function () {
    Route::get('api/videos', ['uses'=>'Bishopm\Churchsite\Http\Controllers\VideosController@live','as'=>'live']);
});
