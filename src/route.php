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
    Route::resource('user', 'UsersController')->middleware('checkPemrission');
    Route::post('getUsers', 'UsersController@getUsers');
    Route::post('getRolesOfUser', 'UsersController@getRolesOfUser');
    Route::post('giveRoleToUser', 'UsersController@giveRoleToUser')->middleware('checkPemrission');
    Route::post('user/changeStatus', 'UsersController@changeStatus')->middleware('checkPemrission');
    
    /* RolesController */
    Route::resource('role', 'RolesController')->middleware('checkPemrission');
    Route::post('getLimitRoles', 'RolesController@getLimitRoles');
    Route::post('givePermissionsToRole', 'RolesController@givePermissionsToRole')->middleware('checkPemrission');
    
    /* PermissionsController */
    Route::resource('permission', 'PermissionsController')->middleware('checkPemrission');
    Route::get('getPermissions', 'PermissionsController@getPermissions');
    Route::get('create/{id?}', 'PermissionsController@create')->where(['id' => '[0-9]+']);
});
    