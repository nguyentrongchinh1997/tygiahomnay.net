<?php

namespace App\Http\Services\Client;

use App\Model\Bank;

class InterestService
{
	protected $bankModel;

	public function __construct(Bank $bankModel)
	{
		$this->bankModel = $bankModel;
	}

	public function viewInterest()
	{
		$banks = $this->bankModel->with(['interest' => function($query){
									$query->oldest('period_id');
								 }])
								->get();
								
		$data = [
			'banks' => $banks,
		];

		return $data;
	}
}