<?php

namespace App\Http\Controllers\Api\Afip;

use Jenssegers\Date\Date;
use Illuminate\Http\Request;
use App\Src\Tools\StdClassTool;
use App\Src\Afip\WS\Source\WSFEV1;
use App\Src\Traits\DateFormatTrait;
use App\Http\Controllers\Controller;
use App\Src\Afip\WS\Source\WSFECRED;
use App\Exceptions\Afip\AfipResponseException;
use App\Src\Repositories\App\SaleInvoiceRepository;
use App\Src\Afip\WS\Responses\WSFEGetCaeOnAfipResponse;
use App\Transformers\Afip\GetCaeOnAFipToSaveTransformer;
use App\Src\Afip\WS\Responses\WSFEUltimoAutorizadoResponse;

class WSFEController extends Controller
{
    use DateFormatTrait;
    
    protected $wsfe;
    
    protected $wsFeCred;
    
    protected $wsfe_response;

    public function __construct()
    {
        $this->wsfe = new WSFEV1( env('WSFEV1_AFIP_ENVIRONMENT'));
        
        $this->wsFeCred = new WSFECRED( env('WSFECRED_AFIP_ENVIRONMENT'));
    }

    public function ultimo_autorizado()
    {   
        \Log::info("########### ULTIMO AUTORIZADO ##########");
        \Log::info('DATOS QUE SE VAN A CONSULTAR: CBTETIPO -> '.request()->CteTipo );
        \Log::info("###########");
        $result = $this->wsfe->ultimoAutorizado(6, request()->CteTipo);
        
        $this->wsfe_response = new WSFEUltimoAutorizadoResponse($result);

        if($this->wsfe_response->hasErrors()){
           
            $this->wsfe_response->saveErrors(request());

            $err = $this->wsfe_response->getErrors();

            throw new AfipResponseException($err->toJson(), 444);
        }

        return $this->wsfe_response->getUltimoAutorizado();
        
    }

    public function generate()
    {
        $req = request()->all()['data'];
        //dd($req);
        $cuit =  (double) $req['FECAEDetRequest']['DocNro'];
        $date = $this->change_divider_slash($req['FECAEDetRequest']['CbteFch']);
        
        $req['FECAEDetRequest']['DocNro'] = (double) $req['FECAEDetRequest']['DocNro'];
        
        $FchVtoPago = $req['FECAEDetRequest']['FchVtoPago'];

        if ($req['FECAEDetRequest']['Concepto'] == 1) {
            $req['FECAEDetRequest']['FchVtoPago'] = '';
        }

        if ($req['FeCabReq']['CbteTipo'] == '001' || $req['FeCabReq']['CbteTipo'] == '006' || $req['FeCabReq']['CbteTipo'] == '011') {
            $req['FECAEDetRequest']['FchVtoPago'] = '';
        }

        if ($this->wsFeCred->isMiPyme($cuit, $date)) {
            
            if ( $req['FECAEDetRequest']['ImpNeto'] >= $this->wsFeCred->montoDesde) {

                if ($req['FeCabReq']['CbteTipo'] == '001')  $req['FeCabReq']['CbteTipo'] = '201';  
                
                if ($req['FeCabReq']['CbteTipo'] == '002')  $req['FeCabReq']['CbteTipo'] = '202';  
                if ($req['FeCabReq']['CbteTipo'] == '003')  $req['FeCabReq']['CbteTipo'] = '203';  
                
                if ($req['FeCabReq']['CbteTipo'] == '006')  $req['FeCabReq']['CbteTipo'] = '206';  
                if ($req['FeCabReq']['CbteTipo'] == '007')  $req['FeCabReq']['CbteTipo'] = '207';  
                if ($req['FeCabReq']['CbteTipo'] == '008')  $req['FeCabReq']['CbteTipo'] = '208';  

                $req['FECAEDetRequest']['FchVtoPago'] = $FchVtoPago;

                $req = $this->wsFeCred->setOpcional($req);

                $result = $this->wsfe->ultimoAutorizado(6, $req['FeCabReq']['CbteTipo']);

                $num = StdClassTool::toArray($result);
                
                $req['FECAEDetRequest']['CbteDesde'] = $num['FECompUltimoAutorizadoResult']['CbteNro'] + 1;
                $req['FECAEDetRequest']['CbteHasta'] = $num['FECompUltimoAutorizadoResult']['CbteNro'] + 1; 
            }
        }

        $result = $this->wsfe->getCaeOnAfip(
            $req['FeCabReq'], 
            $req['FECAEDetRequest']
        );

        $this->wsfe_response = new WSFEGetCaeOnAfipResponse($result);

        if ($this->wsfe_response->isRejected()) {
           
            $this->wsfe_response->saveErrors(request());

            $errors = collect($this->wsfe_response->getMessages());

            throw new AfipResponseException($errors->toJson(), 444);
        }
       
       return response()->json($result, 200);
    }

    public function tipoTributos()
    {
        $result = $this->wsfe->tipoTributos();
        dd($result);
        return response()->json($result, 200);
        

    }
}