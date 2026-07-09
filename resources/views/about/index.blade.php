<x-base-layout>

<style>
.ao *:not(i) { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

/* ── Hero ─────────────────────────────────────────── */
.ao-hero {
    background: var(--color-hero-bg, #1a1a1a);
    padding: 48px 32px;
    text-align: center;
}
.ao-hero__label {
    display: inline-block;
    background: rgba(255,255,255,0.08);
    color: var(--color-hero-sub, #c8bfb0);
    font-size: 11px; font-weight: 800;
    letter-spacing: 0.16em; text-transform: uppercase;
    padding: 5px 16px; border-radius: 50px;
    margin-bottom: 24px;
}
.ao-hero__titel {
    font-size: 52px; font-weight: 900;
    color: var(--color-hero-text, #fff); letter-spacing: -0.04em;
    line-height: 1.1; margin: 0 0 20px;
}
.ao-hero__sub {
    font-size: 17px; color: var(--color-hero-sub, #9ca3af);
    font-weight: 400; line-height: 1.7;
    max-width: 560px; margin: 0 auto;
}

/* ── 3 blokken ────────────────────────────────────── */
.ao-blokken {
    background: var(--color-body-bg, #fff);
    padding: 80px 32px;
}
.ao-blokken__inner {
    max-width: 1250px; margin: 0 auto;
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 28px;
}
@media (max-width: 800px) { .ao-blokken__inner { grid-template-columns: 1fr; } }

.ao-blok {
    background: var(--color-card-bg, #f9f7f3);
    border: 1px solid var(--color-muted, #ece9e3);
    border-radius: 20px;
    padding: 36px 32px;
}
.ao-blok__ico {
    width: 52px; height: 52px;
    background: var(--color-header-bg, #f5f0e8);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; color: var(--color-muted, #8b7355);
    margin-bottom: 24px;
}
.ao-blok__titel {
    font-size: 20px; font-weight: 800;
    color: var(--color-muted, #1a1a1a); letter-spacing: -0.02em;
    margin: 0 0 12px;
}
.ao-blok__tekst {
    font-size: 14px; color: var(--color-muted, #6b7280);
    line-height: 1.75; margin: 0;
}

/* ── Verhaal ──────────────────────────────────────── */
.ao-verhaal {
    background: var(--color-header-bg, #f5f0e8);
    padding: 96px 32px;
}
.ao-verhaal__inner {
    max-width: 1250px; margin: 0 auto;
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 80px; align-items: center;
}
@media (max-width: 840px) { .ao-verhaal__inner { grid-template-columns: 1fr; gap: 40px; } }

.ao-verhaal__img {
    border-radius: 20px; overflow: hidden;
    aspect-ratio: 4/3;
    background: var(--color-header-bg, #ede8de);
    display: flex; align-items: center; justify-content: center;
    color: var(--color-muted, #c8bfb0); font-size: 64px;
}
.ao-verhaal__img img { width: 100%; height: 100%; object-fit: cover; display: block; }

.ao-verhaal__label {
    display: inline-block;
    background: color-mix(in srgb, var(--color-muted, #8b7355) 20%, transparent); color: var(--color-muted, #8b7355);
    font-size: 11px; font-weight: 800;
    letter-spacing: 0.14em; text-transform: uppercase;
    padding: 5px 14px; border-radius: 50px;
    margin-bottom: 20px;
}
.ao-verhaal__titel {
    font-size: 36px; font-weight: 900;
    color: var(--color-muted, #1a1a1a); letter-spacing: -0.03em;
    line-height: 1.15; margin: 0 0 20px;
}
.ao-verhaal__tekst {
    font-size: 15px; color: var(--color-content-text, #6b7280);
    line-height: 1.8; margin: 0 0 16px;
}

/* ── CTA ──────────────────────────────────────────── */
.ao-cta {
    background: var(--color-body-bg, #fff);
    padding: 80px 32px;
    text-align: center;
}
.ao-cta__inner { max-width: 600px; margin: 0 auto; }
.ao-cta__titel {
    font-size: 32px; font-weight: 900;
    color: var(--color-muted, #1a1a1a); letter-spacing: -0.03em;
    margin: 0 0 14px;
}
.ao-cta__sub {
    font-size: 15px; color: var(--color-body-text, #1a1a1a);
    line-height: 1.7; margin: 0 0 32px;
}
.ao-cta__btn {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--color-muted, #1a1a1a); color: #fff;
    text-decoration: none; font-size: 14px; font-weight: 700;
    padding: 14px 32px; border-radius: 50px;
    letter-spacing: 0.03em;
    transition: background 0.18s, transform 0.18s;
}
.ao-cta__btn:hover { background: var(--color-header-text, #1a1a1a); transform: translateY(-2px); }
</style>

{{-- Hero --}}
<div class="ao-hero">
    <span class="ao-hero__label">{{ \App\Helpers\ContentHelper::get('about_hero_label', 'Over ons') }}</span>
    <h1 class="ao-hero__titel">{!! nl2br(e(\App\Helpers\ContentHelper::get('about_hero_titel', 'Bedrijven snel en eenvoudig vinden'))) !!}</h1>
    <p class="ao-hero__sub">{{ \App\Helpers\ContentHelper::get('about_hero_sub', 'SnelopZoek.net verbindt ondernemers met klanten in de buurt. Betrouwbaar, overzichtelijk en altijd actueel.') }}</p>
</div>

{{-- 3 blokken --}}
<section class="ao-blokken">
    <div class="ao-blokken__inner">
        <div class="ao-blok">
            <div class="ao-blok__ico"><i class="fa-solid fa-shield-halved"></i></div>
            <h3 class="ao-blok__titel">{{ \App\Helpers\ContentHelper::get('about_blok1_titel', 'Betrouwbaarheid') }}</h3>
            <p class="ao-blok__tekst">{{ \App\Helpers\ContentHelper::get('about_blok1_tekst', 'Alle bedrijven op ons platform worden zorgvuldig gecontroleerd. Je kunt erop vertrouwen dat de informatie die je hier vindt actueel en correct is. Kwaliteit staat bij ons altijd voorop.') }}</p>
        </div>
        <div class="ao-blok">
            <div class="ao-blok__ico"><i class="fa-solid fa-briefcase"></i></div>
            <h3 class="ao-blok__titel">{{ \App\Helpers\ContentHelper::get('about_blok2_titel', 'Aanbod') }}</h3>
            <p class="ao-blok__tekst">{{ \App\Helpers\ContentHelper::get('about_blok2_tekst', 'Van loodgieters tot schilders, van kappers tot aannemers — ons platform biedt een breed en divers aanbod van lokale bedrijven. Voor elke klus of vraag vind je hier de juiste professional.') }}</p>
        </div>
        <div class="ao-blok">
            <div class="ao-blok__ico"><i class="fa-solid fa-bullseye"></i></div>
            <h3 class="ao-blok__titel">{{ \App\Helpers\ContentHelper::get('about_blok3_titel', 'Zichtbaarheid') }}</h3>
            <p class="ao-blok__tekst">{{ \App\Helpers\ContentHelper::get('about_blok3_tekst', 'Wij helpen lokale ondernemers om online beter gevonden te worden. Met een profiel op SnelopZoek.net vergroot je jouw bereik en trek je nieuwe klanten aan zonder moeite.') }}</p>
        </div>
    </div>
</section>

{{-- Verhaal --}}
<section class="ao-verhaal">
    <div class="ao-verhaal__inner">
        <div class="ao-verhaal__img">
            <i class="fa-solid fa-city"></i>
        </div>
        <div>
            <span class="ao-verhaal__label">{{ \App\Helpers\ContentHelper::get('about_verhaal_label', 'Ons verhaal') }}</span>
            <h2 class="ao-verhaal__titel">{{ \App\Helpers\ContentHelper::get('about_verhaal_titel', 'Lokale bedrijven verdienen een sterk podium') }}</h2>
            <p class="ao-verhaal__tekst">{{ \App\Helpers\ContentHelper::get('about_verhaal_tekst1', 'SnelopZoek.net is ontstaan vanuit een simpele gedachte: lokale ondernemers verdienen meer zichtbaarheid. Veel kwalitatieve bedrijven zijn moeilijk te vinden, terwijl klanten juist op zoek zijn naar betrouwbare professionals in hun buurt.') }}</p>
            <p class="ao-verhaal__tekst">{{ \App\Helpers\ContentHelper::get('about_verhaal_tekst2', 'Ons platform brengt vraag en aanbod samen op een overzichtelijke manier. Of je nu een aannemer zoekt voor een verbouwing of een schilder voor je gevel — bij SnelopZoek.net vind je snel de juiste partij.') }}</p>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="ao-cta">
    <div class="ao-cta__inner">
        <h2 class="ao-cta__titel">{{ \App\Helpers\ContentHelper::get('about_cta_titel', 'Staat jouw bedrijf er al bij?') }}</h2>
        <p class="ao-cta__sub">{{ \App\Helpers\ContentHelper::get('about_cta_sub', 'Meld je gratis aan en word gevonden door honderden potentiële klanten in jouw regio.') }}</p>
        <a href="{{ route('contact.index') }}" class="ao-cta__btn">
            Gratis aanmelden <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</section>

</x-base-layout>
