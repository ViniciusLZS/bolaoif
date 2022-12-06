<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdicionarUser extends Controller
{
    public function index() {
        return view('adicionarUsuario');
    }
}
