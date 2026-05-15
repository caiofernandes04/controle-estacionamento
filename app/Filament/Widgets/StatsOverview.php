<?php

namespace App\Filament\Widgets;

use App\Models\MonthlyClient;
use App\Models\Vehicle;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;


class StatsOverview extends BaseWidget
{
    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {
    
        return [
                Stat::make('monthly_clients_count', MonthlyClient::count())
                    ->label('Total de mensalistas')
                    ->description('Número total de mensalistas cadastrados.'),

                Stat::make('active_monthly_clients_count', MonthlyClient::where('active', true)->count())
                    ->label('Mensalistas ativos')
                    ->description('Número de mensalistas atualmente ativos.'),

                Stat::make('value_of_active_monthly_clients', MonthlyClient::where('active', true)->sum('monthly_price'))
                    ->label('Valor mensal dos ativos')
                    ->description('Valor total mensal dos mensalistas ativos.'),

                stat::make('vehicles_count', Vehicle::whereDate('created_at', today())->count())
                    ->label('Total de veículos')
                    ->description('Número total de veículos cadastrados.'),

                stat::make('value_of_vehicles', Vehicle::whereDate('created_at', today())->sum('value'))
                    ->label('Valor total dos veículos')
                    ->description('Valor total de todos os veículos cadastrados.'),
                
        ];
    }
}
