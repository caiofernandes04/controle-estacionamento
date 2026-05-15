<?php

namespace App\Filament\Resources\MonthlyClients;

use App\Filament\Resources\MonthlyClients\Pages\CreateMonthlyClient;
use App\Filament\Resources\MonthlyClients\Pages\EditMonthlyClient;
use App\Filament\Resources\MonthlyClients\Pages\ListMonthlyClients;
use App\Filament\Resources\MonthlyClients\Schemas\MonthlyClientForm;
use App\Filament\Resources\MonthlyClients\Tables\MonthlyClientsTable;
use App\Models\MonthlyClient;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MonthlyClientResource extends Resource
{
    protected static ?string $model = MonthlyClient::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    
    protected static ?string $navigationLabel = 'Mensalistas';

    protected static ?string $modelLabel = 'Mensalista';

    protected static ?string $pluralModelLabel = 'Mensalistas';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return MonthlyClientForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MonthlyClientsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMonthlyClients::route('/'),
            'create' => CreateMonthlyClient::route('/create'),
            'edit' => EditMonthlyClient::route('/{record}/edit'),
        ];
    }
}
