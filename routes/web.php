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

Route::get('/', 'Client\HomeController@homePage')->name('client.home');

Route::get('ty-gia/{bank}', 'Client\BankController@bankView')->name('client.bank');

Route::group(['prefix' => 'ty-gia'], function(){
	Route::get('{bank}', 'Client\BankController@bankView')->name('client.bank');

	Route::get('export/{date}/{bankId}', 'Client\BankController@export')->name('client.bank.export');
});

Route::get('ngoai-te/{currencyName}', 'Client\CurrencyController@currencyView')->name('client.currency');

Route::group(['prefix' => 'gia-xang-dau'], function(){
	Route::get('petrolimex', 'Client\OilController@petrolimexView')->name('client.oil');
	Route::get('dau-tho', 'Client\OilController@crude')->name('client.crude');
});

Route::get('lai-suat', 'Client\InterestController@viewInterest')->name('client.interest');

Route::group(['prefix' => 'gia-vang'], function(){
	Route::get('{slug}', 'Client\GoldController@goldView')->name('client.gold');
	// Route::get('sjc', 'Client\GoldController@sjcView')->name('client.sjc');

	// Route::get('doji', 'Client\GoldController@dojiView')->name('client.doji');

	// Route::get('pnj', 'Client\GoldController@pnjView')->name('client.pnj');

	// Route::get('bao-tin-minh-chau', 'Client\GoldController@btmcView')->name('client.btmc');

	// Route::get('phu-quy', 'Client\GoldController@pqView')->name('client.pq');
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

		Route::get('pnj', 'Client\CloneController@pnj');

		Route::get('pq', 'Client\CloneController@phuQuy');

		Route::get('btmc', 'Client\CloneController@btmc');
	});

	Route::get('rate', 'Client\CloneController@rate');
});
