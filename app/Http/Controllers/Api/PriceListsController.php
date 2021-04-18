<?php

namespace App\Http\Controllers\Api;

use App\Src\Models\Product;
use Illuminate\Http\Request;
use App\Src\Models\PriceList;
use App\Http\Controllers\Controller;
use App\Src\Models\PriceListProduct;
use App\Transformers\PriceLists\PriceListsByProductTransformer;

class PriceListsController extends Controller
{

    public function enablePriceList()
    {
        $price_lists = PriceList::where('enable', 1)->get();

        return response()->json($price_lists, 200);
    }

    public function getPriceListsOfAProduct()
    {
        //$p = Product::find(request()->product_id);

        $pid = request()->product_id;

        $pl = PriceListProduct::where('product_id', $pid)->get();
        
        $l = fractal($pl, new PriceListsByProductTransformer())->toArray()['data'];

        return response()->json($l, 200);
        
    }

    public function updatePriceProductOnPriceList()
    {
        $plpr = PriceListProduct::where('pricelist_id', request()->pricelist_id)
                ->where('product_id', request()->product_id)
                ->update(
                    ['price' => request()->new_val]
                );
        return response()->json($plpr, 204);
    }
}
