<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Client\BankService;

class BankController extends Controller
{
	protected $bankService;

	public function __construct(BankService $bankService)
	{
		$this->bankService = $bankService;
	}

    public function bankView($bankName, Request $request)
    {
    	$bank = $this->bankService->bankView($bankName);

    	if (!empty($bank)) {
    		if ($request->date) {
    			$date = $request->date;
    			$exchangeRate = $this->bankService->exchangeRateDate($bank->id, $date);
    		} else {
    			$exchangeRate = $this->bankService->exchangeRate($bank->id);
    		}

    		$data = [
    			'date' => $exchangeRate[0],
    			'exchangeRate' => $exchangeRate[1],
    			'bank' => $bank,
    			'check' => count($exchangeRate[1]),
    		];

			return view('client.pages.bank', $data);
    	} else {
    		return redirect()->route('client.home');
    	}
    	
    }

    public function test(Request $request)
    {
    	dd($request->date);
    }
}
