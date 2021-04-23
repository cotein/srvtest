<?php

namespace App\Transformers\Afip;

use App\Src\Models\Voucher;
use App\Src\Models\Customer;
use App\Src\Tools\StdClassTool;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class GetCaeOnAFipToSaveTransformer extends TransformerAbstract
{
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
   
    public function transform($responseFromAfip)
    {
        $c = collect($responseFromAfip);
        \Log::alert("----------------------");
        \Log::alert("######################");
        \Log::alert("responseFromAfip : " . $c->toJson());
        \Log::alert("######################");
        \Log::alert("######################");

        $FECAESolicitarResult = collect($c->get('FECAESolicitarResult'));

        $FeDetResp = $FECAESolicitarResult->get('FeDetResp');
        \Log::alert("----------------------");
        \Log::alert("######################");
        \Log::alert("FeDetResp : " . collect($FeDetResp)->toJson());
        \Log::alert("######################");
        \Log::alert("######################");
        $FeCabResp = $FECAESolicitarResult->get('FeCabResp');

        $cbte_tipo = str_pad(
            $FeCabResp['CbteTipo'], 
            3, 
            '0', 
            STR_PAD_LEFT
        );

        $customer = Customer::where('number', $FeDetResp['FECAEDetResponse']['DocNro'])->get();
        \Log::alert("customer : " . $customer->toJson());
        //dd($customer->first()->id, $customer->count());
        \Log::alert("----------------------");
        \Log::alert("######################");
        \Log::alert("customer->first()->id : " . $customer->first()->id);
        \Log::alert("######################");
        \Log::alert("----------------------");
        
        $result = [
            //'customer_id' => 3,
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
            'afip_data' => $c->toArray(),
        ];

        return $result;
    }
}
