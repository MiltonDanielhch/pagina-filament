<?php

namespace App\Filament\Resources\Complaint;

use App\Filament\Resources\Complaint\Pages\CreateComplaint;
use App\Filament\Resources\Complaint\Pages\EditComplaint;
use App\Filament\Resources\Complaint\Pages\ListComplaints;
use App\Filament\Resources\Complaint\Pages\ViewComplaint;
use App\Filament\Resources\Complaint\Schemas\ComplaintForm;
use App\Filament\Resources\Complaint\Tables\ComplaintsTable;
use App\Models\Complaint;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;
    protected static ?string $navigationLabel = 'Quejas y Reclamos';
    protected static ?string $pluralModelLabel = 'Quejas, Reclamos y Sugerencias';
    protected static ?string $modelLabel = 'Queja';
    protected static string|UnitEnum|null $navigationGroup = 'Servicios';
    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Schema $schema): Schema { return ComplaintForm::configure($schema); }
    public static function table(Table $table): Table { return ComplaintsTable::configure($table); }
    public static function getPages(): array
    {
        return [
            'index' => ListComplaints::route('/'),
            'create' => CreateComplaint::route('/create'),
            'view' => ViewComplaint::route('/{record}'),
            'edit' => EditComplaint::route('/{record}/edit'),
        ];
    }
}
