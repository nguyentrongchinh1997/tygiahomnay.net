<?php

namespace App\Http\Services\Client;

use App\Model\Oil;

class OilService
{
	protected $oilModel;

	public function __construct(Oil $oilModel)
	{
		$this->oilModel = $oilModel;
	}

	public function petrolimexView()
	{
		try {
			$oil = $this->oilModel->orderBy('created_at', 'desc')->take(1)->first();

			if (isset($oil)) {
				$date = $oil->date;
				$oils = $this->oilModel->where('date', $date)->get();
				$data = [
					'date' => $date,
					'oil' => $oils,
					'check' => count($oils)
				];

				return $data;
			} else {
				return NULL;
			}
		} catch (\Exception $e) {
			return NULL;
		}

	}

	public function petrolimexSearch($date)
	{
		try {
			$oils = $this->oilModel->where('date', $date)->get();
			$data = [
				'date' => $date,
				'oil' => $oils,
				'check' => count($oils),
			];

			return $data;
		} catch (\Exception $e) {
			return NULL;
		}

	}
}