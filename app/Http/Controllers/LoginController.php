<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->back();
        }

        return back()->withErrors(['login' => 'Email ou senha incorretos.']);
    }

    function cadastrar(Request $request)
    {

        // verificar se o email já está cadastrado.
        $usuario = User::whereEmail($request->email)->first();
        if ($usuario )
            return back()->withErrors(["cadastro" => "E-mail já cadastrado!"]);

        // verificar se as senhas combinam.
        if ($request->password !== $request->confirma_senha)
            return back()->withErrors(["cadastro" => "Senha e Confirmar Senha não combinam!"]);

        // salvar usuário.
        $usuario = new User();
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->admin = '';
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return back()->with('cadastro', 'Cadastro realizado com sucesso, agora o usuário pode fazer o login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('welcome');
    }
}
