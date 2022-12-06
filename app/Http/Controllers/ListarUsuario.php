<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListarUsuario extends Controller
{
    public function index() {
        $usuarios = User::all();
        return view('listarUsuarios', compact('usuarios'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
}
