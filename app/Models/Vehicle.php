<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    // Nome da tabela (opcional se for "vehicles")
    protected $table = 'vehicles';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'name',
        'plate',
        'value',
        'visit',
        'eco',
        'day_entry',
        'time_exits',
        'entry_time'
    ];

    // Se quiser tratar datas automaticamente
    protected $casts = [
        'entry_time' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS (EXEMPLOS)
    |--------------------------------------------------------------------------
    */

    // Exemplo: placa formatada
    public function getPlateUpperAttribute()
    {
        return strtoupper($this->plate);
    }

    // Exemplo: verificar se é visitante
    public function isVisitor()
    {
        return $this->visit == 1;
    }
}