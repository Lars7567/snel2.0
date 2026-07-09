<x-base-layout>

<style>
/* Hero */
.bvn-hero {
    background: var(--color-hero-bg, #1a1a1a);
    padding: 48px 32px;
    text-align: center;
}
.bvn-hero__label {
    display: inline-block;
    background: rgba(255,255,255,0.08); color: var(--color-hero-sub, #c8bfb0);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 11px; font-weight: 800;
    letter-spacing: 0.16em; text-transform: uppercase;
    padding: 5px 16px; border-radius: 50px; margin-bottom: 20px;
}
.bvn-hero__titel {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 44px; font-weight: 900;
    color: var(--color-hero-text, #fff); letter-spacing: -0.04em;
    line-height: 1.1; margin: 0 0 16px;
}
.bvn-hero__sub {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 16px; color: var(--color-hero-sub, #9ca3af);
    font-weight: 400; line-height: 1.7;
    max-width: 480px; margin: 0 auto;
}

.bvn-sectie { padding: 48px 0 100px; background: var(--color-body-bg, #fff); }
.bvn-inner  { max-width: 1200px; margin: 0 auto; padding: 0 32px; }

/* Filters */
.bvn-filters {
    display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
    background: var(--color-header-bg, #f9f7f3); border: 1px solid var(--color-border, #ece9e3); border-radius: 14px;
    padding: 16px 20px; margin-bottom: 20px;
}
.bvn-search-wrap {
    flex: 1; min-width: 200px;
    display: flex; align-items: center; gap: 10px;
    background: var(--color-card-bg, #fff); border: 1.5px solid var(--color-border, #e2ddd5); border-radius: 50px;
    padding: 10px 16px;
}
.bvn-search-wrap i { color: var(--color-muted, #b0a898); font-size: 13px; flex-shrink: 0; }
.bvn-search-wrap input {
    flex: 1; border: none; outline: none; background: none;
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13.5px;
    color: var(--color-body-text, #1a1a1a); font-weight: 500;
}
.bvn-search-wrap input::placeholder { color: var(--color-muted, #b0a898); font-weight: 400; }

/* Custom dropdown */
.bvn-dropdown { position: relative; }
.bvn-dropdown__toggle {
    background: var(--color-card-bg, #fff); border: 1.5px solid var(--color-border, #e2ddd5); border-radius: 50px;
    padding: 10px 18px; font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px; font-weight: 600; color: var(--color-body-text, #1a1a1a);
    cursor: pointer; display: flex; align-items: center; gap: 10px;
    white-space: nowrap; transition: border-color 0.15s;
}
.bvn-dropdown__toggle:hover { border-color: var(--color-muted, #1a1a1a); }
.bvn-dropdown__toggle i {
    font-size: 11px; color: var(--color-muted, #b0a898);
    transition: transform 0.2s;
}
.bvn-dropdown.open .bvn-dropdown__toggle { border-color: var(--color-muted, #1a1a1a); }
.bvn-dropdown.open .bvn-dropdown__toggle i { transform: rotate(180deg); }

.bvn-dropdown__menu {
    display: none; position: absolute; top: calc(100% + 8px); left: 0;
    background: var(--color-card-bg, #fff); border: 1.5px solid var(--color-border, #e2ddd5); border-radius: 14px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.12); min-width: 200px;
    overflow: hidden; z-index: 100;
}
.bvn-dropdown.open .bvn-dropdown__menu { display: block; }

.bvn-dropdown__item {
    display: block; width: 100%; text-align: left;
    padding: 11px 18px; background: none; border: none;
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13.5px;
    font-weight: 500; color: var(--color-muted, #374151); cursor: pointer;
    transition: background 0.12s;
}
.bvn-dropdown__item:hover  { background: var(--color-header-bg, #f9f7f3); color: var(--color-body-text, #1a1a1a); }
.bvn-dropdown__item.active { background: var(--color-header-bg, #f5f0e8); color: var(--color-muted, #8b7355); font-weight: 700; }

.bvn-dropdown__toggle i:first-child { color: var(--color-muted, #8b7355); font-size: 12px; }

/* Resultaat label */
.bvn-resultaat {
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px;
    color: var(--color-muted, #b0a898); font-weight: 500; margin: 0 0 28px;
}

/* Grid */
.bvn-grid {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;
}
@media (max-width: 960px) { .bvn-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 560px)  { .bvn-grid { grid-template-columns: 1fr; } }

/* Kaart */
.bvn-kaart {
    background: var(--color-card-bg, #fff); border: 1px solid var(--color-border, #ece9e3); border-radius: 16px;
    overflow: hidden; text-decoration: none;
    display: flex; flex-direction: column;
    transition: transform 0.2s, box-shadow 0.2s;
}
.bvn-kaart:hover { transform: translateY(-4px); box-shadow: 0 16px 48px rgba(0,0,0,0.1); }

.bvn-kaart__img {
    width: 100%; aspect-ratio: 4/3; overflow: hidden;
    background: var(--color-header-bg, #f5f0e8); flex-shrink: 0;
    border-radius: 0; margin: 0;
}
.bvn-kaart__img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.35s; display: block; }
.bvn-kaart:hover .bvn-kaart__img img { transform: scale(1.05); }
.bvn-kaart__img-leeg {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    color: var(--color-muted, #d4c9b8); font-size: 40px;
}

.bvn-kaart__body {
    padding: 20px 22px 24px;
    display: flex; flex-direction: column; gap: 7px; flex: 1;
}
.bvn-kaart__naam {
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 16px; font-weight: 800;
    color: var(--color-body-text, #0f0f0f); margin: 0; letter-spacing: -0.01em;
}
.bvn-kaart__plaats {
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 12.5px;
    color: var(--color-muted, #b0a898); font-weight: 500; margin: 0;
    display: flex; align-items: center; gap: 5px;
}
.bvn-kaart__plaats i { font-size: 11px; }
.bvn-kaart__desc {
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13.5px;
    color: var(--color-content-text, #6b7280); line-height: 1.6; margin: 0; flex: 1;
}
.bvn-kaart__cta {
    display: inline-flex; align-items: center; gap: 7px;
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 12.5px;
    font-weight: 700; color: var(--color-body-text, #0f0f0f); margin-top: 8px; letter-spacing: 0.02em;
}
.bvn-kaart__cta i { font-size: 11px; transition: transform 0.2s; }
.bvn-kaart:hover .bvn-kaart__cta i { transform: translateX(4px); }

/* Geen resultaten */
.bvn-geen {
    text-align: center; padding: 80px 20px; color: var(--color-muted, #c4bdb3);
}
.bvn-geen i { font-size: 48px; margin-bottom: 16px; display: block; }
.bvn-geen p { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 15px; font-weight: 500; margin: 0; }

/* Meer knop */
.bvn-meer { display: flex; justify-content: center; margin-top: 56px; }
.bvn-meer-btn {
    background: var(--color-body-text, #0f0f0f); color: #fff; border: none; border-radius: 50px;
    padding: 15px 44px; font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px; font-weight: 700; cursor: pointer;
    letter-spacing: 0.03em; transition: background 0.18s, transform 0.18s;
}
.bvn-meer-btn:hover    { background: var(--color-muted, #2a2a2a); transform: translateY(-2px); }
.bvn-meer-btn:disabled { background: #e5e7eb; color: #9ca3af; cursor: not-allowed; transform: none; }
</style>

<div class="bvn-hero">
    <span class="bvn-hero__label">{{ \App\Helpers\ContentHelper::get('bedrijven_hero_label', 'Overzicht') }}</span>
    <h1 class="bvn-hero__titel">{{ \App\Helpers\ContentHelper::get('bedrijven_hero_titel', 'Alle bedrijven') }}</h1>
    <p class="bvn-hero__sub">{{ \App\Helpers\ContentHelper::get('bedrijven_hero_sub', 'Zoek, filter en ontdek lokale bedrijven in jouw regio.') }}</p>
</div>

<section class="bvn-sectie">
    <div class="bvn-inner">
        <div class="bvn-filters">
            <div class="bvn-search-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="zoek-input" placeholder="Zoek op naam, plaats of omschrijving…">
            </div>

            <div class="bvn-dropdown" id="cat-dropdown">
                <button class="bvn-dropdown__toggle" id="cat-toggle" type="button">
                    <span id="cat-label">Alle categorieën</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="bvn-dropdown__menu" id="cat-menu">
                    <button class="bvn-dropdown__item active" data-value="" type="button">Alle categorieën</button>
                    @foreach($categorieen as $cat)
                        <button class="bvn-dropdown__item" data-value="{{ $cat->id }}" type="button">{{ $cat->categorie }}</button>
                    @endforeach
                </div>
            </div>
            <input type="hidden" id="categorie-select" value="">

            <div class="bvn-dropdown" id="sort-dropdown">
                <button class="bvn-dropdown__toggle" id="sort-toggle" type="button">
                    <i class="fa-solid fa-arrow-up-wide-short"></i>
                    <span id="sort-label">Meest bezocht</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="bvn-dropdown__menu" id="sort-menu">
                    <button class="bvn-dropdown__item active" data-sort="clicks_desc" type="button">Meest bezocht</button>
                    <button class="bvn-dropdown__item" data-sort="nieuwste" type="button">Nieuwste eerst</button>
                    <button class="bvn-dropdown__item" data-sort="naam_asc" type="button">Naam A → Z</button>
                    <button class="bvn-dropdown__item" data-sort="naam_desc" type="button">Naam Z → A</button>
                </div>
            </div>
        </div>

        <p class="bvn-resultaat" id="resultaat-label">{{ $totaal }} bedrijven gevonden</p>

        <div class="bvn-grid" id="bedrijven-grid">
            @foreach($bedrijven as $bedrijf)
            <a href="{{ route('home.show', $bedrijf->id) }}" class="bvn-kaart">
                <div class="bvn-kaart__img">
                    @if($bedrijf->afbeelding && file_exists(public_path('images/' . $bedrijf->afbeelding)))
                        <img src="{{ asset('images/' . $bedrijf->afbeelding) }}" alt="{{ $bedrijf->naam }}">
                    @else
                        <div class="bvn-kaart__img-leeg"><i class="fa-solid fa-building"></i></div>
                    @endif
                </div>
                <div class="bvn-kaart__body">
                    <p class="bvn-kaart__naam">{{ $bedrijf->naam }}</p>
                    @if($bedrijf->plaats)
                    <p class="bvn-kaart__plaats"><i class="fa-solid fa-location-dot"></i> {{ $bedrijf->plaats }}</p>
                    @endif
                    @if($bedrijf->beschrijving_kort)
                    <p class="bvn-kaart__desc">{{ Str::limit($bedrijf->beschrijving_kort, 75) }}</p>
                    @endif
                    <span class="bvn-kaart__cta">Bekijk bedrijf <i class="fa-solid fa-arrow-right"></i></span>
                </div>
            </a>
            @endforeach
        </div>

        <div class="bvn-geen" id="geen-resultaten" style="display:none">
            <i class="fa-solid fa-building-circle-xmark"></i>
            <p>Geen bedrijven gevonden</p>
        </div>

        <div class="bvn-meer" id="meer-wrap" @if($totaal <= 9) style="display:none" @endif>
            <button class="bvn-meer-btn" id="meer-btn">Meer bedrijven laden</button>
        </div>

    </div>
</section>


<script>
(function () {
    let offset     = 9;
    let bezig      = false;
    let huidigSort = 'clicks_desc';

    const grid     = document.getElementById('bedrijven-grid');
    const meerBtn  = document.getElementById('meer-btn');
    const meerWrap = document.getElementById('meer-wrap');
    const geenEl   = document.getElementById('geen-resultaten');
    const labelEl  = document.getElementById('resultaat-label');
    const zoekInput  = document.getElementById('zoek-input');
    const catSelect  = document.getElementById('categorie-select');

    /* Herbruikbare dropdown init */
    function initDropdown(dropId, menuId, labelId, onChange) {
        const drop   = document.getElementById(dropId);
        const toggle = drop.querySelector('.bvn-dropdown__toggle');
        const menu   = document.getElementById(menuId);
        const label  = document.getElementById(labelId);
        toggle.addEventListener('click', e => { e.stopPropagation(); drop.classList.toggle('open'); });
        document.addEventListener('click', () => drop.classList.remove('open'));
        menu.querySelectorAll('.bvn-dropdown__item').forEach(item => {
            item.addEventListener('click', () => {
                menu.querySelectorAll('.bvn-dropdown__item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                label.textContent = item.textContent.trim();
                drop.classList.remove('open');
                onChange(item.dataset.value !== undefined ? item.dataset.value : item.dataset.sort);
            });
        });
    }

    initDropdown('cat-dropdown', 'cat-menu', 'cat-label', val => { catSelect.value = val; herlaad(); });
    initDropdown('sort-dropdown', 'sort-menu', 'sort-label', val => { huidigSort = val; herlaad(); });

    /* Debounce zoekbalk */
    let zoekTimer;
    zoekInput.addEventListener('input', () => {
        clearTimeout(zoekTimer);
        zoekTimer = setTimeout(herlaad, 350);
    });

    if (meerBtn) meerBtn.addEventListener('click', laadMeer);

    function params(extraOffset) {
        return new URLSearchParams({
            offset:    extraOffset ?? offset,
            sort:      huidigSort,
            zoek:      zoekInput.value.trim(),
            categorie: catSelect.value,
        });
    }

    function herlaad() {
        if (bezig) return;
        bezig = true;
        offset = 0;
        grid.innerHTML = '';
        if (meerWrap) meerWrap.style.display = 'none';
        geenEl.style.display = 'none';

        fetch('/bedrijven-laden?' + params(0))
            .then(r => r.json())
            .then(data => {
                verwerkData(data, false);
            })
            .finally(() => { bezig = false; });
    }

    function laadMeer() {
        if (bezig) return;
        bezig = true;
        meerBtn.disabled = true;
        meerBtn.textContent = 'Laden…';

        fetch('/bedrijven-laden?' + params())
            .then(r => r.json())
            .then(data => {
                verwerkData(data, true);
            })
            .finally(() => {
                bezig = false;
                meerBtn.disabled = false;
                meerBtn.textContent = 'Meer bedrijven laden';
            });
    }

    function verwerkData(data, append) {
        if (!append) grid.innerHTML = '';

        if (data.bedrijven.length === 0 && !append) {
            geenEl.style.display = 'block';
            labelEl.textContent = '0 bedrijven gevonden';
            if (meerWrap) meerWrap.style.display = 'none';
            return;
        }

        data.bedrijven.forEach(b => grid.insertAdjacentHTML('beforeend', kaartHTML(b)));
        offset += data.bedrijven.length;

        labelEl.textContent = data.totaal + ' bedrijven gevonden';

        if (data.heeftMeer) {
            meerWrap.style.display = 'flex';
        } else {
            if (meerWrap) meerWrap.style.display = 'none';
        }
    }

    function kaartHTML(b) {
        const img = b.afbeelding
            ? `<img src="/images/${esc(b.afbeelding)}" alt="${esc(b.naam)}">`
            : `<div class="bvn-kaart__img-leeg"><i class="fa-solid fa-building"></i></div>`;

        const plaats = b.plaats
            ? `<p class="bvn-kaart__plaats"><i class="fa-solid fa-location-dot"></i> ${esc(b.plaats)}</p>` : '';

        const desc = b.beschrijving_kort
            ? `<p class="bvn-kaart__desc">${esc(b.beschrijving_kort.substring(0, 75))}${b.beschrijving_kort.length > 75 ? '…' : ''}</p>` : '';

        return `
        <a href="/bedrijven/${b.id}" class="bvn-kaart">
            <div class="bvn-kaart__img">${img}</div>
            <div class="bvn-kaart__body">
                <p class="bvn-kaart__naam">${esc(b.naam)}</p>
                ${plaats}${desc}
                <span class="bvn-kaart__cta">Bekijk bedrijf <i class="fa-solid fa-arrow-right"></i></span>
            </div>
        </a>`;
    }

    function esc(s) {
        return String(s ?? '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
})();
</script>

</x-base-layout>
