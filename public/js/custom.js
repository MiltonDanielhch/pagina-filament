// Custom JavaScript for Gobernación del Beni

// Accessibility Functions
function toggleHighContrast() {
    document.documentElement.classList.toggle('high-contrast');
    const isHighContrast = document.documentElement.classList.contains('high-contrast');
    localStorage.setItem('highContrast', isHighContrast);
    
    const button = document.querySelector('button[onclick="toggleHighContrast()"]');
    if (button) {
        button.setAttribute('aria-label', isHighContrast ? 'Desactivar modo alto contraste' : 'Activar modo alto contraste');
    }
}

// Font Size Controls
const MIN_FONT_SCALE = 0.8;
const MAX_FONT_SCALE = 1.4;
const FONT_STEP = 0.1;

function getFontScale() {
    return parseFloat(localStorage.getItem('fontScale')) || 1;
}

function setFontScale(scale) {
    scale = Math.max(MIN_FONT_SCALE, Math.min(MAX_FONT_SCALE, scale));
    localStorage.setItem('fontScale', scale);
    document.documentElement.style.fontSize = (scale * 100) + '%';
}

function increaseFontSize() {
    setFontScale(getFontScale() + FONT_STEP);
}

function decreaseFontSize() {
    setFontScale(getFontScale() - FONT_STEP);
}

function resetFontSize() {
    setFontScale(1);
}

// Load preferences on page load
document.addEventListener('DOMContentLoaded', () => {
    // Load font scale
    setFontScale(getFontScale());
    
    // Load high contrast
    const highContrast = localStorage.getItem('highContrast') === 'true';
    if (highContrast) {
        document.documentElement.classList.add('high-contrast');
        const button = document.querySelector('button[onclick="toggleHighContrast()"]');
        if (button) {
            button.setAttribute('aria-label', 'Desactivar modo alto contraste');
        }
    }
});

// Keyboard navigation improvements
document.addEventListener('keydown', (e) => {
    // Skip to main content with Alt+M
    if (e.altKey && e.key === 'm') {
        e.preventDefault();
        document.getElementById('main-content')?.focus();
    }
});

// Toast notification function
function showToast(message, type = 'info', duration = 5000) {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    const icons = {
        success: '<svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>',
        error: '<svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>',
        info: '<svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
    };

    toast.innerHTML = `
        ${icons[type]}
        <span class="flex-1">${message}</span>
        <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    `;

    container.appendChild(toast);

    // Auto remove after duration
    setTimeout(() => {
        toast.classList.add('hiding');
        toast.addEventListener('animationend', () => toast.remove());
    }, duration);
}

// Service Worker Registration for PWA
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then((registration) => {
                console.log('Service Worker registrado con éxito:', registration.scope);
            })
            .catch((error) => {
                console.log('Error al registrar Service Worker:', error);
            });
    });
}

// PWA Install Prompt
let deferredPrompt;
window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    
    // Mostrar botón de instalación (puedes personalizar esto según tu diseño)
    const installButton = document.createElement('button');
    installButton.textContent = 'Instalar App';
    installButton.className = 'fixed bottom-4 right-4 bg-official text-white px-4 py-2 rounded-lg shadow-lg hover:bg-official-dark transition z-50';
    installButton.onclick = () => {
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                console.log('Usuario aceptó instalar la PWA');
            }
            deferredPrompt = null;
            installButton.remove();
        });
    };
    document.body.appendChild(installButton);
});

// Detectar si la app está instalada
window.addEventListener('appinstalled', () => {
    console.log('PWA instalada exitosamente');
});
