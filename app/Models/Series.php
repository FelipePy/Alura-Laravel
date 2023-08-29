<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    # Caso eu não queira as informações do timestamps, basta apagar da minha migration
    # inserir a linha abaixo no model
    # public $timestamps = false;

    # Caso o nome da classe (Model) fosse diferente do denominado aqui
    # Poderiamos referenciar da seguinte maneira
    ## protected $table = 'seriados';
    protected $fillable = ['name'];
    protected $with = ['seasons'];

    public function seasons()
    {
        return $this->hasMany(Season::class, 'series_id');
    }

    // Escopo global para quando o model for chamado
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
           $queryBuilder->orderBy('name');
        });
    }
}

