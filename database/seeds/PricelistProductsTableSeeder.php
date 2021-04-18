<?php

use Illuminate\Database\Seeder;

class PricelistProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pricelist_products')->delete();
        
        \DB::table('pricelist_products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pricelist_id' => 11,
                'product_id' => 1,
                'price' => 777.0,
                'created_at' => NULL,
                'updated_at' => '2020-08-01 18:09:56',
            ),
            1 => 
            array (
                'id' => 2,
                'pricelist_id' => 2,
                'product_id' => 2,
                'price' => 100.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'pricelist_id' => 15,
                'product_id' => 3,
                'price' => 200.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'pricelist_id' => 12,
                'product_id' => 4,
                'price' => 1500.0,
                'created_at' => NULL,
                'updated_at' => '2020-08-01 16:27:15',
            ),
            4 => 
            array (
                'id' => 5,
                'pricelist_id' => 20,
                'product_id' => 5,
                'price' => 400.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'pricelist_id' => 2,
                'product_id' => 6,
                'price' => 500.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'pricelist_id' => 6,
                'product_id' => 7,
                'price' => 555.0,
                'created_at' => NULL,
                'updated_at' => '2020-08-01 18:09:41',
            ),
            7 => 
            array (
                'id' => 8,
                'pricelist_id' => 14,
                'product_id' => 8,
                'price' => 700.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'pricelist_id' => 7,
                'product_id' => 9,
                'price' => 800.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'pricelist_id' => 17,
                'product_id' => 10,
                'price' => 900.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'pricelist_id' => 14,
                'product_id' => 11,
                'price' => 1000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'pricelist_id' => 11,
                'product_id' => 12,
                'price' => 1100.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'pricelist_id' => 12,
                'product_id' => 13,
                'price' => 1200.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'pricelist_id' => 6,
                'product_id' => 14,
                'price' => 1300.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'pricelist_id' => 12,
                'product_id' => 15,
                'price' => 1400.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'pricelist_id' => 19,
                'product_id' => 16,
                'price' => 1500.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'pricelist_id' => 13,
                'product_id' => 17,
                'price' => 1600.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'pricelist_id' => 19,
                'product_id' => 18,
                'price' => 1700.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'pricelist_id' => 12,
                'product_id' => 19,
                'price' => 1800.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'pricelist_id' => 12,
                'product_id' => 20,
                'price' => 1900.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'pricelist_id' => 10,
                'product_id' => 21,
                'price' => 2000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'pricelist_id' => 20,
                'product_id' => 22,
                'price' => 2100.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'pricelist_id' => 19,
                'product_id' => 23,
                'price' => 2200.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'pricelist_id' => 5,
                'product_id' => 24,
                'price' => 2300.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'pricelist_id' => 10,
                'product_id' => 25,
                'price' => 2400.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'pricelist_id' => 19,
                'product_id' => 26,
                'price' => 2500.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'pricelist_id' => 9,
                'product_id' => 27,
                'price' => 2600.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'pricelist_id' => 6,
                'product_id' => 28,
                'price' => 2700.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'pricelist_id' => 13,
                'product_id' => 29,
                'price' => 2800.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'pricelist_id' => 12,
                'product_id' => 30,
                'price' => 2900.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'pricelist_id' => 19,
                'product_id' => 31,
                'price' => 3000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'pricelist_id' => 3,
                'product_id' => 32,
                'price' => 3100.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'pricelist_id' => 10,
                'product_id' => 33,
                'price' => 3200.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'pricelist_id' => 12,
                'product_id' => 34,
                'price' => 3300.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'pricelist_id' => 17,
                'product_id' => 35,
                'price' => 3400.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'pricelist_id' => 17,
                'product_id' => 36,
                'price' => 3500.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'pricelist_id' => 20,
                'product_id' => 37,
                'price' => 3600.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'pricelist_id' => 13,
                'product_id' => 38,
                'price' => 3700.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'pricelist_id' => 6,
                'product_id' => 39,
                'price' => 3800.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'pricelist_id' => 6,
                'product_id' => 40,
                'price' => 3900.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'pricelist_id' => 3,
                'product_id' => 41,
                'price' => 4000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'pricelist_id' => 2,
                'product_id' => 42,
                'price' => 4100.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'pricelist_id' => 11,
                'product_id' => 43,
                'price' => 4200.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'pricelist_id' => 2,
                'product_id' => 44,
                'price' => 4300.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'pricelist_id' => 11,
                'product_id' => 45,
                'price' => 4400.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'pricelist_id' => 9,
                'product_id' => 46,
                'price' => 4500.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'pricelist_id' => 15,
                'product_id' => 47,
                'price' => 4600.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'pricelist_id' => 11,
                'product_id' => 48,
                'price' => 4700.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'pricelist_id' => 15,
                'product_id' => 49,
                'price' => 4800.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'pricelist_id' => 1,
                'product_id' => 50,
                'price' => 4900.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'pricelist_id' => 15,
                'product_id' => 51,
                'price' => 5000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'pricelist_id' => 11,
                'product_id' => 52,
                'price' => 5100.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'pricelist_id' => 17,
                'product_id' => 53,
                'price' => 5200.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'pricelist_id' => 13,
                'product_id' => 54,
                'price' => 5300.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'pricelist_id' => 15,
                'product_id' => 55,
                'price' => 5400.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'pricelist_id' => 11,
                'product_id' => 56,
                'price' => 5500.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'pricelist_id' => 19,
                'product_id' => 57,
                'price' => 5600.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'pricelist_id' => 15,
                'product_id' => 58,
                'price' => 5700.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'pricelist_id' => 7,
                'product_id' => 59,
                'price' => 5800.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'pricelist_id' => 9,
                'product_id' => 60,
                'price' => 5900.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'pricelist_id' => 2,
                'product_id' => 61,
                'price' => 6000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'pricelist_id' => 11,
                'product_id' => 62,
                'price' => 6100.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'pricelist_id' => 20,
                'product_id' => 63,
                'price' => 6200.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'pricelist_id' => 8,
                'product_id' => 64,
                'price' => 6300.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'pricelist_id' => 1,
                'product_id' => 65,
                'price' => 6400.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'pricelist_id' => 5,
                'product_id' => 66,
                'price' => 6500.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'pricelist_id' => 18,
                'product_id' => 67,
                'price' => 6600.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'pricelist_id' => 6,
                'product_id' => 68,
                'price' => 6700.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'pricelist_id' => 3,
                'product_id' => 69,
                'price' => 6800.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'pricelist_id' => 19,
                'product_id' => 70,
                'price' => 6900.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'pricelist_id' => 5,
                'product_id' => 71,
                'price' => 7000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'pricelist_id' => 16,
                'product_id' => 72,
                'price' => 7100.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}