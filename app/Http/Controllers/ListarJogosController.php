<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListarJogosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jogos = Jogo::all();
        return view('listarJogos', ["jogos" => $jogos]);
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
        
            Validator::make(
                $request->all(),
                [
                    'time_1' => 'required|string',
                    'time_2' => 'required|string',
                    'bandeira_1' => 'required|string',
                    'bandeira_2' => 'required|string',
                    
                ],
                [
                    'required' => 'O campo :attribute é obrigatório.',
                ]
            )->validate();
            $jogo = Jogo::find($request->id);
            $jogo->time_1 = $request->time_1;
            $jogo->time_2 = $request->time_2;
            $jogo->bandeira_1 = $request->bandeira_1;
            $jogo->bandeira_2 = $request->bandeira_2;
            $jogo->placar_1 = $request->placar_1;
            $jogo->placar_2 = $request->placar_2;
            $jogo->save();
            return back()->with("sucess", "Jogo atualizado com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jogo  $jogo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jogo::destroy($id);
        return back()->with("sucess", "Jogo removido com sucesso");
    }
}
