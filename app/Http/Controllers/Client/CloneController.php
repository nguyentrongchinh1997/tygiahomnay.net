<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CurrencyName;
use App\Model\ExchangeRate;
use App\Model\Oil;
use App\Model\Gold;
use App\Model\GoldDetail;
use App\Model\City;
use App\Model\Period;
use App\Model\Interest;
use App\Model\Bank;
use App\Model\GoldToday;

class CloneController extends Controller
{
	public function all()
	{
		$this->priceGoldToday();
		$this->sacombank();
		$this->tpbank();
		$this->bidv();
		$this->vietinbank();
		$this->vietcombank();
		$this->techcombank();
		$this->oil();
		$this->sjc();
		$this->doji();
		$this->pnj();
		$this->phuQuy();
		$this->btmc();
		$this->agribank();
	}

	public function priceGoldToday()
	{
		$html = file_get_html('http://sjc.com.vn/giavang/textContent.php');
		$stt = 0;
		GoldToday::getQuery()->delete();
		foreach ($html->find('.bx1 table tr') as $tr) {
			$dem = $stt++;
			if ($dem > 0 && $dem < 10) {
				$this->getDataPriceGoldToday($tr);
			}
		}
	}

	public function getDataPriceGoldToday($tr)
	{
		foreach ($tr->find('td') as $td)
		{
			$list[] = $td->plaintext;
		}

		return GoldToday::create([
			'type' => $list[0],
			'buy' => $list[1],
			'sell' => $list[2],
		]);
	}

