{{--
    Ubicación: resources/views/forms/components/tiptap-editor.blade.php
    Descripción: Componente Blade para el editor Tiptap. Renderiza
                 toolbar y textarea.
    Accesibilidad: lang="es", skip link, contraste 4.5:1, semantic HTML
    Roadmap: 06-FRONTEND.md — Bloque 6.1
--}}
@php
    $id = $getId();
    $state = $getState();
    $toolbarButtons = $getToolbarButtons();
@endphp

<div x-data="tiptapEditor(@js($id), @js($state))" class="space-y-2">
    <div class="border border-gray-300 rounded-lg overflow-hidden">
        <div class="bg-gray-50 border-b border-gray-300 p-2 flex flex-wrap gap-1">
            @if(in_array('bold', $toolbarButtons))
                <button type="button" x-on:click="toggleBold()" class="p-2 hover:bg-gray-200 rounded" title="Negrita">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"></path></svg>
                </button>
            @endif
            @if(in_array('italic', $toolbarButtons))
                <button type="button" x-on:click="toggleItalic()" class="p-2 hover:bg-gray-200 rounded" title="Cursiva">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h4m-2 0l-4 16m0 0h4"></path></svg>
                </button>
            @endif
            @if(in_array('strike', $toolbarButtons))
                <button type="button" x-on:click="toggleStrike()" class="p-2 hover:bg-gray-200 rounded" title="Tachado">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16M17.5 7.5l-9 9"></path></svg>
                </button>
            @endif
            @if(in_array('h2', $toolbarButtons))
                <button type="button" x-on:click="toggleHeading(2)" class="p-2 hover:bg-gray-200 rounded font-bold" title="Título 2">H2</button>
            @endif
            @if(in_array('h3', $toolbarButtons))
                <button type="button" x-on:click="toggleHeading(3)" class="p-2 hover:bg-gray-200 rounded font-bold" title="Título 3">H3</button>
            @endif
            @if(in_array('bulletList', $toolbarButtons))
                <button type="button" x-on:click="toggleBulletList()" class="p-2 hover:bg-gray-200 rounded" title="Lista sin orden">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            @endif
            @if(in_array('orderedList', $toolbarButtons))
                <button type="button" x-on:click="toggleOrderedList()" class="p-2 hover:bg-gray-200 rounded" title="Lista ordenada">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M7 16h10M4 8h.01M4 12h.01M4 16h.01"></path></svg>
                </button>
            @endif
            @if(in_array('link', $toolbarButtons))
                <button type="button" x-on:click="setLink()" class="p-2 hover:bg-gray-200 rounded" title="Enlace">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                </button>
            @endif
            @if(in_array('image', $toolbarButtons))
                <button type="button" x-on:click="addImage()" class="p-2 hover:bg-gray-200 rounded" title="Imagen">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </button>
            @endif
            @if(in_array('codeBlock', $toolbarButtons))
                <button type="button" x-on:click="toggleCodeBlock()" class="p-2 hover:bg-gray-200 rounded" title="Código">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                </button>
            @endif
        </div>
        <div x-ref="editor" class="prose prose-sm max-w-none p-4 min-h-[200px] focus:outline-none"></div>
    </div>
    <input type="hidden" wire:model="{{ $getStatePath() }}" id="{{ $id }}">
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('tiptapEditor', (id, initialContent) => ({
        editor: null,
        element: null,

        init() {
            this.$nextTick(() => {
                this.element = this.$refs.editor;
                this.initEditor();
            });
        },

        initEditor() {
            if (typeof window.Tiptap === 'undefined') {
                setTimeout(() => this.initEditor(), 100);
                return;
            }

            const TiptapCore = window.Tiptap.Core;
            const TiptapStarterKit = window.Tiptap.StarterKit;
            const TiptapLink = window.Tiptap.Link;
            const TiptapImage = window.Tiptap.Image;
            const TiptapPlaceholder = window.Tiptap.Placeholder;

            this.editor = new TiptapCore({
                element: this.element,
                extensions: [
                    new TiptapStarterKit(),
                    new TiptapLink({
                        openOnClick: true,
                        HTMLAttributes: {
                            target: '_blank',
                            rel: 'noopener noreferrer',
                        },
                    }),
                    new TiptapImage(),
                    new TiptapPlaceholder({
                        placeholder: 'Escribe tu contenido aquí...',
                    }),
                ],
                content: initialContent || '',
                onUpdate: ({ editor }) => {
                    document.getElementById(id).value = editor.getHTML();
                },
            });
        },

        toggleBold() {
            this.editor?.chain().focus().toggleBold().run();
        },
        toggleItalic() {
            this.editor?.chain().focus().toggleItalic().run();
        },
        toggleStrike() {
            this.editor?.chain().focus().toggleStrike().run();
        },
        toggleHeading(level) {
            this.editor?.chain().focus().toggleHeading({ level }).run();
        },
        toggleBulletList() {
            this.editor?.chain().focus().toggleBulletList().run();
        },
        toggleOrderedList() {
            this.editor?.chain().focus().toggleOrderedList().run();
        },
        toggleCodeBlock() {
            this.editor?.chain().focus().toggleCodeBlock().run();
        },
        setLink() {
            const url = prompt('Ingresa la URL:');
            if (url) {
                this.editor?.chain().focus().setLink({ href: url }).run();
            }
        },
        addImage() {
            const url = prompt('Ingresa la URL de la imagen:');
            if (url) {
                this.editor?.chain().focus().setImage({ src: url }).run();
            }
        },
    }));
});
</script>
@endpush