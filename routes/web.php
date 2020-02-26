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
	return view('client.pages.home');
})->name('client.home');
Route::get('ty-gia/{bank}', 'Client\BankController@bankView')->name('client.bank');
Route::get('ngoai-te/{currencyName}', 'Client\CurrencyController@currencyView')->name('client.currency');

Route::group(['prefix' => 'gia-xang-dau'], function(){
	Route::get('petrolimex', 'Client\OilController@petrolimexView')->name('client.oil');
	Route::get('dau-tho', 'Client\OilController@crude')->name('client.crude');
});

Route::group(['prefix' => 'gia-vang'], function(){
	Route::get('{slug}', 'Client\GoldController@goldView')->name('client.gold');
});


Route::group(['prefix' => 'clone'], function(){
	Route::get('all', 'Client\CloneController@all');

	Route::group(['prefix' => 'webgia'], function(){
		Route::get('tpbank', 'Client\CloneController@tpbank');
		Route::get('vietcombank', 'Client\CloneController@vietcombank');
		Route::get('bidv', 'Client\CloneController@bidv');
	});
	Route::get('agribank', 'Client\CloneController@agribank');
	Route::get('sacombank', 'Client\CloneController@sacombank');
	Route::get('techcombank', 'Client\CloneController@techcombank');
	Route::get('vietinbank', 'Client\CloneController@vietinbank');

	Route::get('oil', 'Client\CloneController@oil');

	Route::group(['prefix' => 'gold'], function(){
		Route::get('sjc', 'Client\CloneController@sjc');

		Route::get('doji', 'Client\CloneController@doji');
	});
});
