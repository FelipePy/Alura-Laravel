<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $with = ['episodes'];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function watchedEpisodes(): int
    {
        return $this->episodes
            ->filter(fn ($episode) => $episode->watched)
            ->count();
    }
}
