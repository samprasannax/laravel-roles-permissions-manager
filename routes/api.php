<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

    Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('permissions', 'Admin\PermissionsController');
        Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
        Route::resource('roles', 'Admin\RolesController');
        Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
        Route::resource('users', 'Admin\UsersController');
        Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
    
    }); 
 

});
