<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Client\InterestService;

class InterestController extends Controller
{
	protected $interestService;

	public function __construct(InterestService $interestService)
	{
		$this->interestService = $interestService;
	}

    public function viewInterest()
    {
    	try {
    		$data = $this->interestService->viewInterest();

    		return view('client.pages.interest', $data);
    	} catch (\Exception $e) {
    		return redirect()->route('client.home');
    	}
    	
    }
}
