<x-base-layout>

<style>
.dp * { box-sizing: border-box; }
.dp *:not(i) { font-family: 'Plus Jakarta Sans', sans-serif; }
.dp { background: var(--color-body-bg, #faf8f4); min-height: 80vh; }

/* ── Hero ─────────────────────────────────────────────── */
.dp-hero {
    background: var(--color-hero-bg, #1a1a1a);
    border-bottom: none;
    padding: 40px 32px 36px;
}
.dp-hero__inner {
    max-width: 1100px;
    margin: 0 auto;
}
.dp-terug {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--color-hero-sub, #b0a898);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    margin-bottom: 22px;
    transition: color 0.15s;
}
.dp-terug:hover { color: var(--color-hero-text, #fff); }
.dp-hero__label {
    display: inline-block;
    background: rgba(255,255,255,0.08);
    color: var(--color-hero-sub, #c8bfb0);
    font-size: 10.5px;
    font-weight: 800;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 50px;
    margin-bottom: 12px;
}
.dp-hero__naam {
    font-size: 38px;
    font-weight: 900;
    color: var(--color-hero-text, #fff);
    margin: 0 0 12px;
    letter-spacing: -0.03em;
    line-height: 1.1;
}
.dp-hero__meta {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}
.dp-hero__meta span {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13.5px;
    color: var(--color-hero-sub, #9e8e7a);
    font-weight: 500;
}
.dp-hero__meta i { font-size: 11px; color: var(--color-hero-sub, #b8a888); }

/* ── Body ─────────────────────────────────────────────── */
.dp-body { padding: 40px 32px 80px; }
.dp-body__inner {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 32px;
    align-items: start;
}
@media (max-width: 820px) { .dp-body__inner { grid-template-columns: 1fr; } }

/* ── Links ────────────────────────────────────────────── */
.dp-links { display: flex; flex-direction: column; gap: 24px; }

.dp-afbeelding {
    width: 100%;
    aspect-ratio: 16/9;
    border-radius: 14px;
    overflow: hidden;
    background: var(--color-header-bg, #ede8de);
    border: 1px solid var(--color-border, #e2ddd5);
}
.dp-afbeelding img { width: 100%; height: 100%; object-fit: cover; display: block; }
.dp-afbeelding__leeg {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    color: var(--color-muted, #c8bfb0); font-size: 52px;
}

.dp-over {
    background: var(--color-card-bg, #fff);
    border: 1px solid var(--color-border, #e8e2d8);
    border-radius: 14px;
    padding: 28px 30px;
}
.dp-over__kort {
    font-size: 16px;
    font-weight: 600;
    color: var(--color-body-text, #4b3f2f);
    line-height: 1.65;
    margin: 0 0 18px;
    padding-bottom: 18px;
    border-bottom: 1px solid var(--color-border, #f0ece5);
    font-style: italic;
}
.dp-over__titel {
    font-size: 15px;
    font-weight: 800;
    color: var(--color-body-text, #1a1a1a);
    margin: 0 0 10px;
    letter-spacing: -0.01em;
}
.dp-over__tekst {
    font-size: 14px;
    color: var(--color-content-text, #374151);
    line-height: 1.8;
    margin: 0;
}
.dp-over__tekst a { color: var(--color-primary, #b8930a); }
.dp-over__leeg { font-size: 14px; color: var(--color-muted, #c4bdb3); font-style: italic; margin: 0; }

.dp-cats { display: flex; flex-wrap: wrap; gap: 8px; }
.dp-cats__tag {
    background: var(--color-header-bg, #f5f0e8);
    color: var(--color-muted, #8b7355);
    font-size: 12px;
    font-weight: 700;
    padding: 5px 13px;
    border-radius: 50px;
    border: 1px solid var(--color-muted, #e8dfd0);
}

/* ── Sidebar ──────────────────────────────────────────── */
.dp-sidebar { display: flex; flex-direction: column; gap: 28px; }

.dp-kaart {
    background: var(--color-card-bg, #fff);
    border: 1px solid var(--color-border, #e8e2d8);
    border-radius: 14px;
    padding: 24px;
}
.dp-kaart__titel {
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--color-muted, #b0a898);
    margin: 0 0 18px;
}
.dp-kaart__lijst {
    list-style: none;
    padding: 0; margin: 0;
    display: flex; flex-direction: column; gap: 12px;
}
.dp-kaart__lijst li {
    display: flex; align-items: flex-start; gap: 11px;
    font-size: 13.5px; color: var(--color-body-text, #374151); line-height: 1.5;
}
.dp-kaart__ico {
    width: 30px; height: 30px;
    background: var(--color-header-bg, #f5f0e8);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    color: var(--color-muted, #8b7355); font-size: 12px; flex-shrink: 0;
}
.dp-kaart__lijst a { color: var(--color-body-text, #374151); text-decoration: none; font-weight: 500; transition: color 0.15s; word-break: break-all; }
.dp-kaart__lijst a:hover { color: var(--color-primary, #1a1a1a); }
.dp-kaart__leeg { font-size: 13px; color: var(--color-muted, #c4bdb3); font-style: italic; }

.dp-bel {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    background: var(--color-primary, #1a1a1a); color: #fff;
    text-decoration: none; font-size: 14px; font-weight: 700;
    padding: 13px; border-radius: 10px; margin-top: 20px;
    transition: background 0.18s; letter-spacing: 0.02em;
}
.dp-bel:hover { background: var(--color-muted, #333); }

.dp-socials-kaart {
    background: var(--color-card-bg, #fff);
    border: 1px solid var(--color-border, #e8e2d8);
    border-radius: 14px;
    padding: 20px 24px;
}
.dp-socials-kaart__titel {
    font-size: 11px; font-weight: 800;
    text-transform: uppercase; letter-spacing: 0.1em;
    color: var(--color-muted, #b0a898); margin: 0 0 14px;
}
.dp-socials { display: flex; gap: 8px; flex-wrap: wrap; }
.dp-socials a {
    width: 36px; height: 36px; border-radius: 9px;
    background: var(--color-header-bg, #f5f0e8); border: 1px solid var(--color-muted, #e2dbd0);
    display: grid; place-items: center;
    color: var(--color-muted, #b8a898); text-decoration: none;
    transition: background 0.15s, color 0.15s;
}
.dp-socials a i {
    font-size: 15px;
    line-height: 1;
    color: inherit;
    display: block;
    margin: 0; padding: 0;
}
.dp-socials a:hover { background: var(--color-primary, #1a1a1a); color: #fff; border-color: var(--color-primary, #1a1a1a); }
</style>

<div class="dp">

    <div class="dp-hero">
        <div class="dp-hero__inner">
            <a href="{{ route('home.index') }}" class="dp-terug">
                <i class="fa-solid fa-arrow-left"></i> Terug naar overzicht
            </a>
            <span class="dp-hero__label">Bedrijfsprofiel</span>
            <h1 class="dp-hero__naam">{{ $bedrijven->naam }}</h1>
            <div class="dp-hero__meta">
                @if($bedrijven->plaats)
                <span><i class="fa-solid fa-location-dot"></i> {{ $bedrijven->postcode }} {{ $bedrijven->plaats }}</span>
                @endif
                @if($bedrijven->telefoon)
                <span><i class="fa-solid fa-phone"></i> {{ $bedrijven->telefoon }}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="dp-body">
        <div class="dp-body__inner">

            <div class="dp-links">
                <div class="dp-afbeelding">
                    @if($bedrijven->afbeelding && file_exists(public_path('images/' . $bedrijven->afbeelding)))
                        <img src="{{ asset('images/' . $bedrijven->afbeelding) }}" alt="{{ $bedrijven->naam }}">
                    @else
                        <div class="dp-afbeelding__leeg"><i class="fa-solid fa-building"></i></div>
                    @endif
                </div>

                <div class="dp-over">
                    @if($bedrijven->beschrijving_kort)
                    <p class="dp-over__kort">"{{ $bedrijven->beschrijving_kort }}"</p>
                    @endif
                    <h2 class="dp-over__titel">Over {{ $bedrijven->naam }}</h2>
                    @if($bedrijven->beschrijving_lang)
                        <p class="dp-over__tekst">{{ $bedrijven->beschrijving_lang }}</p>
                    @else
                        <p class="dp-over__leeg">Nog geen uitgebreide beschrijving beschikbaar.</p>
                    @endif
                </div>

                @if($bedrijven->categorieen && $bedrijven->categorieen->isNotEmpty())
                <div class="dp-cats">
                    @foreach($bedrijven->categorieen as $cat)
                    <span class="dp-cats__tag">{{ $cat->categorie }}</span>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="dp-sidebar">
                <div class="dp-kaart">
                    <p class="dp-kaart__titel">Contactgegevens</p>
                    @if($bedrijven->straat || $bedrijven->telefoon || $bedrijven->gsm || $bedrijven->email || $bedrijven->website)
                    <ul class="dp-kaart__lijst">
                        @if($bedrijven->straat)
                        <li>
                            <span class="dp-kaart__ico"><i class="fa-solid fa-location-dot"></i></span>
                            <span>{{ $bedrijven->straat }} {{ $bedrijven->huisnummer }}<br>{{ $bedrijven->postcode }} {{ $bedrijven->plaats }}</span>
                        </li>
                        @endif
                        @if($bedrijven->telefoon)
                        <li>
                            <span class="dp-kaart__ico"><i class="fa-solid fa-phone"></i></span>
                            <a href="tel:{{ $bedrijven->telefoon }}">{{ $bedrijven->telefoon }}</a>
                        </li>
                        @endif
                        @if($bedrijven->gsm)
                        <li>
                            <span class="dp-kaart__ico"><i class="fa-solid fa-mobile-screen-button"></i></span>
                            <a href="tel:{{ $bedrijven->gsm }}">{{ $bedrijven->gsm }}</a>
                        </li>
                        @endif
                        @if($bedrijven->email)
                        <li>
                            <span class="dp-kaart__ico"><i class="fa-solid fa-envelope"></i></span>
                            <a href="mailto:{{ $bedrijven->email }}">{{ $bedrijven->email }}</a>
                        </li>
                        @endif
                        @if($bedrijven->website)
                        <li>
                            <span class="dp-kaart__ico"><i class="fa-solid fa-globe"></i></span>
                            <a href="{{ Str::startsWith($bedrijven->website, ['http://','https://']) ? $bedrijven->website : 'https://'.$bedrijven->website }}" target="_blank" rel="noopener">{{ $bedrijven->website }}</a>
                        </li>
                        @endif
                    </ul>
                    @else
                    <p class="dp-kaart__leeg">Geen contactgegevens beschikbaar.</p>
                    @endif

                    @if($bedrijven->telefoon)
                    <a href="tel:{{ $bedrijven->telefoon }}" class="dp-bel">
                        <i class="fa-solid fa-phone"></i> Bel direct
                    </a>
                    @endif
                </div>

                @if($bedrijven->facebook || $bedrijven->linkedin || $bedrijven->instagram || $bedrijven->website)
                <div class="dp-socials-kaart">
                    <p class="dp-socials-kaart__titel">Volg ons</p>
                    <div class="dp-socials">
                        @if($bedrijven->website)
                        <a href="{{ Str::startsWith($bedrijven->website, ['http://','https://']) ? $bedrijven->website : 'https://'.$bedrijven->website }}" target="_blank" title="Website"><i class="fa-solid fa-globe"></i></a>
                        @endif
                        @if($bedrijven->facebook)
                        <a href="{{ Str::startsWith($bedrijven->facebook, ['http://','https://']) ? $bedrijven->facebook : 'https://'.$bedrijven->facebook }}" target="_blank" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        @endif
                        @if($bedrijven->linkedin)
                        <a href="{{ Str::startsWith($bedrijven->linkedin, ['http://','https://']) ? $bedrijven->linkedin : 'https://'.$bedrijven->linkedin }}" target="_blank" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        @endif
                        @if($bedrijven->instagram)
                        <a href="{{ Str::startsWith($bedrijven->instagram, ['http://','https://']) ? $bedrijven->instagram : 'https://'.$bedrijven->instagram }}" target="_blank" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        @endif
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>

</div>

</x-base-layout>
