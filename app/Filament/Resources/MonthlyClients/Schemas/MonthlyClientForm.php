<?php

namespace App\Filament\Resources\MonthlyClients\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MonthlyClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required(),
                TextInput::make('phone')
                    ->label('Telefone')
                    ->tel(),
                TextInput::make('plate')
                    ->label('Placa')
                    ->required(),
                TextInput::make('vehicle_model')
                    ->label('Modelo do veículo'),
                TextInput::make('monthly_price')
                    ->label('Preço mensal')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                DatePicker::make('start_date')
                    ->label('Data de início')
                    ->required(),
                DatePicker::make('due_date')
                    ->label('Data de vencimento'),
                Toggle::make('active')
                    ->label('Ativo')
                    ->required(),
            ]);
    }
}
