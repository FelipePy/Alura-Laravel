<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return to_route('series.index');
    }
}

# TODO: Preciso inserir o tratamento de erros em todos os controllers, repositorys e etc
