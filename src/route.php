<?php

Route::namespace('Lizyu\\Admin\\Controllers')->middleware('web')->group(function(){
    /* IndexController */
    Route::get('index', 'IndexController@index');
    Route::get('index/main', 'IndexController@main');
    
    /* LoginController */
    Route::get('login', 'LoginController@showLoginForm');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::post('login', 'LoginController@login')->name('login');
    
    /* UserController */
    Route::resource('user', 'UsersController')->middleware('checkPermission');
    Route::post('getUsers', 'UsersController@getUsers');
    Route::post('getRolesOfUser', 'UsersController@getRolesOfUser');
    Route::post('giveRoleToUser', 'UsersController@giveRoleToUser')->middleware('checkPermission');
    Route::post('user/changeStatus', 'UsersController@changeStatus')->middleware('checkPermission');
    
    /* RolesController */
    Route::resource('role', 'RolesController')->middleware('checkPermission');
    Route::post('getLimitRoles', 'RolesController@getLimitRoles');
    Route::post('givePermissionsToRole', 'RolesController@givePermissionsToRole')->middleware('checkPermission');
    
    /* PermissionsController */
    Route::resource('permission', 'PermissionsController')->middleware('checkPermission');
    Route::get('getPermissions', 'PermissionsController@getPermissions');
    Route::get('create/{id?}', 'PermissionsController@create')->where(['id' => '[0-9]+']);
});
    
