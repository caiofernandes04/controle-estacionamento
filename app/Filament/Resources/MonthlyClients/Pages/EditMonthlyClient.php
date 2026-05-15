<?php

namespace App\Filament\Resources\MonthlyClients\Pages;

use App\Filament\Resources\MonthlyClients\MonthlyClientResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMonthlyClient extends EditRecord
{
    protected static string $resource = MonthlyClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Excluir')
                ->requiresConfirmation()
                ->modalHeading('Excluir mensalista')
                ->modalSubheading('Tem certeza de que deseja excluir este mensalista? Esta ação não pode ser desfeita.'),
        ];
    }
}
