<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Client\OilService;

class OilController extends Controller
{
	protected $oilService;

	public function __construct(OilService $oilService)
	{
		$this->oilService = $oilService;
	}

    public function petrolimexView(Request $request)
    {
    	if ($request->date) {
    		$date = $request->date;
    		$oils = $this->oilService->petrolimexSearch($date);
    	} else {
    		$oils = $this->oilService->petrolimexView();
    	}

    	if (!empty($oils)) {
    		$data = [
				'date' => $oils['date'],
				'oils' => $oils['oil'],
				'check' => $oils['check']
			];

			return view('client.pages.oils.petrolimex', $data);
    	} else {
    		return redirect()->route('client.home');
    	}

		
    }

    public function crude()
    {
    	return view('client.pages.oils.dau_tho');
    }
}
