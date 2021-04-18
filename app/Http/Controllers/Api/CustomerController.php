<?php

namespace App\Http\Controllers\Api;

use App\Src\Models\Address;
use App\Src\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\Afip\NotFoundPerson;
use App\Src\Afip\WS\Responses\WSPUCResponse;
use App\Transformers\Customer\CustomerTransformer;

class CustomerController extends Controller
{
    public function index()
    {
        $ctmrs = Customer::query();

        if(request()->customer)
        {
            $ctmrs = $ctmrs->where('id', request()->customer);
        }

        $ctmrs = $ctmrs->paginate(20);

        $customers = fractal($ctmrs, new CustomerTransformer())->toArray()['data'];
        
        $response = [
            'pagination' => [
                'total' => $ctmrs->total(),
                'per_page' => $ctmrs->perPage(),
                'current_page' => $ctmrs->currentPage(),
                'last_page' => $ctmrs->lastPage(),
                'from' => $ctmrs->firstItem(),
                'to' => $ctmrs->lastItem()
            ],
            'data' => $customers
        ];
        
        return response()->json($response, 200);
    }
    /**
     * It is bill data
     * //TODO : Create tyransformer class 
     */
    public function customer_transform($customer)
    {
        $address = null;

        $posibles_cities = null;
        //dd($customer->addresses->first());
        if ($customer->addresses()->exists()) {

            $address = [

                'country' =>  'Argentina',
                            
                'state' =>  ($customer->addresses()->exists()) ? $customer->addresses->first()->state['name'] : '',
                            
                'city' =>  ($customer->addresses()->exists()) ? $customer->addresses->first()->city->name : '',
                            
                'cp' =>  ($customer->addresses()->exists()) ? $customer->addresses->first()->cp : '',
                            
                'domicilio' =>  ($customer->addresses()->exists()) ? $customer->addresses->first()->address : '',
                            
            ];

            $posibles_cities = $customer->addresses->first()->city;
            
        }
        
        $customer = [

            'id' => $customer->id,

            'number' => $customer->number,

            'name' => $customer->name,

            'purchaser_document' => $customer->purchaserDocument->name,

            'address' => $address,

            'inscription' => (($customer->inscription()->exists())) ? $customer->inscription->name : '',

            'posibles_cities' => $posibles_cities,
            
            'inscription_id' => $customer->inscription_id
        ];

        return $customer;
    }
    
    public function exist_customer()
    {
        $customer = Customer::where('number',request()->number)->get();

        if ($customer->isEmpty()) {
            
            $result = false;

            return response()->json($result, 200);
        }

        $customer = $customer->first();
        
        //$customer = $this->customer_transform($customer);
        $customer = fractal($customer, new CustomerTransformer())->toArray()['data'];
        return response()->json($customer, 200);
    }

    public function store()
    {
        $response = new WSPUCResponse(request()->customer);

        if(array_key_exists('idPersonaListReturn', request()->customer))  
            return response()->json(false, 200);
        
        if ($response->hasError()) throw new NotFoundPerson;

        if (! Customer::where('number',  $response->idPersona())->exists()) {

            $customer = new Customer;
            $customer->name = $response->nameOrRazonSocia();
            $customer->number = $response->idPersona();
            $customer->inscription_id = $response->inscriptionType();
            $customer->purchaser_document_id = $response->getTipoClave();
            $customer->datos_generales = ($response->hasDatosGenerales()) 
                ? $response->getDatosGenerales() 
                : null;
            $customer->regimen_general = ($response->hasDatosRegimenGeneral()) 
                ? $response->getDatosRegimenGeneral() 
                : null;
            $customer->monotributo = ($response->hasDatosMonotributo()) 
                ? $response->getDatosMonotributo() 
                : null;
            $customer->afip_data = $response->getData();
            $customer->has_afip_data = true;
            $customer->save();
            $customer->fresh();

            if (! array_key_exists('errorConstancia', request()->customer['personaReturn'])) {

                $customer->addresses()->create([
                    'country_id' => 1,
                    'province_id' => $response->getProvinceId(),
                    'city_id' => $response->getCityId(),
                    'address' => $response->getAddress(),
                    'number' => null,
                    'type_id' => 1, 
                    'cp' => $response->getCodPostal(),
                ]);

                $customer->address_id = $customer->addresses()->first()->id;
                $customer->save();
                $customer->fresh();
            }
            
            //$customer = $this->customer_transform($customer);
            $customer = fractal($customer, new CustomerTransformer())->toArray()['data'];
            
            return response()->json($customer, 201);

        }else {
            
            $customer  = Customer::where('number', $response->idPersona())->get()->first();

            $customer = $this->customer_transform($customer);
            
            return response()->json($customer, 200);
        }

    }

