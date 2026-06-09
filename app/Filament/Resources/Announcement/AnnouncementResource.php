<?php

namespace App\Filament\Resources\Announcement;

use App\Filament\Resources\Announcement\Pages\CreateAnnouncement;
use App\Filament\Resources\Announcement\Pages\EditAnnouncement;
use App\Filament\Resources\Announcement\Pages\ListAnnouncements;
use App\Filament\Resources\Announcement\Pages\ViewAnnouncement;
use App\Filament\Resources\Announcement\Schemas\AnnouncementForm;
use App\Filament\Resources\Announcement\Tables\AnnouncementsTable;
use App\Models\Announcement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    protected static ?string $navigationLabel = 'Convocatorias';
    protected static ?string $pluralModelLabel = 'Convocatorias y Contrataciones';
    protected static ?string $modelLabel = 'Convocatoria';

    protected static string|UnitEnum|null $navigationGroup = 'Transparencia';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema { return AnnouncementForm::configure($schema); }
    public static function table(Table $table): Table { return AnnouncementsTable::configure($table); }

    public static function getPages(): array
    {
        return [
            'index' => ListAnnouncements::route('/'),
            'create' => CreateAnnouncement::route('/create'),
            'view' => ViewAnnouncement::route('/{record}'),
            'edit' => EditAnnouncement::route('/{record}/edit'),
        ];
    }
}
