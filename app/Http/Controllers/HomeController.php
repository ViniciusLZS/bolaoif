<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogo;

class HomeController extends Controller
{
    function index()
    {
        return view('welcome')->with('jogos', Jogo::limit(6)->get());
    }
}
