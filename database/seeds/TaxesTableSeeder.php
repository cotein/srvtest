<?php

use Illuminate\Database\Seeder;

class TaxesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('taxes')->delete();
        
        \DB::table('taxes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'PERCEP. IVA',
                'accounting_account_id' => 3,
                'tax_type_id' => 2,
                'created_at' => NULL,
                'updated_at' => '2021-01-28 17:02:37',
                'state_id' => 1,
                'movement_type_id' => 1,
                'active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'PERCEP. IIBB - BS.AS',
                'accounting_account_id' => 7,
                'tax_type_id' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-01-28 14:58:11',
                'state_id' => 3,
                'movement_type_id' => 1,
                'active' => 0,
            ),
        ));
        
        
    }
}