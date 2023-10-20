<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return to_route("series.index");
        }
        return view('login.index');
    }

    public function store(Request $request)
    {
        if (!Auth::attempt($request->all('email', 'password'))) {
            return redirect()->back()->withErrors("Usuário ou senha inválidos.");
        }

        return to_route('series.index');
    }
}
