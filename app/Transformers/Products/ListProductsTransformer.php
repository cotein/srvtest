<?php

namespace App\Transformers\Products;

use App\Src\Models\Product;
use App\Src\Traits\MoneyFormatTrait;
use App\Src\Unsplash\SearchUnSplash;
use League\Fractal\TransformerAbstract;

class ListProductsTransformer extends TransformerAbstract
{
    use MoneyFormatTrait;

    private $search_photos;

    public function __construct()
    {
        $this->search_photos = new SearchUnSplash();
    }
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        /* $imgs = collect();
        $images = $product->getMedia('product');

        $images->each(function($i) use ($imgs){ 
            //$imgs->prepend(str_replace('http://localhost/', '', $i->getUrl()));
            $imgs->prepend(|$this->search_photos->search('shoes', 30)->getCleanUrls()->url()->getUrlResized(260, 350));
        });

        $sizes = $product->sizes()->get()->map(function($i){
            return [
                'code' => $i->code,
                'name' => $i->name,
            ];
        });
        
        $colours = $product->colours()->get()->map(function($i){
            return [
                'code' => $i->code,
                'name' => $i->name,
                'rgb' => $i->rgb
            ];
        }); */
        return [
            'id' => $product->id,
            'code' => strtoupper($product->code),
            'name' => $product->name,
            'brand' => $product->code,
            'price' => $this->DisplayToUserCurrency($product->original_price),
            'description' => $product->description,
            'in_stock' => $product->in_stock,
            'slug' => $product->slug,
            'imgs' => $product->getMedia('product'),
            //'sizes' => $sizes->toArray(),
            //'colours' => $colours
        ];
    }
}
