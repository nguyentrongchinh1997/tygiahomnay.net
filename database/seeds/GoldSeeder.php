<?php

use Illuminate\Database\Seeder;
use App\Model\Gold;

class GoldSeeder extends Seeder
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
		        'name'=> 'SJC',
                'slug' => str_slug('SJC'),
		       ),
		    array(
		        'name'=> 'PNJ',
                'slug' => str_slug('PNJ'),
		       ),
            array(
                'name'=> 'Bảo tín Minh Châu',
                'slug' => str_slug('Bảo tín Minh Châu'),
               ),
            array(
                'name'=> 'DOJI',
                'slug' => str_slug('DOJI'),
               ),
            array(
                'name'=> 'Phú Quý',
                'slug' => str_slug('Phú Quý'),
               ),
        );
    	Gold::insert($data);
    }
}
