<?php

use Illuminate\Database\Seeder;

class PedidosClientesItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pedidos_clientes_items')->delete();
        
        \DB::table('pedidos_clientes_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pedido_cliente_id' => 4,
                'product_id' => 53,
                'pricelist_id' => 17,
                'unit_price' => 5200.0,
                'quantity' => 1,
                'discount_percentage' => 0,
                'discount_import' => 0.0,
                'iva_id' => 5,
                'iva_percentage' => 21.0,
                'iva_import' => 1092.0,
                'neto_import' => 5200.0,
                'total' => 6292.0,
                'price_list' => '[{"name": "SODIMAC", "price": "$ 5.200,00", "price_raw": 5200, "product_id": 53, "pricelist_id": 17}]',
                'created_at' => '2020-08-01 16:39:30',
                'updated_at' => '2020-08-01 16:39:30',
            ),
            1 => 
            array (
                'id' => 2,
                'pedido_cliente_id' => 5,
                'product_id' => 6,
                'pricelist_id' => 2,
                'unit_price' => 500.0,
                'quantity' => 1,
                'discount_percentage' => 0,
                'discount_import' => 0.0,
                'iva_id' => 5,
                'iva_percentage' => 21.0,
                'iva_import' => 105.0,
                'neto_import' => 500.0,
                'total' => 605.0,
                'price_list' => '[{"name": "SECTOR 1 MAYO", "price": "$ 500,00", "price_raw": 500, "product_id": 6, "pricelist_id": 2}]',
                'created_at' => '2020-08-01 16:49:02',
                'updated_at' => '2020-08-01 16:49:02',
            ),
        ));
        
        
    }
}