<?php

namespace App\Filament\Resources\MonthlyClients\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MonthlyClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Telefone')
                    ->searchable(),
                TextColumn::make('plate')
                    ->label('Placa')
                    ->searchable(),
                TextColumn::make('vehicle_model')
                    ->label('Modelo do veículo')
                    ->searchable(),
                TextColumn::make('monthly_price')
                    ->label('Preço mensal')
                    ->money()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Data de início')
                    ->date()
                    ->sortable(),
                TextColumn::make('due_date')
                    ->label('Data de vencimento')
                    ->date()
                    ->sortable(),
                IconColumn::make('active')
                    ->label('Ativo')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                ->label('Editar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
