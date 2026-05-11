<?php

/**
 * Ubicación: `app/Forms/Components/TiptapEditor.php`
 *
 * Descripción: Componente Filament Forms para editor de texto enriquecido
 *              Tiptap. Reemplaza awcodes/tiptap-editor incompatible con Filament 5.x
 *
 * Uso: TiptapEditor::make('content')
 * Roadmap: 05-BACKEND.md — Bloque 5.3
 */

namespace App\Forms\Components;

use Filament\Forms\Components\Textarea;

class TiptapEditor extends Textarea
{
    protected string $view = 'forms.components.tiptap-editor';

    protected function setUp(): void
    {
        parent::setUp();

        $this->columnSpan('full');
    }

    public function getToolbarButtons(): array
    {
        return $this->evaluate($this->toolbarButtons ?? [
            'bold',
            'italic',
            'strike',
            'h2',
            'h3',
            'bulletList',
            'orderedList',
            'link',
            'image',
            'codeBlock',
        ]);
    }

    public function toolbarButtons(array $buttons): static
    {
        $this->toolbarButtons = $buttons;

        return $this;
    }
}