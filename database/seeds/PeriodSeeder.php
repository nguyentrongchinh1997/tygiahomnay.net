<?php

use Illuminate\Database\Seeder;
use App\Model\Period;

class PeriodSeeder extends Seeder
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
		        'name'=> 'KKH',
                'slug' => 'kkh',
		       ),
		    array(
		        'name'=> '1 tháng',
                'slug' => '1-thang'
		       ),
            array(
                'name'=> '2 tháng',
                'slug' => '2-thang'
               ),
            array(
                'name'=> '3 tháng',
                'slug' => '3-thang'
               ),
            array(
                'name'=> '6 tháng',
                'slug' => '6-thang'
               ),
            array(
                'name'=> '9 tháng',
                'slug' => '9-thang'
               ),
            array(
                'name'=> '12 tháng',
                'slug' => '12-thang'
               ),
            array(
                'name'=> '18 tháng',
                'slug' => '18-thang'
               ),
                        array(
                'name'=> '24 tháng',
                'slug' => '24-thang'
               ),
            array(
                'name'=> '36 tháng',
                'slug' => '36-thang'
               ),
        );
    	Period::insert($data);
    }
}
