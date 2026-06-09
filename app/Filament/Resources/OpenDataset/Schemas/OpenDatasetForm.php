<?php

namespace App\Filament\Resources\OpenDataset\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class OpenDatasetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Información del dataset')->schema([
                TextInput::make('title')->label('Título')->required()->columnSpanFull(),
                Textarea::make('description')->label('Descripción')->rows(4)->columnSpanFull(),
                Grid::make(2)->schema([
                    TextInput::make('category')->label('Categoría')->placeholder('presupuesto, salud, educacion...'),
                    TextInput::make('publisher')->label('Publicador / Secretaría'),
                ]),
            ]),
            Section::make('Actualización')->schema([
                Grid::make(2)->schema([
                    Select::make('update_frequency')->label('Frecuencia')->options([
                        'diario' => 'Diario', 'semanal' => 'Semanal',
                        'mensual' => 'Mensual', 'trimestral' => 'Trimestral',
                        'anual' => 'Anual', 'eventual' => 'Eventual',
                    ])->default('eventual'),
                    DatePicker::make('last_updated_at')->label('Última actualización'),
                ]),
            ]),
            Section::make('Archivos y formatos')->schema([
                Select::make('formats')->label('Formatos disponibles')
                    ->options(['csv' => 'CSV', 'json' => 'JSON', 'xlsx' => 'Excel', 'pdf' => 'PDF'])
                    ->multiple()
                    ->required()
                    ->columnSpanFull(),
                Grid::make(2)->schema([
                    FileUpload::make('file_csv')->label('Archivo CSV')->disk('public')->directory('open-data'),
                    FileUpload::make('file_json')->label('Archivo JSON')->disk('public')->directory('open-data'),
                    FileUpload::make('file_xlsx')->label('Archivo Excel')->disk('public')->directory('open-data'),
                    FileUpload::make('file_pdf')->label('Archivo PDF')->disk('public')->directory('open-data'),
                ]),
                TextInput::make('external_url')->label('Enlace externo (datos.gob.bo)')->url()->columnSpanFull(),
            ]),
            Section::make('Configuración')->schema([
                Grid::make(3)->schema([
                    TextInput::make('license')->label('Licencia')->default('CC-BY-4.0'),
                    TextInput::make('sort_order')->label('Orden')->numeric()->default(0),
                    Toggle::make('is_published')->label('Publicado')->default(true),
                ]),
            ]),
        ]);
    }
}
