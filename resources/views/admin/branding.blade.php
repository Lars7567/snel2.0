<x-base-layout>

    <div class="branding-admin">
        <div class="branding-admin__inner">

            <h1 class="branding-admin__title">Huisstijl beheren</h1>

            @if(session('success'))
                <div class="branding-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.branding.update') }}" enctype="multipart/form-data" class="branding-form">
                @csrf

                {{-- Template / Lay-out --}}
                <div class="branding-section">
                    <h2 class="branding-section__title">Template & lay-out</h2>
                    <p class="branding-hint" style="margin-bottom:20px;">Kies de volledige opmaak van de website. Elke template heeft een eigen structuur en stijl.</p>

                    <div class="template-picker">
                        @php $currentTemplate = $settings['template'] ?? 'modern'; @endphp

                        <label class="template-card {{ $currentTemplate === 'modern' ? 'selected' : '' }}">
                            <input type="radio" name="template" value="modern" {{ $currentTemplate === 'modern' ? 'checked' : '' }}>
                            <div class="template-preview template-preview--modern">
                                <div class="tp-header"><div class="tp-logo"></div><div class="tp-nav"><span></span><span></span><span></span></div></div>
                                <div class="tp-hero"></div>
                                <div class="tp-cards"><div class="tp-card"></div><div class="tp-card"></div><div class="tp-card"></div></div>
                                <div class="tp-footer"></div>
                            </div>
                            <div class="template-label">
                                <strong>Modern</strong>
                                <span>Huidige stijl — donkere header, kaartgrid, CTA-balk</span>
                            </div>
                        </label>

                        <label class="template-card {{ $currentTemplate === 'minimal' ? 'selected' : '' }}">
                            <input type="radio" name="template" value="minimal" {{ $currentTemplate === 'minimal' ? 'checked' : '' }}>
                            <div class="template-preview template-preview--minimal">
                                <div class="tp-header tp-header--light"><div class="tp-logo tp-logo--dark"></div><div class="tp-nav tp-nav--right"><span></span><span></span><span></span></div></div>
                                <div class="tp-hero tp-hero--light"></div>
                                <div class="tp-list"><div class="tp-listitem"></div><div class="tp-listitem"></div><div class="tp-listitem"></div></div>
                                <div class="tp-footer tp-footer--light"></div>
                            </div>
                            <div class="template-label">
                                <strong>Minimalistisch</strong>
                                <span>Wit, editorial — nav rechts, kaarten als lijst</span>
                            </div>
                        </label>

                        <label class="template-card {{ $currentTemplate === 'warm' ? 'selected' : '' }}">
                            <input type="radio" name="template" value="warm" {{ $currentTemplate === 'warm' ? 'checked' : '' }}>
                            <div class="template-preview template-preview--warm">
                                <div class="tp-header tp-header--warm"><div class="tp-logo tp-logo--warm"></div><div class="tp-nav tp-nav--warm"><span></span><span></span><span></span></div></div>
                                <div class="tp-hero tp-hero--warm"></div>
                                <div class="tp-cards"><div class="tp-card tp-card--warm"></div><div class="tp-card tp-card--warm"></div><div class="tp-card tp-card--warm"></div></div>
                                <div class="tp-footer tp-footer--warm"></div>
                            </div>
                            <div class="template-label">
                                <strong>Warm & Gezellig</strong>
                                <span>Aardtinten, afgeronde hoeken, vriendelijk en uitnodigend</span>
                            </div>
                        </label>

                        <label class="template-card {{ $currentTemplate === 'corporate' ? 'selected' : '' }}">
                            <input type="radio" name="template" value="corporate" {{ $currentTemplate === 'corporate' ? 'checked' : '' }}>
                            <div class="template-preview template-preview--corporate">
                                <div class="tp-header tp-header--corporate"><div class="tp-logo tp-logo--light"></div><div class="tp-nav tp-nav--light"><span></span><span></span><span></span></div></div>
                                <div class="tp-hero tp-hero--corporate"></div>
                                <div class="tp-list tp-list--corporate"><div class="tp-listitem tp-listitem--corporate"></div><div class="tp-listitem tp-listitem--corporate"></div><div class="tp-listitem tp-listitem--corporate"></div></div>
                                <div class="tp-footer tp-footer--corporate"></div>
                            </div>
                            <div class="template-label">
                                <strong>Zakelijk</strong>
                                <span>Navy blauw, professioneel — kaarten als horizontale lijst</span>
                            </div>
                        </label>

                        <label class="template-card {{ $currentTemplate === 'dark' ? 'selected' : '' }}">
                            <input type="radio" name="template" value="dark" {{ $currentTemplate === 'dark' ? 'checked' : '' }}>
                            <div class="template-preview template-preview--dark">
                                <div class="tp-header tp-header--dark"><div class="tp-logo tp-logo--dim"></div><div class="tp-nav tp-nav--dim"><span></span><span></span><span></span></div></div>
                                <div class="tp-hero tp-hero--dark"></div>
                                <div class="tp-cards"><div class="tp-card tp-card--dark"></div><div class="tp-card tp-card--dark"></div><div class="tp-card tp-card--dark"></div></div>
                                <div class="tp-footer tp-footer--dark"></div>
                            </div>
                            <div class="template-label">
                                <strong>Indigo / Nacht</strong>
                                <span>Dark mode — modern, tech-stijl met glow-effecten</span>
                            </div>
                        </label>

                        <label class="template-card {{ $currentTemplate === 'retro' ? 'selected' : '' }}">
                            <input type="radio" name="template" value="retro" {{ $currentTemplate === 'retro' ? 'checked' : '' }}>
                            <div class="template-preview template-preview--retro">
                                <div class="tp-header tp-header--retro"><div class="tp-logo tp-logo--warm"></div><div class="tp-nav tp-nav--warm"><span></span><span></span><span></span></div></div>
                                <div class="tp-hero tp-hero--retro"></div>
                                <div class="tp-cards"><div class="tp-card tp-card--retro"></div><div class="tp-card tp-card--retro"></div><div class="tp-card tp-card--retro"></div></div>
                                <div class="tp-footer tp-footer--retro"></div>
                            </div>
                            <div class="template-label">
                                <strong>Retro</strong>
                                <span>Vintage krant-stijl — serif lettertypes, sepia tinten</span>
                            </div>
                        </label>

                    </div>
                </div>

                {{-- Algemeen --}}
                <div class="branding-section">
                    <h2 class="branding-section__title">Algemeen</h2>

                    <div class="branding-field">
                        <label class="branding-label" for="site_name">Sitenaam <span class="branding-hint">(verschijnt in browsertab)</span></label>
                        <input type="text" name="site_name" id="site_name" class="branding-text-input"
                               value="{{ $settings['site_name'] ?? config('branding.site_name') }}">
                    </div>

                    <div class="branding-field">
                        <label class="branding-label" for="site_desc">Meta beschrijving <span class="branding-hint">(voor zoekmachines, max. 160 tekens)</span></label>
                        <input type="text" name="site_desc" id="site_desc" class="branding-text-input"
                               value="{{ $settings['site_desc'] ?? config('branding.site_desc') }}">
                    </div>

                    <div class="branding-field">
                        <label class="branding-label" for="favicon">Favicon uploaden <span class="branding-hint">(png of ico, ideaal 32×32px)</span></label>
                        @php $currentFavicon = $settings['favicon'] ?? config('branding.favicon'); @endphp
                        @if($currentFavicon && file_exists(public_path(ltrim($currentFavicon, '/'))))
                            <img src="{{ $currentFavicon }}" alt="favicon" style="width:32px;height:32px;display:block;margin-bottom:8px;border:1px solid #e5e7eb;border-radius:4px;padding:2px;">
                        @endif
                        <input type="file" name="favicon" id="favicon" accept="image/png,image/x-icon,image/svg+xml" class="branding-file-input">
                    </div>
                </div>

                {{-- Logo --}}
                <div class="branding-section">
                    <h2 class="branding-section__title">Logo</h2>

                    <div class="branding-field">
                        <label class="branding-label">Huidig logo</label>
                        <img src="{{ $settings['logo'] ?? config('branding.logo') }}" alt="Huidig logo" class="branding-logo-preview">
                    </div>

                    <div class="branding-field">
                        <label class="branding-label">Kies logo uit bibliotheek</label>
                        <div class="img-picker" id="picker-logo">
                            @foreach($images as $img)
                                <div class="img-picker__item {{ ($settings['logo'] ?? config('branding.logo')) === $img ? 'selected' : '' }}"
                                     onclick="pickImage('logo', '{{ $img }}', this)">
                                    <img src="{{ $img }}" alt="{{ basename($img) }}">
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="logo_existing" id="logo_existing" value="">
                    </div>

                    <div class="branding-field">
                        <label class="branding-label" for="logo">Of nieuw logo uploaden <span class="branding-hint">(jpg, png, svg)</span></label>
                        <input type="file" name="logo" id="logo" accept="image/*" class="branding-file-input">
                    </div>

                    <div class="branding-field" style="margin-top: 24px; padding-top: 24px; border-top: 1px solid #e5e7eb;">
                        <label class="branding-label">Footer logo <span class="branding-hint">(laat leeg om hetzelfde logo als de header te gebruiken)</span></label>
                        @php $currentFooterLogo = $settings['footer_logo'] ?? null; @endphp
                        @if($currentFooterLogo && file_exists(public_path(ltrim($currentFooterLogo, '/'))))
                            <img src="{{ $currentFooterLogo }}" alt="Huidig footer logo" class="branding-logo-preview">
                        @else
                            <p class="branding-hint" style="margin-bottom:12px;">Geen apart footer logo ingesteld — hetzelfde als het header logo.</p>
                        @endif
                    </div>

                    <div class="branding-field">
                        <label class="branding-label">Kies footer logo uit bibliotheek</label>
                        <div class="img-picker" id="picker-footer_logo">
                            @foreach($images as $img)
                                <div class="img-picker__item {{ ($settings['footer_logo'] ?? null) === $img ? 'selected' : '' }}"
                                     onclick="pickImage('footer_logo', '{{ $img }}', this)">
                                    <img src="{{ $img }}" alt="{{ basename($img) }}">
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="footer_logo_existing" id="footer_logo_existing" value="">
                    </div>

                    <div class="branding-field">
                        <label class="branding-label" for="footer_logo">Of nieuw footer logo uploaden <span class="branding-hint">(jpg, png, svg)</span></label>
                        <input type="file" name="footer_logo" id="footer_logo" accept="image/*" class="branding-file-input">
                    </div>

                    <div class="branding-field" style="margin-top: 24px; padding-top: 24px; border-top: 1px solid #e5e7eb;">
                        <label class="branding-label">Huidige header afbeelding</label>
                        <img src="{{ $settings['header_image'] ?? config('branding.header_image') }}" alt="Huidige header afbeelding" class="branding-header-preview">
                    </div>

                    <div class="branding-field">
                        <label class="branding-label">Kies header afbeelding uit bibliotheek</label>
                        <div class="img-picker" id="picker-header_image">
                            @foreach($images as $img)
                                <div class="img-picker__item {{ ($settings['header_image'] ?? config('branding.header_image')) === $img ? 'selected' : '' }}"
                                     onclick="pickImage('header_image', '{{ $img }}', this)">
                                    <img src="{{ $img }}" alt="{{ basename($img) }}">
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="header_image_existing" id="header_image_existing" value="">
                    </div>

                    <div class="branding-field">
                        <label class="branding-label" for="header_image">Of nieuwe header afbeelding uploaden <span class="branding-hint">(jpg, png)</span></label>
                        <input type="file" name="header_image" id="header_image" accept="image/*" class="branding-file-input">
                    </div>
                </div>

                {{-- Kleuren --}}
                <div class="branding-section">
                    <h2 class="branding-section__title">Kleuren</h2>
                    <p class="branding-hint">De hover-kleur wordt automatisch iets donkerder gemaakt.</p>

                    <div class="branding-fields-row">
                        <div class="branding-field">
                            <label class="branding-label" for="primary_color">Hoofdkleur <span class="branding-hint">(titels, links)</span></label>
                            <div class="branding-color-group">
                                <input type="color" name="primary_color" id="primary_color"
                                       value="{{ $settings['colors']['primary'] ?? config('branding.colors.primary') }}"
                                       class="branding-color-input"
                                       oninput="document.getElementById('primary_hex').textContent = this.value">
                                <span id="primary_hex" class="branding-color-hex">
                                    {{ $settings['colors']['primary'] ?? config('branding.colors.primary') }}
                                </span>
                            </div>
                        </div>

                        <div class="branding-field">
                            <label class="branding-label" for="accent_color">Accentkleur <span class="branding-hint">(hover effecten, CTA-knop)</span></label>
                            <div class="branding-color-group">
                                <input type="color" name="accent_color" id="accent_color"
                                       value="{{ $settings['colors']['accent'] ?? config('branding.colors.accent') }}"
                                       class="branding-color-input"
                                       oninput="document.getElementById('accent_hex').textContent = this.value">
                                <span id="accent_hex" class="branding-color-hex">
                                    {{ $settings['colors']['accent'] ?? config('branding.colors.accent') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Achtergrondkleuren --}}
                <div class="branding-section">
                    <h2 class="branding-section__title">Achtergrondkleuren</h2>

                    <div class="branding-fields-row">
                        <div class="branding-field">
                            <label class="branding-label" for="header_bg">Header achtergrond</label>
                            <div class="branding-color-group">
                                <input type="color" name="header_bg" id="header_bg"
                                       value="{{ $settings['colors']['header_bg'] ?? config('branding.colors.header_bg') }}"
                                       class="branding-color-input"
                                       oninput="document.getElementById('header_bg_hex').textContent = this.value">
                                <span id="header_bg_hex" class="branding-color-hex">
                                    {{ $settings['colors']['header_bg'] ?? config('branding.colors.header_bg') }}
                                </span>
                            </div>
                        </div>

                        <div class="branding-field">
                            <label class="branding-label" for="header_text">Header tekst kleur</label>
                            <div class="branding-color-group">
                                <input type="color" name="header_text" id="header_text"
                                       value="{{ $settings['colors']['header_text'] ?? config('branding.colors.header_text') }}"
                                       class="branding-color-input"
                                       oninput="document.getElementById('header_text_hex').textContent = this.value">
                                <span id="header_text_hex" class="branding-color-hex">
                                    {{ $settings['colors']['header_text'] ?? config('branding.colors.header_text') }}
                                </span>
                            </div>
                        </div>

                        <div class="branding-field">
                            <label class="branding-label" for="footer_bg">Footer achtergrond</label>
                            <div class="branding-color-group">
                                <input type="color" name="footer_bg" id="footer_bg"
                                       value="{{ $settings['colors']['footer_bg'] ?? config('branding.colors.footer_bg') }}"
                                       class="branding-color-input"
                                       oninput="document.getElementById('footer_bg_hex').textContent = this.value">
                                <span id="footer_bg_hex" class="branding-color-hex">
                                    {{ $settings['colors']['footer_bg'] ?? config('branding.colors.footer_bg') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="branding-fields-row">
                        <div class="branding-field">
                            <label class="branding-label" for="cta_bg">CTA-balk achtergrond</label>
                            <div class="branding-color-group">
                                <input type="color" name="cta_bg" id="cta_bg"
                                       value="{{ $settings['colors']['cta_bg'] ?? config('branding.colors.cta_bg') }}"
                                       class="branding-color-input"
                                       oninput="document.getElementById('cta_bg_hex').textContent = this.value">
                                <span id="cta_bg_hex" class="branding-color-hex">
                                    {{ $settings['colors']['cta_bg'] ?? config('branding.colors.cta_bg') }}
                                </span>
                            </div>
                        </div>

                        <div class="branding-field">
                            <label class="branding-label" for="cta_btn_bg">CTA-knop achtergrond</label>
                            <div class="branding-color-group">
                                <input type="color" name="cta_btn_bg" id="cta_btn_bg"
                                       value="{{ $settings['colors']['cta_btn_bg'] ?? config('branding.colors.cta_btn_bg') }}"
                                       class="branding-color-input"
                                       oninput="document.getElementById('cta_btn_bg_hex').textContent = this.value">
                                <span id="cta_btn_bg_hex" class="branding-color-hex">
                                    {{ $settings['colors']['cta_btn_bg'] ?? config('branding.colors.cta_btn_bg') }}
                                </span>
                            </div>
                        </div>

                        <div class="branding-field">
                            <label class="branding-label" for="cta_btn_text">CTA-knop tekst</label>
                            <div class="branding-color-group">
                                <input type="color" name="cta_btn_text" id="cta_btn_text"
                                       value="{{ $settings['colors']['cta_btn_text'] ?? config('branding.colors.cta_btn_text') }}"
                                       class="branding-color-input"
                                       oninput="document.getElementById('cta_btn_text_hex').textContent = this.value">
                                <span id="cta_btn_text_hex" class="branding-color-hex">
                                    {{ $settings['colors']['cta_btn_text'] ?? config('branding.colors.cta_btn_text') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Font --}}
                <div class="branding-section">
                    <h2 class="branding-section__title">Lettertype</h2>

                    <div class="branding-field">
                        <label class="branding-label" for="font_family">Kies een lettertype</label>
                        <select name="font_family" id="font_family" class="branding-select" onchange="previewFont(this.value)">
                            @php
                                $fontLabels = [
                                    'Arial'      => 'Arial (standaard)',
                                    'Inter'      => 'Inter',
                                    'Roboto'     => 'Roboto',
                                    'Poppins'    => 'Poppins',
                                    'Lato'       => 'Lato',
                                    'Open Sans'  => 'Open Sans',
                                    'Montserrat' => 'Montserrat',
                                ];
                                $currentFamily = $settings['fonts']['family'] ?? config('branding.fonts.family');
                            @endphp

                            @foreach($fonts as $font)
                                <option value="{{ $font }}"
                                    {{ str_starts_with($currentFamily, $font) ? 'selected' : '' }}>
                                    {{ $fontLabels[$font] ?? $font }}
                                </option>
                            @endforeach
                        </select>

                        <p class="branding-font-preview" id="font-preview">
                            De snelle bruine vos springt over de luie hond.
                        </p>
                    </div>
                </div>

                <button type="submit" class="branding-save-btn">Opslaan</button>
            </form>

        </div>
    </div>

    <style>
        /* Template picker */
        .template-picker {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .template-card {
            flex: 1 1 180px;
            cursor: pointer;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            transition: border-color 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
        }

        .template-card input[type="radio"] { display: none; }

        .template-card:hover { border-color: #999; }

        .template-card.selected {
            border-color: #111;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.08);
        }

        .template-preview {
            width: 100%;
            height: 130px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
        }

        /* Modern preview */
        .template-preview--modern  { background: #f5f5f5; }
        .template-preview--minimal { background: #fafafa; }
        .template-preview--warm    { background: #faf8f4; }

        .tp-header { height: 18px; display: flex; align-items: center; padding: 0 8px; gap: 6px; background: #2d3142; }
        .tp-header--light { background: #fff; border-bottom: 1px solid #e8e8e8; }
        .tp-header--dark  { background: #0c0f22; border-bottom: 1px solid rgba(120,140,255,0.2); }

        .tp-logo { width: 24px; height: 6px; background: #fff; border-radius: 1px; opacity: 0.7; }
        .tp-logo--dark { background: #a5b4fc; opacity: 0.6; }

        .tp-nav { display: flex; gap: 4px; align-items: center; }
        .tp-nav--right { margin-left: auto; }
        .tp-nav span { width: 14px; height: 4px; background: rgba(255,255,255,0.5); border-radius: 1px; }
        .tp-nav--right span { background: #ccc; }

        .tp-hero { height: 42px; background: linear-gradient(135deg, #b8b8b8 0%, #d8d8d8 100%); }
        .tp-hero--light { background: #f0f0f0; }
        .tp-hero--dark  { background: linear-gradient(135deg, #0c0f22 0%, #1a1f45 100%); }

        .tp-cards { display: flex; gap: 4px; padding: 6px 6px 4px; flex: 1; }
        .tp-cards--dark { background: #0c0f22; }
        .tp-card { flex: 1; background: #fff; border-radius: 2px; border: 1px solid #e8e8e8; }
        .tp-card--dark { background: #161c38; border-color: rgba(120,140,255,0.18); border-radius: 4px; }

        .tp-list { display: flex; flex-direction: column; gap: 0; padding: 4px 6px; flex: 1; }
        .tp-listitem { height: 18px; background: #fff; border-bottom: 1px solid #e8e8e8; display: flex; align-items: center; gap: 4px; padding: 0 4px; }
        .tp-listitem::before { content: ''; width: 20px; height: 10px; background: #e0e0e0; border-radius: 1px; flex-shrink: 0; }
        .tp-listitem::after { content: ''; flex: 1; height: 4px; background: #f0f0f0; border-radius: 1px; }

        .tp-header--warm  { background: #f5ede0; border-bottom: 1px solid #e8d9c6; }
        .tp-logo--warm    { background: #8b5e3c; }
        .tp-nav--warm span { background: #b8956a; }
        .tp-hero--warm    { background: linear-gradient(135deg, #c8a882 0%, #e8c9a0 100%); }
        .tp-card--warm    { background: #fff9f4; border: 1px solid #eedfd0; border-radius: 4px; }
        .tp-footer--warm  { background: #2c1f14; }

        /* Corporate */
        .tp-header--corporate { background: #0f2341; }
        .tp-logo--light  { background: rgba(255,255,255,0.7); }
        .tp-nav--light span { background: rgba(255,255,255,0.35); }
        .tp-hero--corporate { background: linear-gradient(135deg, #0f2341 0%, #1a3a6b 100%); }
        .tp-list--corporate { display: flex; flex-direction: column; gap: 2px; padding: 4px; }
        .tp-listitem--corporate { height: 14px; background: #fff; border: 1px solid #dde4ed; border-radius: 2px; display: flex; align-items: center; gap: 3px; padding: 0 4px; }
        .tp-listitem--corporate::before { content: ''; width: 14px; height: 8px; background: #e0e8f0; border-radius: 1px; flex-shrink: 0; }
        .tp-listitem--corporate::after { content: ''; flex: 1; height: 3px; background: #f0f4f8; border-radius: 1px; }
        .tp-footer--corporate { background: #091729; }

        /* Dark */
        .tp-header--dark { background: #161b22; border-bottom: 1px solid #30363d; }
        .tp-logo--dim  { background: rgba(255,255,255,0.25); }
        .tp-nav--dim span { background: rgba(255,255,255,0.15); }
        .tp-hero--dark { background: #0d1117; }
        .tp-card--dark { background: #161b22; border: 1px solid #30363d; border-radius: 3px; }
        .tp-footer--dark { background: #010409; border-top: 1px solid #21262d; }

        /* Retro */
        .tp-header--retro { background: #2d1f0a; border-bottom: 3px solid #8b6914; }
        .tp-hero--retro { background: radial-gradient(ellipse at center, #3d2b10, #2d1f0a); }
        .tp-card--retro { background: #fffbf0; border: 1px solid #c8a85a; box-shadow: 2px 2px 0 #c8a85a; }
        .tp-footer--retro { background: #1a1106; border-top: 2px solid #8b6914; }

        .tp-footer { height: 16px; background: #2d3142; }
        .tp-footer--light { background: #fff; border-top: 1px solid #e8e8e8; }

        .template-label {
            padding: 12px 14px;
            background: #fff;
            border-top: 1px solid #e5e7eb;
        }

        .template-label strong {
            display: block;
            font-size: 0.9rem;
            color: #111;
            margin-bottom: 2px;
        }

        .template-label span {
            font-size: 0.78rem;
            color: #888;
            line-height: 1.4;
            display: block;
        }

        .branding-admin {
            display: flex;
            justify-content: center;
            padding: 60px 20px 100px;
        }

        .branding-admin__inner {
            width: 100%;
            max-width: 800px;
        }

        .branding-admin__title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #111;
        }

        .branding-success {
            background: #d1fae5;
            border: 1px solid #34d399;
            color: #065f46;
            padding: 12px 18px;
            border-radius: 6px;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .branding-form {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .branding-section {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 28px;
            margin-bottom: 24px;
            background: #fff;
        }

        .branding-section__title {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0 0 20px;
            color: #111;
        }

        .branding-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
            font-size: 0.95rem;
        }

        .branding-hint {
            font-weight: 400;
            color: #888;
            font-size: 0.85rem;
        }

        .branding-field {
            margin-bottom: 20px;
        }

        .branding-field:last-child {
            margin-bottom: 0;
        }

        .branding-fields-row {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .branding-fields-row .branding-field {
            flex: 1 1 200px;
        }

        .branding-logo-preview {
            max-width: 200px;
            max-height: 60px;
            display: block;
            margin-bottom: 12px;
            border: 1px solid #e5e7eb;
            padding: 8px;
            border-radius: 4px;
            background: #f9fafb;
        }

        .img-picker {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 12px;
        }

        .img-picker__item {
            width: 90px;
            height: 70px;
            border: 2px solid #e5e7eb;
            border-radius: 6px;
            overflow: hidden;
            cursor: pointer;
            transition: border-color 0.15s;
        }

        .img-picker__item:hover {
            border-color: #999;
        }

        .img-picker__item.selected {
            border-color: #111;
            box-shadow: 0 0 0 2px #111;
        }

        .img-picker__item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .branding-header-preview {
            width: 100%;
            max-height: 140px;
            object-fit: cover;
            display: block;
            margin-bottom: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
        }

        .branding-text-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.95rem;
            outline: none;
            box-sizing: border-box;
        }

        .branding-text-input:focus {
            border-color: #111;
        }

        .branding-file-input {
            display: block;
            font-size: 0.9rem;
            color: #333;
        }

        .branding-color-group {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .branding-color-input {
            width: 52px;
            height: 52px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            padding: 2px;
            background: none;
        }

        .branding-color-hex {
            font-family: monospace;
            font-size: 1rem;
            color: #333;
            background: #f3f4f6;
            padding: 6px 12px;
            border-radius: 4px;
        }

        .branding-select {
            width: 100%;
            max-width: 320px;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
            background: #fff;
            cursor: pointer;
            outline: none;
        }

        .branding-select:focus {
            border-color: #111;
        }

        .branding-font-preview {
            margin-top: 14px;
            font-size: 1.1rem;
            color: #444;
            border-left: 3px solid #e5e7eb;
            padding-left: 14px;
            transition: font-family 0.2s;
        }

        .branding-save-btn {
            padding: 14px 40px;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            align-self: flex-start;
            transition: background 0.2s;
        }

        .branding-save-btn:hover {
            background: #333;
        }

        @media (max-width: 600px) {
            .branding-fields-row {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>

    <script>
        function pickImage(field, path, el) {
            // Deselecteer alle items in deze picker
            document.querySelectorAll('#picker-' + field + ' .img-picker__item').forEach(function(item) {
                item.classList.remove('selected');
            });
            el.classList.add('selected');
            document.getElementById(field + '_existing').value = path;
        }

        // Laad Google Fonts dynamisch voor de preview
        const googleFontUrls = {
            'Inter':      'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap',
            'Roboto':     'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap',
            'Poppins':    'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap',
            'Lato':       'https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap',
            'Open Sans':  'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap',
            'Montserrat': 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap',
        };

        function previewFont(fontName) {
            const preview = document.getElementById('font-preview');
            if (googleFontUrls[fontName]) {
                // Laad het font als het nog niet geladen is
                if (!document.querySelector(`link[href="${googleFontUrls[fontName]}"]`)) {
                    const link = document.createElement('link');
                    link.rel  = 'stylesheet';
                    link.href = googleFontUrls[fontName];
                    document.head.appendChild(link);
                }
                preview.style.fontFamily = `'${fontName}', sans-serif`;
            } else {
                preview.style.fontFamily = 'Arial, Helvetica, sans-serif';
            }
        }

        // Direct preview tonen van huidig geselecteerd font bij laden
        window.addEventListener('DOMContentLoaded', () => {
            const select = document.getElementById('font_family');
            if (select) previewFont(select.value);

            // Template picker: update 'selected' class bij klikken
            document.querySelectorAll('.template-card input[type="radio"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    document.querySelectorAll('.template-card').forEach(function(card) {
                        card.classList.remove('selected');
                    });
                    this.closest('.template-card').classList.add('selected');
                });
            });
        });
    </script>

</x-base-layout>
