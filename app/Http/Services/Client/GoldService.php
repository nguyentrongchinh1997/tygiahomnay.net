<?php

namespace App\Http\Services\Client;

use App\Model\Gold;
use App\Model\GoldDetail;

class GoldService
{

	protected $goldModel, $goldDetailModel;

	public function __construct(GoldDetail $goldDetailModel, Gold $goldModel)
	{
		$this->goldDetailModel = $goldDetailModel;
		$this->goldModel = $goldModel;
	}

	public function goldView($slug)
	{
		try {
			$gold = $this->goldModel->where('slug', $slug)->first();
			$goldDetail = $this->goldDetailModel->where('gold_id', $gold->id)
												->orderBy('date', 'desc')
												->take(1)
												->first();
			if (isset($goldDetail)) {
				$recentDay = $goldDetail->date;
				$goldDetails = $this->goldDetailModel->where('gold_id', $gold->id)
													 ->where('date', $recentDay)
													 ->get();
				$data = [
					'recent_day_detail' => $goldDetail->updated_at,
					'goldDetails' => $goldDetails,
					'recent_day' => $recentDay,
					'check' => 1,
				];
			} else {
				$data = [
					'recent_day_detail' => '',
					'goldDetails' => '',
					'recent_day' => date('d-m-Y'),
					'check' => 0,
				];
			}
			

			return $data;
		} catch (\Exception $e) {
			return NULL;
		}
	}

	public function goldViewSearch($slug, $date)
	{
		try {
			$gold = $this->goldModel->where('slug', $slug)->first();
			$goldDetail = $this->goldDetailModel->where('gold_id', $gold->id)
									->where('date', $date)
									->take(1)
									->first();
			if (isset($goldDetail)) {
				$goldDetails = $this->goldDetailModel->where('gold_id', $gold->id)
												 	 ->where('date', $date)
												 	 ->get();
				$data = [
					'recent_day_detail' => $goldDetail->updated_at,
					'goldDetails' => $goldDetails,
					'recent_day' => $date,
					'check' => 1
				];
			} else {
				$data = [
					'recent_day_detail' => '',
					'goldDetails' => '',
					'recent_day' => $date,
					'check' => 0
				];
			}	

			return $data;
		} catch (\Exception $e) {
			return NULL;
		}
	}
}
