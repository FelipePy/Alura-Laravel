<?php

namespace App\Repositories;

use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;

interface SeasonsRepository
{
    public function create(array $seasons);
    public function find(int $id): ? Season;
    public function findAll(): Collection;
    public function delete(int $id): int;
    public function update(Season $seasons);
}
