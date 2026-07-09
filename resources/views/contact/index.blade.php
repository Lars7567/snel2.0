<x-base-layout>

<style>
.ct *:not(i) { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

/* ── Hero ─────────────────────────────────────────── */
.ct-hero {
    background: var(--color-hero-bg, #1a1a1a);
    padding: 48px 32px;
    text-align: center;
}
.ct-hero__label {
    display: inline-block;
    background: rgba(255,255,255,0.08);
    color: var(--color-hero-sub, #c8bfb0);
    font-size: 11px; font-weight: 800;
    letter-spacing: 0.16em; text-transform: uppercase;
    padding: 5px 16px; border-radius: 50px;
    margin-bottom: 20px;
}
.ct-hero__titel {
    font-size: 44px; font-weight: 900;
    color: var(--color-hero-text, #fff); letter-spacing: -0.04em;
    line-height: 1.1; margin: 0 0 16px;
}
.ct-hero__sub {
    font-size: 16px; color: var(--color-hero-sub, #9ca3af);
    font-weight: 400; line-height: 1.7;
    max-width: 480px; margin: 0 auto;
}

/* ── Body ─────────────────────────────────────────── */
.ct-body { background: var(--color-header-bg, #f5f0e8); padding: 72px 32px; }
.ct-body__inner {
    max-width: 1250px; margin: 0 auto;
    display: grid; grid-template-columns: 1fr 1.6fr;
    gap: 56px; align-items: start;
}
@media (max-width: 860px) { .ct-body__inner { grid-template-columns: 1fr; gap: 40px; } }

/* ── Info kolom ───────────────────────────────────── */
.ct-info__titel {
    font-size: 22px; font-weight: 900;
    color: var(--color-muted, #1a1a1a); letter-spacing: -0.02em;
    margin: 0 0 8px;
}
.ct-info__sub {
    font-size: 14px; color: var(--color-content-text, #6b7280);
    line-height: 1.7; margin: 0 0 36px;
}
.ct-info__items { display: flex; flex-direction: column; gap: 20px; }
.ct-info__item { display: flex; align-items: flex-start; gap: 16px; }
.ct-info__ico {
    width: 44px; height: 44px; flex-shrink: 0;
    background: var(--color-card-bg, #fff); border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; color: var(--color-muted, #8b7355);
    border: 1px solid var(--color-border, #ece9e3);
}
.ct-info__item-titel {
    font-size: 13px; font-weight: 800; color: var(--color-body-text, #1a1a1a);
    letter-spacing: 0.02em; text-transform: uppercase; margin: 0 0 3px;
}
.ct-info__item-tekst { font-size: 14px; color: var(--color-content-text, #6b7280); margin: 0; line-height: 1.6; }

/* ── Formulier ────────────────────────────────────── */
.ct-form {
    background: var(--color-card-bg, #fff); border: 1px solid var(--color-border, #ece9e3);
    border-radius: 20px; padding: 40px 36px;
}
.ct-form__row {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 16px; margin-bottom: 16px;
}
@media (max-width: 560px) { .ct-form__row { grid-template-columns: 1fr; } }

.ct-form__group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
.ct-form__label {
    font-size: 12px; font-weight: 700; color: var(--color-body-text, #1a1a1a);
    letter-spacing: 0.06em; text-transform: uppercase;
}
.ct-form__input,
.ct-form__textarea {
    background: var(--color-header-bg, #f9f7f3); border: 1.5px solid var(--color-border, #ece9e3); border-radius: 10px;
    padding: 12px 16px; font-size: 14px; color: var(--color-body-text, #1a1a1a);
    font-family: 'Plus Jakarta Sans', sans-serif;
    outline: none; transition: border-color 0.18s; width: 100%;
}
.ct-form__input:focus,
.ct-form__textarea:focus { border-color: var(--color-muted, #8b7355); }
.ct-form__textarea { resize: vertical; min-height: 140px; }

/* Custom dropdown */
.ct-dropdown { position: relative; }
.ct-dropdown__toggle {
    width: 100%; display: flex; align-items: center; justify-content: space-between;
    background: var(--color-header-bg, #f9f7f3); border: 1.5px solid var(--color-border, #ece9e3); border-radius: 10px;
    padding: 12px 16px; font-size: 14px; color: var(--color-content-text, #6b7280);
    font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 400;
    cursor: pointer; transition: border-color 0.18s; text-align: left;
}
.ct-dropdown__toggle.selected { color: var(--color-body-text, #1a1a1a); }
.ct-dropdown.open .ct-dropdown__toggle,
.ct-dropdown__toggle:focus { border-color: var(--color-muted, #8b7355); outline: none; }
.ct-dropdown__toggle i { font-size: 12px; color: var(--color-muted, #b0a898); transition: transform 0.2s; flex-shrink: 0; }
.ct-dropdown.open .ct-dropdown__toggle i { transform: rotate(180deg); }

.ct-dropdown__menu {
    display: none; position: absolute; top: calc(100% + 6px); left: 0; right: 0;
    background: var(--color-card-bg, #fff); border: 1.5px solid var(--color-border, #e2ddd5); border-radius: 12px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.10); overflow: hidden; z-index: 100;
}
.ct-dropdown.open .ct-dropdown__menu { display: block; }
.ct-dropdown__item {
    display: block; width: 100%; text-align: left;
    padding: 11px 16px; background: none; border: none;
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px;
    font-weight: 500; color: var(--color-body-text, #374151); cursor: pointer;
    transition: background 0.12s;
}
.ct-dropdown__item:hover  { background: var(--color-header-bg, #f9f7f3); color: var(--color-body-text, #1a1a1a); }
.ct-dropdown__item.active { background: var(--color-header-bg, #f5f0e8); color: var(--color-muted, #8b7355); font-weight: 700; }

.ct-form__btn {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--color-muted, #1a1a1a); color: #fff; border: none; cursor: pointer;
    font-size: 14px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    padding: 14px 32px; border-radius: 50px; letter-spacing: 0.03em;
    transition: background 0.18s, transform 0.18s; margin-top: 8px;
}
.ct-form__btn:hover { background: var(--color-muted, #333); transform: translateY(-2px); }

/* ── Flash berichten ──────────────────────────────── */
.ct-alert {
    border-radius: 12px; padding: 14px 18px;
    font-size: 14px; font-weight: 600;
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 20px;
}
.ct-alert--success { background: #f0fdf4; border: 1.5px solid #bbf7d0; color: #166534; }
.ct-alert--error   { background: #fef2f2; border: 1.5px solid #fecaca; color: #991b1b; }
</style>

{{-- Hero --}}
<div class="ct-hero">
    <span class="ct-hero__label">{{ \App\Helpers\ContentHelper::get('contact_hero_label', 'Contact') }}</span>
    <h1 class="ct-hero__titel">{{ \App\Helpers\ContentHelper::get('contact_hero_titel', 'Neem contact op') }}</h1>
    <p class="ct-hero__sub">{{ \App\Helpers\ContentHelper::get('contact_hero_sub', 'Heb je een vraag, opmerking of wil je jouw bedrijf aanmelden? Stuur ons een bericht.') }}</p>
</div>

{{-- Body --}}
<div class="ct-body">
    <div class="ct-body__inner">

        {{-- Info --}}
        <div>
            <p class="ct-info__titel">{{ \App\Helpers\ContentHelper::get('contact_info_titel', 'Hoe kunnen we helpen?') }}</p>
            <p class="ct-info__sub">{{ \App\Helpers\ContentHelper::get('contact_info_sub', 'We reageren doorgaans binnen één werkdag op jouw bericht.') }}</p>

            @php
                $brandingFile = storage_path('app/branding.json');
                $ctBs = file_exists($brandingFile) ? (json_decode(file_get_contents($brandingFile), true) ?? []) : [];
                $ctEmail = $ctBs['contact_email'] ?? '';
                $ctPhone = $ctBs['site_phone'] ?? '';
                $ctHours = $ctBs['site_hours'] ?? '';
            @endphp
            <div class="ct-info__items">
                @if($ctEmail)
                <div class="ct-info__item">
                    <div class="ct-info__ico"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <p class="ct-info__item-titel">E-mail</p>
                        <p class="ct-info__item-tekst">{{ $ctEmail }}</p>
                    </div>
                </div>
                @endif
                @if($ctPhone)
                <div class="ct-info__item">
                    <div class="ct-info__ico"><i class="fa-solid fa-phone"></i></div>
                    <div>
                        <p class="ct-info__item-titel">Telefoon</p>
                        <p class="ct-info__item-tekst">{{ $ctPhone }}</p>
                    </div>
                </div>
                @endif
                @if($ctHours)
                <div class="ct-info__item">
                    <div class="ct-info__ico"><i class="fa-solid fa-clock"></i></div>
                    <div>
                        <p class="ct-info__item-titel">Openingstijden</p>
                        <p class="ct-info__item-tekst">{{ $ctHours }}</p>
                    </div>
                </div>
                @endif
                <div class="ct-info__item">
                    <div class="ct-info__ico"><i class="fa-solid fa-store"></i></div>
                    <div>
                        <p class="ct-info__item-titel">Bedrijf aanmelden</p>
                        <p class="ct-info__item-tekst">Gratis zichtbaar worden op ons platform</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Formulier --}}
        <div class="ct-form">

            @if(session('success'))
                <div class="ct-alert ct-alert--success">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="ct-alert ct-alert--error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}">
                @csrf

                <div class="ct-form__row">
                    <div class="ct-form__group">
                        <label class="ct-form__label">Aanhef</label>
                        <div class="ct-dropdown" id="aanhef-dropdown">
                            <button type="button" class="ct-dropdown__toggle" id="aanhef-toggle">
                                <span id="aanhef-label">Selecteer...</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>
                            <div class="ct-dropdown__menu" id="aanhef-menu">
                                <button type="button" class="ct-dropdown__item" data-value="man">De heer</button>
                                <button type="button" class="ct-dropdown__item" data-value="vrouw">Mevrouw</button>
                            </div>
                        </div>
                        <input type="hidden" name="callname" id="callname-input" value="{{ old('callname') }}" required>
                        @error('callname')<span style="font-size:12px;color:#991b1b">{{ $message }}</span>@enderror
                    </div>
                    <div class="ct-form__group">
                        <label class="ct-form__label">Naam</label>
                        <input type="text" name="name" class="ct-form__input" placeholder="Jan Jansen" value="{{ old('name') }}" required>
                        @error('name')<span style="font-size:12px;color:#991b1b">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="ct-form__group">
                    <label class="ct-form__label">E-mailadres</label>
                    <input type="email" name="email" class="ct-form__input" placeholder="jan@bedrijf.nl" value="{{ old('email') }}" required>
                    @error('email')<span style="font-size:12px;color:#991b1b">{{ $message }}</span>@enderror
                </div>

                <div class="ct-form__group">
                    <label class="ct-form__label">Bedrijfsnaam <span style="font-weight:400;color:#9ca3af">(optioneel)</span></label>
                    <input type="text" name="bussiness" class="ct-form__input" placeholder="Jansen B.V." value="{{ old('bussiness') }}">
                </div>

                <div class="ct-form__group">
                    <label class="ct-form__label">Bericht</label>
                    <textarea name="message" class="ct-form__textarea" placeholder="Schrijf hier je bericht..." required>{{ old('message') }}</textarea>
                    @error('message')<span style="font-size:12px;color:#991b1b">{{ $message }}</span>@enderror
                </div>

                <button type="submit" class="ct-form__btn">
                    Verstuur bericht <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>

        </div>

    </div>
</div>

<script>
(function () {
    const drop   = document.getElementById('aanhef-dropdown');
    const toggle = document.getElementById('aanhef-toggle');
    const label  = document.getElementById('aanhef-label');
    const input  = document.getElementById('callname-input');
    const menu   = document.getElementById('aanhef-menu');

    // Herstel oude waarde na validatiefout
    const oldVal = input.value;
    if (oldVal) {
        const match = menu.querySelector(`[data-value="${oldVal}"]`);
        if (match) {
            label.textContent = match.textContent.trim();
            toggle.classList.add('selected');
            match.classList.add('active');
        }
    }

    toggle.addEventListener('click', e => { e.stopPropagation(); drop.classList.toggle('open'); });
    document.addEventListener('click', () => drop.classList.remove('open'));

    menu.querySelectorAll('.ct-dropdown__item').forEach(item => {
        item.addEventListener('click', () => {
            menu.querySelectorAll('.ct-dropdown__item').forEach(i => i.classList.remove('active'));
            item.classList.add('active');
            label.textContent = item.textContent.trim();
            toggle.classList.add('selected');
            input.value = item.dataset.value;
            drop.classList.remove('open');
        });
    });
})();
</script>

</x-base-layout>