    public function agribank()
    {
    	try {
    		$date = date('d-m-Y');
    		$dateDetail = date('Y-m-d H:i:s');
	    	$year = date('Y');
	    	$html = file_get_html("https://www.agribank.com.vn/wcm/connect/ttkhac/ty-gia/$year/$date?source=library&srv=cmpnt&cmpntid=b42b798a-7057-49c3-b0fd-3766e30729cf");
	    	$timestamp = strtotime($date);
	    	$bankId = config('config.bank.agribank');
	    	$check = $this->check($date, $bankId);
	    	$stt = 0;
	    	$list = array();

	    	if (count($check) > 0) {
	    		foreach ($html->find('table.table.table-bordered.table-striped tr') as $tr) {
		    		if ($stt > 0 && $stt <= 12) {
						foreach ($tr->find('td') as $key => $td) {
							$code = $tr->find('td')[0]->plaintext; // mã tỷ giá
							$buy = replaceComma($tr->find('td')[1]->plaintext, 2); // mua
							$transfer = replaceComma($tr->find('td')[2]->plaintext, 2); // chuyển khoản 
							$sell = replaceComma($tr->find('td')[3]->plaintext, 2); // bán
						}
						$currencyId = CurrencyName::where('currency_code', $code)->first()->id;
						$this->updateExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, '', $timestamp, $date, $dateDetail);
					}
					$stt++;
		    	}
		    	echo "Cập nhật thành công";
	    	} else {
	    		foreach ($html->find('table.table.table-bordered.table-striped tr') as $tr) {
		    		if ($stt > 0 && $stt <= 12) {
						foreach ($tr->find('td') as $key => $td) {
							$code = $tr->find('td')[0]->plaintext; // mã tỷ giá
							$buy = replaceComma($tr->find('td')[1]->plaintext, 2); // mua
							$transfer = replaceComma($tr->find('td')[2]->plaintext, 2); // chuyển khoản 
							$sell = replaceComma($tr->find('td')[3]->plaintext, 2); // bán
						}
						$currencyId = CurrencyName::where('currency_code', $code)->first()->id;
						$this->insertExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, '', $timestamp, $date);
					}
					$stt++;
		    	}
		    	echo "Thêm thành công";
	    	}
    	} catch (\Exception $e) {
    		echo "Thêm thất bại";
    	}
    }

    public function check($date, $bankId)
    {
    	$check = ExchangeRate::where('date', $date)
    						->where('bank_id', $bankId)
    						->get();
    	return $check;
    }

    public function sacombank()
    {
    	$html = file_get_html('https://www.sacombank.com.vn/company/Pages/ty-gia.aspx');
    	$date = date('d-m-Y');
    	$dateDetail = date('Y-m-d H:i:s');
    	$timestamp = strtotime($date);
    	$bankId = config('config.bank.sacombank');
    	$check = $this->check($date, $bankId);
    	$list = array();
    	$listArray = array();

    	if (count($check) > 0) {
    		$listArray = $this->arrayDataSacombank($html, $listArray);
    		$count = count($listArray);
	    	for ($i = 0; $i < $count; $i++) {
	    		$currencyId = CurrencyName::where('currency_code', trim($listArray[$i][0]))->first()->id;
	    		
	    		$this->updateExchangeRate($currencyId, $bankId, $listArray[$i][1], $listArray[$i][2], $listArray[$i][3], $listArray[$i][4], $timestamp, $date, $dateDetail);
	    	}

    		echo "Cập nhật thành công sacombank" . '<br>';
    	} else {
    		$listArray = $this->arrayDataSacombank($html, $listArray);
	    	$count = count($listArray);
	    	for ($i = 0; $i < $count; $i++) {
	    		$currencyId = CurrencyName::where('currency_code', trim($listArray[$i][0]))->first()->id;
	    		
	    		$this->insertExchangeRate($currencyId, $bankId, $listArray[$i][1], $listArray[$i][2], $listArray[$i][3], $listArray[$i][4], $timestamp, $date);
	    	}
	    	echo "Thêm thành công sacombank" . '<br>';
    	}
    }

    public function arrayDataSacombank($html, $listArray)
    {
    	foreach ($html->find('#bdUSDG7 .table .tr-items') as $tr) {
			$listArray[] = $this->getDataSacombank($tr);
    	}
    	foreach ($html->find('#bdOther .table .tr-items') as $tr) {
			$listArray[] = $this->getDataSacombank($tr);
    	}

    	return $listArray;
    }

    public function getDataSacombank($tr)
    {
    	foreach ($tr->find('td') as $key => $td) {
			$code = $tr->find('td')[0]->plaintext; // mã tỷ giá
			$buy = replaceDot($tr->find('td')[1]->plaintext); // mua
			$transfer = replaceDot($tr->find('td')[2]->plaintext); // mua chuyển khoản
			$sell = replaceDot($tr->find('td')[4]->plaintext); // bán
			$sellTransfer = replaceDot($tr->find('td')[3]->plaintext);
			$list = [$code, $buy, $transfer, $sell, $sellTransfer];
		}

		return $list;
    }

    public function techcombank()
    {	
    	$date = date('d-m-Y');
    	$dateDetail = date('Y-m-d H:i:s');
    	$dateFormat = date('d/m/Y', strtotime($date));
    	$html = file_get_html('https://www.techcombank.com.vn/customfield/findexchange?catId=234&date=' . $dateFormat);
    	$timestamp = strtotime($date);
    	$bankId = config('config.bank.techcombank');
    	$check = $this->check($date, $bankId);
    	$stt = 0;

    	if (count($check) > 0) {
    		foreach ($html->find('.table-responsive table tr') as $tr) {
	    		if ($stt > 3 && $stt <= 33 && ($stt%2 == 0)) {
					foreach ($tr->find('td') as $key => $td) {
						$code = $tr->find('td')[0]->plaintext; // mã tỷ giá
						$buy = replaceComma(str_replace('&nbsp;', '', $tr->find('td')[1]->plaintext)); // mua
						$transfer = replaceComma(str_replace('&nbsp;', '', $tr->find('td')[2]->plaintext)); // chuyển khoản 
						$sell = replaceComma(str_replace('&nbsp;', '', $tr->find('td')[3]->plaintext)); // bán
					}
					$currencyId = CurrencyName::where('currency_code', $code)->first()->id;
					$this->updateExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, '',$timestamp, $date, $dateDetail);
				}
				$stt++;
	    	}
	    	echo "Cập nhật thành công techcombank <br>";
    	} else {
    		foreach ($html->find('.table-responsive table tr') as $tr) {
	    		if ($stt > 3 && $stt <= 33 && ($stt%2 == 0)) {
					foreach ($tr->find('td') as $key => $td) {
						$code = $tr->find('td')[0]->plaintext; // mã tỷ giá
						$buy = replaceComma(str_replace('&nbsp;', '', $tr->find('td')[1]->plaintext)); // mua
						$transfer = replaceComma(str_replace('&nbsp;', '', $tr->find('td')[2]->plaintext)); // chuyển khoản 
						$sell = replaceComma(str_replace('&nbsp;', '', $tr->find('td')[3]->plaintext)); // bán
					}
					$currencyId = CurrencyName::where('currency_code', $code)->first()->id;
					$this->insertExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, '',$timestamp, $date);
				}
				$stt++;
	    	}
	    	echo "Thêm thành công techcombank<br>";
	    }
    }

    public function vietinbank()
    {
    	$date = date('d-m-Y');
    	$dateDetail = date('Y-m-d H:i:s');
    	$dateFormat = date('d/m/Y', strtotime($date));
    	$html = file_get_html('https://www.vietinbank.vn/web/home/vn/ty-gia/?theDate=' . $dateFormat);
    	$timestamp = strtotime($date);
    	$bankId = config('config.bank.vietinbank');
    	$check = $this->check($date, $bankId);
    	$stt = 0;
    	$list = $listArray = array();

    	if (count($check) > 0) {
    		foreach ($html->find('.exTbl tr') as $tr) {
	    		if ($stt > 1 && $stt < 20 && $stt != 8) {
					foreach ($tr->find('td') as $key => $td) {
						$code = $tr->find('td')[0]->plaintext; // mã tỷ giá
						$buy = replaceComma(str_replace('#', '', $tr->find('td')[2]->plaintext)); // mua
						$transfer = replaceComma($tr->find('td')[3]->plaintext); // chuyển khoản 
						$sell = replaceComma($tr->find('td')[4]->plaintext); // bán
					}
					$currencyId = CurrencyName::where('currency_code', $code)->first()->id;
					$this->updateExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, '', $timestamp, $date, $dateDetail);
				}
				$stt++;
	    	}

	    	echo "Cập nhật thành công vietinbank<br>";
    	} else {
    		foreach ($html->find('.exTbl tr') as $tr) {
	    		if ($stt > 1 && $stt < 20 && $stt != 8) {
					foreach ($tr->find('td') as $key => $td) {
						$code = $tr->find('td')[0]->plaintext; // mã tỷ giá
						$buy = replaceComma(str_replace('#', '', $tr->find('td')[2]->plaintext)); // mua
						$transfer = replaceComma($tr->find('td')[3]->plaintext); // chuyển khoản 
						$sell = replaceComma($tr->find('td')[4]->plaintext); // bán
					}
					$currencyId = CurrencyName::where('currency_code', $code)->first()->id;
					$this->insertExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, '', $timestamp, $date);
				}
				$stt++;
	    	}
	    	echo "Thêm thành công vietinbank<br>";
	    }
    }

