<?php
use App\User;
use App\Src\Arba\Arba;
use GuzzleHttp\Client;
use App\Src\Models\City;
use App\Src\Models\Order;
use App\Src\Models\Status;
use App\Src\Meli\MeliUsers;
use App\Src\Models\Address;
use App\Src\Models\Company;
use App\Src\Models\Product;
use App\Src\Models\Receipt;
use App\Src\Models\Voucher;
use App\Src\Models\WebHook;
use App\Src\SyncroProducts;
use App\Src\Meli\MeliHealth;
use App\Src\Meli\MeliOrders;
use App\Src\Meli\MeliVisits;
use App\Src\Models\Category;
use App\Src\Models\Customer;
use App\Src\Models\Provider;
use App\Src\Models\Supplier;
use App\Src\Meli\MeliBilling;
use App\Src\Meli\MeliMessage;
use App\Src\Meli\MeliReviews;
use App\Src\Models\PriceList;
use App\Src\Models\Variation;
use App\Src\Meli\MeliPictures;
use Spatie\MediaLibrary\Media;
use App\Src\Meli\MeliProductos;
use App\Src\Meli\MeliQuestions;
use App\Src\Models\Publication;
use App\Src\Models\SaleInvoice;
use App\Src\Tools\StdClassTool;
use App\Src\Geo\GeoLocalization;
use App\Src\Meli\MeliCategories;
use App\Src\Meli\MeliHandleData;
use App\Src\Models\PedidoCliente;
use App\Src\Afip\WS\Source\WSBase;
use App\Src\Afip\WS\Source\WSFEV1;
use App\Src\Meli\MeliDescriptions;
use App\Src\Meli\MeliPublications;
use App\Src\MercadoPago\MPPayment;
use Illuminate\Support\Facades\DB;
use App\Src\Afip\WS\Source\WSPUC04;
use App\Src\Afip\WS\Source\WSPUC05;
use App\Src\Afip\WS\Source\WSPUC13;
use App\Src\Meli\MeliNotifications;
use App\Src\Models\PurchaseInvoice;
use App\Src\Models\WebHookMessages;
use App\Src\Models\WebHookQuestion;
use App\Src\Afip\WS\Source\WSFECRED;
use App\Src\Categories\CategoryBase;
use App\Src\Unsplash\SearchUnSplash;
use Illuminate\Support\Facades\Auth;
use App\Src\DataBase\CheckConnection;
use App\Src\Models\ReceiptCancelation;
use App\Src\Tests\VariationsMyOwnTest;
use Illuminate\Support\Facades\Schema;
use App\Events\WebHookOrderWasReceived;
use App\Src\Models\PedidoClienteStatus;
use App\Src\Traits\GenerateFilterTrait;
use Spatie\Activitylog\Models\Activity;
use Kolovious\MeliSocialite\Facade\Meli;
use App\Events\WebHookMessageWasReceived;
use App\Src\Afip\WS\Source\WSFEV1Manager;
use App\Src\Afip\WS\Source\WSPUCResponse;
use MahdiMajidzadeh\LaravelUnsplash\Photo;
use MahdiMajidzadeh\LaravelUnsplash\Search;
use App\Src\Models\ReceiptPaymentToProvider;
use App\Listeners\CreateProductByPublication;
use App\Transformers\Afip\InvoiceTransformer;
use App\Transformers\Company\CompanyTransformer;
use App\Transformers\Meli\WebHookMessageTransformer;
use App\Http\Controllers\Api\MeliNotificationController;
use App\Transformers\PedidoCliente\PedidoClienteListTransformer;
use App\Transformers\PublicationHere\NestableCategoryTransformer;
use App\Transformers\PurchaseInvoice\IvaComprasAlicuotasTransformer;
use App\Transformers\PurchaseInvoice\IvaComprasComprobantesTransformer;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {

    return view('app.mercadolibre.messages.messenger')->with(['view_name' => 'aaaaaaaaaaaaaaaaaaaaaaa']);;
    
});

