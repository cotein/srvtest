<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('addresses')->delete();
        
        \DB::table('addresses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => NULL,
                'country_id' => 1,
                'province_id' => 2,
                'city' => NULL,
                'city_id' => 12447,
                'address' => 'SENADORA PROVINCIAL MOSCOSO HERRERA 957',
                'number' => NULL,
                'cp' => '1804',
                'message' => NULL,
                'geocoder' => NULL,
                'addressable_id' => 1,
                'addressable_type' => 'App\\Src\\Models\\Company',
                'type_id' => NULL,
                'obs' => NULL,
                'status_id' => 1,
                'created_at' => '2020-07-31 22:08:08',
                'updated_at' => '2020-07-31 22:08:08',
                'between_streets' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'code' => NULL,
                'country_id' => 1,
                'province_id' => 2,
                'city' => NULL,
                'city_id' => 12504,
                'address' => 'Diego Laure 337',
                'number' => NULL,
                'cp' => '1804',
                'message' => NULL,
                'geocoder' => NULL,
                'addressable_id' => 10,
                'addressable_type' => 'App\\Src\\Models\\Customer',
                'type_id' => 2,
                'obs' => NULL,
                'status_id' => 1,
                'created_at' => '2020-08-01 03:30:39',
                'updated_at' => '2020-08-01 03:30:39',
                'between_streets' => 'Tuyuti y Yatay',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => NULL,
                'country_id' => 1,
                'province_id' => 2,
                'city' => NULL,
                'city_id' => 12504,
                'address' => 'Chenaut 536',
                'number' => NULL,
                'cp' => '1804',
                'message' => NULL,
                'geocoder' => NULL,
                'addressable_id' => 10,
                'addressable_type' => 'App\\Src\\Models\\Customer',
                'type_id' => 1,
                'obs' => NULL,
                'status_id' => 1,
                'created_at' => '2020-08-01 03:31:33',
                'updated_at' => '2020-08-01 03:31:33',
                'between_streets' => 'Chaco y San Luis',
            ),
            3 => 
            array (
                'id' => 4,
                'code' => NULL,
                'country_id' => 1,
                'province_id' => 2,
                'city' => NULL,
                'city_id' => 1290,
                'address' => 'SAN MARTIN 1333',
                'number' => NULL,
                'cp' => '1814',
                'message' => NULL,
                'geocoder' => NULL,
                'addressable_id' => 101,
                'addressable_type' => 'App\\Src\\Models\\Customer',
                'type_id' => 1,
                'obs' => NULL,
                'status_id' => 1,
                'created_at' => '2020-08-01 10:04:28',
                'updated_at' => '2020-08-01 10:04:28',
                'between_streets' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'code' => NULL,
                'country_id' => 1,
                'province_id' => 2,
                'city' => NULL,
                'city_id' => 901,
                'address' => 'jjjjjjj 444',
                'number' => NULL,
                'cp' => '6660',
                'message' => NULL,
                'geocoder' => NULL,
                'addressable_id' => 2,
                'addressable_type' => 'App\\Src\\Models\\Customer',
                'type_id' => 1,
                'obs' => NULL,
                'status_id' => 1,
                'created_at' => '2020-08-01 18:14:03',
                'updated_at' => '2020-08-01 18:14:03',
                'between_streets' => 'rrrr',
            ),
            5 => 
            array (
                'id' => 6,
                'code' => NULL,
                'country_id' => 1,
                'province_id' => 2,
                'city' => NULL,
                'city_id' => 2780,
                'address' => 'FRAY LUIS BELTRAN 623',
                'number' => NULL,
                'cp' => '1842',
                'message' => NULL,
                'geocoder' => NULL,
                'addressable_id' => 205,
                'addressable_type' => 'App\\Src\\Models\\Customer',
                'type_id' => 1,
                'obs' => NULL,
                'status_id' => 1,
                'created_at' => '2020-08-01 22:32:25',
                'updated_at' => '2020-08-01 22:32:25',
                'between_streets' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'code' => NULL,
                'country_id' => 1,
                'province_id' => 2,
                'city' => NULL,
                'city_id' => 12448,
                'address' => 'AVELLANEDA 351',
                'number' => NULL,
                'cp' => '1842',
                'message' => NULL,
                'geocoder' => NULL,
                'addressable_id' => 206,
                'addressable_type' => 'App\\Src\\Models\\Customer',
                'type_id' => NULL,
                'obs' => NULL,
                'status_id' => 1,
                'created_at' => '2020-08-01 22:39:49',
                'updated_at' => '2020-08-01 22:39:49',
                'between_streets' => NULL,
            ),
        ));
        
        
    }
}