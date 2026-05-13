<?php

namespace App\Exports;

use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;

class VehiclesExport implements FromCollection
{
    public function collection()
    {
        return Vehicle::join('users', 'vehicles.user_id', '=', 'users.id')
            ->select(
                'vehicles.id',
                'vehicles.name',
                'vehicles.plate',
                'vehicles.type',
                'vehicles.value',
                'vehicles.created_at',
                'vehicles.updated_at',
                'users.name as user_name'
            )
            ->get()
            ->map(function ($vehicle) {

                return [
                    'ID' => $vehicle->id,

                    'Nome' => $vehicle->name,

                    'Placa' => $vehicle->plate,

                    'Tipo' => $vehicle->type,

                    'Valor' => 'R$ ' . number_format(
                        $vehicle->value,
                        2,
                        ',',
                        '.'
                    ),

                    'Usuário' => $vehicle->user_name,

                    'Criado em' => Carbon::parse(
                        $vehicle->created_at
                    )->format('d/m/Y H:i:s'),

                    'Atualizado em' => Carbon::parse(
                        $vehicle->updated_at
                    )->format('d/m/Y H:i:s'),
                ];
            });
    }
}