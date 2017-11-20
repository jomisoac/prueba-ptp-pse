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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/info_pago', 'NuevoPagoController@checkInfoPago')->name('check-pago');
Route::post('/info_pago', 'NuevoPagoController@confirmInfoPago')->name('confirm-pago');

Route::get('/nuevo_pago', 'NuevoPagoController@getBancos')->name('init-new-pago');

Route::post('/nuevo_pago/create_transaction', 'NuevoPagoController@createTransaction')->name('transaction-pago');