/*Không có lịch sử tỷ giá trong trang webgia.com*/
	public function tpbank()
	{
		$html = file_get_html('https://webgia.com/ty-gia/tpbank/');
		$dateFind = $html->find('#main .h-head small')[0]->plaintext;
    	$dateReplaceFirst = str_replace('- Cập nhật lúc ', '', $dateFind);
    	$dateReplaceSecond = str_replace('/', '-', $dateReplaceFirst);
    	$date = date('d-m-Y', strtotime($dateReplaceSecond));
    	$dateDetail = date('Y-m-d H:i:s');
    	$timestamp = strtotime($date);
    	$bankId = config('config.bank.tpbank');
    	$check = $this->check($date, $bankId);
    	$stt = 0;
    	$result = $this->getDataTpBank($check, $html, $stt, $date, $timestamp, $bankId, $dateDetail);

    	echo $result;
	}

	public function bidv()
    {
    	$html = file_get_html('https://webgia.com/ty-gia/bidv/');
		$dateFind = $html->find('#main .h-head small')[0]->plaintext;
    	$dateReplaceFirst = str_replace('- Cập nhật lúc ', '', $dateFind);
    	$dateReplaceSecond = str_replace('/', '-', $dateReplaceFirst);
    	$date = date('d-m-Y', strtotime($dateReplaceSecond));
    	$dateDetail = date('Y-m-d H:i:s');
    	$timestamp = strtotime($date);
    	$bankId = config('config.bank.bidv');
    	$check = $this->check($date, $bankId);
    	$stt = 0;
    	$result = $this->getDataBidv($check, $html, $stt, $date, $timestamp, $bankId, $dateDetail);

    	echo $result;
    }

    public function getDataBidv($check, $html, $stt, $date, $timestamp, $bankId, $dateDetail) {
    	if (count($check) > 0) {
    		foreach ($html->find('.table-responsive table tr') as $tr) {
	    		if ($stt > 1) {
					foreach ($tr->find('th') as $key => $td) {
						$code = $tr->find('th')[0]->plaintext; // mã tỷ giá
					}
					foreach ($tr->find('td') as $key => $td) {
						$buy = $tr->find('td')[0]->plaintext; // mua
						$transfer = $tr->find('td')[1]->plaintext; // chuyển khoản 
						$sell = $tr->find('td')[2]->plaintext; // bán
					}
					$currencyId = CurrencyName::where('currency_code', $code)->first()->id;
					$this->updateExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, '', $timestamp, $date, $dateDetail);
				}
				$stt++;
	    	}

    		return "Cập nhật thành công BIDV <br>";
    	} else {
    		foreach ($html->find('.table-responsive table tr') as $tr) {
	    		if ($stt > 1) {
					foreach ($tr->find('th') as $key => $td) {
						$code = $tr->find('th')[0]->plaintext; // mã tỷ giá
					}
					foreach ($tr->find('td') as $key => $td) {
						$buy = $tr->find('td')[0]->plaintext; // mua
						$transfer = $tr->find('td')[1]->plaintext; // chuyển khoản 
						$sell = $tr->find('td')[2]->plaintext; // bán
					}
					$currencyId = CurrencyName::where('currency_code', $code)->first()->id;
					$this->insertExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, '', $timestamp, $date);
				}
				$stt++;
	    	}
	    	return "Thêm thành công BIDV<br>";
	    }
    }

    public function getDataTpBank($check, $html, $stt, $date, $timestamp, $bankId, $dateDetail)
    {
    	if (count($check) > 0) {
    		foreach ($html->find('.table-responsive table tr') as $tr) {
	    		if ($stt > 1) {
					foreach ($tr->find('th') as $key => $td) {
						$code = $tr->find('th')[0]->plaintext; // mã tỷ giá
					}
					foreach ($tr->find('td') as $key => $td) {
						$buy = $tr->find('td')[0]->plaintext; // mua
						$transfer = $tr->find('td')[1]->plaintext; // chuyển khoản 
						$sell = $tr->find('td')[2]->plaintext; // bán
						//$list = [$code, $buy, $transfer, $sell];
					}
					$currencyId = CurrencyName::where('currency_code', $code)->first()->id;
					$this->updateExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, '', $timestamp, $date, $dateDetail);
				}
				$stt++;
	    	}

	    	return "Cập nhật thành công TPbank<br>";
    	} else {
    		foreach ($html->find('.table-responsive table tr') as $tr) {
	    		if ($stt > 1) {
					foreach ($tr->find('th') as $key => $td) {
						$code = $tr->find('th')[0]->plaintext; // mã tỷ giá
					}
					foreach ($tr->find('td') as $key => $td) {
						$buy = $tr->find('td')[0]->plaintext; // mua
						$transfer = $tr->find('td')[1]->plaintext; // chuyển khoản 
						$sell = $tr->find('td')[2]->plaintext; // bán
						//$list = [$code, $buy, $transfer, $sell];
					}
					$currencyId = CurrencyName::where('currency_code', $code)->first()->id;
					$this->insertExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, '', $timestamp, $date);
				}
				$stt++;
	    	}
	    	return "Thêm thành công TPbank<br>";
	    }
    }
