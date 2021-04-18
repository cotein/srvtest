<?php

use Illuminate\Database\Seeder;

class PriceListTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('price_list')->delete();
        
        \DB::table('price_list')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Sector 2 sept',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Sector 1 Mayo',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Servicios',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Mercado libre',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'CUPONICA',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Click on',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Lista General',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'baigorria',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Club cupon',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Liquidados',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'CLUNCO',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'NICO BUTERA',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Grupón',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'AVENIDA',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'FRAVEGA',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'GARBARINO',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'SODIMAC',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'VICALI',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'MAYORISTAS',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'CONTADO',
                'enable' => 1,
                'created_at' => '2020-07-31 11:45:11',
                'updated_at' => '2020-07-31 11:45:11',
            ),
        ));
        
        
    }
}