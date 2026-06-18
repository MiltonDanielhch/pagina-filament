<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\Api\InfrastructureProjectController as ApiInfrastructureProjectController;
use App\Http\Controllers\InfrastructureProjectController as PublicInfrastructureProjectController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\InstitutionalController;
use App\Http\Controllers\SecretariatController;
use App\Http\Controllers\TransparencyController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OpenDatasetController;
use App\Http\Controllers\CredentialController;
use Illuminate\Support\Facades\Route;

// Filament routes (auto-registered by Filament)
// Livewire routes are automatically registered by Livewire v3

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- Institucional (RM 067/2025) ---
Route::prefix('institucional')->name('institutional.')->group(function () {
    Route::get('/', [InstitutionalController::class, 'index'])->name('index');
    Route::get('/autoridades', [OfficialController::class, 'publicIndex'])->name('officials');
    Route::get('/organigrama', [InstitutionalController::class, 'organigrama'])->name('organigrama');
    Route::get('/secretarias', [SecretariatController::class, 'index'])->name('secretariats');
    Route::get('/secretarias/{slug}', [SecretariatController::class, 'show'])->name('secretariats.show');
});

// --- Servicios al ciudadano ---
Route::prefix('tramites')->name('procedures.')->group(function () {
    Route::get('/', [ProcedureController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProcedureController::class, 'show'])->name('show');
});

// --- Convocatorias y contratación ---
Route::prefix('convocatorias')->name('announcements.')->group(function () {
    Route::get('/', [AnnouncementController::class, 'index'])->name('index');
    Route::get('/{slug}', [AnnouncementController::class, 'show'])->name('show');
});

// --- Quejas y reclamos (Libro de Reclamaciones Virtual) ---
Route::prefix('quejas-reclamos')->name('complaints.')->group(function () {
    Route::get('/', [ComplaintController::class, 'create'])->name('create');
    Route::post('/', [ComplaintController::class, 'store'])->name('store');
    Route::get('/seguir', [ComplaintController::class, 'trackForm'])->name('track-form');
    Route::post('/seguir', [ComplaintController::class, 'trackSearch'])->name('track-search');
    Route::get('/seguir/{token}', [ComplaintController::class, 'track'])->name('track');
    Route::get('/confirmacion/{code}', [ComplaintController::class, 'confirmation'])->name('confirmation');
});

// --- Atención al ciudadano ---
Route::get('/atencion-ciudadano', [OfficeController::class, 'index'])->name('offices');

// --- Datos abiertos ---
Route::prefix('datos-abiertos')->name('open-data.')->group(function () {
    Route::get('/', [OpenDatasetController::class, 'index'])->name('index');
    Route::get('/{slug}', [OpenDatasetController::class, 'show'])->name('show');
    Route::get('/{slug}/descargar/{format}', [OpenDatasetController::class, 'download'])->name('download');
});

// --- Mapa de Proyectos ---
Route::get('/mapa-proyectos', function () {
    return view('mapa-proyectos');
})->name('mapa-proyectos');

// --- Transparencia ---
Route::prefix('transparencia')->name('transparency.')->group(function () {
    Route::get('/', [TransparencyController::class, 'index'])->name('index');
    Route::get('/presupuesto', [TransparencyController::class, 'presupuesto'])->name('presupuesto');
    Route::get('/poa', [TransparencyController::class, 'poa'])->name('poa');
    Route::get('/informes', [TransparencyController::class, 'informes'])->name('informes');
    Route::get('/rendicion-cuentas', [TransparencyController::class, 'rendicion'])->name('rendicion');
    Route::get('/auditorias', [TransparencyController::class, 'auditorias'])->name('auditorias');
    Route::get('/marco-normativo', [TransparencyController::class, 'marcoNormativo'])->name('marco-normativo');
});

// --- Contenido existente ---
Route::get('/blog', [PostController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/category/{slug}', [PostController::class, 'category'])->name('posts.category');
Route::get('/eventos', [EventController::class, 'index'])->name('events');
Route::get('/galeria', [GalleryController::class, 'index'])->name('gallery');
Route::get('/galeria/{slug}', [GalleryController::class, 'show'])->name('gallery.show');
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');
Route::get('/agenda/{agenda}/ical', [AgendaController::class, 'exportIcal'])->name('agenda.export-ical');
Route::get('/agenda/{agenda}/google', [AgendaController::class, 'exportGoogleCalendar'])->name('agenda.export-google');
Route::get('/resultados', [AchievementController::class, 'index'])->name('achievements');
Route::get('/estadisticas', [StatisticsController::class, 'index'])->name('statistics');

// API Routes
Route::get('/api/infrastructure-projects', [ApiInfrastructureProjectController::class, 'index'])->name('api.infrastructure-projects.index');
Route::get('/api/statistics', [StatisticsController::class, 'api'])->name('api.statistics');

// --- Proyectos de Inversión (RM 067/2025 — Componente 15) ---
Route::prefix('gobierno/proyectos')->name('gobierno.proyectos.')->group(function () {
    Route::get('/', [PublicInfrastructureProjectController::class, 'index'])->name('index');
    Route::get('/{slug}', [PublicInfrastructureProjectController::class, 'show'])->name('show');
});
Route::get('/autoridades', [OfficialController::class, 'index'])->name('officials');
Route::get('/credenciales', [CredentialController::class, 'index'])->name('credentials');
Route::get('/contacto', [ContactController::class, 'show'])->name('contact');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');
Route::get('/buscar', [SearchController::class, 'index'])->name('search');
Route::get('/api/buscar', [SearchController::class, 'search']);
Route::view('/gobernador', 'gobernador')->name('gobernador');
Route::get('/sobre-nosotros', [HomeController::class, 'about'])->name('sobre-nosotros');

// Página dinámica — siempre AL FINAL
Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');
