<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use Illuminate\Http\Request;

class addJogosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jogos = Jogo::all();
        return view('adicionarJogos', ["jogos" => $jogos]);
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
        // salvar usuário.
       
        $jogos = new Jogo();
        $jogos->time_1 = $request->time_1;
        $jogos->time_2 = $request->time_2;
        $jogos->bandeira_1 = $request->bandeira_1;
        $jogos->bandeira_2 = $request->bandeira_2;
        $jogos->placar_1 = $request->placar_1;
        $jogos->placar_2 = $request->placar_2;
        
        $jogos->save();

        return back()->with('cadastro', 'Cadastro realizado com sucesso, agora o usuário pode fazer apostar');
    
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
    public function edit(Jogo $jogo)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jogo  $jogo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jogo $jogo)
    {
        //
    }
}
