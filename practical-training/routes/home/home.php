<?php

Route::get('/', 'Home\IndexController@index')->name('home.index');

Route::get('/detail/{article}', 'Home\IndexController@detail')->name('home.detail');