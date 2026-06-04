import './bootstrap';

// Alpine.js
import Alpine from 'alpinejs';

window.Alpine = Alpine;

console.log('Alpine.js loaded:', Alpine);

Alpine.start();

console.log('Alpine.js started');

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
