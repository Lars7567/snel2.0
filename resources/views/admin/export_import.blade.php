<x-base-layout>

<style>
.ei-wrap {
    max-width: 1000px;
    margin: 40px auto;
    padding: 0 24px;
    font-family: var(--font-family);
}
.ei-title {
    font-size: 1.8rem;
    margin-bottom: 32px;
    color: #111827;
}
.ei-section {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 28px;
    margin-bottom: 32px;
}
.ei-section h2 {
    font-size: 1.2rem;
    margin: 0 0 20px 0;
    color: #111827;
    border-bottom: 2px solid #f3f4f6;
    padding-bottom: 12px;
}
.ei-alert-success {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #6ee7b7;
    border-radius: 6px;
    padding: 12px 16px;
    margin-bottom: 20px;
}
.ei-alert-error {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
    border-radius: 6px;
    padding: 12px 16px;
    margin-bottom: 20px;
}
.ei-controls {
    display: flex;
    gap: 12px;
    margin-bottom: 16px;
    flex-wrap: wrap;
    align-items: center;
}
.ei-btn-select {
    background: none;
    border: 1px solid #d1d5db;
    border-radius: 5px;
    padding: 6px 14px;
    cursor: pointer;
    font-size: 13px;
    color: #374151;
}
.ei-btn-select:hover { background: #f3f4f6; }
.ei-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 10px;
    max-height: 360px;
    overflow-y: auto;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 12px;
    background: #fafafa;
}
.ei-item {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 5px;
    padding: 8px 12px;
    font-size: 14px;
}
.ei-item input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #e00000;
    flex-shrink: 0;
}
.ei-item label {
    cursor: pointer;
    line-height: 1.3;
}
.ei-item label small {
    display: block;
    color: #9ca3af;
    font-size: 12px;
}
.ei-submit {
    background: #111827;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 10px 24px;
    font-size: 15px;
    cursor: pointer;
    margin-top: 20px;
    transition: background 0.2s;
}
.ei-submit:hover { background: #374151; }
.ei-file-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #374151;
    font-size: 14px;
}
.ei-file-input {
    display: block;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 14px;
    width: 100%;
    max-width: 400px;
    background: #fff;
    margin-bottom: 8px;
}
.ei-file-hint {
    font-size: 12px;
    color: #9ca3af;
}
</style>

