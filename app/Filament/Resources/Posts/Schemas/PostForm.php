<?php

namespace App\Filament\Resources\Posts\Schemas;

// 📝 Campos de entrada (Formularios)
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

// 🛠️ Estructura y maquetación de Esquemas unificados (Filament v5)
use Filament\Schemas\Components\Grid; // 💡 Cambiado aquí
use Filament\Schemas\Schema;

use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\PostTemplate;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Selector de plantilla
                Grid::make(1)
                    ->schema([
                        Select::make('template_id')
                            ->label('Plantilla (opcional)')
                            ->options(PostTemplate::active()->pluck('name', 'id'))
                            ->placeholder('Seleccionar plantilla para comenzar con estructura predefinida')
                            ->live()
                            ->afterStateUpdated(function ($state, $set) {
                                if ($state) {
                                    $template = PostTemplate::find($state);
                                    if ($template && is_array($template->default_data)) {
                                        $data = $template->default_data;
                                        
                                        if (isset($data['title'])) {
                                            $set('title', $data['title']);
                                            $set('slug', Str::slug($data['title']));
                                            $set('meta_title', $data['title']);
                                        }
                                        if (isset($data['body'])) {
                                            $set('body', $data['body']);
                                        }
                                        if (isset($data['category_id'])) {
                                            $set('category_id', $data['category_id']);
                                        }
                                    }
                                }
                            }),
                    ]),

                // Campos del formulario
                Grid::make(2)
                    ->schema([
                        Select::make('user_id')
                            ->label('Autor')
                            ->relationship('user', 'name')
                            ->default(fn () => auth()->id())
                            ->disabled(fn () => !auth()->user()?->hasRole('super_admin'))
                            ->dehydrated()
                            ->required(),

                        Select::make('category_id')
                            ->label('Categoría')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ]),

                TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $set('slug', Str::slug($state));
                        
                        if (empty($get('meta_title'))) {
                            $set('meta_title', $state);
                        }

                        if (empty($get('category_id')) && !empty($state)) {
                            $titleLower = Str::lower($state);
                            
                            $keywordMap = [
                                'salud'           => ['salud', 'hospital', 'medicina', 'covid', 'vacuna', 'consulta'],
                                'infraestructura' => ['obra', 'construcción', 'asfalto', 'puente', 'carretera', 'edificio'],
                                'cultura'         => ['cultura', 'tradición', 'festividad', 'folklore', 'arte', 'música'],
                                'educacion'       => ['educación', 'escuela', 'colegio', 'universidad', 'estudiante', 'docente'],
                            ];

                            foreach ($keywordMap as $slug => $keywords) {
                                foreach ($keywords as $keyword) {
                                    if (str_contains($titleLower, $keyword)) {
                                        $category = Category::where('slug', $slug)->first();
                                        if ($category) {
                                            $set('category_id', $category->id);
                                            return;
                                        }
                                    }
                                }
                            }
                        }
                    })
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Imagen')
                    ->collection('featured')
                    ->multiple(false)
                    ->columnSpanFull(),

                Textarea::make('excerpt')
                    ->label('Extracto')
                    ->columnSpanFull()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $set, $get) {
                        if (!empty($state) && empty($get('meta_description'))) {
                            $set('meta_description', $state);
                        }
                    }),

                RichEditor::make('body')
                    ->label('Contenido')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $set, $get) {
                        if (empty($get('excerpt')) && !empty($state)) {
                            $plainText = strip_tags($state);
                            $excerpt = Str::limit($plainText, 150, '...');
                            $set('excerpt', $excerpt);

                            if (empty($get('meta_description'))) {
                                $set('meta_description', $excerpt);
                            }
                        }
                    })
                    ->columnSpanFull(),

                Grid::make(2)
                    ->schema([
                        Select::make('status')
                            ->label('Estado')
                            ->options([
                                'draft' => 'Borrador', 
                                'published' => 'Publicado', 
                                'archived' => 'Archivado'
                            ])
                            ->default('published')
                            ->required(),

                        Toggle::make('is_pinned')
                            ->label('Destacado'),
                    ]),

                DateTimePicker::make('published_at')
                    ->label('Fecha de publicación')
                    ->default(fn () => now()->timezone('America/La_Paz'))
                    ->timezone('America/La_Paz')
                    ->columnSpanFull(),

                TextInput::make('meta_title')
                    ->label('Meta título')
                    ->columnSpanFull(),

                Textarea::make('meta_description')
                    ->label('Meta descripción')
                    ->columnSpanFull(),
            ]);
    }
}