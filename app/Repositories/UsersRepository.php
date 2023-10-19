<?php

namespace App\Repositories;

use App\Repositories\Eloquent\EloquentUsersRepository;

interface UsersRepository
{
    public function create(array $user);
    public function find(int $id);
    public function delete(int $id);
}
