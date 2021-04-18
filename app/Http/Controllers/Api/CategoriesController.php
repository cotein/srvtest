<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Src\Meli\MeliCategories;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;

class CategoriesController extends BaseController
{
    protected $meli_categories;

    public function __construct(MeliCategories $meli_categories)
    {
        parent::__construct();

        $this->meli_categories = $meli_categories;
    } 
    
    public function fetch_main_categories()
    {
        return $this->meli_categories->fetch_main_categories();
    }

    public function fetch_children_categories(Request $request)
    {
        $category = $request->category;

        return $this->meli_categories->fetch_children_categories($category);
    }
}
