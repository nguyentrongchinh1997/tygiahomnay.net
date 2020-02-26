<?php

use Illuminate\Database\Seeder;
use App\Model\CurrencyName;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $data = array(
        	array(
		        'name'=> 'Đô la Mỹ',
		        'currency_code'=> 'USD',
		        'image' => 'usd.png',
		       ),
		    array(
		        'name'=> 'Euro',
		        'currency_code'=> 'EUR',
		        'image' => 'eur.png',
		       ),
		    array(
		        'name'=> 'Bảng Anh',
		        'currency_code'=> 'GBP',
		        'image' => 'gbp.png',
		       ),
		    array(
		        'name'=> 'Đô la Hồng Kông',
		        'currency_code'=> 'HKD',
		        'image' => 'hkd.png',
		       ),
		    array(
		        'name'=> 'Franc Thuỵ Sĩ',
		        'currency_code'=> 'CHF',
		        'image' => 'chf.png',
		       ),
		    array(
		        'name'=> 'Yên Nhật',
		        'currency_code'=> 'JPY',
		        'image' => 'jpy.png',
		       ),
		    array(
		        'name'=> 'Đô la Úc',
		        'currency_code'=> 'AUD',
		        'image' => 'aud.png',
		       ),
		    array(
		        'name'=> 'Đô la Singapore',
		        'currency_code'=> 'SGD',
		        'image' => 'sgd.png',
		       ),
		    array(
		        'name'=> 'Baht Thái',
		        'currency_code'=> 'THB',
		        'image' => 'thb.png',
		       ),
		    array(
		        'name'=> 'Đô la Canada',
		        'currency_code'=> 'CAD',
		        'image' => 'cad.png',
		       ),
		    array(
		        'name'=> 'Ðô la New Zealand',
		        'currency_code'=> 'NZD',
		        'image' => 'nzd.png',
		       ),
		    array(
		        'name'=> 'Won Hàn Quốc',
		        'currency_code'=> 'KRW',
		        'image' => 'krw.png',
		       ),
		    array(
		        'name'=> 'Kíp Lào',
		        'currency_code'=> 'LAK',
		        'image' => 'lak.png',
		       ),
		    array(
		        'name'=> 'Riel Campuchia',
		        'currency_code'=> 'KHR',
		        'image' => 'khr.png',
		       ),
		    array(
		        'name'=> 'Đồng Thụy Điển',
		        'currency_code'=> 'SEK',
		        'image' => 'sek.png',
		       ),
		    array(
		        'name'=> 'Nhân dân tệ',
		        'currency_code'=> 'CNY',
		        'image' => 'cny.png',
		       ),
		    array(
		        'name'=> 'Krone Na Uy',
		        'currency_code'=> 'NOK',
		        'image' => 'nok.png',
		       ),
		    array(
		        'name'=> 'Dollar Đài Loan mới',
		        'currency_code'=> 'TWD',
		        'image' => 'twd.png',
		       ),
		    array(
		        'name'=> 'Peso Philippin',
		        'currency_code'=> 'PHP',
		        'image' => 'php.png',
		       ),
		    array(
		        'name'=> 'Ringgit Mã Lai',
		        'currency_code'=> 'MYR',
		        'image' => 'myr.png',
		       ),
		    array(
		        'name'=> 'Đồng Đan Mạch',
		        'currency_code'=> 'DKK',
		        'image' => 'dkk.png',
		       ),
		    array(
		        'name'=> 'Đô la Mỹ',
		        'currency_code'=> 'USD, (1,2)',
		        'image' => 'usd.png',
		       ),
		    array(
		        'name'=> 'Đô la Mỹ',
		        'currency_code'=> 'USD, (5,10,20)',
		        'image' => 'usd.png',
		       ),
		    array(
		        'name'=> 'Đô la Mỹ',
		        'currency_code'=> 'USD,50-100',
		        'image' => 'usd.png',
		       ),
		    array(
		        'name'=> 'Rub Nga',
		        'currency_code'=> 'RUB',
		        'image' => 'russia.png',
		       ),
		    array(
		        'name'=> 'đô la',
		        'currency_code'=> 'USD(1-2-5)',
		        'image' => 'usd.png',
		       ),
		    array(
		        'name'=> 'đô la',
		        'currency_code'=> 'USD(10-20)',
		        'image' => 'usd.png',
		       ),
		    array(
		        'name'=> 'Saudi riyal',
		        'currency_code'=> 'SAR',
		        'image' => 'sar.png',
		       ),
		    array(
		        'name'=> 'Dinar Kuwait',
		        'currency_code'=> 'KWD',
		        'image' => 'kwd.png',
		       ),
		    array(
		        'name'=> 'Rupee Ấn Độ',
		        'currency_code'=> 'INR',
		        'image' => 'inr.png',
		       ),
		    
        );
    	CurrencyName::insert($data);
    }
}
