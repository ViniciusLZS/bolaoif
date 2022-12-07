<?php

namespace App\Http\Controllers;

use App\Models\Aposta;
use App\Models\Jogo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListarApostaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // 
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jogo  $jogo
     * @return \Illuminate\Http\Response
     */
    public function show(Jogo $jogo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jogo  $jogo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::all();
        $jogos = Jogo::all();
        $apostas = Aposta::all();
        return view('listarApostas', ["jogos" => $jogos, 'apostas' => $apostas, 'id' => $id, 'usuarios' =>$usuario]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jogo  $jogo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jogo $jogo)
    {
        Validator::make(
            $request->all(),
            [
        
                'palpite_1' => 'required|numeric',
                'palpite_2' => 'required|numeric',
                    
            ],
            [
                'required' => 'O campo :attribute é obrigatório.',
            ]
        )->validate();
        $aposta = Aposta::find($request->id);
        $aposta->palpite_1 = $request->palpite_1;
        $aposta->palpite_2 = $request->palpite_2;
        $aposta->save();
        return back()->with("sucess", "Aposta atualizada com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jogo  $jogo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Aposta::destroy($id);
        return back()->with("sucess", "Aposta removida com sucesso");
    }
}
