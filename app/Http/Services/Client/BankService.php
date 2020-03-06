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

	public function exchangeRate($bankId, $request, $bankName)
	{
		$banks = $this->bankModel->all();
		if ($request->date) {
			$date = $this->exchangeRateModel->where('bank_id', $bankId)
											->where('date', $request->date)
											->first();
		} else {
			$date = $this->exchangeRateModel->where('bank_id', $bankId)
											->orderBy('timestamp', 'desc')
											->take(1)
											->first();
		}

		if (isset($date)) {

			$exchangeRate = $this->exchangeRateModel->where('bank_id', $bankId)
												->where('date', $date->date)
												->get();
			$data = [
				'banks' => $banks,
				'date' => $date->date,
				'updated_at' => $date->updated_at,
				'exchangeRate' => $exchangeRate,
				'check' => count($exchangeRate),
				'bankName' => $bankName,
			];
		} else {
			$data = [
				'banks' => $banks,
				'date' => $request->date,
				'updated_at' => date("H:i:s $request->date"),
				'exchangeRate' => '',
				'check' => 0,
				'bankName' => $bankName,
			];
		}

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