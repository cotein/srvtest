<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function create()
    {
        return view('app.products.new')->with(['view_name' => "Ingreso de Productos"]);
    }

    public function price()
    {
        return view('app.products.price')->with(['view_name' => "Importe de un Artículo"]);
    }
}
