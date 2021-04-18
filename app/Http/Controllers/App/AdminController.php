<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function activate_user()
    {
        return view('app.admin.activate-user')->with(['view_name' => 'Activación de Usuarios y Roles']);
    }

    public function taxes()
    {
        return view('app.admin.taxes')->with(['view_name' => 'Alta - Baja de Impuestos']);
    }
}
