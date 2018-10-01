<?php

//Admin routes
Route::group(['middleware' => 'web', 'namespace' => 'Sylain\CyberTrail\Http\Controllers'], function() {

	Route::get('admin', 'AdminController@index')->name('admin_home');

	Route::get('admin/show{slug}', 'AdminController@showTable')->name('admin_showTable');

	Route::get('admin/addNew{slug}/{pid?}', 'AdminController@addToTable')->name('admin_addToTable');

	Route::post('admin/store', 'AdminController@store')->name('admin_store');

	Route::post('admin/edit{slug}', 'AdminController@edit')->name('admin_edit');

	Route::delete('admin/delete/{id}', 'AdminController@delete')->name('admin_delete');

	Route::get('admin/settings', 'AdminController@settings')->name('admin_settings');

	

});

Route::group(['middleware' => 'web', 'namespace' => 'Sylain\CyberTrail\Http'], function() {

	Route::post('admin/addSettings', 'Settings@setTables')->name('admin_addSettings');

	Route::get('admin/getTables', 'Settings@getTables')->name('admin_getTables');

});