<div class="ei-wrap">
    <h1 class="ei-title">Export / Import</h1>

    @if(session('import_success'))
        <div class="ei-alert-success">{{ session('import_success') }}</div>
    @endif
    @if(session('import_error'))
        <div class="ei-alert-error">{{ session('import_error') }}</div>
    @endif

    {{-- ===================== EXPORT ===================== --}}
    <div class="ei-section">
        <h2>Exporteren</h2>

        <form method="POST" action="{{ route('admin.export') }}">
            @csrf

            {{-- Bedrijven --}}
            <div style="margin-bottom: 24px;">
                <strong style="font-size:15px;">Bedrijven</strong>
                <div class="ei-controls">
                    <button type="button" class="ei-btn-select" onclick="selectAll('bedrijf_ids')">Alles selecteren</button>
                    <button type="button" class="ei-btn-select" onclick="deselectAll('bedrijf_ids')">Alles deselecteren</button>
                </div>
                <div class="ei-grid">
                    @foreach($bedrijven as $bedrijf)
                        <div class="ei-item">
                            <input type="checkbox" name="bedrijf_ids[]" value="{{ $bedrijf->id }}" id="b_{{ $bedrijf->id }}" checked>
                            <label for="b_{{ $bedrijf->id }}">
                                {{ $bedrijf->naam }}
                                <small>{{ $bedrijf->plaats }} &bull; {{ $bedrijf->categorieen->pluck('categorie')->implode(', ') ?: 'geen categorie' }}</small>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Categorieën --}}
            <div>
                <strong style="font-size:15px;">Categorieën</strong>
                <div class="ei-controls">
                    <button type="button" class="ei-btn-select" onclick="selectAll('categorie_ids')">Alles selecteren</button>
                    <button type="button" class="ei-btn-select" onclick="deselectAll('categorie_ids')">Alles deselecteren</button>
                </div>
                <div class="ei-grid" style="grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));">
                    @foreach($categorieen as $cat)
                        <div class="ei-item">
                            <input type="checkbox" name="categorie_ids[]" value="{{ $cat->id }}" id="c_{{ $cat->id }}" checked>
                            <label for="c_{{ $cat->id }}">{{ $cat->categorie }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="ei-submit">
                <i class="fa-solid fa-download" style="margin-right:8px;"></i>Exporteren als ZIP
            </button>
        </form>
    </div>

    {{-- ===================== IMPORT ===================== --}}
    <div class="ei-section">
        <h2>Importeren</h2>
        <p style="color:#6b7280; font-size:14px; margin-bottom:20px;">Upload een eerder geëxporteerd JSON-bestand. Bestaande categorieën worden overgeslagen, nieuwe bedrijven worden toegevoegd.</p>

        <form method="POST" action="{{ route('admin.import') }}" enctype="multipart/form-data">
            @csrf
            @if($errors->has('import_file'))
                <div class="ei-alert-error">{{ $errors->first('import_file') }}</div>
            @endif
            <label class="ei-file-label" for="import_file">ZIP of JSON bestand</label>
            <input type="file" name="import_file" id="import_file" class="ei-file-input" accept=".zip,.json">
            <span class="ei-file-hint">Maximaal 50 MB · .zip (met afbeeldingen) of .json</span>
            <br>
            <button type="submit" class="ei-submit">
                <i class="fa-solid fa-upload" style="margin-right:8px;"></i>Importeren
            </button>
        </form>
    </div>
    {{-- ===================== VERWIJDEREN ===================== --}}
    <div class="ei-section" style="border-color: #fca5a5;">
        <h2 style="color:#991b1b; border-bottom-color:#fee2e2;">Gegevens verwijderen</h2>
        <p style="color:#6b7280; font-size:14px; margin-bottom:20px;">
            Gebruik dit als een import fout is gegaan en je opnieuw wilt beginnen. Deze actie kan <strong>niet</strong> ongedaan worden gemaakt.
        </p>

        <form method="POST" action="{{ route('admin.clear_bedrijven') }}" onsubmit="return bevestigVerwijder(this)">
            @csrf
            @method('DELETE')
            <div style="display:flex; gap:12px; flex-wrap:wrap;">
                <button type="submit" name="what" value="bedrijven" class="ei-submit" style="background:#dc2626;">
                    <i class="fa-solid fa-trash" style="margin-right:8px;"></i>Alle bedrijven verwijderen
                </button>
                <button type="submit" name="what" value="alles" class="ei-submit" style="background:#7f1d1d;">
                    <i class="fa-solid fa-trash" style="margin-right:8px;"></i>Alle bedrijven + categorieën verwijderen
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function selectAll(name) {
    document.querySelectorAll('input[name="' + name + '[]"]').forEach(cb => cb.checked = true);
}
function deselectAll(name) {
    document.querySelectorAll('input[name="' + name + '[]"]').forEach(cb => cb.checked = false);
}
function bevestigVerwijder(form) {
    const alles = form.querySelector('[name="what"]:focus')?.value === 'alles';
    const tekst = alles
        ? 'Weet je zeker dat je ALLE bedrijven én categorieën wilt verwijderen? Dit kan niet ongedaan worden gemaakt.'
        : 'Weet je zeker dat je alle bedrijven wilt verwijderen? Dit kan niet ongedaan worden gemaakt.';
    adminConfirm(tekst, function() { form.submit(); });
    return false;
}
</script>

</x-base-layout>
