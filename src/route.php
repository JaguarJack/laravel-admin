<?php

Route::namespace('Lizyu\\Admin\\Controllers')->middleware('web', 'checkPemrission')->group(function(){
    Route::get('indexs', 'IndexController@index');
    Route::get('index/main', 'IndexController@main');
    Route::get('login', 'LoginController@showLoginForm');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::post('login', 'LoginController@login')->name('login');
    Route::resource('user', 'UsersController');
    Route::resource('role', 'rolesController');
    Route::resource('permission', 'PermissionsController');
    Route::post('getUsers', 'UsersController@getUsers');
    Route::post('giveRoleToUser', 'UsersController@giveRoleToUser');
    Route::post('delUsers', 'UsersController@delUsers');
    Route::post('user/changeStatus', 'UsersController@changeStatus');
    Route::get('getRoles', 'RolesController@getRoles');
    Route::post('getLimitRoles', 'RolesController@getLimitRoles');
    Route::post('givePermissionsToRole', 'RolesController@givePermissionsToRole');
    
    Route::post('getRolesOfUser', 'UsersController@getRolesOfUser');
    
    Route::get('getPermissions', 'PermissionsController@getPermissions');
    Route::get('permission', 'PermissionsController@index');
    Route::get('create/{id?}', 'PermissionsController@create')->where(['id' => '[0-9]+']);
    Route::post('permission/store', 'PermissionsController@store');
    Route::post('getPermissions', 'PermissionsController@getPermissions');
    Route::post('update', 'PermissionsController@update');
});
