<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CurrencyName;
use App\Model\ExchangeRate;
use App\Model\Oil;
use App\Model\Gold;
use App\Model\GoldDetail;

class CloneController extends Controller
{
	public function all()
	{
		$this->sacombank();
		$this->tpbank();
		$this->bidv();
		$this->vietinbank();
		$this->vietcombank();
		$this->techcombank();
		$this->oil();
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

    		echo "Cập nhật thành công";
    	} else {
    		$listArray = $this->arrayDataSacombank($html, $listArray);
	    	$count = count($listArray);
	    	for ($i = 0; $i < $count; $i++) {
	    		$currencyId = CurrencyName::where('currency_code', trim($listArray[$i][0]))->first()->id;
	    		
	    		$this->insertExchangeRate($currencyId, $bankId, $listArray[$i][1], $listArray[$i][2], $listArray[$i][3], $listArray[$i][4], $timestamp, $date);
	    	}
	    	echo "Thêm thành công";
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
	    	echo "Cập nhật thành công";
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
	    	echo "Thêm thành công";
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

	    	echo "Cập nhật thành công";
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
	    	echo "Thêm thành công";
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

    		return "Cập nhật thành công";
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
	    	return "Thêm thành công";
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

	    	return "Cập nhật thành công";
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
	    	return "Thêm thành công";
	    }
    }
/*end*/

/*Có lịch sử tỷ giá trong trang webgia.com*/
    public function vietcombank()
    {
    	$date = date('d-m-Y');
    	$dateDetail = date('Y-m-d H:i:s');
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
	    	echo "Cập nhật thành công";
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
	    	echo "Thêm thành công";
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
	    	echo "Thêm thành công";
    	} catch (\Exception $e) {
    		echo "Thêm thất bại";
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

    public function insertGoldTable($data, $date, $goldId)
    {	
    	$listArray = $array = array();
    	$name = $data['name'];
    	$item = $data->item;
    	for ($i = 0; $i < count($item); $i++) {
    		GoldDetail::create(
	    		[
	    			'buy' => $item[$i]['buy'],
	    			'sell' => $item[$i]['sell'],
	    			'type' => $item[$i]['type'],
	    			'gold_id' => $goldId,
	    			'date' => $date,
	    			'city' => $name,
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
	      	$goldId = config('config.gold.sjc');
	      	$check = $this->checkSJC($date, $goldId);

	      	if ($check > 0) {
	      		GoldDetail::where('date', $date)->where('gold_id', $goldId)->delete();
	      		foreach ($xml->ratelist->city as $key => $item) {
		      		$this->insertGoldTable(($xml->ratelist->city)[$stt], $date, $goldId);
		      		$stt++;
		      	}
		      	echo "Cập nhật thành công";
	      	} else {
	      		foreach ($xml->ratelist->city as $key => $item) {
		      		$this->insertGoldTable(($xml->ratelist->city)[$stt], $date, $goldId);
		      		$stt++;
		      	}
		      	echo "Thêm thành công";
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
    	$html = file_get_html('http://giavang.doji.vn/');
    	$stt = 0;
    	$goldId= config('config.gold.doji');
    	$date = date('d-m-Y');
    	$check = $this->checkSJC($date, $goldId);

    	if ($check > 0) {
    		GoldDetail::where('date', $date)->where('gold_id', $goldId)->delete();
    		$this->insertDoji($html, $stt, $goldId, $date);
    	} else {
    		$this->insertDoji($html, $stt, $goldId, $date);
    	}
    	
    }

    public function insertDoji($html, $stt, $goldId, $date)
    {
    	foreach ($html->find('.goldprice-view tr') as $tr) {
	    		if ($stt > 0) {
	    			foreach ($tr->find('td') as $item) {
	    				$type = $tr->find('td')[0]->plaintext;
	    				$buy = $tr->find('td')[1]->plaintext;
	    				$sell = $tr->find('td')[2]->plaintext;
	    			}
	    			GoldDetail::create(
	    				[
	    					'type' => $type,
	    					'buy' => $buy,
	    					'sell' => $sell,
	    					'gold_id' => $goldId,
	    					'date' => $date
	    				]
	    			);
	    		}
	    		$stt++;
	    	}
    }
}