/*end*/

/*Có lịch sử tỷ giá trong trang webgia.com*/
    public function vietcombank()
    {
    	$date = date('01-m-Y');
    	$dateDetail = date('Y-m-01 H:i:s');
    	$html = file_get_html('https://webgia.com/ty-gia/vietcombank/' . $date . '.html');
    	$timestamp = strtotime($date);
    	$bankId = config('config.bank.vietcombank');
    	$check = $this->check($date, $bankId);
    	$stt = 0;

    	if (count($check) > 0) {
    		foreach ($html->find('article#main table tr') as $tr) {
	    		if ($stt > 0 && $stt < 21) {
					foreach ($tr->find('th') as $key => $td) {
						$code = $tr->find('th')[0]->plaintext; // mã tỷ giá
					}
					foreach ($tr->find('td') as $key => $td) {
						$buy = $tr->find('td')[1]->plaintext; // mua
						$transfer = $tr->find('td')[2]->plaintext; // chuyển khoản
						$sell = $tr->find('td')[3]->plaintext; // bán
						//$list = [$code, $buy, $transfer, $sell];
					}
					$currencyId = CurrencyName::where('currency_code', $code)->first()->id;
					$this->updateExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, '', $timestamp, $date, $dateDetail);
				}
				$stt++;
	    	}
	    	echo "Cập nhật thành công vietcombank<br>";
    	} else {
    		foreach ($html->find('article#main table tr') as $tr) {
	    		if ($stt > 0 && $stt < 21) {
					foreach ($tr->find('th') as $key => $td) {
						$code = $tr->find('th')[0]->plaintext; // mã tỷ giá
					}
					foreach ($tr->find('td') as $key => $td) {
						$buy = $tr->find('td')[1]->plaintext; // mua
						$transfer = $tr->find('td')[2]->plaintext; // chuyển khoản
						$sell = $tr->find('td')[3]->plaintext; // bán
						//$list = [$code, $buy, $transfer, $sell];
					}
					$currencyId = CurrencyName::where('currency_code', $code)->first()->id;
					$this->insertExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, '', $timestamp, $date, $dateDetail);
				}
				$stt++;
	    	}
	    	echo "Thêm thành công vietcombank<br>";
	    }
    }
