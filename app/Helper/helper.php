<?php

namespace App\Helper;

use App\Model\GoldDetail;

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
}