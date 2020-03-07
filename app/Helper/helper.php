<?php

namespace App\Helper;

use App\Model\GoldDetail;
use App\Model\ExchangeRate;

class Helper
{
	public static function type($goldId, $typeSlug, $date)
	{
		$type = GoldDetail::where('gold_id', $goldId)
					->where('type_slug', $typeSlug)
					->where('date', $date)
					->first();

		return $type;
	}

	public static function getPrice($goldId, $date, $typeSlug, $cityId)
	{
		$price = GoldDetail::where('gold_id', $goldId)
							->where('date', $date)
							->where('type_slug', $typeSlug)
							->where('city_id', $cityId)
							->first();

		return $price;
	}

	public static function getExchangeRate($date, $bankId, $currencyId)
	{
		$data = ExchangeRate::where('date', $date)
							->where('bank_id', $bankId)
							->where('currency_name_id', $currencyId)
							->first();

		if (isset($data)) {
			return $data;
		} else if ($bankId == config('config.bank.techcombank')) {
			$data = ExchangeRate::orderBy('created_at', 'desc')
						 		 	 ->where('bank_id', $bankId)
						 		 	 ->where('currency_name_id', 22)
						 		 	 ->first();
			return $data;
		} else {
			$data = ExchangeRate::orderBy('created_at', 'desc')
						 		 	 ->where('bank_id', $bankId)
						 		 	 ->where('currency_name_id', $currencyId)
						 		 	 ->first();
			return $data;
		}
	}
}