    public function store_from_form()
    {
        $validator = \Validator::make(request()->all(), [
            'customer.name' => 'required|unique:customers,name',
            'customer.number' => 'required|unique:customers,number',
            'customer.inscription.id' => 'required',
            'customer.purchase_document.id' => 'required',
            'customer.sublevel_accounting_account.id' => 'required',
        ],
        [
            'customer.name.required' => 'El campo Nombre es requerido.',        
            'customer.name.unique' => 'Este proveedor ya se encuentra registrado.',        
            'customer.number.required' => 'El campo Número es requerido.',        
            'customer.number.unique' => 'La CUIT ya se encuentra registrada.',        
            'customer.inscription.id.required' => 'El campo Inscripción es requerido.',   
            'customer.purchase_document.id.required' => 'El campo Documento Tipo es requerido.',   
            'customer.sublevel_accounting_account.id.required' => 'El campo Cuenta Gastos es requerido.',   
        ]);
        
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 422);
        }

        $cstmr = request()->customer;

        $response = new WSPUCResponse($cstmr['afip_data']);
        
        if ($response->hasError()) throw new NotFoundPerson;
        
        $customer = new Customer;

        $customer->name = $response->nameOrRazonSocia();
        $customer->number = $response->idPersona();
        $customer->inscription_id = $response->inscriptionType();
        $customer->purchaser_document_id = $response->getTipoClave();
        $customer->datos_generales = ($response->hasDatosGenerales()) 
            ? $response->getDatosGenerales() 
            : null;
        $customer->regimen_general = ($response->hasDatosRegimenGeneral()) 
            ? $response->getDatosRegimenGeneral() 
            : null;
        $customer->monotributo = ($response->hasDatosMonotributo()) 
            ? $response->getDatosMonotributo() 
            : null;
        $customer->afip_data = $response->getData();
        $customer->has_afip_data = true;
        $customer->save();
        $customer->fresh();

        if (array_key_exists('addresses', $cstmr)) {
            $customer->addresses()->create([
                'country_id' => 1,
                'province_id' => $response->getProvinceId(),
                'city_id' => $response->getCityId(),
                'address' => $response->getAddress(),
                'number' => (is_null($cstmr['number']) ? null : $cstmr['number']),
                'type_id' => 1, 
                'cp' => $response->getCodPostal(),
            ]);
            $customer->save();
            $customer->fresh();
        }
       /*  if ($cstmr['address']['address'] != '') {
            $customer->addresses()->create([
                'country_id' => 1,
                'province_id' => $response->getProvinceId(),
                'city_id' => $response->getCityId(),
                'address' => $response->getAddress(),
                'number' => (is_null($cstmr['address']['number']) ? null : $cstmr['address']['number']),
                'type_id' => 1, 
                'cp' => $response->getCodPostal(),
            ]);

            $customer->save();
            $customer->fresh();
        } */
        
        $customer = fractal($customer, new CustomerTransformer())->toArray()['data'];
        
        return response()->json($customer, 201);

    }

    public function update()
    {
        $response = new WSPUCResponse(request()->customer);
        //dd(request()->dni_cuil_cuit);
        //* Cuando devuelve un listado de personas

        /* if(array_key_exists('idPersonaListReturn', request()->customer))  
            return response()->json(false, 200); */
        
        if ($response->hasError()) throw new NotFoundPerson;
        try {
            
            if (! is_null(request()->original_cuit)) {
                $customer = Customer::where('number',  request()->original_cuit)->get()->first();
                
            }else{

                $customer = Customer::where('number',  request()->dni_cuil_cuit)->get()->first();
            }
            
            //$name = $response->nameOrRazonSocia() . ' | ' . (is_null($customer->name)) ? '' : $customer->name;
            $name = $response->nameOrRazonSocia() . ' | ' .  $customer->name;

            $customer->name = $name;
            $customer->number = $response->idPersona();
            $customer->inscription_id = $response->inscriptionType();
            $customer->purchaser_document_id = $response->getTipoClave();
            $customer->datos_generales = ($response->hasDatosGenerales()) 
                ? $response->getDatosGenerales() 
                : null;
            $customer->regimen_general = ($response->hasDatosRegimenGeneral()) 
                ? $response->getDatosRegimenGeneral() 
                : null;
            $customer->monotributo = ($response->hasDatosMonotributo()) 
                ? $response->getDatosMonotributo() 
                : null;
            $customer->afip_data = $response->getData();
            $customer->has_afip_data = true;
            $customer->save();
            $customer->fresh();

            if (! array_key_exists('errorConstancia', request()->customer['personaReturn'])) {

                $customer->addresses()->create([
                    'country_id' => 1,
                    'province_id' => $response->getProvinceId(),
                    'city_id' => $response->getCityId(),
                    'address' => $response->getAddress(),
                    'number' => null,
                    'type_id' => 1, 
                    'cp' => $response->getCodPostal(),
                ]);

                $customer->address_id = $customer->addresses()->first()->id;
                $customer->save();
                $customer->fresh();
            }
            
            $customer = fractal($customer, new CustomerTransformer())->toArray()['data'];
            
            return response()->json($customer, 200);
        
        } catch (\Exception $e) {
            
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    public function address_update()
    {
        $customer_data = request()->customer_data['customer'];

        $address = request()->customer_data['address']; 

        $customer = Customer::find($customer_data['id']);

        $customer->addresses()->create([
            'country_id' => 1,
            'province_id' => $address['state']['id'],
            'city_id' => $address['city']['id'],
            'address' => strtoupper($address['address']),
            'number' => null,
            'cp' => $address['city']['cp'],
        ]);

        $customer->address_id = $customer->addresses()->first()->id;
        $customer->save();
        $customer->fresh();

        $customer = $this->customer_transform($customer);

        return response()->json($customer, 200);
    }

    public function find_customer_by_name()
    {
        //$customers = Customer::search(request()->customer)->get(['id', 'name', 'number']);

        $customers = Customer::where('name', 'like', '%' . request()->customer . '%')->take(51)->get(['id', 'name', 'number']);

        //$customers = fractal($customers, new CustomerTransformer())->toArray()['data'];

        return response()->json($customers, 200);
    }

    public function show()
    {
        $cstmr = Customer::find(request()->customer_id);

        $customer = fractal($cstmr, new CustomerTransformer())->toArray()['data'];

        return response()->json($customer, 200);
    }

    public function update_from_modal()
    {
        $customer = request()->customer;

        $c = Customer::find($customer['id']);
        $c->inscription_id = $customer['inscription']['id'];
        $c->contact = $customer['contact']['name'];
        $c->cell_phone = $customer['contact']['cell_phone'];
        $c->phone_1 = $customer['contact']['phone_1'];
        $c->phone_2 = $customer['contact']['phone_2'];
        $c->phone_3 = $customer['contact']['phone_3'];
        $c->email = $customer['contact']['email'];
        $c->customer_type_id = $customer['type']['id'];
        $c->accounting_account_child_id = $customer['sublevel_accounting_account']['id'];

        $c->save();
        $c->refresh();

        collect($customer['addresses'])->map(function($address) use($c) {
            if (array_key_exists('id', $address)) {
                $addr = Address::find($address['id']);
                
                $addr->province_id = $address['state']['id'];
                $addr->city_id = $address['city']['id'];
                $addr->type_id = $address['type']['id'];
                $addr->address = strtoupper($address['address']);
                $addr->number = $address['number'];
                $addr->obs = $address['obs'];
                $addr->between_streets = $address['between'];
                $addr->cp = $address['cp'];
                $addr->save();
                
            }else{
                
                $c->addresses()->create([
                    'country_id' => 1,
                    'province_id' => $address['state']['id'],
                    'city_id' => $address['city']['id'],
                    'type_id' => $address['type']['id'],
                    'between_streets' => $address['between'],
                    'obs' => $address['obs'],
                    'address' => strtoupper($address['address']),
                    'number' => $address['city']['cp'],
                    'cp' => $address['city']['cp'],
                ]);
            }
        });

        $customer = fractal($c, new CustomerTransformer())->toArray()['data'];

        return response()->json($customer, 201);
    }
}
