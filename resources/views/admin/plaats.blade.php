<x-base-layout>

<style>
.pl *:not(i) { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

.pl-wrap  { display: flex; justify-content: center; padding: 50px 20px 100px; }
.pl-inner { width: 100%; max-width: 960px; }

/* Topbar */
.pl-topbar {
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: 12px;
    margin-bottom: 28px;
}
.pl-back {
    display: inline-flex; align-items: center; gap: 8px;
    color: #6b7280; font-size: 13px; font-weight: 600;
    text-decoration: none;
    padding: 8px 14px; border: 1.5px solid #e5e7eb; border-radius: 50px;
    transition: border-color 0.15s, color 0.15s;
}
.pl-back:hover { border-color: #1a1a1a; color: #1a1a1a; }
.pl-back i { font-size: 11px; }

.pl-title {
    font-size: 1.7rem; font-weight: 900; color: #111;
    letter-spacing: -0.03em; margin: 0;
}
.pl-title span { color: #8b7355; }

/* Alert */
.pl-alert {
    background: #f0fdf4; border: 1.5px solid #bbf7d0; color: #166534;
    border-radius: 10px; padding: 12px 18px; margin-bottom: 22px;
    font-size: 14px; font-weight: 600;
    display: flex; align-items: center; gap: 10px;
}

/* Grid */
.pl-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 18px;
}
@media (max-width: 560px) { .pl-grid { grid-template-columns: 1fr; } }

/* Kaart */
.pl-kaart {
    background: #fff;
    border: 1.5px solid #e5e7eb;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.18s, border-color 0.18s;
}
.pl-kaart:hover {
    box-shadow: 0 8px 28px rgba(0,0,0,0.09);
    border-color: #d1d5db;
}

/* Foto */
.pl-kaart__img {
    width: 100%; height: 160px;
    background: #f5f0e8;
    overflow: hidden;
    flex-shrink: 0;
    position: relative;
}
.pl-kaart__img img {
    width: 100%; height: 100%; object-fit: cover;
    display: block;
}
.pl-kaart__img-leeg {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    color: #d4c9b8; font-size: 40px;
}

/* Body */
.pl-kaart__body { padding: 18px 20px; flex: 1; display: flex; flex-direction: column; gap: 14px; }

.pl-kaart__naam {
    font-size: 16px; font-weight: 800;
    color: #1a1a1a; letter-spacing: -0.02em; margin: 0;
}
.pl-kaart__cats {
    display: flex; flex-wrap: wrap; gap: 5px;
}
.pl-kaart__cat-tag {
    background: #f5f0e8; color: #8b7355;
    font-size: 11px; font-weight: 700;
    padding: 3px 9px; border-radius: 50px;
    letter-spacing: 0.02em;
}

/* Info rijen */
.pl-kaart__info { display: flex; flex-direction: column; gap: 7px; }
.pl-kaart__row {
    display: flex; align-items: flex-start; gap: 10px;
    font-size: 13px; color: #6b7280; line-height: 1.5;
}
.pl-kaart__row i {
    color: #b0a898; font-size: 12px;
    margin-top: 2px; flex-shrink: 0; width: 14px; text-align: center;
}
.pl-kaart__row a { color: #1a1a1a; text-decoration: none; font-weight: 500; }
.pl-kaart__row a:hover { text-decoration: underline; }

/* Beschrijving */
.pl-kaart__desc {
    font-size: 13px; color: #6b7280;
    line-height: 1.65; margin: 0;
    display: -webkit-box; -webkit-line-clamp: 3;
    -webkit-box-orient: vertical; overflow: hidden;
}

/* Footer acties */
.pl-kaart__footer {
    padding: 12px 20px 16px;
    border-top: 1px solid #f3f4f6;
    display: flex; align-items: center; gap: 8px;
}
.pl-kaart__edit {
    flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 7px;
    background: #1a1a1a; color: #fff;
    text-decoration: none; font-size: 13px; font-weight: 700;
    padding: 9px 16px; border-radius: 8px;
    transition: background 0.15s;
}
.pl-kaart__edit:hover { background: #333; }

.pl-kaart__del-form { display: inline; }
.pl-kaart__del {
    display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    background: none; color: #9ca3af;
    border: 1.5px solid #e5e7eb; border-radius: 8px;
    padding: 9px 14px; font-size: 13px; font-weight: 600;
    cursor: pointer; transition: background 0.15s, color 0.15s, border-color 0.15s;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.pl-kaart__del:hover { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
</style>

<div class="pl-wrap">
<div class="pl-inner">

    <div class="pl-topbar">
        <a href="{{ route('admin.index') }}" class="pl-back">
            <i class="fa-solid fa-arrow-left"></i> Terug naar dashboard
        </a>
        <h1 class="pl-title">Bedrijven in <span>{{ $plaats }}</span></h1>
    </div>

    @if(session('success'))
        <div class="pl-alert">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="pl-grid">
        @foreach ($bedrijven as $bedrijf)
        <div class="pl-kaart">

            {{-- Foto --}}
            <div class="pl-kaart__img">
                @if($bedrijf->afbeelding && file_exists(public_path('images/' . $bedrijf->afbeelding)))
                    <img src="{{ asset('images/' . $bedrijf->afbeelding) }}" alt="{{ $bedrijf->naam }}">
                @else
                    <div class="pl-kaart__img-leeg"><i class="fa-solid fa-building"></i></div>
                @endif
            </div>

            {{-- Body --}}
            <div class="pl-kaart__body">

                <div>
                    <p class="pl-kaart__naam">{{ $bedrijf->naam }}</p>
                    @if($bedrijf->categorieen->count())
                    <div class="pl-kaart__cats" style="margin-top:8px;">
                        @foreach($bedrijf->categorieen as $cat)
                            <span class="pl-kaart__cat-tag">{{ $cat->categorie }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>

                @if($bedrijf->beschrijving_kort)
                    <p class="pl-kaart__desc">{{ $bedrijf->beschrijving_kort }}</p>
                @endif

                <div class="pl-kaart__info">
                    @if($bedrijf->straat || $bedrijf->plaats)
                    <div class="pl-kaart__row">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>{{ trim($bedrijf->straat . ' ' . $bedrijf->huisnummer) }}@if($bedrijf->straat && $bedrijf->plaats), @endif{{ $bedrijf->plaats }}@if($bedrijf->postcode) {{ $bedrijf->postcode }}@endif</span>
                    </div>
                    @endif
                    @if($bedrijf->telefoon)
                    <div class="pl-kaart__row">
                        <i class="fa-solid fa-phone"></i>
                        <a href="tel:{{ $bedrijf->telefoon }}">{{ $bedrijf->telefoon }}</a>
                    </div>
                    @endif
                    @if($bedrijf->email)
                    <div class="pl-kaart__row">
                        <i class="fa-solid fa-envelope"></i>
                        <a href="mailto:{{ $bedrijf->email }}">{{ $bedrijf->email }}</a>
                    </div>
                    @endif
                    @if($bedrijf->website)
                    <div class="pl-kaart__row">
                        <i class="fa-solid fa-globe"></i>
                        <a href="{{ Str::startsWith($bedrijf->website, ['http://','https://']) ? $bedrijf->website : 'https://' . $bedrijf->website }}" target="_blank" rel="noopener">{{ $bedrijf->website }}</a>
                    </div>
                    @endif
                </div>

            </div>

            {{-- Footer --}}
            <div class="pl-kaart__footer">
                <a href="{{ url('/admin/edit/' . $bedrijf->id) . '?from_plaats=' . urlencode($bedrijf->plaats) }}" class="pl-kaart__edit">
                    <i class="fa-solid fa-pen"></i> Bewerken
                </a>
                <form action="{{ url('/admin/delete/' . $bedrijf->id) }}" method="POST" class="pl-kaart__del-form">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="from_plaats" value="{{ $bedrijf->plaats }}">
                    <button type="submit" class="pl-kaart__del"
                        onclick="return adminConfirmSubmit(this.closest('form'), 'Weet je zeker dat je {{ addslashes($bedrijf->naam) }} wilt verwijderen?')">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>

        </div>
        @endforeach
    </div>

</div>
</div>

</x-base-layout>
