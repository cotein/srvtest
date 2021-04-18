<?php

use App\User;
/* use IvaSeeder;
use MoneySeeder;
use StatusSeeder;
use CategorySeeder;
use PriceListSeeder;
use CoinsTableSeeder;
use SizesTableSeeder;
use UsersTableSeeder;
use InscriptionSeeder;
use ColoursTableSeeder;
use App\Src\Models\Size;
use VouchersTableSeeder;
/* use ShippmentModeSeeder;
/* use CompaniesTableSeeder;
use App\Src\Models\Colour;
use CustomersTableSeeder;
use SujetosTableSeeder; */
//use TypeUsersTableSeeder;
use App\Src\Models\Brand;
use App\Src\Models\Product;
use Faker\Factory as Faker;
//use CuitSujetosTableSeeder;
//use AddressesTableSeeder; 
/* use PublicationTypesSeeder; */
use App\Src\Models\Category;
/* use PublicationsTableSeeder;
use PriceListTableSeeder; */
//use SalesInvoicesTableSeeder;
use App\Src\Models\AddressType;
use App\Src\Models\Publication;
use Illuminate\Database\Seeder;
/* use PedidosClientesTableSeeder;
use IncludedConceptsTableSeeder;
use App\Src\Models\ShippmentMode;
use MeasureUnitiesTableSeeder; */
/* use PricelistProductsTableSeeder; */
use Illuminate\Support\Facades\DB;
/* use PurchaserDocumentsTableSeeder; */
//use SaleInvoiceItemsTableSeeder; 
use App\Src\Models\PublicationTypes;
/* use PedidosClientesItemsTableSeeder; */

class DatabaseSeeder extends Seeder
{
    const PATH = __DIR__;
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\MoneySeeder::class);
        $this->call(\StatusSeeder::class);
        //$this->call(\CategorySeeder::class);
        $this->call(\InscriptionSeeder::class);
        $this->call(\ShippmentModeSeeder::class);
        $this->call(\PublicationTypesSeeder::class);
        $this->call(\ColoursTableSeeder::class);
        $this->call(\SizesTableSeeder::class);
        $this->call(\PurchaserDocumentsTableSeeder::class);
        $this->call(\MeasureUnitiesTableSeeder::class);
        $this->call(\CoinsTableSeeder::class);
        $this->call(\CuitSujetosTableSeeder::class);
        $this->call(\SujetosTableSeeder::class);
        $this->call(\IncludedConceptsTableSeeder::class);
        $this->call(\PriceListSeeder::class);
        $this->call(\PaymentTypeSeeder::class);
        $this->call(\AccountingAccountsTableSeeder::class);
       
        $this->command->info('Cargando Bancos');
        \DB::unprepared(\File::get(self::PATH.'/sql/banks.sql')); 
        
        $this->command->info('Cargando Provincias');
        \DB::unprepared(\File::get(self::PATH.'/sql/provinces.sql')); 
        
        /* $this->command->info('Cargando Localidades');
        \DB::unprepared(\File::get(self::PATH.'/sql/cities.sql'));  */
        
       /*  $brand = new Brand;
        $brand->name = 'PIAMOND SA';
        $brand->save(); */

        $address_type = [
            ['name' => 'FISCAL'],
            ['name' => 'ENTREGA'],
        ];

        collect($address_type)->each(function($a){
            AddressType::create(
                [
                    'name' => $a['name'],
                ]);
            $this->call(AccountingAccountsTableSeeder::class);
        $this->call(TaxTypesTableSeeder::class);
        $this->call(TaxesTableSeeder::class);
        $this->call(ProvidersRegimenTableSeeder::class);
        $this->call(DailyMovementTypesTableSeeder::class);
        $this->call(IvasTableSeeder::class);
        $this->call(VouchersTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(CustomerTypesTableSeeder::class);
        $this->call(\TypeUsersTableSeeder::class);
        $this->call(MeliTokensTableSeeder::class);
        $this->call(AccountTypesTableSeeder::class);
        $this->call(BankAccountsTableSeeder::class);
        $this->call(\CategoriesTableSeeder::class);
        $this->call(\CitiesTableSeeder::class);
        $this->call(\BrandsTableSeeder::class);
        $this->call(\UsersTableSeeder::class);
    });

    $this->call(\CompaniesTableSeeder::class);
       
    
    }
}
