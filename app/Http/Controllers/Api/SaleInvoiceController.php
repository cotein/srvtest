<?php

namespace App\Http\Controllers\Api;

use App\Src\Models\Status;
use App\Src\Models\Receipt;
use App\Src\Models\Customer;
use Illuminate\Http\Request;
use App\Src\Models\SaleInvoice;
use App\Http\Controllers\Controller;
use App\Transformers\InvoiceListTransformer;
use App\Src\Repositories\App\SaleInvoiceRepository;
use App\Transformers\SaleInvoiceByCustomerTransformer;
use App\Transformers\Afip\GetCaeOnAFipToSaveTransformer;
use App\Transformers\Receipt\ReceiptWithDebtTransformer;

class SaleInvoiceController extends Controller
{
    protected $sirepo;
    
    public function __construct()
    {
        $this->sirepo = new SaleInvoiceRepository();
    }
    
    public function index()
    {
        $invoices = SaleInvoice::query();

        if(request()->customer)
        {
            $invoices = $invoices->where('customer_id', request()->customer);
        }

        $invoices = $invoices->orderBy('created_at', 'desc')->paginate(20);

        $invoices_list = fractal($invoices, new InvoiceListTransformer())->toArray()['data'];
        
        $response = [
            'pagination' => [
                'total' => $invoices->total(),
                'per_page' => $invoices->perPage(),
                'current_page' => $invoices->currentPage(),
                'last_page' => $invoices->lastPage(),
                'from' => $invoices->firstItem(),
                'to' => $invoices->lastItem()
            ],
            'data' => $invoices_list
        ];
        return response()->json($response, 200);
    }

    public function voucher_id($value)
    {
        switch ($value) {
            case '001':
                return 1;
            case '002':
                return 2;    
            case '003':
                return 3;    
            case '004':
                return 4;    
            case '005':
                return 5;    
            case '006':
                return 6;    
            case '007':
                return 7;    
            case '008':
                return 8;    
            case '009':
                return 9;    
            case '010':
                return 10;    
            case '011':
                return 11;    
            case '012':
                return 12;    
            case '013':
                return 13;    
            case '201':
                return 92;    
            case '202':
                return 93;    
            case '203':
                return 94;    
        }
    }

    public function store()
    {
        //dd(request()->all());
        activity()
        ->withProperties('SaleInvoice')
        ->log(collect(request()->invoice)->toJson());
        //dd(request()->all());

        $c = collect(request()->invoice['afip_invoice']['FECAESolicitarResult']);

        $FECAESolicitarResult = collect(request()->invoice['afip_invoice']['FECAESolicitarResult']);

        $FeCabResp = $FECAESolicitarResult->get('FeCabResp');
        $FeDetResp = $FECAESolicitarResult->get('FeDetResp');

        $cbte_tipo = str_pad(
            $FeCabResp['CbteTipo'], 
            3, 
            '0', 
            STR_PAD_LEFT
        );

        $customer = Customer::where('number', $FeDetResp['FECAEDetResponse']['DocNro'])->get();
        
        $bill_data = [
            'customer_id' => $customer->first()->id,
            'company_id' => auth()->user()->company_id,
            'doc_nro' => $FeDetResp['FECAEDetResponse']['DocNro'],
            'voucher_id' => $this->voucher_id($cbte_tipo),
            'pto_vta' => $FeCabResp['PtoVta'],
            'cbte_desde' => $FeDetResp['FECAEDetResponse']['CbteDesde'],
            'cbte_hasta' => $FeDetResp['FECAEDetResponse']['CbteHasta'],
            'cbte_fch' => $FeDetResp['FECAEDetResponse']['CbteFch'],
            'cae' => $FeDetResp['FECAEDetResponse']['CAE'],
            'cae_fch_vto' =>$FeDetResp['FECAEDetResponse']['CAEFchVto'],
            /**
             * //TODO Verificar el estado del comprobante
             * al momento de crearlo se puede saldar, o dejar
             * en cuenta corriente
             */
            'status_id' => 1,
            'user_id' => auth()->user()->id,
            'afip_data' => collect(request()->invoice['afip_invoice']),
        ];

        $si = $this->sirepo->create($bill_data, request()->invoice, request()->invoice['products'], request()->invoices, request()->invoice['percep_iibb']);
        
        return response()->json($si, 201);
    }

    public function byCustomer()
    {
        $customer = request()->customer['id'];

        $r = request()->all();

        $invoices = SaleInvoice::where('customer_id', $customer)
                    ->where('searching', false)->whereHas('voucher', function($query) use($r){
            //$query->where('name', 'LIKE', '%'. 'FACTURA'.'%');
            $query->where('name', 'LIKE', '%'. $r['query'] .'%');
            
        })->get();
        
        $invoices =  fractal($invoices, new SaleInvoiceByCustomerTransformer())->toArray()['data'];

        return response()->json($invoices, 200);
    }

    public function byCustomerWithDebt()
    {
        $customer = request()->customer['id'];

        $r = request()->all();

        $invoices = SaleInvoice::where('customer_id', $customer)
                    ->where('status_id', Status::PENDIENTE)
                    ->whereHas('voucher', function($query) use($r){
            //$query->where('name', 'LIKE', '%'. 'FACTURA'.'%');
            $query->where('name', 'LIKE', '%'. $r['query'] .'%');
            
        })->get();

        $rs = Receipt::where('customer_id', $customer)
                    ->where('status_id', Status::PENDIENTE)->get();

        $receipt =  fractal($rs, new ReceiptWithDebtTransformer())->toArray()['data']; 
    
        $invoices =  fractal($invoices, new SaleInvoiceByCustomerTransformer())->toArray()['data'];
        
        $invoices = collect($invoices);

        $invoices = $invoices->merge($receipt);

        return response()->json($invoices->toArray(), 200);
    }

    public function isSearching()
    {
        $invoice = SaleInvoice::find(request()->invoice);
        $invoice->searching = ! $invoice->searching;
        $invoice->save();
    }
}
