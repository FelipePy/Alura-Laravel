<?php

namespace App\Repositories;

use App\Models\Episode;
use App\Repositories\Eloquent\EloquentEpisodesRepository;
use Illuminate\Database\Eloquent\Collection;

interface EpisodesRepository
{
    public function create(array $episodes);
    public function find(int $id): ? Episode;
    public function findAll(): Collection;
    public function delete(int $id): int;
}

