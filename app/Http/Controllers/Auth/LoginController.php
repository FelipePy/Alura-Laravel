<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{
    public function index(): string
    {
        if (Auth::check()) {
            return to_route("series.index");
        }
        return view('login.index');
    }

    public function store(Request $request): string
    {
        if (!Auth::attempt($request->all('email', 'password'))) {
            return redirect()->back()->withErrors("Usuário ou senha inválidos.");
        }

        return to_route('series.index');
    }

    public function destroy(): string
    {
        Auth::logout();

        return to_route('login');
    }
}
