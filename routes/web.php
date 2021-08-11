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
    });

    Route::prefix('/establecimientos') -> middleware('auth:admin') -> group(function(){
        

        Route::get('/', 'PortafolioController@index') -> name('panel.portafolio.index');
        Route::get('/create', 'PortafolioController@create') -> name('panel.portafolio.create');
        Route::put('/create/store', 'PortafolioController@store') -> name('panel.portafolio.store');
        Route::get('/edit/{id}', 'PortafolioController@edit') -> name('panel.portafolio.edit');
        Route::post('/edit/{id}/update', 'PortafolioController@update') -> name('panel.portafolio.update');
        Route::delete('/destroy/{id}', 'PortafolioController@destroy') -> name('panel.portafolio.destroy');
        Route::post('/change/status', 'PortafolioController@changeStatus') -> name('panel.portafolio.status');
        Route::post('/ordenamiento/galeria', 'PortafolioController@ordenamiento') -> name('panel.portafolio.ordenamiento');
        Route::post('/destroy/galeria', 'PortafolioController@destroyImageGallery') -> name('panel.portafolio.destroy.galeria');
    });

    //Noticias
    Route::prefix('/noticias') -> middleware('auth:admin') -> group(function(){
        Route::prefix('/categorias') -> group(function () {
            Route::get('/', 'NoticiasCategoriasController@index') -> name('panel.noticias.categorias.index');
            Route::put('/add', 'NoticiasCategoriasController@store') -> name('panel.noticias.categorias.store');
            Route::post('/update', 'NoticiasCategoriasController@update') -> name('panel.noticias.categorias.update');
            Route::delete('/destroy/{id}', 'NoticiasCategoriasController@destroy') -> name('panel.noticias.categorias.destroy');
        });

        Route::get('/', 'NoticiasController@index') -> name('panel.noticias.index');
        Route::get('/create', 'NoticiasController@create') -> name('panel.noticias.create');
        Route::put('/create/store', 'NoticiasController@store') -> name('panel.noticias.store');
        Route::get('/edit/{id}', 'NoticiasController@edit') -> name('panel.noticias.edit');
        Route::post('/edit/{id}/update', 'NoticiasController@update') -> name('panel.noticias.update');
        Route::delete('/destroy/{id}', 'NoticiasController@destroy') -> name('panel.noticias.destroy');
        Route::post('/change/status', 'NoticiasController@changeStatus') -> name('panel.noticias.status');
    });
});