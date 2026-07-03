<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\aboutController;
use App\Http\Controllers\contactController;

// contact form routes
use App\Http\Controllers\homeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\bedrijvenController;
use App\Http\Controllers\brandingController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ExportImportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\BevestigingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::name('home.')->group(function () {
    Route::get('/', [homeController::class, 'index'])->name('index');
    Route::get('/meer-bedrijven', [homeController::class, 'meer'])->name('meer');
    Route::get('/bedrijven/{bedrijf}', [homeController::class, 'show'])->name('show');
});

Route::name('about.')->group(function () {
    Route::get('/about', [aboutController::class, 'index'])->name('index');
    
});

Route::name('contact.')->group(function () {
    Route::get('/contact', [contactController::class, 'index'])->name('index');
    Route::post('/contact', [contactController::class, 'store'])->name('store');
});

Route::name('bedrijven.')->group(function () {
    Route::get('/bedrijven', [bedrijvenController::class, 'index'])->name('index');
    Route::get('/bedrijven-laden', [bedrijvenController::class, 'meer'])->name('meer');
});

// Eerste keer setup — alleen toegankelijk als er nog geen gebruikers zijn
Route::get('/setup',  [SetupController::class, 'index'])->name('setup');
Route::post('/setup', [SetupController::class, 'store']);

// Frontend theme cookie (bezoekers kunnen zelf van template wisselen)
Route::post('/set-template', function (Request $request) {
    $template = $request->input('template', 'modern');
    if (!in_array($template, ['modern', 'minimal', 'warm', 'corporate', 'dark', 'retro'])) {
        $template = 'modern';
    }
    return redirect()->back()->withCookie(cookie()->forever('template', $template));
})->name('set.template');

Route::get('/algemene-voorwaarden', function () {
    $brandingFile = storage_path('app/branding.json');
    $bs = file_exists($brandingFile) ? (json_decode(file_get_contents($brandingFile), true) ?? []) : [];
    $avPdf = $bs['av_pdf'] ?? '';
    if ($avPdf && file_exists(public_path('files/' . $avPdf))) {
        return response()->file(public_path('files/' . $avPdf));
    }
    $avContent = $bs['av_content'] ?? '';
    return view('av', compact('avContent'));
})->name('av.download');

Route::get('dashboard', function () {
    return view('/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [adminController::class, 'index'])->name('index');
    Route::get('/create', [adminController::class, 'create'])->name('create');
    // dedicated form for adding a new category
    Route::get('/categorie/new', [adminController::class, 'newCategorie'])->name('newCategorie');
    Route::post('/store', [adminController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [adminController::class, 'edit'])->name('edit');
    Route::put('/{id}', [adminController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [adminController::class, 'destroy'])->name('destroy');
    Route::get('/plaats/{plaats}', [adminController::class, 'show'])->name('show');
    Route::get('/categorie_create/{id}', [adminController::class, 'createCategorie'])->name('createCategorie');
    Route::post('/storeCategorie', [adminController::class, 'storeCategorie'])->name('storeCategorie');
    Route::get('/showCategorie/{id}', [adminController::class, 'showCategorie'])->name('showCategorie');
    Route::get('/editCategorie/{id}', [adminController::class, 'editCategorie'])->name('editCategorie');
    Route::put('/updateCategorie/{id}', [adminController::class, 'updateCategorie'])->name('updateCategorie');
    Route::delete('/deleteCategorie/{id}', [adminController::class, 'destroyCategorie'])->name('destroyCategorie');
    Route::get('/branding', [brandingController::class, 'index'])->name('branding');
    Route::post('/branding', [brandingController::class, 'update'])->name('branding.update');
    Route::get('/content', [ContentController::class, 'index'])->name('content');
    Route::post('/content', [ContentController::class, 'update'])->name('content.update');
    Route::get('/export-import', [ExportImportController::class, 'index'])->name('export_import');
    Route::post('/export', [ExportImportController::class, 'export'])->name('export');
    Route::post('/import', [ExportImportController::class, 'import'])->name('import');
    Route::delete('/clear-bedrijven', [ExportImportController::class, 'clearBedrijven'])->name('clear_bedrijven');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('/settings/test-mail', [SettingsController::class, 'testMail'])->name('settings.test_mail');
    Route::post('/settings/bev-defaults', [SettingsController::class, 'updateBevDefaults'])->name('settings.bev_defaults');
    Route::get('/settings/bev-defaults', [SettingsController::class, 'getBevDefaults'])->name('settings.bev_defaults.get');
    Route::get('/offerte-tool', function () {
        return view('admin.offerte-tool');
    })->name('offerte_tool');
    Route::get('/bevestigingen', [BevestigingController::class, 'index'])->name('bevestigingen.index');
    Route::post('/bevestigingen', [BevestigingController::class, 'store'])->name('bevestigingen.store');
    Route::get('/bevestigingen/{bevestiging}', [BevestigingController::class, 'show'])->name('bevestigingen.show');
    Route::put('/bevestigingen/{bevestiging}', [BevestigingController::class, 'update'])->name('bevestigingen.update');
    Route::delete('/bevestigingen/{bevestiging}', [BevestigingController::class, 'destroy'])->name('bevestigingen.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
