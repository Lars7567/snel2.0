<x-base-layout>

<style>
.af *:not(i) { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

.af-wrap  { display: flex; justify-content: center; padding: 50px 20px 100px; }
.af-inner { width: 100%; max-width: 720px; }

.af-topbar {
    display: flex; align-items: center; gap: 20px;
    margin-bottom: 32px; flex-wrap: wrap;
}
.af-back {
    display: inline-flex; align-items: center; gap: 8px;
    color: #6b7280; font-size: 13px; font-weight: 600; text-decoration: none;
    padding: 8px 14px; border: 1.5px solid #e5e7eb; border-radius: 50px;
    transition: border-color 0.15s, color 0.15s; flex-shrink: 0;
}
.af-back:hover { border-color: #1a1a1a; color: #1a1a1a; }
.af-back i { font-size: 11px; }

.af-title { font-size: 1.7rem; font-weight: 900; color: #111; letter-spacing: -0.03em; margin: 0; }

/* Alert */
.af-alert-ok  { background: #f0fdf4; border: 1.5px solid #bbf7d0; color: #166534; border-radius: 10px; padding: 12px 18px; margin-bottom: 20px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
.af-alert-err { background: #fef2f2; border: 1.5px solid #fecaca; color: #991b1b; border-radius: 10px; padding: 12px 18px; margin-bottom: 20px; font-size: 14px; }
.af-alert-err ul { margin: 4px 0 0 18px; padding: 0; }
.af-alert-err li { font-size: 13px; margin-bottom: 3px; }

/* Sectie kaart */
.af-card { background: #fff; border: 1.5px solid #e5e7eb; border-radius: 14px; padding: 26px; margin-bottom: 16px; }
.af-card-titel { font-size: 13px; font-weight: 700; color: #374151; margin: 0 0 20px; padding-bottom: 14px; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; gap: 8px; }
.af-card-titel i { color: #8b7355; font-size: 13px; }

/* Velden */
.af-field  { margin-bottom: 16px; }
.af-field:last-child { margin-bottom: 0; }
.af-label  { display: block; font-size: 12px; font-weight: 700; color: #374151; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 7px; }
.af-label span { color: #dc2626; font-weight: 400; text-transform: none; }
.af-input, .af-textarea {
    width: 100%; padding: 10px 14px;
    border: 1.5px solid #e5e7eb; border-radius: 8px;
    font-size: 14px; color: #1a1a1a;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #fafafa; outline: none;
    transition: border-color 0.15s, background 0.15s;
}
.af-input:focus, .af-textarea:focus { border-color: #1a1a1a; background: #fff; }
.af-textarea { resize: vertical; min-height: 100px; line-height: 1.6; }
.af-input[type="file"] { background: #fff; cursor: pointer; font-size: 13px; padding: 8px 12px; }

.af-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
@media (max-width: 520px) { .af-row { grid-template-columns: 1fr; } }

/* Checkboxes */
.af-checks { display: flex; flex-wrap: wrap; gap: 8px; }
.af-check-label {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 7px 14px; border: 1.5px solid #e5e7eb; border-radius: 50px;
    cursor: pointer; font-size: 13px; font-weight: 600; color: #6b7280;
    transition: border-color 0.15s, background 0.15s, color 0.15s;
    user-select: none;
}
.af-check-label input { display: none; }
.af-check-label:has(input:checked) { border-color: #1a1a1a; background: #1a1a1a; color: #fff; }
.af-check-label:hover { border-color: #9ca3af; color: #1a1a1a; }
.af-check-label:has(input:checked):hover { background: #333; border-color: #333; }

/* Img preview */
.af-img-preview { max-width: 180px; max-height: 120px; border: 1.5px solid #e5e7eb; border-radius: 8px; display: block; margin-bottom: 12px; object-fit: cover; }

/* Knoppen */
.af-footer { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 8px; }
.af-btn-primary {
    display: inline-flex; align-items: center; gap: 8px;
    background: #1a1a1a; color: #fff; border: none; cursor: pointer;
    font-size: 14px; font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif;
    padding: 12px 28px; border-radius: 8px;
    transition: background 0.15s;
}
.af-btn-primary:hover { background: #333; }
.af-btn-secondary {
    display: inline-flex; align-items: center; gap: 8px;
    background: #fff; color: #6b7280;
    border: 1.5px solid #e5e7eb; cursor: pointer;
    font-size: 14px; font-weight: 600; font-family: 'Plus Jakarta Sans', sans-serif;
    padding: 12px 22px; border-radius: 8px;
    transition: border-color 0.15s, color 0.15s;
}
.af-btn-secondary:hover { border-color: #9ca3af; color: #1a1a1a; }
</style>

<div class="af-wrap">
<div class="af-inner">

    <div class="af-topbar">
        <a href="{{ route('admin.index') }}" class="af-back"><i class="fa-solid fa-arrow-left"></i> Terug</a>
        <h1 class="af-title">Bedrijf toevoegen</h1>
    </div>

    @if(session('success'))
        <div class="af-alert-ok"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="af-alert-err">
            <strong>Controleer de volgende velden:</strong>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ url('/admin/store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Algemeen --}}
        <div class="af-card">
            <p class="af-card-titel"><i class="fa-solid fa-building"></i> Algemeen</p>
            <div class="af-field">
                <label class="af-label">Bedrijfsnaam <span>*</span></label>
                <input type="text" name="naam" class="af-input" placeholder="Bijv. Bakkerij De Wit" value="{{ old('naam') }}">
            </div>
            <div class="af-field">
                <label class="af-label">Afbeelding</label>
                <input type="file" name="afbeelding" class="af-input" accept="image/*">
            </div>
        </div>

        {{-- Beschrijving --}}
        <div class="af-card">
            <p class="af-card-titel"><i class="fa-solid fa-align-left"></i> Beschrijving</p>
            <div class="af-field">
                <label class="af-label">Korte beschrijving</label>
                <textarea name="beschrijving_kort" class="af-textarea" placeholder="Één zin over het bedrijf..." rows="3">{{ old('beschrijving_kort') }}</textarea>
            </div>
            <div class="af-field">
                <label class="af-label">Langere beschrijving</label>
                <textarea name="beschrijving_lang" class="af-textarea" placeholder="Uitgebreidere omschrijving..." rows="5">{{ old('beschrijving_lang') }}</textarea>
            </div>
        </div>

        {{-- Locatie --}}
        <div class="af-card">
            <p class="af-card-titel"><i class="fa-solid fa-location-dot"></i> Locatie</p>
            <div class="af-row af-field">
                <div>
                    <label class="af-label">Straat</label>
                    <input type="text" name="straat" class="af-input" placeholder="Kerkstraat" value="{{ old('straat') }}">
                </div>
                <div>
                    <label class="af-label">Huisnummer</label>
                    <input type="text" name="huisnummer" class="af-input" placeholder="12A" value="{{ old('huisnummer') }}">
                </div>
            </div>
            <div class="af-row">
                <div>
                    <label class="af-label">Plaats</label>
                    <input type="text" name="plaats" class="af-input" placeholder="Amsterdam" value="{{ old('plaats') }}">
                </div>
                <div>
                    <label class="af-label">Postcode</label>
                    <input type="text" name="postcode" class="af-input" placeholder="1234 AB" value="{{ old('postcode') }}">
                </div>
            </div>
        </div>

        {{-- Contact --}}
        <div class="af-card">
            <p class="af-card-titel"><i class="fa-solid fa-phone"></i> Contact</p>
            <div class="af-row af-field">
                <div>
                    <label class="af-label">Telefoon</label>
                    <input type="text" name="telefoon" class="af-input" placeholder="020 123 4567" value="{{ old('telefoon') }}">
                </div>
                <div>
                    <label class="af-label">Mobiel / GSM</label>
                    <input type="text" name="gsm" class="af-input" placeholder="06 12345678" value="{{ old('gsm') }}">
                </div>
            </div>
            <div class="af-field">
                <label class="af-label">E-mailadres</label>
                <input type="email" name="email" class="af-input" placeholder="info@bedrijf.nl" value="{{ old('email') }}">
            </div>
        </div>

        {{-- Online --}}
        <div class="af-card">
            <p class="af-card-titel"><i class="fa-solid fa-globe"></i> Online aanwezigheid</p>
            <div class="af-field">
                <label class="af-label">Website</label>
                <input type="text" name="website" class="af-input" placeholder="https://www.bedrijf.nl" value="{{ old('website') }}">
            </div>
            <div class="af-row af-field">
                <div>
                    <label class="af-label"><i class="fa-brands fa-facebook-f"></i> Facebook</label>
                    <input type="text" name="facebook" class="af-input" placeholder="https://facebook.com/..." value="{{ old('facebook') }}">
                </div>
                <div>
                    <label class="af-label"><i class="fa-brands fa-linkedin-in"></i> LinkedIn</label>
                    <input type="text" name="linkedin" class="af-input" placeholder="https://linkedin.com/..." value="{{ old('linkedin') }}">
                </div>
            </div>
            <div class="af-field">
                <label class="af-label"><i class="fa-brands fa-instagram"></i> Instagram</label>
                <input type="text" name="instagram" class="af-input" placeholder="https://instagram.com/..." value="{{ old('instagram') }}">
            </div>
        </div>

        {{-- Categorieën --}}
        <div class="af-card">
            <p class="af-card-titel"><i class="fa-solid fa-tag"></i> Categorieën <span style="color:#dc2626;font-weight:400;">*</span></p>
            <div class="af-checks">
                @foreach($categorieen as $categorie)
                    <label class="af-check-label">
                        <input type="checkbox" name="categorie_ids[]" value="{{ $categorie->id }}"
                            {{ is_array(old('categorie_ids')) && in_array($categorie->id, old('categorie_ids')) ? 'checked' : '' }}>
                        {{ $categorie->categorie }}
                    </label>
                @endforeach
            </div>
        </div>

        <div class="af-footer">
            <button type="submit" name="action" value="save" class="af-btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Opslaan
            </button>
            <button type="submit" name="action" value="save_new" class="af-btn-secondary">
                <i class="fa-solid fa-plus"></i> Opslaan en nieuwe maken
            </button>
        </div>

    </form>
</div>
</div>

</x-base-layout>
