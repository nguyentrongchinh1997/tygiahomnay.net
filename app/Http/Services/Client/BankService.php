<?php

namespace App\Http\Services\Client;

use App\Model\Bank;
use App\Model\ExchangeRate;

class BankService
{
	public function __construct(Bank $bankModel, ExchangeRate $exchangeRateModel)
	{
		$this->bankModel = $bankModel;
		$this->exchangeRateModel = $exchangeRateModel;
	}

	public function bankView($bankName)
	{
		try {
			$bank = $this->bankModel->where('name', $bankName)->first();

			return $bank;
		} catch (\Exception $e) {
			return NULL;
		}
	}

	public function exchangeRate($bankId)
	{
		$date = $this->exchangeRateModel->where('bank_id', $bankId)
												->orderBy('date', 'desc')
												->first();
		$exchangeRate = $this->exchangeRateModel->where('bank_id', $bankId)
												->where('date', $date->date)
												->get();
		$data = [
			'0' => $date,
			'1' => $exchangeRate
		];

		return $data;
	}

	public function exchangeRateDate($bankId, $date)
	{
		$exchange = $this->exchangeRateModel->where('bank_id', $bankId)
												->where('date', $date)
												->first();
		$exchangeRate = $this->exchangeRateModel->where('bank_id', $bankId)
												->where('date', $date)
												->get();
		$data = [
			'0' => $exchange,
			'1' => $exchangeRate
		];
		
		return $data;
	}
}