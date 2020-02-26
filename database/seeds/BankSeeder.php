<?php

use Illuminate\Database\Seeder;
use App\Model\Bank;

class BankSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
        	array(
		        'name'=> 'agribank',
                'name_vi' => 'Ngân hàng Nông nghiệp và Phát triển Nông thôn Việt Nam - Agribank',
		       ),
		    array(
		        'name'=> 'sacombank',
                'name_vi' => 'Ngân hàng TMCP Sài Gòn Thương Tín - Sacombank'
		       ),
            array(
                'name'=> 'techcombank',
                'name_vi' => 'Ngân hàng TMCP Kỹ thương Việt Nam - Techcombank',
               ),
            array(
                'name'=> 'vietinbank',
                'name_vi' => 'Ngân hàng TMCP Công Thương Việt Nam - VietinBank'
               ),
            array(
                'name'=> 'tpbank',
                'name_vi' => 'Ngân hàng Thương mại Cổ phần Tiên Phong - TPBank',
               ),
            array(
                'name'=> 'vietcombank',
                'name_vi' => 'Ngân hàng thương mại cổ phần Ngoại thương Việt Nam - Vietcombank',
               ),
            array(
                'name'=> 'bidv',
                'name_vi' => 'Ngân hàng Đầu tư và Phát triển Việt Nam - BIDV',
               ),
        );
    	Bank::insert($data);
    }
}
