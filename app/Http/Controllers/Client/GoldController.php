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
		$gold = $this->goldService->getGold($slug);

		if ($gold->id == config('config.gold.doji')) {
			$data = $this->goldService->dojiView($gold->id, $request, $slug);
		} else {
			$data = $this->goldService->goldView($gold->id, $request, $slug);
		}

		return view('client.pages.golds.' . $gold->symbol, $data);
	}

    public function sjcView(Request $request)
    {
    	$goldId = config('config.gold.sjc');
    	$slug = 'sjc';
    	$data = $this->goldService->sjcView($goldId, $request);

    	return view('client.pages.golds.sjc', $data);
    }

    public function dojiView(Request $request)
    {
    	$goldId = config('config.gold.doji');
    	$slug = 'doji';
    	$data = $this->goldService->dojiView($goldId, $request);

    	return view('client.pages.golds.doji', $data);
    }

    public function pnjView(Request $request)
    {
    	$goldId = config('config.gold.pnj');
    	$data = $this->goldService->pnjView($request, $goldId);

    	return view('client.pages.golds.pnj', $data);
    }

    public function btmcView(Request $request)
    {
    	$goldId = config('config.gold.btmc');
    	$data = $this->goldService->btmcView($request, $goldId);

    	return view('client.pages.golds.btmc', $data);
    }

    public function pqView(Request $request)
    {
    	$goldId = config('config.gold.pq');
    	$data = $this->goldService->pqView($request, $goldId);

    	return view('client.pages.golds.pq', $data);
    }
}
