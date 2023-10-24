<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\LoginMail;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function store(Request $request, UsersRepository $usersRepository)
    {
        $data = $request->except(['_token']);
        $user = $usersRepository->create($data);

        Auth::login($user);

        $email = new LoginMail(
            $user->name,
            $user->email,
            "mail.auth.create-user",
            "Usuário criado"
        );
        $when = now()->addSeconds( 2);
        Mail::to($user)->later($when, $email);

        return to_route('series.index');
    }
}

# TODO: Preciso inserir o tratamento de erros em todos os controllers, repositorys e etc