/*end*/

    public function insertExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, $sellTransfer, $timestamp, $date)
    {
    	return ExchangeRate::create([
					'currency_name_id' => $currencyId,
					'bank_id' => $bankId,
					'buy' => $buy,
					'transfer' => $transfer,
					'sell' => $sell,
					'sell_transfer' => $sellTransfer,
					'timestamp' => $timestamp,
					'date' => $date
				]);
    }

    public function updateExchangeRate($currencyId, $bankId, $buy, $transfer, $sell, $sellTransfer, $timestamp, $date, $updated_at)
    {
    	ExchangeRate::updateOrCreate(
    		[
    			'bank_id' => $bankId,
    			'date' => $date,
    			'currency_name_id' => $currencyId,
    		],
    		[
    			'buy' => $buy,
				'transfer' => $transfer,
				'sell' => $sell,
				'sell_transfer' => $sellTransfer,
				'updated_at' => $updated_at
    		]
    	);
    }

    public function oil()
    {
    	try {
    		$html = file_get_html('https://www.petrolimex.com.vn/');
	    	$date = date('d-m-Y');
	    	$check = Oil::where('date', $date)->first();

	    	if (isset($check)) {
	    		echo "Dữ liệu ngày này đã được thêm";
	    	} else {
	    		foreach ($html->find('#vie_p6_PortletContent .list-table>div') as $div) {
		    		foreach ($div->find('div') as $key => $row) {
		    			$name = $div->find('div')[0]->plaintext;
		    			$price1 = $div->find('div')[1]->plaintext;
		    			$price2 = $div->find('div')[2]->plaintext;
		    		}
		    		$this->insertOil($name, $price1, $price2, $date);
		    	}
	    	}
	    	echo "Thêm thành công dầu<br>";
    	} catch (\Exception $e) {
    		echo "Thêm thất bại dầu<br>";
    	}
    }

    public function insertOil($name, $price1, $price2, $date)
    {
    	return Oil::create([
    		'oil_name' => $name,
    		'price_1' => $price1,
    		'price_2' => $price2,
    		'date' => $date
    	]);
    }

    public function checkCity($slug, $name)
    {
    	$city = City::where('slug', $slug)->first();
    	if (empty($city)) {
    		$city = City::create([
    			'name' => $name,
    			'slug' => $slug
    		]);
    	}

    	return $city;
    }

    public function insertGoldTable($data, $date, $goldId)
    {
    	$listArray = $array = array();
    	$name = $data['name'];
    	$slug = str_slug($name);
    	$item = $data->item;
    	$city = $this->checkCity($slug, $name);

    	for ($i = 0; $i < count($item); $i++) {
    		GoldDetail::create(
	    		[
	    			'buy' => $item[$i]['buy'],
	    			'sell' => $item[$i]['sell'],
	    			'type' => $item[$i]['type'],
	    			'type_slug' => str_slug($item[$i]['type']),
	    			'gold_id' => $goldId,
	    			'date' => $date,
	    			'city_id' => $city->id,
	    		]
	    	);
    	}
    }

    public function sjc()
    {
    	try {
    		$stt = 0;
	    	$url = "http://www.sjc.com.vn/xml/tygiavang.xml";
	      	$xml = simplexml_load_file($url);
	      	$time = ($xml->ratelist)['updated'];
	      	$date = str_replace('/', '-', explode(' ', $time)[2]);
	      	$date = date('Y-m-d', strtotime($date));
	      	$goldId = config('config.gold.sjc');
	      	$check = $this->checkSJC($date, $goldId);

	      	if ($check > 0) {
	      		GoldDetail::where('date', $date)->where('gold_id', $goldId)->delete();
	      		foreach ($xml->ratelist->city as $key => $item) {
		      		$this->insertGoldTable(($xml->ratelist->city)[$stt], $date, $goldId);
		      		$stt++;
		      	}
		      	echo "Cập nhật thành công vàng sjc<br>";
	      	} else {
	      		foreach ($xml->ratelist->city as $key => $item) {
		      		$this->insertGoldTable(($xml->ratelist->city)[$stt], $date, $goldId);
		      		$stt++;
		      	}
		      	echo "Thêm thành công vàng sjc<br>";
	      	}
    	} catch (\Exception $e) {
    		echo "Lỗi";
    	}

    }

    public function checkSJC($date, $goldId)
    {
    	$check = GoldDetail::where('date', $date)->where('gold_id', $goldId)->get();

    	return count($check);
    }

    public function doji()
    {
    	try {
    		$html = file_get_html('https://webgia.com/gia-vang/doji/');
	    	$stt = 0;
	    	$goldId= config('config.gold.doji');
	    	$date = date('Y-m-d');
	    	$check = $this->checkSJC($date, $goldId);

	    	if ($check > 0) {
	    		GoldDetail::where('date', $date)->where('gold_id', $goldId)->delete();
	    		$this->insertDoji($html, $stt, $goldId, $date);

	    		echo "Cập nhật thành công vàng doji<br>";
	    	} else {
	    		$this->insertDoji($html, $stt, $goldId, $date);

	    		echo "Thêm thành công vàng doji<br>";
	    	}
    	} catch (\Exception $e) {
    		echo "Lỗi";
    	}    	
    }

    public function insertDoji($html, $stt, $goldId, $date)
    {
    	foreach ($html->find('.table-responsive table tr') as $tr) {
    		if ($stt > 1) {
    			foreach ($tr->find('td') as $item) {
    				$type = $tr->find('td')[0]->plaintext;
    				$buyHN = $tr->find('td')[1]->plaintext;
    				$sellHN = $tr->find('td')[2]->plaintext;
    				$buyDN = $tr->find('td')[3]->plaintext;
    				$sellDN = $tr->find('td')[4]->plaintext;
    				$buyHCM = $tr->find('td')[5]->plaintext;
    				$sellHCM = $tr->find('td')[6]->plaintext;
    			}
    			$this->insertDojiHN($type, $buyHN, $sellHN, $buyDN, $sellDN, $buyHCM, $sellHCM, $goldId, $date);
    		}
    		$stt++;
	    }
    }

    public function insertGoldDetail($cityId, $type, $buy, $sell, $goldId, $date, $updated_at)
    {
    	return GoldDetail::create(
			[
				'city_id' => $cityId,
				'type' => $type,
				'type_slug' => str_slug($type),
				'buy' => $buy,
				'sell' => $sell,
				'gold_id' => $goldId,
				'date' => $date,
				'updated_at' => $updated_at
			]
		);
    }

    public function insertDojiHN($type, $buyHN, $sellHN, $buyDN, $sellDN, $buyHCM, $sellHCM, $goldId, $date)
    {
    	$updated_at = date('Y-m-d H:i:s');
    	$this->insertGoldDetail(2, $type, $buyHN, $sellHN, $goldId, $date, $updated_at);
    	$this->insertGoldDetail(3, $type, $buyDN, $sellDN, $goldId, $date, $updated_at);
    	$this->insertGoldDetail(1, $type, $buyHCM, $sellHCM, $goldId, $date, $updated_at);
    }

    public function pnj()
    {
    	$html = file_get_html('https://vangmieng.pnj.com.vn/');
    	$stt = 0;
    	$goldId = config('config.gold.pnj');
    	$time = trim($html->find('.portlet-body table tr')[1]->find('td')[4]->plaintext);
    	$dateFormat = str_replace('/', '-', $time);
    	$date = date('Y-m-d', strtotime($dateFormat));
    	$updated_at = date('Y-m-d H:i:s', strtotime($dateFormat));
    	$check = $this->checkSJC($date, $goldId);

    	if ($check > 0) {
    		GoldDetail::where('gold_id', $goldId)->where('date', $date)->delete();
    		$this->getDataPNJ($html, $stt, $date, $updated_at, $goldId);

    		echo "Cập nhật thành công vàng pnj<br>";
    		
    	} else {
    		$this->getDataPNJ($html, $stt, $date, $updated_at, $goldId);

    		echo "Thêm thành công vàng pnj<br>";
    	}
    }

    public function getDataPNJ($html, $stt, $date, $updated_at, $goldId)
    {
    	foreach ($html->find('.portlet-body table tr') as $tr) {
    		$dem = $stt;
    		if ($dem > 0 && $dem < 4 ) {
    			$this->insertPNJ($tr, $goldId, config('config.city.hcm'), $dem, 1, $date, $updated_at);
    		} 
    		else if ($dem > 3 && $dem < 6) {
    			$this->insertPNJ($tr, $goldId, config('config.city.hn'), $dem, 4, $date, $updated_at);
    		} else if ($dem > 5 && $dem < 8) {
    			$this->insertPNJ($tr, $goldId, config('config.city.dn'), $dem, 6, $date, $updated_at);
    		} else if ($dem > 7 && $dem < 10) {
    			$this->insertPNJ($tr, $goldId, config('config.city.ct'), $dem, 8, $date, $updated_at);
    		} else if ($dem > 9 && $dem < 15){
    			$this->insertPNJ($tr, $goldId, config('config.city.other'), $dem, 10, $date, $updated_at);
    		}	

    		$stt++;
    	}
    }

    public function insertPNJ($tr, $goldId, $cityId, $dem, $position, $date, $updated_at)
    {
    	if ($dem == $position) {
    		foreach ($tr->find('td') as $td) {
	    		$type = $tr->find('td')[1]->plaintext;
	    		$type_slug = str_slug($type);
	    		$buy = $tr->find('td')[2]->plaintext;
	    		$sell = $tr->find('td')[3]->plaintext;
	    	}

    	} else {
    		foreach ($tr->find('td') as $td) {
	    		$type = $tr->find('td')[0]->plaintext;
	    		$type_slug = str_slug($type);
	    		$buy = $tr->find('td')[1]->plaintext;
	    		$sell = $tr->find('td')[2]->plaintext;
	    	}
    	}

    	return $this->insertGoldDetail($cityId, $type, $buy, $sell, $goldId, $date, $updated_at);
    }

    public function getDateWebGia($html)
    {
    	$dateFind = $html->find('#main .h-head small')[0]->plaintext;
    	$dateReplaceFirst = str_replace('- Cập nhật lúc ', '', $dateFind);
    	$dateReplaceSecond = str_replace('/', '-', $dateReplaceFirst);
    	$date = date('Y-m-d', strtotime($dateReplaceSecond));
    	$dateDetail = date('Y-m-d H:i:s', strtotime($dateReplaceSecond));

    	return $data = [
    		'date' => $date,
    		'updated_at' => $dateDetail
    	];
    }

    public function phuQuy()
    {
    	$html = file_get_html('https://webgia.com/gia-vang/phu-quy/');
    	$stt = 0;
    	$goldId = config('config.gold.pq');
    	$date = $this->getDateWebGia($html);
    	$check = $this->checkSJC($date['date'], $goldId);

    	if ($check > 0) {
    		GoldDetail::where('gold_id', $goldId)->where('date', $date['date'])->delete();
    		$this->getDataPhuQuy($html, $stt, $date['date'], $date['updated_at'], $goldId);

    		echo "Cập nhật thành công vàng phú quý<br>";
    	} else {
    		$this->getDataPhuQuy($html, $stt, $date['date'], $date['updated_at'], $goldId);

    		echo "Thêm thành công vàng phú quý<br>";
    	}
    }

    public function getDataPhuQuy($html, $stt, $date, $dateDetail, $goldId)
    {
    	foreach ($html->find('.table-responsive table tr') as $tr) {
    		$dem = $stt;
    		if ($dem > 0 && $dem <= 3) {
    			$this->insertPhuQuy(config('config.city.hn'), $tr, $date, $dateDetail, $goldId, $dem, 1);
    		} else if ($dem > 3 && $dem <= 6) {
    			$this->insertPhuQuy(config('config.city.hcm'), $tr, $date, $dateDetail, $goldId, $dem, 4);
    		} else if ($dem == 7) {
    			$this->insertPhuQuy(config('config.city.ban-buon'), $tr, $date, $dateDetail, $goldId, $dem, 7);
    		}
    		$stt++;
    	}
    }

    public function insertPhuQuy($cityId, $tr, $date, $updated_at, $goldId, $dem, $stt)
    {
    	foreach ($tr->find('td') as $item) {
    		if ($dem == $stt) {
    			$type = $tr->find('td')[1]->plaintext;
    			$buy = $tr->find('td')[2]->plaintext;
    			$sell = $tr->find('td')[3]->plaintext;
    		} else {
    			$type = $tr->find('td')[0]->plaintext;
    			$buy = $tr->find('td')[1]->plaintext;
    			$sell = $tr->find('td')[2]->plaintext;
    		}
    	}

    	return $this->insertGoldDetail($cityId, $type, $buy, $sell, $goldId, $date, $updated_at);
    }

    public function btmc()
    {
    	$html = file_get_html('https://webgia.com/gia-vang/bao-tin-minh-chau/');
    	$stt = 0;
    	$goldId = config('config.gold.btmc');
    	$date = $this->getDateWebGia($html);
    	$check = $this->checkSJC($date['date'], $goldId);

    	if ($check > 0) {
    		GoldDetail::where('gold_id', $goldId)->where('date', $date['date'])->delete();
    		$this->getDataBaoTinMinhChau($html, $goldId, $date);

  			echo "Cập nhật thành công vàng bảo tín minh châu<br>";
    	} else {
    		$this->getDataBaoTinMinhChau($html, $goldId, $date);
    		echo "Thêm thành công vàng bảo tín minh châu<br>";
    	}
    }

    public function getDataBaoTinMinhChau($html, $goldId, $date)
    {
    	$stt = 0;
    	foreach ($html->find('.table-responsive table tr') as $tr) {
    		$dem = $stt;
    		if ($dem > 0 && $dem <= 4) {
    			$this->insertBaoTinMinhChau($tr, $goldId, $date['date'], $date['updated_at'], $dem, 1);
    		} else if ($dem > 8 && $dem <= 13) {
    			$this->insertBaoTinMinhChau($tr, $goldId, $date['date'], $date['updated_at'], $dem, 9);
    		} else if ($dem > 13 && $dem <= 18) {
    			$this->insertBaoTinMinhChau($tr, $goldId, $date['date'], $date['updated_at'], $dem, 14);
    		} else if ($dem >=5 && $dem <=8 ) {
    			$this->insertBaoTinMinhChau($tr, $goldId, $date['date'], $date['updated_at'], $dem, 222);
    		}
    		$stt++;
    	}
    }

    public function insertBaoTinMinhChau($tr, $goldId, $date, $updated_at, $dem, $stt)
    {
    	foreach($tr->find('td') as $td) {
    		if ($dem == $stt || $stt == 222) {
    			$type = $tr->find('td')[1]->plaintext;
    			$buy = $tr->find('td')[2]->plaintext;
    			$sell = $tr->find('td')[3]->plaintext;
    		} else {
    			$type = $tr->find('td')[0]->plaintext;
    			$buy = $tr->find('td')[1]->plaintext;
    			$sell = $tr->find('td')[2]->plaintext;
    		}
    	}
    	
    	return $this->insertGoldDetail('', $type, $buy, $sell, $goldId, $date, $updated_at);
    }

    public function rate()
    {
    	try {
    		$date = date('Y-m-d');
	    	$html = file_get_html("https://tygiadola.com/laisuat/so-sanh-lai-suat-ngan-hang");
	    	$tr = $html->find('.table-responsive table tr');
	    	$stt = 0;
	    	Interest::getQuery()->delete();
	    	foreach ($tr as $trItem) {
	    		$dem = $stt;
	    		if ($dem > 1) {
	    			$this->dataRate($trItem, $date, $dem);
	    		}
	    		$stt++;
			}

			echo "Thêm thành công";
    	} catch (\Exception $e) {
    		echo $e->getMessage();
    	}
    }

    public function dataRate($tr, $date, $dem)
    {
    	
    	foreach ($tr->find('td') as $key => $td) {
    		if (isset($tr->find('td img')[0])) {
    			$bankName = str_slug($tr->find('td img')[0]->alt);
	    		$bank = Bank::where('name', $bankName)->first();
	    		if ($key > 0) {
	    			if (isset($bank)) {
		    			$bankId = $bank->id;
		    			$this->insertInterest($bankId, $key, $tr->find('td')[$key]->plaintext, $date, config('config.interest.type.counter'));
		    			
		    		} else if ($dem == 14) {
		    			$bankId = config('config.bank.agribank');
		    			$this->insertInterest($bankId, $key, $tr->find('td')[$key]->plaintext, $date, config('config.interest.type.counter'));
		    		} else if ($dem == 18) {
		    			$bankId = config('config.bank.vietinbank');
		    			$this->insertInterest($bankId, $key, $tr->find('td')[$key]->plaintext, $date, config('config.interest.type.counter'));
		    		} else if ($dem == 33) {
		    			$bankId = config('config.bank.tpbank');
		    			$this->insertInterest($bankId, $key, $tr->find('td')[$key]->plaintext, $date, config('config.interest.type.counter'));
		    		}
	    		}
    		}
    	}
    }

    public function insertInterest($bankId, $key, $percent, $date, $type)
    {
    	return Interest::create([
			'bank_id' => $bankId,
			'period_id' => $key,
			'percent' => $percent,
			'date' => $date,
			'type' => $type,
		]);
    }
}
