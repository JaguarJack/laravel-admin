<?php

Route::namespace('Lizyu\\Admin\\Controllers')->middleware(['web'])->group(function(){
    /* IndexController */
    Route::get('index', 'IndexController@index')->middleware('auth:admin');
    Route::get('index/main', 'IndexController@main')->middleware('auth:admin');
    /* LoginController */
    Route::get('login', 'LoginController@showLoginForm');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::post('login', 'LoginController@login')->name('login');
    
    /* UserController */
    Route::resource('user', 'UsersController')->middleware('auth:admin', 'checkPermission');
    Route::post('getUsers', 'UsersController@getUsers');
    Route::post('getRolesOfUser', 'UsersController@getRolesOfUser');
    Route::post('giveRoleToUser', 'UsersController@giveRoleToUser')->middleware('auth:admin', 'checkPermission');
    Route::post('user/changeStatus', 'UsersController@changeStatus')->middleware('auth:admin', 'checkPermission');
    
    /* RolesController */
    Route::resource('role', 'RolesController')->middleware('auth:admin', 'checkPermission');
    Route::post('getLimitRoles', 'RolesController@getLimitRoles')->middleware('auth:admin');
    Route::post('givePermissionsToRole', 'RolesController@givePermissionsToRole')->middleware('auth:admin', 'checkPermission');
    
    /* PermissionsController */
    Route::resource('permission', 'PermissionsController')->middleware('auth:admin', 'checkPermission');
    Route::get('getPermissions', 'PermissionsController@getPermissions')->middleware('auth:admin');
    Route::get('create/{id?}', 'PermissionsController@create')->where(['id' => '[0-9]+'])->middleware('auth:admin');
});
    
