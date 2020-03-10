<?php

namespace App\Http\Services\Client;

use App\Model\ExchangeRate;
use App\Model\Bank;
use App\Model\GoldToday;

class HomeService
{
	protected $exchangeRateModel, $bankModel, $priceGoldToday;

	public function __construct(ExchangeRate $exchangeRateModel, Bank $bankModel, GoldToday $priceGoldToday)
	{
		$this->exchangeRateModel = $exchangeRateModel;
		$this->bankModel = $bankModel;
		$this->priceGoldToday = $priceGoldToday;
	}

	public function homePage()
	{
		//$number_day_in_month = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
		$priceGoldToday = $this->priceGoldToday->all();
		$dateUpdatePriceGold = $this->priceGoldToday->first();
		$today = date('d');
		$date = date('d-m-Y');
		$currency = $this->exchangeRateModel->where('date', $date)
											->where('currency_name_id', config('config.currency.usd'))
											->get();
		$banks = $this->bankModel->all();
		for ($i = 1; $i <= $today; $i++) {
			if ($i < 10) {
				$i = 0 . $i;
			}
			$Ox[] = $i . '-' . date('m') . '-' . date('Y');
		}
		//dd($Ox);
		$list =array();
		foreach ($Ox as $ox) {
			$exchange = $this->exchangeRateModel->where('date', $ox)
												->where('bank_id', config('config.bank.vietinbank'))
												->where('currency_name_id', config('config.currency.eur'))
												->first();
  			try {
				if (is_numeric($exchange->buy)) {
					$buy1[] = replaceCommaToDot(replaceDot(format($exchange->buy)));
				} else {
					$buy1[] = 0;
				}
				if (is_numeric($exchange->sell)) {
					$sell1[] = replaceCommaToDot(replaceDot(format($exchange->sell)));
				} else {
					$sell1[] = 0;
				}				
			} catch (\Exception $e) {
				$buy1[] = 0;
				$sell1[] = 0;
			}
		}

		$data = [
			'priceGoldToday' => $priceGoldToday,
			'banks' => $banks,
			'buy' => $buy1,
			'sell' => $sell1,
			'Ox' => $Ox,
			'currency' => $currency,
			'dateUpdatePriceGold' => $dateUpdatePriceGold->created_at,
		];

		return $data;
	}
}