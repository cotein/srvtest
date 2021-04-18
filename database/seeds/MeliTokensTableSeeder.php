<?php

use Illuminate\Database\Seeder;

class MeliTokensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('meli_tokens')->delete();
        
        \DB::table('meli_tokens')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_id' => 1,
                'meli_user_id' => 17220993,
                'token_type' => 'bearer',
                'meli_token' => 'APP_USR-3652192885027390-020318-23ced3d6d434ba44216af14ba03ee58f-17220993',
                'meli_refresh_token' => 'TG-5f4fda648653460006fdf507-17220993',
                'meli_token_expiration_time' => '2021-02-04 00:09:09',
                'meli_email' => NULL,
                'active' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-02-03 18:09:09',
            ),
        ));
        
        
    }
}