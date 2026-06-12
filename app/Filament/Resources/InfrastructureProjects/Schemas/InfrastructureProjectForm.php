<?php

/**
 * Ubicación: `app/Filament/Resources/InfrastructureProjects/Schemas/InfrastructureProjectForm.php`
 *
 * Descripción: Formulario Filament para proyectos de inversión.
 *              Incluye los nuevos campos del B4 (RM 067/2025).
 *
 * Cumplimiento: 14-cumplimiento-normativo-rm067-2025.md — Bloque B4.
 */

namespace App\Filament\Resources\InfrastructureProjects\Schemas;

use App\Models\InfrastructureProject;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;

class InfrastructureProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información general')
                    ->icon('heroicon-o-identification')
                    ->columns(2)
                    ->schema([
                        Select::make('user_id')
                            ->label('Autor')
                            ->relationship('user', 'name')
                            ->default(fn () => auth()->id())
                            ->disabled(fn () => !auth()->user()?->hasRole('super_admin'))
                            ->dehydrated()
                            ->required(),
                        Select::make('secretariat_id')
                            ->label('Secretaría responsable')
                            ->relationship('secretariat', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Seleccione secretaría'),
                    ]),

                Section::make('Identificación')
                    ->columns(1)
                    ->schema([
                        TextInput::make('code')
                            ->label('Código del proyecto')
                            ->placeholder('GAD-BENI-PI-2026-001')
                            ->maxLength(50)
                            ->unique(ignoreRecord: true)
                            ->helperText('Identificador único institucional (opcional, se puede autogenerar).'),
                        TextInput::make('title')
                            ->label('Título del proyecto')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                $set('slug', Str::slug((string) $state));
                                if (blank($get('code'))) {
                                    $year = now()->year;
                                    $set('code', sprintf('GAD-BENI-PI-%d-%04d', $year, random_int(1, 9999)));
                                }
                            }),
                        TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Se genera automáticamente del título.')
                            ->disabled()
                            ->dehydrated(),
                    ]),

                Section::make('Descripción y beneficiarios')
                    ->columns(1)
                    ->schema([
                        Textarea::make('description')
                            ->label('Descripción del proyecto')
                            ->rows(4)
                            ->columnSpanFull()
                            ->helperText('Objetivo general, alcance y justificación del proyecto.'),
                        KeyValue::make('beneficiary_communities')
                            ->label('Comunidades beneficiarias')
                            ->keyLabel('Comunidad / localidad')
                            ->valueLabel('Nº familias aprox.')
                            ->columnSpanFull()
                            ->addActionLabel('Agregar comunidad'),
                    ]),

                Section::make('Clasificación')
                    ->columns(2)
                    ->schema([
                        Select::make('category')
                            ->label('Categoría')
                            ->options(\App\Models\InfrastructureProject::categories())
                            ->required()
                            ->searchable(),
                        Select::make('municipality')
                            ->label('Municipio')
                            ->options(self::municipalityOptions())
                            ->required()
                            ->searchable()
                            ->placeholder('Seleccione municipio'),
                    ]),

                Section::make('Ubicación geográfica')
                    ->columns(2)
                    ->schema([
                        TextInput::make('latitude')
                            ->label('Latitud')
                            ->numeric()
                            ->step(0.00000001)
                            ->placeholder('-14.8333'),
                        TextInput::make('longitude')
                            ->label('Longitud')
                            ->numeric()
                            ->step(0.00000001)
                            ->placeholder('-64.9000'),
                    ])
                    ->collapsible(),

                Section::make('Estado y cronograma')
                    ->columns(3)
                    ->schema([
                        Select::make('status')
                            ->label('Estado')
                            ->options(InfrastructureProject::statuses())
                            ->required()
                            ->default(InfrastructureProject::STATUS_PLANNING),
                        TextInput::make('progress_percentage')
                            ->label('Avance (%)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%')
                            ->default(0),
                        Toggle::make('is_featured')
                            ->label('Destacado en homepage')
                            ->inline(false)
                            ->default(false),
                        DatePicker::make('start_date')
                            ->label('Fecha de inicio')
                            ->native(false),
                        DatePicker::make('end_date_planned')
                            ->label('Fecha prevista de conclusión')
                            ->native(false),
                        DatePicker::make('end_date_real')
                            ->label('Fecha real de conclusión')
                            ->native(false)
                            ->helperText('Se llena al concluir la obra.'),
                    ]),

                Section::make('Presupuesto y financiamiento')
                    ->columns(2)
                    ->schema([
                        TextInput::make('budget')
                            ->label('Presupuesto total (Bs.)')
                            ->numeric()
                            ->prefix('Bs.')
                            ->step(0.01)
                            ->minValue(0),
                        TextInput::make('contract_number')
                            ->label('Nº de contrato')
                            ->maxLength(100),
                        TextInput::make('contracting_company')
                            ->label('Empresa contratista')
                            ->maxLength(255),
                        TextInput::make('financing_source')
                            ->label('Fuente de financiamiento')
                            ->placeholder('TGN, IDH, Crédito, Cooperación…')
                            ->maxLength(255),
                    ]),

                Section::make('Imagen y galería')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Imagen principal')
                            ->image()
                            ->directory('infrastructure-projects')
                            ->imageEditor()
                            ->columnSpanFull(),
                        Select::make('gallery_id')
                            ->label('Galería asociada (opcional)')
                            ->relationship('gallery', 'title')
                            ->searchable()
                            ->preload()
                            ->placeholder('Sin galería vinculada'),
                    ]),
            ]);
    }

    /**
     * Municipios del Beni (subset ampliado).
     */
    private static function municipalityOptions(): array
    {
        return [
            'trinidad'      => 'Trinidad',
            'san_ignacio'   => 'San Ignacio de Moxos',
            'riberalta'     => 'Riberalta',
            'guayaramerin'  => 'Guayaramerín',
            'rurrenabaque'  => 'Rurrenabaque',
            'san_borja'     => 'San Borja',
            'san_javier'    => 'San Javier',
            'san_andres'    => 'San Andrés',
            'san_joaquin'   => 'San Joaquín',
            'magdalena'     => 'Magdalena',
            'baures'        => 'Baures',
            'huacaraje'     => 'Huacaraje',
            'reyes'         => 'Reyes',
            'santa_rosa'    => 'Santa Rosa',
            'exaltacion'    => 'Exaltación',
            'loreto'        => 'Loreto',
            'puerto_siles'  => 'Puerto Siles',
        ];
    }
}
