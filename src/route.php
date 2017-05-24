<?php

Route::get('region/index', 'RegionController@index');
Route::get('region/city', 'RegionController@getCity');
Route::get('region/county', 'RegionController@getCounty');