<?php

namespace App\Http\Services\Client;

use App\Model\CurrencyName;
use App\Model\ExchangeRate;
use App\Model\Bank;

class CurrencyService
{
	protected $currencyModel;

	public function __construct(CurrencyName $currencyModel, ExchangeRate $exchangeRate)
	{
		$this->currencyModel = $currencyModel;
		$this->exchangeRate = $exchangeRate;
	}

	public function currencyView($currencyName, $date)
	{
		try {
			$banks = Bank::all();
			$currencyList = CurrencyName::take(20)->get();
			$timestamp = strtotime($date);
			$currency = $this->currencyModel->where('currency_code', $currencyName)->first();
			$exchangeRate = $this->exchangeRate->where('currency_name_id', $currency->id)
											   ->where('timestamp', $timestamp)
											   ->get();
			$data = [
				'date' => $date,
				'banks' => $banks,
				'currency' => $currency, 
				'exchangeRate' => $exchangeRate, 
				'currencyList' => $currencyList, 
				'currencyName' => $currencyName
			];
			
			return $data;
		} catch (\Exception $e) {
			return NULL;
		}
	}
}