Route::get('pp', function () {
    $ws = new WSFECRED('testing');
    $r = $ws->consultarMontoObligadoRecepcion(30507950848, '2021-03-26'); //molino cañuelas

    dd($r);
    dd($r['consultarMontoObligadoRecepcionReturn']);

    $sale_invoices = [
        [
            'company_id' => 1,
            'customer_id' => 495,
            'doc_nro' => '30716148684',
            'voucher_id' => 1,
            'pto_vta' => 6,
            'cbte_desde' => 181, 
            'cbte_hasta' => 181,
            'cbte_fch' => 20210321,
            'cae' => '71123557292231',
            'cae_fch_vto' => 20210331,
            'iibb_percentage' => 0,
            'percerp_iibb' => 0,
            'status_id' => 6,
            'user_id' => 1,
            'afip_data' => [],
        ],
        
    ];

    collect($sale_invoices)->map(function($i){
        $si = new SaleInvoice;
        
        $si->company_id = $i['company_id'];
        $si->customer_id = $i['customer_id'];
        $si->doc_nro = $i['doc_nro'];
        $si->voucher_id = $i['voucher_id'];
        $si->pto_vta = $i['pto_vta'];
        $si->cbte_desde = $i['cbte_desde'];
        $si->cbte_hasta = $i['cbte_hasta'];
        $si->cbte_fch = $i['cbte_fch'];
        $si->cae = $i['cae'];
        $si->cae_fch_vto = $i['cae_fch_vto'];
        $si->iibb_percentage = 0;
        $si->percerp_iibb = 0;
        $si->status_id = $i['status_id'];
        $si->user_id = $i['user_id'];
        $si->afip_data = $i['afip_data'];
        
        $si->save();
        $si->refresh();

        $si->items()->create([
            'sale_invoice_id' => $si->id,
            'product_id' => 215,
            'quantity' => 1,
            'neto_import' => 6346.28,
            'iva_import' => 1332.72,
            'iva_id' => 6,
            'discount' => 0,
            'discount_import' => 0,
            'total' => 7679,
            'obs' => 'Sobre: FACTURAS A 00006 - 00000' . $si->cbte_desde,
        ]);
    });




    $c = Customer::find(3);
    dd($c->addresses);
    $a = Address::find(6);
    dd($a->type->name . ' - ' . strtoupper($a->address) . ' - ' . City::find($a->city_id)->name . ' - ' . $a->cp . ' - ' . $a->state->name . ' - AGENTINA');
    $u = new MeliUsers;
    $ww = $u->create_test_user();
    dd($ww);

    $p = Product::find(1);
    dd($p->getMedia());
    $pi = PurchaseInvoice::all();
    //$pi = fractal($pi, new IvaComprasComprobantesTransformer())->toArray()['data'];
    $tr =  new IvaComprasAlicuotasTransformer();
    $r = $pi->map(function($i) use($tr) {
        return $tr->transform($i);
    })->flatten()->toArray();
   // dd($pi->items->groupBy('iva_id'));
    dd($r);
    
    $p = PurchaseInvoice::find(1);
    $w = $p->items->map(function($i){
        if ($i->iva_id == 2) {
            return $i->iva_import;
        }
    });
    dd($p->taxes()->exists());
    $p = User::where('type_user_id', 1)->get();
    dd($p->pluck('email')->toArray());
    try {
        $db =  \DB::connection()->getPdo();
        $database_name =  \DB::connection()->getDatabaseName();
        dd($db, $database_name);
        
    } catch (\Throwable $th) {
        dd('lo cacheo');
    }
    $q = new MeliHealth;
    dd($q->get_actions_for_improved_publication('MLA733049139'));
    $a = PedidoCliente::find(7131);
    collect($a->meli_data['order_items'])->map(function($i){
        dd($i['item']['id']);
    });
    $b = new MeliUsers;
    dd($b->get_seller_by_id('17220993'));

    $b = new MeliBilling;
    dd($b->get_billing_by_period());
    $a = new CheckConnection;
    dd($a->hasConnectionWithMsql2());
    
    $r = new MeliReviews;
    dd($r->reviews('MLA869767147'));
    dd($r->visits_by_publication_between_dates('2015-01-01', '2020-12-31', 'MLA830654647'));
    /* $response = 'wwww ppppp';
    broadcast(new WebHookOrderWasReceived($response));
    
    dd($response); */
    /* $p = PedidoCliente::find(7222);
    dd($p->payment_type); */
    $client = new Client([

        'base_uri' => 'https://api.mercadolibre.com',

        'timeout' => 2.0

    ]);
    //// meli user id 17220993 piamond
    //$response = $client->request('GET', '/users/17220993/items_visits?date_from=2018-12-28&date_to=2020-12-28');
    //$response = $client->request('GET', '/users/17220993/items_visits/time_window?last=365&unit=day');
    //dd($response->getBody()->getContents());    
    
    $u = new MeliUsers;
    dd($u->last_month_visits('17220993', 2));
    $topic = '/orders/4244013336';

    $notifications = new MeliNotifications;
    //$wh = WebHook::where('topic', 'orders_v2')->where('status_id',1)->orderByDesc('id')->limit(1)->get();
    
    $user = User::find(1);
    //dd($user->company->mercadoLibre->meli_refresh_token);
    if($user->verify_expiration_time_token())
    {
        $mu = new MeliUsers;
        $meli_data = $mu->refresh_token($user->company->mercadoLibre->meli_refresh_token); 

        $user->updateDataWithRefreshToken($meli_data);

    }
    $response = $notifications->notification_resource($user->company->mercadoLibre->meli_token, $topic);
    $ord = StdClassTool::toArray($response['body']);
    
    $wh_prueba = new WebHook;
    $wh_prueba->meli_info = $ord;
    $wh_prueba->save();
    $wh_prueba->refresh();

    $customer_id = null;

    $cstmr = Customer::where('meli_id', $ord['buyer']['id'])->get();

    if ($cstmr->isEmpty()) {

        $phone = (array_key_exists('phone', $ord['buyer'])) ? $ord['buyer']['phone']['area_code'] . ' '. $ord['buyer']['phone']['number'] : 'Sin informar';
        
        $customer = new Customer;
        $customer->name = $ord['buyer']['last_name'] . ' ' . $ord['buyer']['first_name'];
        $customer->meli_nick = $ord['buyer']['nickname'];
        $customer->meli_id = $ord['buyer']['id'];
        $customer->email = $ord['buyer']['email'];
        $customer->number = $ord['buyer']['billing_info']['doc_number'];
        $customer->phone_1 = $phone;
        
        $customer->save();

        $customer_id = $customer->id;
        
    }else{

        $customer_id = $cstmr->first()->id;
    }
    sleep(1);

        $or = PedidoCliente::where('meli_id', $ord['id'])->get();


            $pc = new PedidoCliente;
            $pc->customer_id = $customer_id;
            $pc->meli_id = $ord['id'];
            $pc->is_meli_order = true;
            $pc->meli_data = $ord;
            $pc->status_id = Status::PENDIENTE;
            $pc->user_id = 999999; //AUTOMATICO
            $pc->save();
            $pc->code = 'PD-' . $ord['date_created'] . '-' . $pc->customer_id . '-' . $pc->id;
            $pc->number = $pc->id;
            $pc->save();

            $pc->refresh();
            $pedido = fractal($pc, new PedidoClienteListTransformer())->toArray()['data'];
            $pedido['now'] = true;
            broadcast(new WebHookOrderWasReceived($pedido));

           
    dd($pedido);
    /* $wh->each(function($w) use($notifications, $user) {

        $response = $notifications->notification_resource($user->company->mercadoLibre->meli_token, $w->meli_info['resource']);
        $w->status_id = 22; //leida
        $w->save();
        broadcast(new WebHookOrderWasReceived($response));

        dd($response);
    });  */
    /* $message = 'pp';
    broadcast(new WebHookMessageWasReceived($message)); */
    $message = [
        "message_id"=> "0033b582a1474fa98c02d229abcec43c",
        "date_received"=> "2016-09-01T05:15:25.821Z",
        "date"=> "2016-09-01T05:15:25.821Z",
        "date_available"=> "2016-09-01T05:15:25.821Z",
        "date_notified"=> "2016-09-01T05:17:42.945Z",
        "date_read"=> "2016-09-01T21:31:19.606Z",
        "from"=> [
          "user_id"=> "123456789",
          "email"=> "userfrom.n4tx9d+2-ogeytenjqgi3tomjw@mail.mercadolibre.com",
          "name"=> "User from"
        ],
        "to"=> [
          
            "user_id"=> "123456780",
            "email"=> "userto.3fd70y+2-ogeytenjqgi3tombx@mail.mercadolibre.com"
          
        ],
        "subject"=> "Test Item subject",
        "text"=> [
          "plain"=> "Ejemplo de texto"
        ],
        "attachments"=> [
          []
        ],
        "attachments_validations"=> [
                "invalid_size"=> [
                    ],
                    "invalid_extension"=> [
                    ],
                    "forbidden"=> [
                    ],
                    "internal_error"=> [
                    
                    ],
            "site_id"=> "MLA",
            "resource"=> "orders",
            "resource_id"=> "1234567871",
            "status"=> "available",
            "moderation"=> [
                "status"=> "clean",
                "date_moderated"=> "2019-03-13T09:34:26.450-04:00",
                "source"=> "online"
            ],
        ],
    ];

    //$message = WebHookMessages::where('resource_id', '4200440134')->get()->first();
    $message1 = ["order_id"=>"2120423484","from"=>["user_id"=>"17220991","email"=>"colchonesmercado@gmail.com","name"=>"PIAMOND SA"],"to"=>[["user_id"=>"73784568","email"=>"marcelo.j.callao@gmail.com","name"=>"Marcelo Jorge Callao"]],"created_at"=>["date"=>"2020-12-09 15=>59=>48.000000","timezone_type"=>3,"timezone"=>"UTC"],"text"=>["plain"=>"Bienvenido/a al curso gratis de Firebase, donde aprenderás todo lo necesario para utilizar Firebase en tus proyectos con Vue o, por supuesto, JavaScript nativo"]];
    $message2 = ["order_id"=>"2120423485","from"=>["user_id"=>"17220992","email"=>"colchonesmercado@gmail.com","name"=>"wwwwww SA"],"to"=>[["user_id"=>"73784567","email"=>"marcelo.j.callao@gmail.com","name"=>"Marcelo Jorge Callao"]],"created_at"=>["date"=>"2020-12-09 15=>59=>48.000000","timezone_type"=>3,"timezone"=>"UTC"],"text"=>["plain"=>"s todo lo necesario para utilizar Firebase en tus proyectos con Vue o, por supuesto, JavaScript nativo"]];
    $message3 = ["order_id"=>"2120423486","from"=>["user_id"=>"17220993","email"=>"colchonesmercado@gmail.com","name"=>"pppppp SA"],"to"=>[["user_id"=>"73784561","email"=>"marcelo.j.callao@gmail.com","name"=>"Marcelo Jorge Callao"]],"created_at"=>["date"=>"2020-12-09 15=>59=>48.000000","timezone_type"=>3,"timezone"=>"UTC"],"text"=>["plain"=>"is de Firebase, donde aprenderás todo lo or "]];
    //$msg =  fractal($message, new WebHookMessageTransformer())->toArray()['data'];
    $int = random_int(1,3);
    if ($int == 1) {
        broadcast(new WebHookMessageWasReceived($message1));
    }
    if ($int == 2) {
        broadcast(new WebHookMessageWasReceived($message2));
    }
    if ($int == 3) {
        broadcast(new WebHookMessageWasReceived($message3));
    }
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');    

    /** PRODUCTS */
    Route::group(['prefix' => 'productos', 'middleware' => ['meli']], function () {
        Route::get('nuevo', 'App\ProductController@create')->name('product.create');
        Route::get('precio', 'App\ProductController@price')->name('product.price');
    });

    /** PUBLICATIONS */
    Route::group(['prefix' => 'publicacion', 'middleware' => ['meli']], function () {
        Route::get('nueva', 'App\PublicationController@create')->name('publication.create');
    });

    /** VARIATIONS */
    Route::group(['prefix' => 'variacion', 'middleware' => ['meli']], function () {
        Route::get('nueva', 'App\VariationController@create')->name('variation.create');
    });

    /** MERCADO LIBRE */
    Route::group(['prefix' => 'mercadolibre', 'middleware' => ['meli']], function () {
        Route::get('listado', 'App\MercadoLibreController@list')->name('meli.list');
        Route::get('editar/{meli_id}', 'App\MercadoLibreController@edit')->name('meli.edit');
        Route::get('sincronizar/cuenta', 'App\MercadoLibreController@syncro')->name('meli.syncro');
    });

    /** MERCADOPAGO */
    Route::group(['prefix' => 'mercadopago', 'middleware' => ['meli']], function () {
        Route::get('listado', 'App\MercadoPagoController@mercadopago_payments')->name('mercadopago.list');    
    });

    /** PEDIDOS */
    Route::group(['prefix' => 'pedidos', 'middleware' => ['meli']], function () {
        Route::get('listado', 'App\OrdersController@pedidos');    
    });

    Route::group(['prefix' => 'ordenes'], function () {
        
        Route::get('/listado', 'App\MeliNotificationController@list')->name('notifications.list');
        Route::get('/orden', 'App\MeliNotificationController@show')->name('order.show');

    });
    /** PEDIDOS CLIENTES */
    Route::group(['prefix' => 'pedidos/clientes'], function () {
        
        Route::get('/nuevo', 'App\PedidoClienteController@create');
        Route::get('/edicion/{code}', 'App\PedidoClienteController@edit');
        Route::get('/listado', 'App\PedidoClienteController@list');
        Route::get('/comanda', 'App\PedidoClienteController@comanda');

    });
    
    Route::group(['prefix' => 'clientes'], function () {
        Route::get('listado', 'App\CustomerController@customer_list');       
        Route::get('generar/comprobantes', 'App\CustomerController@generate_voucher')->middleware('afip-data');
        Route::get('listado/comprobantes', 'App\CustomerController@invoices_list')->middleware('afip-data');
        Route::get('edicion/{id}', 'App\CustomerController@edit');
        Route::get('generar/recibo', 'App\CustomerController@generate_recibo');
        Route::get('/recibo/listado', 'App\ReceiptCustomerController@list');
        Route::get('/nuevo', 'App\CustomerController@create');
    });
    /**COMPRAS */
    Route::group(['prefix' => 'proveedores'], function () {
        Route::get('/comprobantes/ingreso', 'App\PurchaserInvoiceController@create');
        Route::get('/comprobantes/pagar', 'App\PurchaserInvoiceController@to_pay');
        Route::get('/comprobantes/listado', 'App\ProviderController@list');
        Route::get('/nuevo', 'App\ProviderController@create');
        Route::get('/ordenes/listado', 'App\OrderPaymentController@list');
        Route::get('/recibos/nuevo', 'App\ReceiptPaymentToProvidersController@create');
        Route::get('/recibos/listado', 'App\ReceiptPaymentToProvidersController@list');
    });

    /** ARBA */
    Route::group(['prefix' => 'arba'], function () {
        Route::get('/alicuota-por-sujeto', 'App\ArbaController@create')->middleware('afip-data');
    });

    /** COMMISSIONS */
    Route::group(['prefix' => 'comisiones'], function () {
        Route::get('/listado', 'App\UserController@list');
    });

});

