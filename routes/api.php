<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/getAuditData', 'AuditController@getAuditData');
Route::get('/getAllTransaction', 'DashboardController@getAllTransactions');
Route::get('ViewMore/{name}','DashboardController@viewMore')->name('ViewMore');



 Route::middleware('cors')->group(function () {
    Route::get('/getRates', 'Rates@getRates');
    Route::get('/getTransactionData/{address}', 'Rates@getTransactionData');            
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
