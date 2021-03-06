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

Route::get('/', 'TransactionController@index');
Route::post('/transaction', 'TransactionController@store')->name('transaction_store');
Route::get('/transaction/{id}/rollback', 'TransactionController@rollback')->name('transaction_rollback')->where('id','[0-9]+');

Route::get('/{not_route}', function () {
    return redirect('/');
});