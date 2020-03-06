<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Client\CurrencyService;

class CurrencyController extends Controller
{
	protected $currencyService;

	public function __construct(CurrencyService $currencyService)
	{
		$this->currencyService = $currencyService;
	}

    public function currencyView($currencyName)
    {
    	$date = date('d-m-Y');
    	$data = $this->currencyService->currencyView($currencyName, $date);

    	if (!empty($data)) {
    		$data = [
    			'currency' => $data['currency'],
    			'exchangeRate' => $data['exchangeRate'],
    			'currencyName' => $currencyName,
                'date' => $date,
                'currencyList' => $data['currencyList']
    		];

    		return view('client.pages.currency', $data);
    	} else {
    		return redirect()->route('client.home');
    	}
    }
}
