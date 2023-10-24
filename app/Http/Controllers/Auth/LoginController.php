<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\LoginMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        $user = Auth::user();
        $email = new LoginMail(
            $user->name,
            $user->email,
            "mail.auth.login",
            "Login realizado"
        );
        $when = now()->addSeconds(4);
        Mail::to($user)->later($when, $email);

        return to_route('series.index');
    }

    public function destroy(): string
    {
        Auth::logout();

        return to_route('login');
    }
}
