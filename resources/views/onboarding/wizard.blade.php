<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom — Website inrichten</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 40px 24px;
        }
        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 44px;
            width: 100%;
            max-width: 620px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
        }
        h1 { font-size: 1.5rem; font-weight: 700; margin: 0 0 4px; color: #111; }
        p.sub { font-size: 0.9rem; color: #888; margin: 0 0 28px; }

        .steps { display: flex; gap: 8px; margin-bottom: 32px; }
        .steps span { flex: 1; height: 4px; border-radius: 2px; background: #e5e7eb; transition: background .2s; }
        .steps span.done { background: #111; }

        .step { display: none; }
        .step.active { display: block; }
        .step h2 { font-size: 1.15rem; font-weight: 700; margin: 0 0 6px; color: #111; }
        .step p.hint { font-size: .85rem; color: #888; margin: 0 0 22px; }

        label { display: block; font-size: 0.85rem; font-weight: 600; color: #333; margin-bottom: 6px; }
        .hint-inline { color: #888; font-weight: 400; font-size: .8rem; }
        input[type=text], input[type=email], input[type=tel], input[type=file] {
            width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 6px;
            font-size: 0.95rem; outline: none; margin-bottom: 18px; background: #fff;
        }
        input:focus { border-color: #111; }
        .error { color: #dc2626; font-size: 0.8rem; margin: -12px 0 14px; }

        .colors-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 8px; }
        .color-item { display: flex; flex-direction: column; gap: 6px; }
        .color-item .row { display: flex; align-items: center; gap: 10px; }
        .color-input { width: 44px; height: 44px; border: none; border-radius: 6px; cursor: pointer; padding: 2px; background: none; }
        .color-hex { font-family: monospace; font-size: .85rem; color: #333; background: #f3f4f6; padding: 5px 10px; border-radius: 4px; }

        .img-current { max-width: 180px; max-height: 60px; display: block; margin-bottom: 10px; border: 1px solid #e5e7eb; border-radius: 4px; padding: 6px; background: #f9fafb; }

        .summary { background: #f9fafb; border-radius: 8px; padding: 18px 20px; font-size: .9rem; color: #444; line-height: 1.7; }
        .summary strong { color: #111; }

        .nav { display: flex; justify-content: space-between; align-items: center; margin-top: 30px; }
        button { font-family: inherit; cursor: pointer; border: none; border-radius: 6px; font-weight: 600; }
        .btn-primary { padding: 12px 28px; background: #111; color: #fff; font-size: 0.97rem; }
        .btn-primary:hover { background: #333; }
        .btn-primary:disabled { background: #999; cursor: not-allowed; }
        .btn-ghost { padding: 12px 20px; background: none; color: #666; font-size: 0.9rem; }
        .btn-ghost:hover { color: #111; }
        .btn-ghost:disabled { visibility: hidden; }

        .status { font-size: .85rem; margin-top: 14px; }
        .status.err { color: #dc2626; }
        .status.ok  { color: #059669; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Welkom! Laten we je website inrichten</h1>
        <p class="sub">Dit scherm zie je eenmalig, bij het allereerste gebruik van de admin-omgeving.</p>

        <div class="steps">
            <span class="s-dot done" data-step="1"></span>
            <span class="s-dot" data-step="2"></span>
            <span class="s-dot" data-step="3"></span>
            <span class="s-dot" data-step="4"></span>
        </div>

        <div id="wizard-status" class="status err" style="display:none;"></div>

        <form id="settings-form">
            @csrf
            {{-- Template ongewijzigd laten: dit veld staat niet in de wizard-UI --}}
            <input type="hidden" name="template" value="{{ $settings['template'] ?? config('branding.template') }}">
            <div class="step active" data-step="1">
                <h2>Basisgegevens</h2>
                <p class="hint">Deze gegevens verschijnen in de topbalk, contactpagina en footer.</p>

                <label>Sitenaam</label>
                <input type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}" placeholder="Mijn Bedrijvengids">

                <label>Ontvangst e-mailadres <span class="hint-inline">(verplicht)</span></label>
                <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}" placeholder="info@voorbeeld.nl" required>

                <label>Telefoonnummer <span class="hint-inline">(topbalk, optioneel)</span></label>
                <input type="tel" name="site_phone" value="{{ $settings['site_phone'] ?? '' }}" placeholder="06 000 000 00">
            </div>

            <div class="step" data-step="2">
                <h2>Kleuren</h2>
                <p class="hint">De hoofdkleuren van je website. De rest kun je later verfijnen bij Instellingen &rarr; Stijl.</p>
                <div class="colors-grid">
                    @foreach([
                        ['primary_color', 'Hoofdkleur',         $settings['colors']['primary']    ?? ''],
                        ['accent_color',  'Accentkleur',        $settings['colors']['accent']     ?? ''],
                        ['header_bg',     'Header achtergrond', $settings['colors']['header_bg']  ?? ''],
                        ['footer_bg',     'Footer achtergrond', $settings['colors']['footer_bg']  ?? ''],
                        ['body_bg',       'Pagina achtergrond', $settings['colors']['body_bg']    ?? ''],
                        ['body_text',     'Pagina tekst',       $settings['colors']['body_text']  ?? ''],
                    ] as [$name, $label, $val])
                    <div class="color-item">
                        <span>{{ $label }}</span>
                        <div class="row">
                            <input type="color" name="{{ $name }}" value="{{ $val ?: '#000000' }}" class="color-input"
                                   oninput="this.nextElementSibling.textContent=this.value">
                            <span class="color-hex">{{ $val ?: 'nog niet gekozen' }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="step" data-step="3">
                <h2>Logo</h2>
                <p class="hint">Upload je logo. Favicon en overige afbeeldingen stel je later in bij Instellingen &rarr; Stijl.</p>
                @php $curLogo = $settings['logo'] ?? ''; @endphp
                @if($curLogo && file_exists(public_path(ltrim($curLogo,'/'))))
                    <img src="{{ $curLogo }}" class="img-current">
                @endif
                <label>Logo uploaden</label>
                <input type="file" name="logo" accept="image/*">
            </div>

            <div class="step" data-step="4">
                <h2>Klaar!</h2>
                <p class="hint">Klik op "Voltooien" om je site in te richten. Je kunt alles later nog aanpassen bij Instellingen.</p>
                <div class="summary">
                    Zodra je op <strong>Voltooien</strong> klikt, worden je gegevens opgeslagen en kom je in het admin-dashboard.
                    Dit inrichtingsscherm verschijnt daarna niet meer opnieuw.
                </div>
            </div>
        </form>

        <div class="nav">
            <button type="button" class="btn-ghost" id="btn-prev" onclick="prevStep()">&larr; Vorige</button>
            <button type="button" class="btn-primary" id="btn-next" onclick="nextStep()">Volgende &rarr;</button>
        </div>
    </div>

<script>
let current = 1;
const TOTAL = 4;

function showStep(n) {
    document.querySelectorAll('.step').forEach(s => s.classList.toggle('active', +s.dataset.step === n));
    document.querySelectorAll('.s-dot').forEach(d => d.classList.toggle('done', +d.dataset.step <= n));
    document.getElementById('btn-prev').disabled = n === 1;
    document.getElementById('btn-next').innerHTML = n === TOTAL ? 'Voltooien' : 'Volgende &rarr;';
    hideStatus();
}

function prevStep() {
    if (current > 1) { current--; showStep(current); }
}

function nextStep() {
    if (current === 1) {
        const email = document.querySelector('[name=contact_email]');
        if (!email.value || !email.checkValidity()) {
            showStatus('Vul een geldig e-mailadres in om verder te gaan.');
            email.focus();
            return;
        }
    }
    if (current < TOTAL) {
        current++;
        showStep(current);
        return;
    }
    finish();
}

function showStatus(msg, ok = false) {
    const el = document.getElementById('wizard-status');
    el.textContent = msg;
    el.className = 'status ' + (ok ? 'ok' : 'err');
    el.style.display = '';
}
function hideStatus() {
    document.getElementById('wizard-status').style.display = 'none';
}

async function finish() {
    const btn = document.getElementById('btn-next');
    btn.disabled = true;
    btn.textContent = 'Bezig...';

    const headers = { 'X-Requested-With': 'XMLHttpRequest' };
    const form = document.getElementById('settings-form');

    try {
        const r1 = await fetch('{{ route("admin.settings.update") }}', { method: 'POST', body: new FormData(form), headers });
        const j1 = await r1.json().catch(() => ({ success: false, message: 'Instellingen opslaan mislukt.' }));

        const r2 = await fetch('{{ route("admin.branding.update") }}', { method: 'POST', body: new FormData(form), headers });
        const j2 = await r2.json().catch(() => ({ success: false, message: 'Stijl opslaan mislukt.' }));

        if (!j1.success || !j2.success) {
            showStatus([j1, j2].filter(j => !j.success).map(j => j.message).join(' '));
            btn.disabled = false; btn.textContent = 'Voltooien';
            return;
        }

        const r3 = await fetch('{{ route("onboarding.complete") }}', {
            method: 'POST',
            headers: { ...headers, 'Content-Type': 'application/json' },
            body: JSON.stringify({ _token: form.querySelector('[name=_token]').value }),
        });
        const j3 = await r3.json().catch(() => ({ success: false }));

        if (j3.success) {
            window.location.href = j3.redirect || '/admin';
        } else {
            showStatus('Voltooien is niet gelukt. Probeer opnieuw.');
            btn.disabled = false; btn.textContent = 'Voltooien';
        }
    } catch (e) {
        showStatus('Verbindingsfout — probeer opnieuw.');
        btn.disabled = false; btn.textContent = 'Voltooien';
    }
}

showStep(current);
</script>
</body>
</html>
