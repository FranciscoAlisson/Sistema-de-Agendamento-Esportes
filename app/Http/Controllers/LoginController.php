<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view ('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],[
            'email.email' => 'O campo de e-mail deve ser um endereço de e-mail válido!',
            'email.required' => 'O campo acima é obrigatório!',
            'password.required' => 'O campo acima é obrigatório!',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();           

            return redirect()->intended('principal');
        }else{
            return redirect()->route('login')->with('loginError','E-mail ou senha inválidos!');
        }
    }

    public function destroy()
    {
        Auth::logout();

        return redirect()->route('login')->with('logout','Logout feito com sucesso!');
    }

    public function register()
    {
        return view ('login.register');
    }

    public function authRegister(Request $request)
    {
        $dados = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('login');
    }
}
