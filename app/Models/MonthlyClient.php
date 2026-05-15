<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyClient extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'plate',
        'vehicle_model',
        'monthly_price',
        'start_date',
        'due_date',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'monthly_price' => 'decimal:2',
            'start_date' => 'date',
            'due_date' => 'date',
            'active' => 'boolean',
        ];
    }
}
