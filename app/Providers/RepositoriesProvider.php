<?php

namespace App\Providers;

use App\Repositories\Eloquent\EloquentEpisodesRepository;
use App\Repositories\Eloquent\EloquentSeasonsRepository;
use App\Repositories\Eloquent\EloquentSeriesRepository;
use App\Repositories\Eloquent\EloquentUsersRepository;
use App\Repositories\EpisodesRepository;
use App\Repositories\SeasonsRepository;
use App\Repositories\SeriesRepository;
use App\Repositories\UsersRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    public array $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class,
        SeasonsRepository::class => EloquentSeasonsRepository::class,
        EpisodesRepository::class => EloquentEpisodesRepository::class,
        UsersRepository::class => EloquentUsersRepository::class
    ];
}
