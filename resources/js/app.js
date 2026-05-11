import './bootstrap';

// Tiptap Editor - Importar y exponer globalmente para el componente
import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';
import Link from '@tiptap/extension-link';
import Placeholder from '@tiptap/extension-placeholder';

window.Tiptap = {
    Core: { Editor },
    StarterKit,
    Image,
    Link,
    Placeholder
};
