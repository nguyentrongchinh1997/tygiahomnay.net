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

	public function getGold($slug)
	{
		$gold = $this->goldModel->where('slug', $slug)->first();

		return $gold;
	}

	public function goldView($goldId, $request, $slug)
	{
		try {
			$goldList = $this->goldModel->all();
			$gold = $this->goldModel->find($goldId);
			if ($request->date) {
				$recentDay = date('Y-m-d', strtotime($request->date));
				$goldDetail = $this->goldDetailModel->where('gold_id', $goldId)
										  	->where('date', $recentDay)
										  	->take(1)
										  	->first();
			} else {
				$goldDetail = $this->goldDetailModel->where('gold_id', $goldId)
										  		->orderBy('date', 'desc')
										  		->take(1)
										  		->first();
				if (isset($goldDetail)) {
					$recentDay = date('d-m-Y', strtotime($goldDetail->date));
				} else {
					$recentDay = date('d-m-Y');
				}
			}
		
			if (isset($goldDetail)) {
				$recentDay = $goldDetail->date;
				$goldDetails = $this->goldDetailModel->where('gold_id', $goldId)
													 ->where('date', $recentDay)
													 ->get();
				$data = [
					'slug' => $slug,
					'goldList' => $goldList,
					'gold' => $gold,
					'recent_day_detail' => $goldDetail->updated_at,
					'goldDetails' => $goldDetails,
					'recent_day' => date('d-m-Y', strtotime($recentDay)),
					'stt' => 0,
					'check' => 1,
				];
			} else {
				$data = [
					'slug' => $slug,
					'goldList' => $goldList,
					'gold' => $gold,
					'recent_day_detail' => date("H:i:s $recentDay"),
					'goldDetails' => '',
					'recent_day' => date('d-m-Y', strtotime($recentDay)),
					'stt' => 0,
					'check' => 0,
				];
			}

			return $data;
		} catch (\Exception $e) {
			return NULL;
		}
	}

	public function sjcView($goldId, $request)
	{
		try {
			if ($request->date) {

				$recentDay = $request->date;
				$goldDetail = $this->goldDetailModel->where('gold_id', $goldId)
										  	->where('date', $recentDay)
										  	->take(1)
										  	->first();
			} else {
				$goldDetail = $this->goldDetailModel->where('gold_id', $goldId)
										  		->orderBy('date', 'desc')
										  		->take(1)
										  		->first();
				if (isset($goldDetail)) {
					$recentDay = $goldDetail->date;
				} else {
					$recentDay = date('d-m-Y');
				}
			}
		
			if (isset($goldDetail)) {
				$recentDay = $goldDetail->date;
				$goldDetails = $this->goldDetailModel->where('gold_id', $goldId)
													 ->where('date', $recentDay)
													 ->get();
				$data = [
					'recent_day_detail' => $goldDetail->updated_at,
					'goldDetails' => $goldDetails,
					'recent_day' => $recentDay,
					'stt' => 0,
					'check' => 1,
				];
			} else {
				$data = [
					'recent_day_detail' => date("H:i:s $recentDay"),
					'goldDetails' => '',
					'recent_day' => $recentDay,
					'stt' => 0,
					'check' => 0,
				];
			}

			return $data;
		} catch (\Exception $e) {
			return NULL;
		}
	}

	public function dojiView($goldId, $request, $slug)
	{
		try {
			$goldList = $this->goldModel->all();
			$gold = $this->goldModel->find($goldId);
			if ($request->date) {
				$recentDay = $request->date;
				$goldDetail = $this->goldDetailModel->where('gold_id', $goldId)
										  	->where('date', $recentDay)
										  	->take(1)
										  	->first();
			} else {
				$goldDetail = $this->goldDetailModel->where('gold_id', $goldId)
										  		->orderBy('date', 'desc')
										  		->take(1)
										  		->first();
				if (isset($goldDetail)) {
					$recentDay = $goldDetail->date;
				} else {
					$recentDay = date('d-m-Y');
				}
			}

			if (isset($goldDetail)) {
				$goldDetails = $this->goldDetailModel->where('gold_id', $goldId)
													 ->where('date', $recentDay)
													 ->get()
													 ->groupBy('type_slug');
				$data = [
					'goldList' => $goldList,
					'slug' => $slug,
					'gold' => $gold,
					'goldId' => $goldId,
					'goldDetails' => $goldDetails,
					'recentDay' => $recentDay,
					'recent_day_detail' => $goldDetail->updated_at,
					'check' => 1,
				];
			} else {
				$data = [
					'goldList' => $goldList,
					'slug' => $slug,
					'gold' => $gold,
					'goldId' => $goldId,
					'goldDetails' => '',
					'recentDay' => $recentDay,
					'recent_day_detail' => date("H:i:s $recentDay"),
					'check' => 0,
				];
			}

			return $data;

		} catch (\Exception $e) {
			return NULL;
		}
		
	}

	public function sjcViewSearch($slug, $date)
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

	public function pnjView($request, $goldId)
	{
		try {
			if ($request->date) {

				$recentDay = $request->date;
				$goldDetail = $this->goldDetailModel->where('gold_id', $goldId)
										  	->where('date', $recentDay)
										  	->take(1)
										  	->first();
			} else {
				$goldDetail = $this->goldDetailModel->where('gold_id', $goldId)
										  		->orderBy('date', 'desc')
										  		->take(1)
										  		->first();
				if (isset($goldDetail)) {
					$recentDay = $goldDetail->date;
				} else {
					$recentDay = date('d-m-Y');
				}
			}
		
			if (isset($goldDetail)) {
				$recentDay = $goldDetail->date;
				$goldDetails = $this->goldDetailModel->where('gold_id', $goldId)
													 ->where('date', $recentDay)
													 ->get();
				$data = [
					'recent_day_detail' => $goldDetail->updated_at,
					'goldDetails' => $goldDetails,
					'recent_day' => $recentDay,
					'stt' => 0,
					'check' => 1,
				];
			} else {
				$data = [
					'recent_day_detail' => date("H:i:s $recentDay"),
					'goldDetails' => '',
					'recent_day' => $recentDay,
					'stt' => 0,
					'check' => 0,
				];
			}

			return $data;
		} catch (\Exception $e) {
			return NULL;	
		}
	}

	public function btmcView($request, $goldId)
	{
		try {
			if ($request->date) {
				$recentDay = $request->date;
				$goldDetail = $this->goldDetailModel->where('gold_id', $goldId)
										  	->where('date', $recentDay)
										  	->take(1)
										  	->first();
			} else {
				$goldDetail = $this->goldDetailModel->where('gold_id', $goldId)
										  		->orderBy('date', 'desc')
										  		->take(1)
										  		->first();
				if (isset($goldDetail)) {
					$recentDay = $goldDetail->date;
				} else {
					$recentDay = date('d-m-Y');
				}
			}
			if (isset($goldDetail)) {
				$recentDay = $goldDetail->date;
				$goldDetails = $this->goldDetailModel->where('gold_id', $goldId)
													 ->where('date', $recentDay)
													 ->get();
				$data = [
					'recent_day_detail' => $goldDetail->updated_at,
					'goldDetails' => $goldDetails,
					'recent_day' => $recentDay,
					'stt' => 0,
					'check' => 1,
				];
			} else {
				$data = [
					'recent_day_detail' => date("H:i:s $recentDay"),
					'goldDetails' => '',
					'recent_day' => $recentDay,
					'stt' => 0,
					'check' => 0,
				];
			}

			return $data;
			
		} catch (\Exception $e) {
			return NULL;
		}
	}

	public function pqView($request, $goldId)
	{
		try {
			if ($request->date) {
				$recentDay = $request->date;
				$goldDetail = $this->goldDetailModel->where('gold_id', $goldId)
										  	->where('date', $recentDay)
										  	->take(1)
										  	->first();
			} else {
				$goldDetail = $this->goldDetailModel->where('gold_id', $goldId)
										  		->orderBy('date', 'desc')
										  		->take(1)
										  		->first();
				if (isset($goldDetail)) {
					$recentDay = $goldDetail->date;
				} else {
					$recentDay = date('d-m-Y');
				}
			}
			if (isset($goldDetail)) {
				$recentDay = $goldDetail->date;
				$goldDetails = $this->goldDetailModel->where('gold_id', $goldId)
													 ->where('date', $recentDay)
													 ->get();
				$data = [
					'recent_day_detail' => $goldDetail->updated_at,
					'goldDetails' => $goldDetails,
					'recent_day' => $recentDay,
					'stt' => 0,
					'check' => 1,
				];
			} else {
				$data = [
					'recent_day_detail' => date("H:i:s $recentDay"),
					'goldDetails' => '',
					'recent_day' => $recentDay,
					'stt' => 0,
					'check' => 0,
				];
			}

			return $data;
			
		} catch (\Exception $e) {
			return NULL;
		}
	}
}
