<?php

namespace App\Filament\Resources\MarcoNormativo\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class MarcoNormativoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Identificación')->schema([
                Grid::make(3)->schema([
                    Select::make('type')->label('Tipo')->options([
                        'ley' => 'Ley',
                        'decreto_supremo' => 'Decreto Supremo',
                        'decreto' => 'Decreto',
                        'resolución' => 'Resolución',
                        'otra' => 'Otra',
                    ])->required()->default('resolución'),
                    TextInput::make('number')->label('Número')->placeholder('5340'),
                    Select::make('scope')->label('Ámbito')->options([
                        'nacional' => 'Nacional',
                        'departamental' => 'Departamental',
                    ])->required()->default('nacional'),
                ]),
                TextInput::make('title')->label('Título')->required()->columnSpanFull(),
            ]),
            Section::make('Contenido y Documento')->schema([
                Textarea::make('summary')->label('Resumen / Síntesis')->rows(4)->columnSpanFull(),
                DatePicker::make('issue_date')->label('Fecha de emisión'),
                Grid::make(2)->schema([
                    FileUpload::make('document_file')->label('Documento PDF')
                        ->disk('public')->directory('normativa')
                        ->acceptedFileTypes(['application/pdf']),
                    TextInput::make('external_url')->label('Enlace externo')->url(),
                ]),
            ]),
            Section::make('Configuración')->schema([
                Grid::make(2)->schema([
                    TextInput::make('sort_order')->label('Orden')->numeric()->default(0),
                    Toggle::make('is_published')->label('Publicado')->default(true),
                ]),
            ]),
        ]);
    }
}
