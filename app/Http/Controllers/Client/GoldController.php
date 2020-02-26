<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Client\GoldService;

class GoldController extends Controller
{
	protected $goldService;

	public function __construct(GoldService $goldService)
	{
		$this->goldService = $goldService;
	}

    public function goldView($slug, Request $request)
    {
    	if ($request->date) {
    		$dataReceive = $this->goldService->goldViewSearch($slug, $request->date);
    	} else {
    		$dataReceive = $this->goldService->goldView($slug);
    	}

    	if (!empty($dataReceive)) {
    		$data = [
    			'stt' => 0,
    			'recent_day' => $dataReceive['recent_day'],
    			'recent_day_detail' => $dataReceive['recent_day_detail'],
    			'goldDetails' => $dataReceive['goldDetails'],
    			'check' => $dataReceive['check'],
    			'slug' => $slug
    		];

    		return view('client.pages.golds.' . $slug, $data);
    	} else {
    		return redirect()->route('client.home');
    	}
    	
    }
}
