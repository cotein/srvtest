<?php

namespace App\Http\Controllers\Api;

use App\Src\Models\Status;
use App\Src\Models\Picture;
use App\Src\Models\Product;
use Illuminate\Http\Request;
use App\Src\Meli\MeliPictures;
use App\Src\Meli\MeliProductos;
use App\Src\Tools\StdClassTool;
use App\Src\Meli\MeliHandleData;
use App\Src\Traits\ProductTrait;
use App\Events\ProductWasCreated;
use App\Http\Controllers\Controller;
use App\Src\Categories\CategoryBase;
use App\Src\Models\PriceListProduct;
use App\Src\Traits\MoneyFormatTrait;
use Illuminate\Support\Facades\Artisan;
use MahdiMajidzadeh\LaravelUnsplash\Photo;
use App\Http\Controllers\Api\BaseController;
use App\Src\Traits\PublicationTransformerTrait;
use App\Transformers\Products\FindProductByNameTransformer;
use App\Transformers\Products\AddVariationToProductTransformer;

class ProductController extends BaseController
{
    use MoneyFormatTrait, PublicationTransformerTrait, ProductTrait;
    
    const MAX_PRIORITY = 10;
    
    const ACTIVE_STATUS = 1;
    
    const CRITICAL_STOCK = 10;
    
    const FIRST_VARIATION = 1;
    
    protected $meliproducts;
    
    protected $handle_data;

    protected $unsplash;

    protected $photo1;
    
    protected $photo2;

    protected $meli_pictures;

    public function __construct(MeliProductos $meliproducts)
    {
        parent::__construct();

        $this->meliproducts = $meliproducts;
        
        $this->unsplash  = new Photo();

        $this->meli_pictures = new MeliPictures();

        //$this->photo1 = $this->unsplash->random('shoes')->get()->urls->small;

    }

    public function total()
    {
        return Product::count();
    }
    
    public function index()
    {
        $products = Product::all();

        $prs = fractal($products, new AddVariationToProductTransformer())->toArray()['data'];

        return response()->json($prs, 200);
    }
    
    public function store(Request $request)
    {
        //$this->photo2 = $this->unsplash->random('shoes')->get()->urls->small;

        $data = $request->all();
        //dd($data);
        $pr = collect(json_decode($data['product'], true))->toArray();

        $files = collect($data['file']);

        $product = new Product;
        $product->supplier_id = $pr['supplier']['id'];
        $product->brand_id = $pr['brand']['id'];
        $product->attr_item_condition = $pr['attr_item_condition'];
        $product->buying_mode = $pr['buying_mode'];
        $product->main_category = $pr['category']; 
        $product->path_from_root = $pr['path_from_root'];
        $product->children_category = $pr['sub_category'];
        $product->name = $pr['name'];
        $product->code = $pr['code']; //tomo estos ceros para el número de variación
        $product->sub_title = null;
        $product->description = $pr['description'];
        $product->original_price = $pr['original_price'];
        $product->sale_price = $pr['sale_price'];
        $product->seller_custom_field = $pr['code']  . '-0000' ; //tomo estos ceros para el número de variación
        $product->meta_keywords = null;
        $product->iva = $pr['iva'];
        $product->listing_type = $pr['listing_type'];
        $product->money = $pr['money'];
        $product->status_id = Status::ACTIVO;
        $product->priority_id = self::MAX_PRIORITY;
        $product->attributes = $pr['others_attributes'];

        $product->save();
        
        $price_list_product = new PriceListProduct;
        $price_list_product->pricelist_id = $pr['price_list']['id'];
        $price_list_product->product_id = $product->id;
        $price_list_product->price = $pr['sale_price'];
        $price_list_product->save();
        
        $product->refresh();

        if ($request->has('file')) {
            
            $files->each(function($f, $key) use($product, $request) {
                $product->addMedia($request->file[$key])->toMediaCollection('products');
            });

            $product->getMedia('products')->each(function($image) use($product) {
                
                $pic = $this->meli_pictures->process_pictures(auth()->user()->company->mercadoLibre->meli_token, $image->getFullUrl());
                
                $img = StdClassTool::toArray($pic['body']);
                
                $picture = new Picture;
                $picture->product_id = $product->id;
                $picture->meli_id = $img['id'];
                $picture->size = $img['variations'][0]['size'];
                $picture->quality = null;
                $picture->max_size = $img['max_size'];
                $picture->url = $img['variations'][0]['url'];
                $picture->secure_url = $img['variations'][0]['secure_url'];
                $picture->save(); 

                sleep(0.5);

                $result = $this->meli_pictures->add_picture_to_product(auth()->user()->company->mercadoLibre->meli_token, $product->meli_id, $img['id']);
                
                activity('AddImageToProduct')
                    ->withProperties(['Product' => $product->meli_id])
                    ->log(collect($result)->toJson());
            });
        }
        
        //dd($product->path_from_root);
        CategoryBase::handler($product->path_from_root);
    
        $variation = $product->variations()->create([
            'product_id' => $product->id,
            'seller_custom_field' => $product->seller_custom_field,
            'attribute_combinations' => $pr['variation']['attribute_combinations'],
            'attributes' => $pr['variation']['attributes'],
        ]);
        
        $variation->stock()->create([
            'variation_id' => $variation->id,
            'total_stock' => $pr['available_total'],
            'available_quantity_meli' =>$pr['available_quantity'],
            'published_meli_history' => 0,
            'available_quantity_here' => 0,
            'published_here_history' => 0,
            'sold_on_meli' => 0,
            'sold_on_here' => 0,
            'critical_stock' => self::CRITICAL_STOCK,
        ]);
        
        Artisan::call('product:search_by');
        
        return response()->json($product, 201);
    }

    public function fetchlistingtypes()
    {
        return $this->meliproducts->fetch_listing_types();
    }
    
    public function fetchattributes(Request $request)
    {
        $category = $request->category;

        $attributes = $this->meliproducts->fetch_attributes($category);

        /* if ($this->response_has_error($attributes)) {

            return response()->json($this->response_message($attributes), 500);

        } */

        return response()->json($attributes, 200);
    }
   
    public function fetchsubcategories(Request $request)
    {
        $category = $request->category['code'];

        return $this->meliproducts->fetch_sub_categories($category);
    }

    public function update_ok()
    {
        return response()->json(1);
    }

    public function iva_update(Request $request)
    {
        $product = Product::find($request->product['product_id']);

        $product->iva = $request->iva;
        $product->save();

        return response()->json($product, 200);
    }

    public function findProductByName()
    {
        $product_name = request()->product_name;
        /* $result = null;
        $e = explode(' ', $product_name);
        foreach ($e as $value) {
            $result = $result .  '%' . $value . '%';
        }  */
        //$prs = Product::search($result)->get();

        $prs = Product::where('search_by', 'like', '%' . $product_name . '%')->take(50)->get();

        $products = fractal($prs, new FindProductByNameTransformer())->toArray()['data'];

        return response()->json($products, 200);
    }
   
}
