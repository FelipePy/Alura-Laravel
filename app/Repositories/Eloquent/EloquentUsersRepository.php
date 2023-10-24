<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UsersRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class EloquentUsersRepository implements UsersRepository
{
    public function create(array $user)
    {
        $user['password'] = Hash::make($user['password']);
        return User::create($user);
    }

    public function find(int $id)
    {
        return User::findOrFail($id);
    }

    public function findAll() {
        return User::all();
    }


    public function findByEmail(string $email)
    {
        return User::select('id')->where('email', $email)->first();
    }

    public function delete(int $id)
    {
        return User::destroy($id);
    }
}
