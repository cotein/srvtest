<?php

namespace App\Http\Controllers\Web;

use App\Src\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\PublicationHere\NestableCategoryTransformer;

class CategoryController extends Controller
{
    public function index()
    {
        /**
         * Devuelve las categorías que tienen productos asignados
         */
         $categories = Category::has('products')->get();

        //return response()->json($categories, 200);

        //$categories = Category::parent(27)->orderBy('name')->renderAsArray();
        //dd($categories);
        $transformed_categories = fractal($categories->sortBy('name'), new NestableCategoryTransformer())->toArray()['data'];
        
        return response()->json($transformed_categories, 200);
    }

    public function category($slug)
    {
        $cat = Category::where('slug', $slug)->get()->first();

        dd($cat->products);
    }


}