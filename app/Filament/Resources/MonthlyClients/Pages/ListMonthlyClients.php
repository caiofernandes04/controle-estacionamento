<?php

namespace App\Filament\Resources\MonthlyClients\Pages;

use App\Filament\Resources\MonthlyClients\MonthlyClientResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMonthlyClients extends ListRecords
{
    protected static string $resource = MonthlyClientResource::class;

    protected function getHeaderActions(): array
    {

        return [
            CreateAction::make()
            ->label('Novo mensalista')
        ];
    }

    public function getTitle(): string
    {
        return 'Mensalistas';
    }

    public function getBreadcrumb(): string
    {
        return 'Lista';
    }
}
