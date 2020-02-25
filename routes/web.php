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
//
//Route::get('/', function () {
//    return view('main');
//});

Route::get('/','DashboardController@index')->name('main');
Route::get('Transactions','DashboardController@TransactionHome')->name('Transactions');
//Route::get('ContractTransactions','DashboardController@ContractTransactions')->name('ContractTransactions');
Route::get('TokenTransactions','DashboardController@TokenTransactions')->name('TokenTransactions');
Route::get('SingleTransaction','DashboardController@SingleTransaction')->name('SingleTransaction');
Route::get('ViewMoreContract/{name}','DashboardController@viewMoreContract');


Route::get('ViewMoreToken','DashboardController@viewMoreToken')->name('ViewMoreToken');

Route::get('SingleTokenTransaction/{provider}','DashboardController@SingleTokenTransaction')->name('SingleTokenTransaction');
Route::get('SingleContractTransaction/{provider}','DashboardController@SingleContractTransaction')->name('SingleContractTransaction');
Route::get('SearchedHashTransaction/{provider}','DashboardController@SearchedHashTransaction')->name('SearchedHashTransaction');
Route::get('SearchedBlockTransaction/{provider}','DashboardController@SearchedBlockTransaction')->name('SearchedBlockTransaction');
Route::get('SearchedAccountTransaction/{provider}','DashboardController@SearchedAccountTransaction')->name('SearchedAccountTransaction');
Route::get('NoSearchedTransaction/{provider}','DashboardController@NoSearchedTransaction')->name('NoSearchedTransaction');
Route::get('AccountTransaction','DashboardController@AccountTransaction')->name('AccountTransaction');
Route::get('Block/{provider}','DashboardController@Block')->name('Block');
Route::get('Audit/','AuditController@index')->name('Audit');
Route::get('GoldReserve/','GoldReserveController@index')->name('GoldReserve');
Route::get('GoldRedeem/','GoldRedeemController@index')->name('GoldRedeem');


Route::get('get/block/count',function (){

    return DB::table('contract_transactions')->select(DB::raw('max(blockNumber) as count'))->first()->count;


});
