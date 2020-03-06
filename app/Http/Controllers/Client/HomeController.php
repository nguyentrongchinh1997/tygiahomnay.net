<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\UserChart;
use App\Http\Services\Client\HomeService;

class HomeController extends Controller
{
	protected $homeService;

	public function __construct(HomeService $homeService)
	{
		$this->homeService = $homeService;
	}

    public function homePage()
    {
        $html = file_get_html('http://sinhdien.com.vn/vn/');
        $buy_99 = $html->find('.panel-body table tr')[1]->find('td')[1]->plaintext;
        $buy_99 = str_replace('.', '', explode(' ', $buy_99)[0]);
        //dd($buy_99);
        $sell_99 = $html->find('.panel-body table tr')[1]->find('td')[2]->plaintext;
        $sell_99 = str_replace('.', '', explode(' ', $sell_99)[0]);
        $buy_sdj = $html->find('.panel-body table tr')[2]->find('td')[1]->plaintext;
        $buy_sdj = str_replace('.', '', explode(' ', $buy_sdj)[0]);
        $sell_sdj = $html->find('.panel-body table tr')[2]->find('td')[2]->plaintext;
        $sell_sdj = str_replace('.', '', explode(' ', $sell_sdj)[0]);
        $title = $html->find('#kiogoldstatus-home .panel-heading .panel-title')[0]->plaintext;
    	$data = $this->homeService->homePage();
    	$usersChart = new UserChart;
    	$usersChart->barwidth(2);
        $usersChart->labels($data['Ox']); // trục Ox
        $usersChart->displaylegend(false);
        $usersChart->dataset('Bán ra', 'line', $data['sell'])
        		   ->color('#ff6300')
        		   ->fill(false)
        		   ->linetension(0);
        $usersChart->dataset('Mua vào', 'line', $data['buy'])
        		   ->color('#0066b3')
        		   ->fill(false)
        		   ->linetension(0);

    	return view('client.pages.home', 
            [
                'usersChart' => $usersChart, 
                'currency' => $data['currency'],
                'banks' => $data['banks'],
                'buy_99' => $buy_99,
                'sell_99' => $sell_99,
                'buy_sdj' => $buy_sdj,
                'sell_sdj' => $sell_sdj,
                'title' => $title
            ]);
    }
}
