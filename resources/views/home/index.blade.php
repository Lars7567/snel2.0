<x-base-layout>

<div class="bdr-hero">
    <span class="bdr-hero__label">{{ \App\Helpers\ContentHelper::get('home_hero_label', 'Ontdek') }}</span>
    <h1 class="bdr-hero__titel">{!! nl2br(e(\App\Helpers\ContentHelper::get('home_hero_titel', 'Lokale bedrijven snel gevonden'))) !!}</h1>
    <p class="bdr-hero__sub">{{ \App\Helpers\ContentHelper::get('home_hero_sub', 'Vind de beste bedrijven bij jou in de buurt — betrouwbaar, overzichtelijk en altijd actueel.') }}</p>
</div>

<section class="bdr-sectie">
    <div class="bdr-inner">

        <div class="bdr-grid" id="bedrijven-grid">
            @foreach($topBedrijven as $bedrijf)
            <a href="{{ route('home.show', $bedrijf->id) }}" class="bdr-kaart">
                <div class="bdr-kaart__img">
                    @if($bedrijf->afbeelding && file_exists(public_path('images/' . $bedrijf->afbeelding)))
                        <img src="{{ asset('images/' . $bedrijf->afbeelding) }}" alt="{{ $bedrijf->naam }}">
                    @else
                        <div class="bdr-kaart__img-leeg"><i class="fa-solid fa-building"></i></div>
                    @endif
                </div>
                <div class="bdr-kaart__body">
                    <p class="bdr-kaart__naam">{{ $bedrijf->naam }}</p>
                    @if($bedrijf->plaats)
                    <p class="bdr-kaart__plaats"><i class="fa-solid fa-location-dot"></i> {{ $bedrijf->plaats }}</p>
                    @endif
                    @if($bedrijf->beschrijving_kort)
                    <p class="bdr-kaart__desc">{{ Str::limit($bedrijf->beschrijving_kort, 75) }}</p>
                    @endif
                    <span class="bdr-kaart__cta">Bekijk bedrijf <i class="fa-solid fa-arrow-right"></i></span>
                </div>
            </a>
            @endforeach
        </div>


    </div>
</section>

<style>
/* Hero */
.bdr-hero {
    background: #1a1a1a;
    padding: 48px 32px;
    text-align: center;
}
.bdr-hero__label {
    display: inline-block;
    background: rgba(255,255,255,0.08); color: #c8bfb0;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px; font-weight: 800;
    letter-spacing: 0.16em; text-transform: uppercase;
    padding: 5px 16px; border-radius: 50px; margin-bottom: 20px;
}
.bdr-hero__titel {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 44px; font-weight: 900;
    color: #fff; letter-spacing: -0.04em;
    line-height: 1.1; margin: 0 0 16px;
}
.bdr-hero__sub {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px; color: #9ca3af;
    font-weight: 400; line-height: 1.7;
    max-width: 480px; margin: 0 auto;
}

.bdr-sectie {
    padding: 64px 0 100px;
    background: #fff;
}
.bdr-inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 32px;
}

/* Grid */
.bdr-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}
@media (max-width: 960px) { .bdr-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 560px)  { .bdr-grid { grid-template-columns: 1fr; } }

/* Kaart */
.bdr-kaart {
    background: #fff;
    border: 1px solid #ece9e3;
    border-radius: 16px;
    overflow: hidden;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s, box-shadow 0.2s;
}
.bdr-kaart:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 48px rgba(0,0,0,0.1);
}
.bdr-kaart__img {
    width: 100%;
    aspect-ratio: 4/3;
    overflow: hidden;
    background: #f5f0e8;
    flex-shrink: 0;
}
.bdr-kaart__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.35s;
}
.bdr-kaart:hover .bdr-kaart__img img { transform: scale(1.05); }
.bdr-kaart__img-leeg {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #d4c9b8;
    font-size: 40px;
}
.bdr-kaart__body {
    padding: 20px 22px 24px;
    display: flex;
    flex-direction: column;
    gap: 7px;
    flex: 1;
}
.bdr-kaart__naam {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: #0f0f0f;
    margin: 0;
    letter-spacing: -0.01em;
}
.bdr-kaart__plaats {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    color: #b0a898;
    font-weight: 500;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 5px;
}
.bdr-kaart__plaats i { font-size: 11px; }
.bdr-kaart__desc {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13.5px;
    color: #6b7280;
    line-height: 1.6;
    margin: 0;
    flex: 1;
}
.bdr-kaart__cta {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12.5px;
    font-weight: 700;
    color: #0f0f0f;
    margin-top: 8px;
    letter-spacing: 0.02em;
}
.bdr-kaart__cta i { font-size: 11px; transition: transform 0.2s; }
.bdr-kaart:hover .bdr-kaart__cta i { transform: translateX(4px); }

</style>


</x-base-layout>
