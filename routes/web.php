<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

// Panel
Route::get('/', 'AdminController@unauthenticated')->name('panel.admins.unauthenticated');
Route::prefix('/admin')->group(function(){
    Route::get('/', 'AdminController@unauthenticated')->name('panel.admins.unauthenticated');
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showAdminLinkRequestForm')->name('panel.admins.password.reset');
    Route::post('/password/email', 'Auth\ForgotPasswordController@sendAdminResetLinkEmail')->name('panel.admins.password.email');
    Route::post('/login', 'AdminController@login')->name('panel.admins.login');
    Route::post('/logout', 'AdminController@logout')->name('panel.admins.logout');

    //Administradores
    Route::prefix('/cuentas')->middleware('auth:admin')->group(function(){
        Route::prefix('/usuarios')->group(function(){
            Route::get('/', 'AdminController@index')->name('panel.admins.index');
            Route::get('/nuevo', 'AdminController@create')->name('panel.admins.create');
            Route::post('/store', 'AdminController@store')->name('panel.admins.store');
            Route::get('/editar/{id}', 'AdminController@edit')->name('panel.admins.edit');
            Route::put('/update/{id}', 'AdminController@update')->name('panel.admins.update');
            Route::get('/password/editar/{id}', 'AdminController@editPassword')->name('panel.admins.edit.password');
            Route::put('/password/update/{id}', 'AdminController@updatePassword')->name('panel.admins.update.password');
            Route::delete('/destroy/{id}', 'AdminController@destroy')->name('panel.admins.destroy');
        });

        Route::prefix('/roles')->group(function(){
            Route::get('/', 'RoleController@index')->name('panel.roles.index');
            Route::get('/nuevo', 'RoleController@create')->name('panel.roles.create');
            Route::get('/editar/{id}', 'RoleController@edit')->name('panel.roles.edit');
            Route::post('/store', 'RoleController@store')->name('panel.roles.store');
            Route::put('/update/{id}', 'RoleController@update')->name('panel.roles.update');
            Route::delete('/destroy/{id}', 'RoleController@destroy')->name('panel.roles.destroy');
        });
    });

    // Seo
    Route::prefix('/seo')->middleware('auth:admin')->group(function(){
        Route::get('/', 'SettingController@index')->name('panel.seo.index');
        Route::post('/update/{id}', 'SettingController@update')->name('panel.seo.update');
    });

    //Settings
    Route::prefix('/configuracion')->middleware('auth:admin')->group(function(){
        Route::get('/editar/seo', 'SettingController@edit')->name('panel.settings.seo');
        Route::get('/editar/seo/facebook', 'SettingController@facebook')->name('panel.settings.seo.facebook');
        Route::get('/editar/seo/analytics', 'SettingController@analytic')->name('panel.settings.seo.analytic');
        Route::put('/editar/seo', 'SettingController@update')->name('panel.settings.seo.update');
    });

    // Eros - Catalogo
    Route::prefix('/eros') -> middleware('auth:admin') -> group(function(){
        //Establecimientos
        Route::prefix('/establecimientos') -> group(function () {
            Route::get('/', 'EstablecimientoController@index') -> name('panel.eros.establecimientos.index');
            Route::get('/create', 'EstablecimientoController@create') -> name('panel.eros.establecimientos.create');
            Route::put('/create/store', 'EstablecimientoController@store') -> name('panel.eros.establecimientos.store');
            Route::get('/edit/{id}', 'EstablecimientoController@edit') -> name('panel.eros.establecimientos.edit');
            Route::post('/edit/{id}/update', 'EstablecimientoController@update') -> name('panel.eros.establecimientos.update');
            Route::delete('/destroy/{id}', 'EstablecimientoController@destroy') -> name('panel.eros.establecimientos.destroy');
            Route::post('/change/status', 'EstablecimientoController@changeStatus') -> name('panel.eros.establecimiento.status');
        });

        // Categorias
        Route::prefix('/categorias') -> group(function () {
            Route::get('/', 'EstablecimientoCategoriasController@index') -> name('panel.eros.categorias.index');
            Route::put('/add', 'EstablecimientoCategoriasController@store') -> name('panel.eros.categorias.store');
            Route::post('/update', 'EstablecimientoCategoriasController@update') -> name('panel.eros.categorias.update');
            Route::delete('/destroy/{id}', 'EstablecimientoCategoriasController@destroy') -> name('panel.eros.categorias.destroy');
        });

        //Productos
        Route::prefix('/productos') -> group(function () {
            Route::get('/', 'ProductosController@index') -> name('panel.eros.productos.index');
            Route::get('/create', 'ProductosController@create') -> name('panel.eros.productos.create');
            Route::put('/create/store', 'ProductosController@store') -> name('panel.eros.productos.store');
            Route::get('/edit/{id}', 'ProductosController@edit') -> name('panel.eros.productos.edit');
            Route::post('/edit/{id}/update', 'ProductosController@update') -> name('panel.eros.productos.update');
            Route::delete('/destroy/{id}', 'ProductosController@destroy') -> name('panel.eros.productos.destroy');
            Route::post('/change/status', 'ProductosController@changeStatus') -> name('panel.eros.productos.status');
        });

        //Habitaciones
        Route::prefix('/habitaciones') -> group(function () {
            Route::get('/', 'ProductosController@indexHabitaciones') -> name('panel.eros.habitaciones.index');
            Route::get('/create', 'ProductosController@createHabitaciones') -> name('panel.eros.habitaciones.create');
            // Route::put('/create/store', 'ProductosController@store') -> name('panel.eros.habitaciones.store');
            Route::get('/edit/{id}', 'ProductosController@editHabitaciones') -> name('panel.eros.habitaciones.edit');
            // Route::post('/edit/{id}/update', 'ProductosController@update') -> name('panel.eros.habitaciones.update');
            // Route::delete('/destroy/{id}', 'ProductosController@destroy') -> name('panel.eros.habitaciones.destroy');
            // Route::post('/change/status', 'ProductosController@changeStatus') -> name('panel.eros.habitaciones.status');
        });

        // Amenidades
        Route::prefix('/amenidades') -> group(function () {
            Route::get('/', 'AmenidadesController@index') -> name('panel.eros.amenidades.index');
            Route::put('/add', 'AmenidadesController@store') -> name('panel.eros.amenidades.store');
            Route::post('/update', 'AmenidadesController@update') -> name('panel.eros.amenidades.update');
            Route::delete('/destroy/{id}', 'AmenidadesController@destroy') -> name('panel.eros.amenidades.destroy');
        });
    });
});