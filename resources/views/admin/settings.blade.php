<x-base-layout>
<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">

<div class="db-wrap">
<div class="db-inner">

    <h1 class="db-title">Dashboard</h1>
    <div id="save-alert" class="db-alert" style="display:none;"></div>

    {{-- ═══ TABS ═══ --}}
    <div class="db-tabs">
        <button class="db-tab active" id="tab-btn-instellingen" onclick="switchTab('instellingen')">
            <i class="fa-solid fa-gear"></i> Instellingen
        </button>
        <button class="db-tab" id="tab-btn-stijl" onclick="switchTab('stijl')">
            <i class="fa-solid fa-palette"></i> Stijl
        </button>
        <button class="db-tab" id="tab-btn-teksten" onclick="switchTab('teksten')">
            <i class="fa-solid fa-align-left"></i> Teksten
        </button>
        <button class="db-tab" id="tab-btn-importexport" onclick="switchTab('importexport')">
            <i class="fa-solid fa-file-import"></i> Import / Export
        </button>
    </div>

    {{-- ═══════════════════════════════════════
         TAB 1 — INSTELLINGEN
    ═══════════════════════════════════════ --}}
    <div class="db-panel" id="panel-instellingen">
    <form id="settings-form" method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="db-section">
            <h2 class="db-section-title">Contactgegevens</h2>
            <p class="db-hint" style="margin-bottom:18px;">Deze gegevens verschijnen in de topbalk, de contactpagina en de footer.</p>
            <div class="db-row">
                <div class="db-field">
                    <label class="db-label">Ontvangst e-mailadres</label>
                    <input type="email" name="contact_email" class="db-input"
                           value="{{ $settings['contact_email'] ?? '' }}" placeholder="info@snelopzoek.net" required>
                </div>
                <div class="db-field">
                    <label class="db-label">Telefoonnummer <span class="db-hint">(topbalk)</span></label>
                    <input type="text" name="site_phone" class="db-input"
                           value="{{ $settings['site_phone'] ?? '' }}" placeholder="06 000 000 00">
                </div>
            </div>
            <div class="db-field">
                <label class="db-label">Openingstijden <span class="db-hint">(topbalk)</span></label>
                <input type="text" name="site_hours" class="db-input" style="max-width:400px"
                       value="{{ $settings['site_hours'] ?? '' }}" placeholder="Ma–Vr: 09:00–17:00">
            </div>
        </div>

        <div class="db-section">
            <h2 class="db-section-title">E-mail verzenden</h2>
            @php $mailType = $settings['mail_type'] ?? 'phpmail'; @endphp

            {{-- Methode keuze --}}
            <div class="db-field" style="margin-bottom:20px;">
                <label class="db-label">Mail methode</label>
                <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:6px;">
                    <label class="mail-method-card {{ $mailType === 'phpmail' ? 'mail-method-active' : '' }}" id="card-phpmail">
                        <input type="radio" name="mail_type" value="phpmail" {{ $mailType === 'phpmail' ? 'checked' : '' }} onchange="toggleMailMethod('phpmail')">
                        <strong><i class="fa-solid fa-server"></i> PHP Mail</strong>
                        <span>Aanbevolen voor Plesk — geen extra instellingen nodig</span>
                    </label>
                    <label class="mail-method-card {{ $mailType === 'smtp' ? 'mail-method-active' : '' }}" id="card-smtp">
                        <input type="radio" name="mail_type" value="smtp" {{ $mailType === 'smtp' ? 'checked' : '' }} onchange="toggleMailMethod('smtp')">
                        <strong><i class="fa-solid fa-envelope"></i> SMTP</strong>
                        <span>Vul hieronder je SMTP-gegevens in</span>
                    </label>
                </div>
            </div>

            {{-- Afzender (altijd zichtbaar) --}}
            <div class="db-row">
                <div class="db-field">
                    <label class="db-label">Afzender e-mailadres <span class="db-hint">(moet op jouw domein staan)</span></label>
                    <input type="email" name="mail_from_address" class="db-input"
                           value="{{ $settings['mail_from_address'] ?? 'info@bedrijfsvermelding.net' }}"
                           placeholder="info@bedrijfsvermelding.net">
                </div>
                <div class="db-field">
                    <label class="db-label">Afzendernaam</label>
                    <input type="text" name="mail_from_name" class="db-input"
                           value="{{ $settings['mail_from_name'] ?? 'Bedrijfsvermelding' }}"
                           placeholder="Bedrijfsvermelding">
                </div>
            </div>

            {{-- SMTP velden --}}
            <div id="smtp-fields" style="{{ $mailType === 'phpmail' ? 'display:none' : '' }}">
                <div class="db-row">
                    <div class="db-field">
                        <label class="db-label">SMTP-host</label>
                        <input type="text" name="mail_host" class="db-input" value="{{ $settings['mail_host'] ?? '' }}" placeholder="mail.bedrijfsvermelding.net">
                    </div>
                    <div class="db-field db-field--sm">
                        <label class="db-label">Poort</label>
                        <input type="number" name="mail_port" class="db-input" value="{{ $settings['mail_port'] ?? '587' }}" placeholder="587">
                    </div>
                </div>
                <div class="db-row">
                    <div class="db-field">
                        <label class="db-label">Gebruikersnaam</label>
                        <input type="text" name="mail_username" class="db-input" value="{{ $settings['mail_username'] ?? '' }}" autocomplete="off">
                    </div>
                    <div class="db-field">
                        <label class="db-label">Wachtwoord</label>
                        <div class="db-pw-wrap">
                            <input type="password" name="mail_password" id="mail_password" class="db-input" value="{{ $settings['mail_password'] ?? '' }}" autocomplete="new-password">
                            <button type="button" class="db-pw-toggle" onclick="togglePw()"><i class="fa-solid fa-eye" id="pw-icon"></i></button>
                        </div>
                    </div>
                </div>
                <div class="db-field db-field--sm">
                    <label class="db-label">Encryptie</label>
                    <select name="mail_encryption" class="db-input" style="max-width:200px;">
                        <option value="tls" {{ ($settings['mail_encryption'] ?? 'tls') === 'tls' ? 'selected' : '' }}>TLS (587)</option>
                        <option value="ssl" {{ ($settings['mail_encryption'] ?? '') === 'ssl' ? 'selected' : '' }}>SSL (465)</option>
                        <option value=""   {{ ($settings['mail_encryption'] ?? '') === '' ? 'selected' : '' }}>Geen</option>
                    </select>
                </div>
            </div>

            <button type="button" onclick="sendTestMail()" class="db-btn-outline" style="margin-top:8px;">
                <i class="fa-solid fa-paper-plane"></i> Testmail versturen
            </button>
        </div>

        <div class="db-section">
            <h2 class="db-section-title">Social media (footer)</h2>
            <p class="db-hint" style="margin-bottom:18px;">Laat leeg om het icoon te verbergen.</p>
            <div class="db-row">
                <div class="db-field">
                    <label class="db-label"><i class="fa-brands fa-facebook-f"></i> Facebook</label>
                    <input type="url" name="footer_facebook" class="db-input" value="{{ $settings['footer_facebook'] ?? '' }}" placeholder="https://facebook.com/…">
                </div>
                <div class="db-field">
                    <label class="db-label"><i class="fa-brands fa-instagram"></i> Instagram</label>
                    <input type="url" name="footer_instagram" class="db-input" value="{{ $settings['footer_instagram'] ?? '' }}" placeholder="https://instagram.com/…">
                </div>
            </div>
            <div class="db-row">
                <div class="db-field">
                    <label class="db-label"><i class="fa-brands fa-linkedin-in"></i> LinkedIn</label>
                    <input type="url" name="footer_linkedin" class="db-input" value="{{ $settings['footer_linkedin'] ?? '' }}" placeholder="https://linkedin.com/…">
                </div>
                <div class="db-field">
                    <label class="db-label"><i class="fa-brands fa-x-twitter"></i> X / Twitter</label>
                    <input type="url" name="footer_twitter" class="db-input" value="{{ $settings['footer_twitter'] ?? '' }}" placeholder="https://x.com/…">
                </div>
            </div>
        </div>

        <div class="db-section">
            <h2 class="db-section-title">Algemene voorwaarden</h2>
            <p class="db-hint" style="margin-bottom:18px;">
                Zichtbaar op <a href="{{ route('av.download') }}" target="_blank" style="color:#111;text-decoration:underline;">/algemene-voorwaarden</a>.
                Een geüploade PDF heeft voorrang.
            </p>
            @php $avPdf = $settings['av_pdf'] ?? ''; @endphp
            @if($avPdf && file_exists(public_path('files/' . $avPdf)))
                <div class="db-pdf-bar">
                    <i class="fa-solid fa-file-pdf" style="color:#dc2626;"></i>
                    <a href="{{ route('av.download') }}" target="_blank">Huidig PDF bekijken</a>
                    <label style="margin-left:auto;display:flex;align-items:center;gap:6px;color:#dc2626;font-weight:600;font-size:.85rem;cursor:pointer;">
                        <input type="checkbox" name="av_pdf_delete" value="1"> Verwijder PDF
                    </label>
                </div>
            @endif
            <div class="db-field">
                <label class="db-label">PDF uploaden <span class="db-hint">(max 10 MB)</span></label>
                <input type="file" name="av_pdf" class="db-input" accept=".pdf">
            </div>
            <div class="db-field">
                <label class="db-label">Of: tekst (HTML) als fallback</label>
                <textarea name="av_content" class="db-input db-textarea" rows="10">{{ $settings['av_content'] ?? '' }}</textarea>
            </div>
        </div>
    </form>
    </div>

    {{-- ═══════════════════════════════════════
         TAB 2 — STIJL
    ═══════════════════════════════════════ --}}
    <div class="db-panel" id="panel-stijl" style="display:none;">
    <form id="branding-form" method="POST" action="{{ route('admin.branding.update') }}" enctype="multipart/form-data">
        @csrf

        {{-- Template --}}
        <div class="db-section">
            <h2 class="db-section-title">Template & lay-out</h2>
            @php $currentTemplate = $settings['template'] ?? 'modern'; @endphp
            <div class="tp-picker">
                @foreach([
                    'snel'      => ['Snel (huidig)',    'Beige tint, sticky nav, zoekbalk'],
                    'modern'    => ['Modern',          'Donkere header, kaartgrid, CTA-balk'],
                    'minimal'   => ['Minimalistisch',  'Wit, editorial — nav rechts'],
                    'warm'      => ['Warm & Gezellig', 'Aardtinten, afgeronde hoeken'],
                    'corporate' => ['Zakelijk',        'Navy blauw, horizontale kaarten'],
                    'dark'      => ['Indigo / Nacht',  'Dark mode, tech-stijl'],
                    'retro'     => ['Retro',           'Vintage krant-stijl'],
                    'helder'    => ['Helder',          'Wit, sticky header, rode accenten'],
                ] as $tpl => [$label, $desc])
                <label class="tp-card {{ $currentTemplate === $tpl ? 'tp-selected' : '' }}">
                    <input type="radio" name="template" value="{{ $tpl }}" {{ $currentTemplate === $tpl ? 'checked' : '' }}>
                    <div class="tp-thumb tp-thumb--{{ $tpl }}">
                        <div class="tp-bar tp-bar--{{ $tpl }}"></div>
                        <div class="tp-body"></div>
                        <div class="tp-foot tp-foot--{{ $tpl }}"></div>
                    </div>
                    <div class="tp-info">
                        <strong>{{ $label }}</strong>
                        <span>{{ $desc }}</span>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        {{-- Algemeen --}}
        <div class="db-section">
            <h2 class="db-section-title">Algemeen</h2>
            <div class="db-field">
                <label class="db-label">Sitenaam <span class="db-hint">(browsertab)</span></label>
                <input type="text" name="site_name" class="db-input" value="{{ $settings['site_name'] ?? '' }}">
            </div>
            <div class="db-field">
                <label class="db-label">Meta beschrijving <span class="db-hint">(zoekmachines, max 160 tekens)</span></label>
                <input type="text" name="site_desc" class="db-input" value="{{ $settings['site_desc'] ?? '' }}">
            </div>
            <div class="db-field">
                <label class="db-label">Footer ondertekst <span class="db-hint">(volledige tekst, bijv. "© 2026 Mijn Bedrijf. Alle rechten voorbehouden.")</span></label>
                <input type="text" name="footer_bottom_text" class="db-input" value="{{ $settings['footer_bottom_text'] ?? '' }}" placeholder="© 2026 Mijn Bedrijf. Alle rechten voorbehouden.">
            </div>
            <div class="db-field">
                <label class="db-label">Favicon <span class="db-hint">(png/ico, 32×32px)</span></label>
                @php $fav = $settings['favicon'] ?? ''; @endphp
                @if($fav && file_exists(public_path(ltrim($fav,'/'))))
                    <img src="{{ $fav }}" style="width:32px;height:32px;margin-bottom:8px;border:1px solid #e5e7eb;border-radius:4px;padding:2px;display:block;">
                @endif
                <input type="file" name="favicon" class="db-input" accept="image/png,image/x-icon,image/svg+xml">
            </div>
        </div>

        {{-- Logo's & Afbeeldingen --}}
        <div class="db-section">
            <h2 class="db-section-title">Logo's &amp; Afbeeldingen</h2>

            @foreach([
                ['logo',         'Header logo',      $settings['logo'] ?? '',         'logo_existing'],
                ['footer_logo',  'Footer logo',      $settings['footer_logo'] ?? '',  'footer_logo_existing'],
                ['header_image', 'Header afbeelding',$settings['header_image'] ?? '', 'header_image_existing'],
            ] as [$field, $fieldLabel, $current, $hiddenName])
            <div class="db-field" style="{{ !$loop->first ? 'padding-top:24px;border-top:1px solid #e5e7eb;margin-top:24px;' : '' }}">
                <label class="db-label">{{ $fieldLabel }}</label>
                @if($current && file_exists(public_path(ltrim($current,'/'))))
                    <img src="{{ $current }}" style="max-width:200px;max-height:60px;display:block;margin-bottom:10px;border:1px solid #e5e7eb;border-radius:4px;padding:6px;background:#f9fafb;">
                @endif
                <p class="db-hint" style="margin-bottom:8px;">Kies uit bibliotheek:</p>
                <div class="img-lib" id="picker-{{ $field }}">
                    @foreach($images as $img)
                    <div class="img-lib__item {{ $current === $img ? 'img-lib__item--active' : '' }}"
                         onclick="pickImg('{{ $field }}','{{ $img }}',this)">
                        <img src="{{ $img }}" alt="{{ basename($img) }}">
                    </div>
                    @endforeach
                </div>
                <input type="hidden" name="{{ $hiddenName }}" id="{{ $hiddenName }}" value="">
                <label class="db-label" style="margin-top:12px;">Of uploaden:</label>
                <input type="file" name="{{ $field }}" class="db-input" accept="image/*">
            </div>
            @endforeach
        </div>

        {{-- Kleuren: Algemeen --}}
        <div class="db-section">
            <h2 class="db-section-title">Kleuren</h2>

            <p class="db-label" style="margin-bottom:14px;">Algemeen</p>
            <div class="db-colors-grid" style="margin-bottom:28px;">
                @foreach([
                    ['primary_color', 'Hoofdkleur',           $settings['colors']['primary']    ?? '#b8930a', 'primary_hex'],
                    ['accent_color',  'Accentkleur',          $settings['colors']['accent']     ?? '#b8930a', 'accent_hex'],
                    ['body_bg',       'Pagina achtergrond',   $settings['colors']['body_bg']    ?? '#ffffff', 'body_bg_hex'],
                    ['body_text',     'Pagina tekst',         $settings['colors']['body_text']  ?? '#1a1a1a', 'body_text_hex'],
                    ['card_bg',       'Kaart achtergrond',    $settings['colors']['card_bg']    ?? '#ffffff', 'card_bg_hex'],
                    ['header_bg',     'Header achtergrond',   $settings['colors']['header_bg']  ?? '#f5f0e8', 'header_bg_hex'],
                    ['header_text',   'Header tekst',         $settings['colors']['header_text']?? '#1a1a1a', 'header_text_hex'],
                    ['footer_bg',     'Footer achtergrond',   $settings['colors']['footer_bg']  ?? '#f5f0e8', 'footer_bg_hex'],
                    ['footer_text',   'Footer tekst',         $settings['colors']['footer_text'] ?? '#8b7355', 'footer_text_hex'],
                    ['hero_bg',       'Hero achtergrond',     $settings['colors']['hero_bg']     ?? '#1a1a1a', 'hero_bg_hex'],
                    ['hero_text',     'Hero titel',           $settings['colors']['hero_text']   ?? '#ffffff', 'hero_text_hex'],
                    ['hero_sub',      'Hero subtitel',        $settings['colors']['hero_sub']    ?? '#9ca3af', 'hero_sub_hex'],
                    ['topbar_bg',     'Topbalk achtergrond',  $settings['colors']['topbar_bg']    ?? '#0f0f0f', 'topbar_bg_hex'],
                    ['topbar_text',   'Topbalk tekst',        $settings['colors']['topbar_text']  ?? '#ffffff', 'topbar_text_hex'],
                    ['header_hover',  'Header hover',         $settings['colors']['header_hover'] ?? '#b8930a', 'header_hover_hex'],
                    ['muted',         'Subtiele tekst',       $settings['colors']['muted']        ?? '#b0a898', 'muted_hex'],
                    ['border',        'Rand kleur',           $settings['colors']['border']       ?? '#e8e2d8', 'border_hex'],
                    ['content_text',  'Inhoud tekst',         $settings['colors']['content_text'] ?? '#374151', 'content_text_hex'],
                ] as [$name, $clabel, $val, $hexId])
                <div class="db-color-item">
                    <span class="db-color-label">{{ $clabel }}</span>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <input type="color" name="{{ $name }}" value="{{ $val }}" class="db-color-input"
                               oninput="document.getElementById('{{ $hexId }}').textContent=this.value">
                        <span id="{{ $hexId }}" class="db-color-hex">{{ $val }}</span>
                    </div>
                </div>
                @endforeach
            </div>

            <div style="border-top:1px solid #e5e7eb;padding-top:22px;">
                <p class="db-label" style="margin-bottom:14px;">CTA-balk</p>
                <div class="db-colors-grid">
                    @foreach([
                        ['cta_bg',       'Achtergrond',  $settings['colors']['cta_bg']      ?? '#2d3142', 'cta_bg_hex'],
                        ['cta_text',     'Tekst',        $settings['colors']['cta_text']    ?? '#ffffff', 'cta_text_hex'],
                        ['cta_btn_bg',   'Knop',         $settings['colors']['cta_btn_bg']  ?? '#111111', 'cta_btn_bg_hex'],
                        ['cta_btn_text', 'Knop tekst',   $settings['colors']['cta_btn_text']?? '#ffffff', 'cta_btn_text_hex'],
                    ] as [$name, $clabel, $val, $hexId])
                    <div class="db-color-item">
                        <span class="db-color-label">{{ $clabel }}</span>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <input type="color" name="{{ $name }}" value="{{ $val }}" class="db-color-input"
                                   oninput="document.getElementById('{{ $hexId }}').textContent=this.value">
                            <span id="{{ $hexId }}" class="db-color-hex">{{ $val }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Lettertype --}}
        <div class="db-section">
            <h2 class="db-section-title">Lettertype</h2>
            @php
                $currentFamily = $settings['fonts']['family'] ?? 'Arial';
                $fontLabels = ['Arial'=>'Arial (standaard)','Inter'=>'Inter','Roboto'=>'Roboto','Poppins'=>'Poppins','Lato'=>'Lato','Open Sans'=>'Open Sans','Montserrat'=>'Montserrat'];
            @endphp
            <div class="db-field">
                <select name="font_family" id="font_family" class="db-input" style="max-width:320px;" onchange="previewFont(this.value)">
                    @foreach($fonts as $font)
                    <option value="{{ $font }}" {{ str_starts_with($currentFamily, $font) ? 'selected' : '' }}>{{ $fontLabels[$font] ?? $font }}</option>
                    @endforeach
                </select>
                <p class="db-font-preview" id="font-preview">De helderle bruine vos springt over de luie hond.</p>
            </div>
        </div>

    </form>
    </div>

    {{-- ═══════════════════════════════════════
         TAB 3 — TEKSTEN
    ═══════════════════════════════════════ --}}
    <div class="db-panel" id="panel-teksten" style="display:none;">
    <form id="content-form" method="POST" action="{{ route('admin.content.update') }}">
        @csrf

        @php
            $currentTemplate = $settings['template'] ?? 'modern';
            $slots = config('template_content.' . $currentTemplate)
                  ?? config('template_content.default');
            $sections = collect($slots)->groupBy('section');
        @endphp

        {{-- Automatisch gegenereerde velden vanuit config/template_content.php --}}
        @foreach($sections as $sectionName => $fields)
        <div class="db-section">
            <h2 class="db-section-title">{{ $sectionName }}</h2>
            @foreach($fields as $field)
            <div class="db-field">
                <label class="db-label">
                    {{ $field['label'] }}
                    @if(!empty($field['hint']))<span class="db-hint">({{ $field['hint'] }})</span>@endif
                    <span class="tc-tag">{{ strtoupper($field['tag']) }}</span>
                </label>
                @if($field['type'] === 'textarea')
                    <textarea name="{{ $field['key'] }}"
                              class="db-input db-textarea"
                              rows="3">{{ $content[$field['key']] ?? $field['default'] }}</textarea>
                @else
                    <input type="text"
                           name="{{ $field['key'] }}"
                           class="db-input"
                           @if($field['tag'] === 'span') style="max-width:280px" @endif
                           value="{{ $content[$field['key']] ?? $field['default'] }}">
                @endif
            </div>
            @endforeach
        </div>
        @endforeach

        {{-- FAQ (altijd aanwezig, eigen Quill-editor logica) --}}
        <div class="db-section">
            <h2 class="db-section-title">Over ons — FAQ</h2>
            <div class="db-field">
                <label class="db-label">Sectietitel <span class="tc-tag">H2</span></label>
                <input type="text" name="about_faq_title" class="db-input" value="{{ $content['about_faq_title'] ?? 'Veel gestelde vragen' }}">
            </div>
            <input type="hidden" name="about_faq_count" id="about_faq_count" value="{{ $content['about_faq_count'] ?? 3 }}">
            <div id="faq-container">
                @php $faqCount = (int)($content['about_faq_count'] ?? 3); @endphp
                @for($i = 1; $i <= $faqCount; $i++)
                <div class="db-faq-block">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                        <strong class="faq-label">Vraag {{ $i }}</strong>
                        <button type="button" onclick="removeFaqBlock(this)" class="db-btn-remove">Verwijderen</button>
                    </div>
                    <div class="db-field">
                        <label class="db-label">Vraag</label>
                        <input type="text" class="db-input faq-question" value="{{ $content['about_faq_'.$i.'_question'] ?? '' }}">
                    </div>
                    <div class="db-field">
                        <label class="db-label">Antwoord</label>
                        <div class="db-quill faq-quill-editor"></div>
                        <input type="hidden" class="faq-answer-hidden" value="{{ $content['about_faq_'.$i.'_answer'] ?? '' }}">
                    </div>
                </div>
                @endfor
            </div>
            <button type="button" onclick="addFaqBlock()" class="db-btn-outline" style="margin-top:8px;">+ Vraag toevoegen</button>
        </div>

    </form>
    </div>

    {{-- ═══════════════════════════════════════
         TAB 4 — IMPORT / EXPORT
    ═══════════════════════════════════════ --}}
    <div class="db-panel" id="panel-importexport" style="display:none;">

        {{-- Export --}}
        <div class="db-section">
            <h2 class="db-section-title">Exporteren</h2>
            <form method="POST" action="{{ route('admin.export') }}">
                @csrf
                <div style="margin-bottom:20px;">
                    <strong class="db-label">Bedrijven</strong>
                    <div style="display:flex;gap:8px;margin:8px 0 10px;">
                        <button type="button" class="db-btn-outline" style="padding:5px 12px;font-size:13px;" onclick="selectAll('bedrijf_ids')">Alles</button>
                        <button type="button" class="db-btn-outline" style="padding:5px 12px;font-size:13px;" onclick="deselectAll('bedrijf_ids')">Geen</button>
                    </div>
                    <div class="ei-grid">
                        @foreach($bedrijven as $b)
                        <div class="ei-item">
                            <input type="checkbox" name="bedrijf_ids[]" value="{{ $b->id }}" id="b_{{ $b->id }}" checked>
                            <label for="b_{{ $b->id }}">{{ $b->naam }}<small>{{ $b->plaats }} · {{ $b->categorieen->pluck('categorie')->implode(', ') ?: '—' }}</small></label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div style="margin-bottom:20px;">
                    <strong class="db-label">Categorieën</strong>
                    <div style="display:flex;gap:8px;margin:8px 0 10px;">
                        <button type="button" class="db-btn-outline" style="padding:5px 12px;font-size:13px;" onclick="selectAll('categorie_ids')">Alles</button>
                        <button type="button" class="db-btn-outline" style="padding:5px 12px;font-size:13px;" onclick="deselectAll('categorie_ids')">Geen</button>
                    </div>
                    <div class="ei-grid" style="grid-template-columns:repeat(auto-fill,minmax(180px,1fr));">
                        @foreach($categorieen as $cat)
                        <div class="ei-item">
                            <input type="checkbox" name="categorie_ids[]" value="{{ $cat->id }}" id="c_{{ $cat->id }}" checked>
                            <label for="c_{{ $cat->id }}">{{ $cat->categorie }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="db-btn-primary"><i class="fa-solid fa-download"></i> Exporteren als ZIP</button>
            </form>
        </div>

        {{-- Import --}}
        <div class="db-section">
            <h2 class="db-section-title">Importeren</h2>
            <p class="db-hint" style="margin-bottom:16px;">Upload een eerder geëxporteerd ZIP- of JSON-bestand. Nieuwe bedrijven worden toegevoegd.</p>
            <form method="POST" action="{{ route('admin.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="db-field">
                    <label class="db-label">ZIP of JSON bestand <span class="db-hint">(max 50 MB)</span></label>
                    <input type="file" name="import_file" class="db-input" accept=".zip,.json">
                </div>
                <button type="submit" class="db-btn-primary"><i class="fa-solid fa-upload"></i> Importeren</button>
            </form>
        </div>

        {{-- Verwijderen --}}
        <div class="db-section" style="border-color:#fca5a5;">
            <h2 class="db-section-title" style="color:#991b1b;">Gegevens verwijderen</h2>
            <p class="db-hint" style="margin-bottom:16px;">Kan <strong>niet</strong> ongedaan worden gemaakt.</p>
            <form method="POST" action="{{ route('admin.clear_bedrijven') }}" onsubmit="return bevestigVerwijder(this)">
                @csrf
                @method('DELETE')
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <button type="submit" name="what" value="bedrijven" class="db-btn-danger">
                        <i class="fa-solid fa-trash"></i> Alle bedrijven verwijderen
                    </button>
                    <button type="submit" name="what" value="alles" class="db-btn-danger" style="background:#7f1d1d;">
                        <i class="fa-solid fa-trash"></i> Bedrijven + categorieën verwijderen
                    </button>
                </div>
            </form>
        </div>

    </div>{{-- /panel-importexport --}}


    {{-- ═══ STICKY OPSLAAN BALK ═══ --}}
    <div class="db-savebar" id="savebar">
        <button type="button" class="db-btn-save" id="save-btn" onclick="saveAll()">
            <i class="fa-solid fa-floppy-disk"></i> Opslaan
        </button>
        <span class="db-hint" id="savebar-hint">Slaat Instellingen, Stijl en Teksten op.</span>
    </div>

</div>
</div>

{{-- ═══ CSS ═══ --}}
<style>
/* Layout */
.db-wrap  { display:flex; justify-content:center; padding:50px 20px 120px; }
.db-inner { width:100%; max-width:900px; }
.db-title { font-size:2rem; font-weight:700; margin-bottom:1.5rem; color:#111; }

/* Alert */
.db-alert { padding:14px 20px; border-radius:8px; margin-bottom:20px; font-weight:600; font-size:.95rem; }
.db-alert.ok  { background:#d1fae5; border:1px solid #34d399; color:#065f46; }
.db-alert.err { background:#fee2e2; border:1px solid #fca5a5; color:#991b1b; }

/* Tabs */
.db-tabs { display:flex; gap:2px; border-bottom:2px solid #e5e7eb; margin-bottom:28px; }
.db-tab  { background:none; border:none; padding:11px 20px; font-size:.92rem; font-weight:600; color:#888; cursor:pointer; border-bottom:2.5px solid transparent; margin-bottom:-2px; display:flex; align-items:center; gap:7px; transition:color .15s,border-color .15s; }
.db-tab:hover  { color:#444; }
.db-tab.active { color:#111; border-bottom-color:#111; }

/* Sections */
.db-section       { border:1px solid #e5e7eb; border-radius:8px; padding:26px; margin-bottom:22px; background:#fff; }
.db-section-title { font-size:1.05rem; font-weight:700; margin:0 0 18px; color:#111; }
.db-row           { display:flex; gap:14px; }
.db-row .db-field { flex:1; }
.db-row .db-field--sm { flex:0 0 130px; }
.db-field  { margin-bottom:18px; }
.db-label  { display:block; font-weight:600; margin-bottom:7px; color:#333; font-size:.88rem; }
.db-hint   { color:#888; font-size:.83rem; font-weight:400; }
.tc-tag    { display:inline-block; margin-left:6px; padding:1px 6px; background:#f3f4f6; border:1px solid #e5e7eb; border-radius:4px; font-size:.72rem; font-weight:700; color:#6b7280; letter-spacing:.04em; vertical-align:middle; }
.db-input  { width:100%; padding:9px 13px; border:1px solid #d1d5db; border-radius:6px; font-size:.93rem; outline:none; box-sizing:border-box; background:#fff; }
.db-input:focus { border-color:#111; }
.db-textarea { resize:vertical; font-family:'Courier New',monospace; font-size:.83rem; line-height:1.6; }
.db-pw-wrap { position:relative; }
.db-pw-wrap .db-input { padding-right:42px; }
.db-pw-toggle { position:absolute; right:10px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#888; font-size:14px; }
.db-pw-toggle:hover { color:#111; }
.db-pdf-bar { display:flex; align-items:center; gap:12px; background:#fef9f0; border:1px solid #fde68a; border-radius:6px; padding:10px 14px; margin-bottom:12px; font-size:.9rem; }
.db-pdf-bar a { color:#111; text-decoration:underline; }

/* Template picker */
.tp-picker  { display:grid; grid-template-columns:repeat(auto-fill,minmax(115px,1fr)); gap:12px; }
.tp-card    { cursor:pointer; border:2px solid #e5e7eb; border-radius:8px; overflow:hidden; transition:border-color .15s,box-shadow .15s; display:flex; flex-direction:column; }
.tp-card input { display:none; }
.tp-card:hover  { border-color:#aaa; }
.tp-selected    { border-color:#111; box-shadow:0 0 0 3px rgba(0,0,0,.07); }
.tp-thumb   { height:70px; display:flex; flex-direction:column; overflow:hidden; }
.tp-bar     { height:12px; background:#2d3142; }
.tp-bar--snel      { background:#0f0f0f; }
.tp-thumb--snel .tp-body { background:#f5f0e8; }
.tp-foot--snel     { background:#1a1a1a; }
.tp-bar--minimal   { background:#fff; border-bottom:1px solid #eee; }
.tp-bar--warm      { background:#f5ede0; border-bottom:1px solid #e8d9c6; }
.tp-bar--corporate { background:#0f2341; }
.tp-bar--dark      { background:#0c0f22; }
.tp-bar--retro     { background:#2d1f0a; border-bottom:2px solid #8b6914; }
.tp-bar--helder      { background:#ffffff; border-bottom:2px solid #e00000; }
.tp-thumb--helder .tp-body { position:relative; }
.tp-thumb--helder .tp-body::before { content:''; position:absolute; left:0; top:0; bottom:0; width:4px; background:#e00000; }
.tp-body    { flex:1; background:#f5f5f5; }
.tp-thumb--minimal .tp-body   { background:#fafafa; }
.tp-thumb--warm .tp-body      { background:#faf8f4; }
.tp-thumb--corporate .tp-body { background:#dde4ed; }
.tp-thumb--dark .tp-body      { background:#0d1117; }
.tp-thumb--retro .tp-body     { background:#fffbf0; }
.tp-thumb--helder .tp-body      { background:#f9fafb; }
.tp-foot    { height:10px; background:#2d3142; }
.tp-foot--minimal   { background:#fff; border-top:1px solid #eee; }
.tp-foot--warm      { background:#2c1f14; }
.tp-foot--corporate { background:#091729; }
.tp-foot--dark      { background:#010409; }
.tp-foot--retro     { background:#1a1106; }
.tp-foot--helder      { background:#1f2937; border-top:2px solid #e00000; }
.tp-info    { padding:8px 10px; background:#fff; border-top:1px solid #e5e7eb; }
.tp-info strong { display:block; font-size:.82rem; color:#111; margin-bottom:1px; }
.tp-info span   { font-size:.73rem; color:#888; line-height:1.3; display:block; }

/* Image library */
.img-lib { display:flex; flex-wrap:wrap; gap:8px; max-height:220px; overflow-y:auto; border:1px solid #e5e7eb; border-radius:6px; padding:10px; background:#fafafa; margin-bottom:10px; }
.img-lib__item { width:80px; height:60px; border:2px solid #e5e7eb; border-radius:5px; overflow:hidden; cursor:pointer; transition:border-color .12s; flex-shrink:0; }
.img-lib__item:hover { border-color:#999; }
.img-lib__item--active { border-color:#111; box-shadow:0 0 0 2px #111; }
.img-lib__item img { width:100%; height:100%; object-fit:cover; display:block; }

/* Kleuren */
.db-colors-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:16px; }
.db-color-item  { display:flex; flex-direction:column; gap:6px; }
.db-color-label { font-size:.85rem; font-weight:600; color:#333; }
.db-color-input { width:48px; height:48px; border:none; border-radius:6px; cursor:pointer; padding:2px; background:none; }
.db-color-hex   { font-family:monospace; font-size:.9rem; color:#333; background:#f3f4f6; padding:5px 10px; border-radius:4px; }
.db-font-preview { margin-top:12px; font-size:1.05rem; color:#444; border-left:3px solid #e5e7eb; padding-left:12px; transition:font-family .2s; }

/* Quill */
.db-quill { border:1px solid #d1d5db; border-radius:0 0 6px 6px; min-height:100px; background:#fff; }
.db-quill .ql-toolbar { border-radius:6px 6px 0 0; border-color:#d1d5db; }
.db-quill .ql-container { border-color:#d1d5db; font-size:.93rem; }

/* FAQ */
.db-faq-block  { background:#f9fafb; border-radius:6px; padding:14px; margin-bottom:14px; }
.db-btn-remove { padding:3px 10px; background:#fee2e2; color:#b91c1c; border:1px solid #fca5a5; border-radius:4px; font-size:.8rem; cursor:pointer; }
.db-btn-remove:hover { background:#fecaca; }

/* Export/Import grid */
.ei-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:8px; max-height:300px; overflow-y:auto; border:1px solid #e5e7eb; border-radius:6px; padding:10px; background:#fafafa; }
.ei-item { display:flex; align-items:center; gap:8px; background:#fff; border:1px solid #e5e7eb; border-radius:5px; padding:7px 10px; font-size:13px; }
.ei-item input { width:15px; height:15px; accent-color:#e00000; flex-shrink:0; }
.ei-item label { cursor:pointer; line-height:1.3; }
.ei-item label small { display:block; color:#9ca3af; font-size:11px; }

/* Buttons */
.db-btn-outline  { padding:9px 18px; background:#fff; color:#111; border:1.5px solid #d1d5db; border-radius:6px; font-size:.88rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:7px; transition:background .15s,border-color .15s; }
.db-btn-outline:hover { background:#f5f5f5; border-color:#111; }
.db-btn-primary  { padding:9px 20px; background:#111; color:#fff; border:none; border-radius:6px; font-size:.9rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:7px; transition:background .15s; }
.db-btn-primary:hover { background:#333; }
.db-btn-danger   { padding:9px 18px; background:#dc2626; color:#fff; border:none; border-radius:6px; font-size:.88rem; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:7px; }
.db-btn-danger:hover { background:#b91c1c; }
.db-btn-save     { padding:12px 34px; background:#111; color:#fff; border:none; border-radius:6px; font-size:.97rem; font-weight:700; cursor:pointer; display:inline-flex; align-items:center; gap:8px; transition:background .15s; }
.db-btn-save:hover    { background:#333; }
.db-btn-save:disabled { background:#777; cursor:not-allowed; }

/* Savebar */
.db-savebar { position:sticky; bottom:0; background:#fff; border-top:1px solid #e5e7eb; padding:14px 0; display:flex; align-items:center; gap:16px; z-index:20; }

/* Mail method cards */
.mail-method-card { flex:1 1 200px; border:2px solid #e5e7eb; border-radius:8px; padding:14px 16px; cursor:pointer; display:flex; flex-direction:column; gap:4px; transition:border-color .15s,background .15s; }
.mail-method-card input { display:none; }
.mail-method-card strong { font-size:.9rem; color:#111; display:flex; align-items:center; gap:7px; }
.mail-method-card span { font-size:.8rem; color:#888; }
.mail-method-card:hover { border-color:#aaa; }
.mail-method-active { border-color:#111; background:#fafafa; box-shadow:0 0 0 3px rgba(0,0,0,.06); }
</style>

{{-- ═══ JS ═══ --}}
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
// ── Tabs ─────────────────────────────────────────────────
const SAVEABLE = ['instellingen','stijl','teksten'];

function switchTab(name) {
    document.querySelectorAll('.db-panel').forEach(p => p.style.display = 'none');
    document.querySelectorAll('.db-tab').forEach(b => b.classList.remove('active'));
    document.getElementById('panel-' + name).style.display = '';
    document.getElementById('tab-btn-' + name).classList.add('active');
    localStorage.setItem('admin_tab', name);

    // Quill initialiseren bij eerste open
    if (name === 'teksten' && !quillReady) initQuill();

    // Savebar hint aanpassen voor import/export tab
    document.getElementById('savebar').style.display = name === 'importexport' ? 'none' : '';
}

// Herstel tab na reload
(function() {
    const t = localStorage.getItem('admin_tab');
    if (t && document.getElementById('panel-' + t)) switchTab(t);
    else switchTab('instellingen');
})();

// ── Mail methode toggle ───────────────────────────────────
function toggleMailMethod(val) {
    document.getElementById('smtp-fields').style.display = val === 'smtp' ? '' : 'none';
    document.getElementById('card-phpmail').classList.toggle('mail-method-active', val === 'phpmail');
    document.getElementById('card-smtp').classList.toggle('mail-method-active', val === 'smtp');
}

// ── Wachtwoord toggle ─────────────────────────────────────
function togglePw() {
    const i = document.getElementById('mail_password');
    const ic = document.getElementById('pw-icon');
    i.type = i.type === 'password' ? 'text' : 'password';
    ic.classList.toggle('fa-eye'); ic.classList.toggle('fa-eye-slash');
}

// ── Template picker ───────────────────────────────────────
document.querySelectorAll('.tp-card input[type=radio]').forEach(r => {
    r.addEventListener('change', function() {
        document.querySelectorAll('.tp-card').forEach(c => c.classList.remove('tp-selected'));
        this.closest('.tp-card').classList.add('tp-selected');
    });
});

// ── Image picker ──────────────────────────────────────────
function pickImg(field, path, el) {
    document.querySelectorAll('#picker-' + field + ' .img-lib__item').forEach(i => i.classList.remove('img-lib__item--active'));
    el.classList.add('img-lib__item--active');
    document.getElementById(field + '_existing').value = path;
}

// ── Font preview ──────────────────────────────────────────
const gFonts = {
    'Inter':      'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap',
    'Roboto':     'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap',
    'Poppins':    'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap',
    'Lato':       'https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap',
    'Open Sans':  'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap',
    'Montserrat': 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap',
};
function previewFont(name) {
    const prev = document.getElementById('font-preview');
    if (gFonts[name]) {
        if (!document.querySelector(`link[href="${gFonts[name]}"]`)) {
            const l = document.createElement('link'); l.rel='stylesheet'; l.href=gFonts[name]; document.head.appendChild(l);
        }
        prev.style.fontFamily = `'${name}', sans-serif`;
    } else { prev.style.fontFamily = 'Arial,sans-serif'; }
}
// Init font preview
const fontSel = document.getElementById('font_family');
if (fontSel) previewFont(fontSel.value);

// ── Quill (lazy init bij Teksten tab) ────────────────────
const toolbarOpts = [['bold','italic','underline'],[{'list':'ordered'},{'list':'bullet'}],['link'],['clean']];
let quillReady = false;
const faqEditors = new Map();

function initQuill() {
    document.querySelectorAll('.ca-faq-block, .db-faq-block').forEach(initFaqQuill);
    quillReady = true;
}

function initFaqQuill(block) {
    const el = block.querySelector('.faq-quill-editor');
    const h  = block.querySelector('.faq-answer-hidden');
    const q  = new Quill(el, { theme:'snow', modules:{ toolbar: toolbarOpts } });
    if (h && h.value) q.clipboard.dangerouslyPasteHTML(h.value);
    faqEditors.set(block, q);
}

function addFaqBlock() {
    const c = document.getElementById('faq-container');
    const n = c.querySelectorAll('.db-faq-block').length + 1;
    const b = document.createElement('div'); b.className = 'db-faq-block';
    b.innerHTML = `<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
        <strong class="faq-label">Vraag ${n}</strong>
        <button type="button" onclick="removeFaqBlock(this)" class="db-btn-remove">Verwijderen</button></div>
        <div class="db-field"><label class="db-label">Vraag</label><input type="text" class="db-input faq-question" value=""></div>
        <div class="db-field"><label class="db-label">Antwoord</label><div class="db-quill faq-quill-editor"></div><input type="hidden" class="faq-answer-hidden" value=""></div>`;
    c.appendChild(b); initFaqQuill(b); renumberFaq();
}
function removeFaqBlock(btn) { const b = btn.closest('.db-faq-block'); faqEditors.delete(b); b.remove(); renumberFaq(); }
function renumberFaq() { document.querySelectorAll('.db-faq-block').forEach((b,i) => b.querySelector('.faq-label').textContent = 'Vraag '+(i+1)); }

function serializeContent() {
    const blocks = document.querySelectorAll('.db-faq-block');
    document.getElementById('about_faq_count').value = blocks.length;
    blocks.forEach(function(b, i) {
        const q = faqEditors.get(b); const html = q ? q.root.innerHTML : '';
        b.querySelector('.faq-question').name = 'about_faq_'+(i+1)+'_question';
        const ah = b.querySelector('.faq-answer-hidden');
        ah.name = 'about_faq_'+(i+1)+'_answer';
        ah.value = html === '<p><br></p>' ? '' : html;
    });
}

// ── Save all ──────────────────────────────────────────────
function fetchWithTimeout(url, options, ms = 15000) {
    const ctrl = new AbortController();
    const id = setTimeout(() => ctrl.abort(), ms);
    return fetch(url, { ...options, signal: ctrl.signal })
        .finally(() => clearTimeout(id));
}

async function saveAll() {
    const btn = document.getElementById('save-btn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Opslaan...';
    document.getElementById('save-alert').style.display = 'none';

    try { if (quillReady) serializeContent(); } catch(e) {}

    const headers = { 'X-Requested-With': 'XMLHttpRequest' };

    try {
        const r1 = await fetchWithTimeout('{{ route("admin.settings.update") }}', { method:'POST', body: new FormData(document.getElementById('settings-form')), headers });
        const j1 = await r1.json().catch(() => ({ success: false, message: 'Ongeldige respons (instellingen)' }));

        const r2 = await fetchWithTimeout('{{ route("admin.branding.update") }}', { method:'POST', body: new FormData(document.getElementById('branding-form')), headers });
        const j2 = await r2.json().catch(() => ({ success: false, message: 'Ongeldige respons (stijl)' }));

        const r3 = await fetchWithTimeout('{{ route("admin.content.update") }}', { method:'POST', body: new FormData(document.getElementById('content-form')), headers });
        const j3 = await r3.json().catch(() => ({ success: false, message: 'Ongeldige respons (teksten)' }));

        if (j1.success && j2.success && j3.success) {
            showAlert('Alles opgeslagen!', 'ok');
        } else {
            const msgs = [j1, j2, j3].filter(j => !j.success).map(j => j.message).join(' ');
            showAlert('Fout: ' + msgs, 'err');
        }
    } catch(e) {
        showAlert(e.name === 'AbortError' ? 'Time-out — server reageert niet. Probeer opnieuw.' : 'Verbindingsfout — probeer opnieuw.', 'err');
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Opslaan';
    }
}

function showAlert(msg, type) {
    const el = document.getElementById('save-alert');
    el.textContent = msg; el.className = 'db-alert ' + type; el.style.display = '';
    window.scrollTo({ top:0, behavior:'smooth' });
}

// ── Testmail ──────────────────────────────────────────────
async function sendTestMail() {
    try {
        const r = await fetch('{{ route("admin.settings.test_mail") }}', {
            method: 'POST',
            body: new URLSearchParams({ _token: document.querySelector('#settings-form [name=_token]').value }),
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const j = await r.json();
        showAlert(j.message, j.success ? 'ok' : 'err');
    } catch(e) { showAlert('Verbindingsfout bij testmail.', 'err'); }
}


// ── Export/Import helpers ────────────────────────────────
function selectAll(name)   { document.querySelectorAll('input[name="'+name+'[]"]').forEach(c=>c.checked=true); }
function deselectAll(name) { document.querySelectorAll('input[name="'+name+'[]"]').forEach(c=>c.checked=false); }
function bevestigVerwijder(form) {
    const v = form.querySelector('[name="what"]:focus')?.value;
    const msg = v === 'alles'
        ? 'Weet je zeker dat je ALLE bedrijven én categorieën wilt verwijderen?'
        : 'Weet je zeker dat je alle bedrijven wilt verwijderen?';
    adminConfirm(msg, function() { form.submit(); });
    return false;
}
</script>

</x-base-layout>