/** Auth Routes */
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

/** MELI Routes */
Route::get('/meli', 'Auth\AuthMeliController@authorization');
Route::get('/meli/callback', 'Auth\AuthMeliController@handleProviderCallback');

Route::post('/meli/create_test_user', 'Web\WebController@create_test_user');


//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/prueba', 'Web\WebController@prueba')->name('prueba');
Route::get('/', 'Web\WebController@root')->name('root');
Route::get('/productos', 'Web\WebController@listing_products')->name('listing.products');
//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');


/** Rutas WEB */
Route::post('mercadopago_callback', 'Web\WebController@mercadopago_callback');    


/** PRODUCTS */
Route::post('get_products', 'Web\ProductController@index');
Route::post('products_by_category', 'Web\ProductController@by_category');
Route::post('search_products', 'Web\ProductController@search_products');

/** PUBLICATIONS  */
Route::post('/publications', 'Web\PublicationController@index');
Route::get('/categorias/{slug}', 'Web\PublicationController@by_category');

/** CATEGORIES */
Route::post('get_categories', 'Web\CategoryController@index');
Route::get('/tienda', 'Web\WebController@shop')->name('init');
Route::get('/producto/{product_slug}/{id}', 'Web\WebController@product');

/** NEWSLETTER */
Route::post('/email/store', 'Web\NewsLetterController@store');

/** BRANDS */
Route::get('/brands', 'Web\BrandController@index');

/** CART */
Route::get('/carro_de_compras', 'Web\CartController@cart_details');
Route::get('/respuesta_de_compra', 'Web\CartController@sales_process_response')->name('sales.response');

/** PROVINCES */
Route::get('/provinces', 'Web\ProvinceController@index');

/** CITIES */
Route::post('/cities', 'Web\CityController@get_cities_per_province');
Route::post('/shipping', 'Web\CityController@shipping');

/** AFIP */
Route::group(['prefix' => 'afip'], function () {
    
    Route::get('mis-datos', 'App\AfipController@afip_data');
});

/** COMPANY */
Route::group(['prefix' => 'empresa'], function () {
    Route::get('datos', 'App\CompanyController@company_data');
    Route::get('activar-usuario', 'App\AdminController@activate_user');
    Route::get('impuestos', 'App\AdminController@taxes');
});

Route::group(['prefix' => 'error'], function () {
    Route::get('401', 'ErrorController@error_401')->name('401');
});

/* Route::group(['prefix' => 'meli'], function () {
    Route::get('notifications', 'MeliNotificationsController@www');
}); */

