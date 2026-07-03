<x-base-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<style>
.app-wrap{max-width:960px;margin:0 auto;padding:24px 20px;color:#111827}
.app-wrap .card{display:block;overflow:visible;padding:22px 24px;flex:none}
.app-wrap .card p,.app-wrap .card h3{padding:0;color:inherit}

.back-bar{margin-bottom:16px}
.back-bar a{color:var(--color-primary);text-decoration:none;font-size:13px;font-weight:600}
.back-bar a:hover{text-decoration:underline}

.step-bar{background:#1a1a2e;color:#fff;padding:18px 28px;border-radius:10px;margin-bottom:22px;display:flex;align-items:center;gap:18px}
.step-bar h2{font-size:18px;font-weight:700;color:#fff}
.step-bar p{font-size:13px;opacity:.6;margin-top:2px;color:#fff}
.steps-ind{display:flex;align-items:center;gap:8px;flex-shrink:0}
.snum{width:34px;height:34px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;flex-shrink:0}
.snum.active{background:var(--color-primary);color:#fff}
.snum.done{background:#22c55e;color:#fff}
.snum.pending{background:rgba(255,255,255,.15);color:rgba(255,255,255,.4)}
.sline{width:28px;height:2px;background:rgba(255,255,255,.2)}

.card{background:#fff;border-radius:8px;padding:22px 24px;margin-bottom:18px;box-shadow:0 1px 4px rgba(0,0,0,.06),0 4px 12px rgba(0,0,0,.04)}
.card-title{font-size:14px;font-weight:700;color:#0f172a;margin-bottom:18px;padding-bottom:12px;border-bottom:2px solid var(--color-primary);display:flex;align-items:center;gap:8px}

.fgrid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.fg{display:flex;flex-direction:column;gap:5px}
.fg.s2{grid-column:1/-1}
label{font-size:12px;font-weight:600;color:#475569}
input[type=text],input[type=number],input[type=email],input[type=tel],input[type=date],select,textarea{
  padding:9px 13px;border:1.5px solid #e2e8f0;border-radius:6px;font-size:13.5px;
  font-family:inherit;color:#1e293b;background:#fafafa;outline:none;transition:border-color .15s,box-shadow .15s}
input:focus,select:focus,textarea:focus{border-color:var(--color-primary);box-shadow:0 0 0 3px color-mix(in srgb,var(--color-primary) 12%,transparent);background:#fff}
textarea{resize:vertical;min-height:70px;line-height:1.5}

.logo-picker{display:grid;grid-template-columns:repeat(5,1fr);gap:10px}
.logo-card{border:2.5px solid #e2e8f0;border-radius:8px;padding:14px 8px;cursor:pointer;
  display:flex;flex-direction:column;align-items:center;gap:8px;transition:all .2s;background:#fafafa}
.logo-card:hover{border-color:var(--color-primary);background:color-mix(in srgb,var(--color-primary) 6%,white)}
.logo-card.sel{border-color:var(--color-primary);background:color-mix(in srgb,var(--color-primary) 8%,white);box-shadow:0 0 0 3px color-mix(in srgb,var(--color-primary) 15%,transparent)}
.logo-card svg{width:64px;height:64px}
.logo-card img{width:64px;height:64px;object-fit:contain}
.logo-card span{font-size:11px;font-weight:600;color:#64748b}

.cat-list{display:flex;flex-direction:column;gap:6px;margin-bottom:8px}
.cat-row{display:flex;gap:6px;align-items:center}
.cat-row input{flex:1}
.btn-rm-cat{background:none;border:none;color:#dc2626;font-size:20px;cursor:pointer;padding:2px 8px;border-radius:4px;line-height:1;flex-shrink:0}
.btn-rm-cat:hover{background:#fef2f2}
.btn-add-cat{background:none;border:2px dashed var(--color-primary);color:var(--color-primary);padding:8px 16px;
  border-radius:6px;font-size:13px;font-weight:600;cursor:pointer;transition:background .2s;width:100%;font-family:inherit}
.btn-add-cat:hover{background:color-mix(in srgb,var(--color-primary) 6%,white)}

.btn-p{background:var(--color-primary);color:#fff;border:none;padding:13px 30px;border-radius:6px;
  font-size:14px;font-weight:700;cursor:pointer;transition:all .2s;font-family:inherit}
.btn-p:hover{background:var(--color-primary-hover);transform:translateY(-1px)}
.btn-s{background:#fff;color:#374151;border:2px solid #e2e8f0;padding:11px 28px;border-radius:6px;
  font-size:14px;font-weight:700;cursor:pointer;transition:all .2s;font-family:inherit}
.btn-s:hover{border-color:#374151}
.btn-gr{background:#16a34a;color:#fff;border:none;padding:13px 30px;border-radius:6px;
  font-size:14px;font-weight:700;cursor:pointer;transition:all .2s;font-family:inherit}
.btn-gr:hover{background:#15803d}
.btn-gr:disabled{background:#86efac;cursor:not-allowed;transform:none}
.f-actions{display:flex;justify-content:flex-end;gap:10px}
.inv-actions{display:flex;gap:10px;margin-bottom:20px;flex-wrap:wrap}

/* ===== BEVESTIGING DOCUMENT ===== */
.inv-wrap{width:794px;margin:0 auto}
.bev-doc{
  background:#fff;
  width:794px;
  min-height:1123px;
  display:flex;
  flex-direction:column;
  box-shadow:0 6px 24px rgba(0,0,0,.12);
  font-family:'Georgia',serif;
}

.bev-content{flex:1;padding:44px 52px 24px}
.bev-header{display:flex;align-items:flex-start;margin-bottom:28px}
.bev-logo-area svg{width:180px;height:180px}
.bev-logo-area img{max-width:300px;width:auto;max-height:110px;height:auto;object-fit:contain}
.bev-mid{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:28px}
.bev-client-addr{font-size:12.5px;line-height:1.8;color:#222;font-family:Arial,sans-serif}
.bev-client-addr .cn{font-weight:700}
.bev-title-block{text-align:right;padding-top:10px}
.bev-title{font-size:26px;font-weight:700;color:#1a1a2e;letter-spacing:2px;font-family:Arial,sans-serif}
.bev-letter{font-family:Arial,sans-serif}
.bev-greeting{font-size:13px;margin-bottom:10px;color:#222}
.bev-intro{font-size:12.5px;line-height:1.65;color:#222;margin-bottom:18px}
.bev-dtbl{width:100%;border-collapse:collapse;margin-bottom:24px}
.bev-dtbl td{padding:2px 0;font-size:12.5px;color:#222;vertical-align:top}
.bev-dtbl td:first-child{width:42%;font-weight:400;padding-right:12px;color:#333}
.bev-closing-block{padding:20px 52px 24px;font-family:Arial,sans-serif}
.bev-confirm{font-size:12px;line-height:1.7;color:#333;margin-bottom:16px}
.bev-closing{font-size:12.5px;color:#222;margin-bottom:6px}
.bev-signer{font-size:12.5px;color:#222;font-weight:600;margin-top:24px}
.bev-footer-info{border-top:1.5px solid #e2e8f0;display:flex;padding:16px 52px 20px;gap:20px;background:#fff}
.bev-fi-block{flex:1;font-family:Arial,sans-serif;font-size:10.5px;line-height:1.75;color:#444}
.bev-fi-name{font-weight:700;color:#1a1a2e;font-size:11px;margin-bottom:2px}

.ot-toast{position:fixed;bottom:24px;right:24px;background:#1a1a2e;color:#fff;padding:14px 20px;border-radius:8px;font-size:13px;font-weight:600;box-shadow:0 4px 20px rgba(0,0,0,.25);z-index:9998;transform:translateY(80px);opacity:0;transition:all .3s}
.ot-toast.show{transform:translateY(0);opacity:1}
.ot-toast.err{background:#b91c1c}

@media print{
  body{background:#fff!important}
  .site-header,.site-footer,#step1,.step-bar,.inv-actions,.back-bar{display:none!important}
  .app-wrap,.main,.main-inner{padding:0!important;max-width:100%!important}
  .inv-wrap{width:100%!important}
  .bev-doc{box-shadow:none!important;width:100%!important;min-height:auto!important}
  @page{margin:0;size:A4}
}
</style>

<div class="app-wrap">

<div class="back-bar">
  <a href="{{ route('admin.bevestigingen.index') }}">← Terug naar bevestigingen</a>
</div>

<!-- ===== STEP 1 ===== -->
<div id="step1">
  <div class="step-bar">
    <div class="steps-ind">
      <div class="snum active">1</div>
      <div class="sline"></div>
      <div class="snum pending">2</div>
    </div>
    <div>
      <h2 id="step1Title">Nieuwe Factuur — Gegevens</h2>
      <p>Vul alle gegevens in om de factuur te genereren</p>
    </div>
  </div>

  <!-- KLANT -->
  <div class="card">
    <div class="card-title">👤 Klantgegevens</div>
    <div class="fgrid">
      <div class="fg"><label>Bedrijfsnaam</label><input type="text" id="kBedrijf" placeholder="VSL Vloeren"></div>
      <div class="fg"><label>KvK/Kmo Nummer</label><input type="text" id="kKvk" placeholder="12345678"></div>
      <div class="fg"><label>Opdrachtgever (contactpersoon)</label><input type="text" id="kContact" placeholder="de heer B. Banchev"></div>
      <div class="fg"><label>Contractperiode</label><input type="text" id="kPeriode" placeholder="07-05-2026 t/m 31-12-2026"></div>
      <div class="fg s2"><label>Adres</label><input type="text" id="kAdres" placeholder="Frans van Ryhovelaan 213"></div>
      <div class="fg"><label>Postcode</label><input type="text" id="kPostcode" placeholder="9000"></div>
      <div class="fg"><label>Plaats</label><input type="text" id="kPlaats" placeholder="Gent"></div>
      <div class="fg"><label>Land</label><input type="text" id="kLand" placeholder="Nederland"></div>
      <div class="fg"><label>Telefoon</label><input type="tel" id="kTel" placeholder="020 123 4567"></div>
      <div class="fg"><label>Mobiel</label><input type="tel" id="kMobiel" placeholder="06 12345678"></div>
      <div class="fg"><label>E-mail</label><input type="email" id="kEmail" placeholder="naam@bedrijf.nl"></div>
      <div class="fg"><label>Website</label><input type="text" id="kWebsite" placeholder="www.bedrijf.nl"></div>
      <div class="fg"><label>Prijs</label><input type="text" id="kPrijs" placeholder="€ 500,00 (excl)"></div>
    </div>
    <div style="margin-top:16px">
      <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:8px">Categorie(ën)</label>
      <div class="cat-list" id="catList"></div>
      <button class="btn-add-cat" onclick="addCat()">+ Categorie Toevoegen</button>
    </div>
  </div>

  <!-- DOCUMENT INSTELLINGEN -->
  <div class="card">
    <div class="card-title">📝 Document Instellingen</div>
    <div class="fgrid">
      <div class="fg"><label>Bevestigingsdatum</label><input type="text" id="dDatum" placeholder="07-05-2026"></div>
      <div class="fg"><label>Ondertekenaar naam</label><input type="text" id="dSigner" value="Mevr. G. Verheyden"></div>
      <div class="fg s2"><label>Intro tekst</label>
        <textarea id="dIntro" rows="3">Hierbij bevestigen wij graag uw opdracht voor het vermelden van uw bedrijfsgegevens op Bedrijfs-index.net.</textarea>
      </div>
      <div class="fg s2"><label>Bevestigingstekst (onderaan) — gebruik {datum} voor de bevestigingsdatum</label>
        <textarea id="dSlot" rows="5">Uw opdracht is bevestigd middels een geluidsopname van {datum}. Mocht u onjuistheden constateren in de bovenstaande gegevens, dan verzoeken wij u vriendelijk, doch dringend, deze binnen een redelijke termijn aan ons door te geven.

Met vriendelijke groet,</textarea>
      </div>
    </div>
  </div>

  <!-- EIGEN BEDRIJF -->
  <div class="card">
    <div class="card-title">🏢 Eigen Bedrijfsgegevens</div>
    <div class="fgrid">
      <div class="fg"><label>Bedrijfsnaam</label><input type="text" id="eBedrijf" placeholder="Bedrijfs-index.net"></div>
      <div class="fg s2"><label>Adres</label><input type="text" id="eAdres" placeholder="Rembrandtstraat 31"></div>
      <div class="fg"><label>Postcode</label><input type="text" id="ePostcode" placeholder="1701 JB"></div>
      <div class="fg"><label>Plaats</label><input type="text" id="ePlaats" placeholder="Heerhugowaard"></div>
      <div class="fg"><label>Land</label><input type="text" id="eLand" placeholder="Nederland"></div>
      <div class="fg"><label>E-mail</label><input type="email" id="eEmail" placeholder="info@bedrijfs-index.net"></div>
      <div class="fg"><label>Telefoon</label><input type="tel" id="eTel" placeholder="+31722400003"></div>
      <div class="fg"><label>IBAN</label><input type="text" id="eIban" placeholder="NL37INGB0113456956"></div>
      <div class="fg"><label>BTW Nummer</label><input type="text" id="eBtw" placeholder="NL864553201B01"></div>
      <div class="fg"><label>KvK Nummer</label><input type="text" id="eKvk" placeholder="88249468"></div>
      <div class="fg"><label>Website</label><input type="text" id="eWebsite" placeholder="www.bedrijfs-index.net"></div>
    </div>
  </div>

  <div class="card"><div class="f-actions">
    <button class="btn-p" onclick="generate()">Factuur Genereren →</button>
  </div></div>
</div>

<!-- ===== STEP 2 ===== -->
<div id="step2" style="display:none">
  <div class="step-bar">
    <div class="steps-ind">
      <div class="snum done">✓</div>
      <div class="sline"></div>
      <div class="snum active">2</div>
    </div>
    <div>
      <h2>Factuur Preview</h2>
      <p>Controleer de factuur en sla op of druk af</p>
    </div>
  </div>
  <div class="inv-actions">
    <button class="btn-s" onclick="goBack()">← Terug naar formulier</button>
    <button class="btn-gr" id="btnSave" onclick="saveToServer()">💾 Opslaan</button>
    <button class="btn-p" id="btnPdf" onclick="savePdf()">📄 Opslaan als PDF</button>
  </div>
  <div class="inv-wrap"><div class="bev-doc" id="bevDoc"></div></div>
</div>

</div>

<div class="ot-toast" id="toast"></div>

<script>
// ===== LOGOS =====
const LOGOS = [
  { name:'Bedrijfsvermelding.net', img:'/images/offerte-logos/bedrijfsvermelding.net.png' },
  { name:'Zakenvinder.net',        img:'/images/offerte-logos/zakenvinder.net.png' },
  { name:'Kaart met pins',         img:'/images/offerte-logos/kaart%20met%20pins.png' },
  { name:'Blauwe hexagon',         img:'/images/offerte-logos/blauwe%20hexagon.png' },
  { name:'OnlineBedrijvenRegister',img:'/images/offerte-logos/OnlineBedrijvenRegister.nl.png' },
];

let selLogo  = 0;
let catCount = 0;
let currentId = null;

const CSRF     = '{{ csrf_token() }}';
const API_BASE = '/admin/bevestigingen';
const urlId    = new URLSearchParams(window.location.search).get('id');

document.addEventListener('DOMContentLoaded', () => {
  renderLogos();
  addCat();
  if (urlId) {
    currentId = parseInt(urlId);
    loadFromServer(currentId);
  } else {
    load();
    loadServerDefaults();
  }
  document.addEventListener('input', save);
});

function loadServerDefaults() {
  fetch('/admin/settings/bev-defaults', { headers:{'Accept':'application/json'} })
  .then(r => r.ok ? r.json() : null)
  .then(d => {
    if (!d || !Object.keys(d).length) return;
    if (typeof d.selLogo === 'number') { selLogo = d.selLogo; renderLogos(); }
    ['eBedrijf','eAdres','ePostcode','ePlaats','eLand','eEmail','eTel','eWebsite','eKvk','eBtw','eIban','dIntro']
      .forEach(k => { if (d[k]) sv(k, d[k]); });
    save();
  })
  .catch(() => {});
}

function renderLogos() {
  const el = document.getElementById('logoPicker');
  if (!el) return;
  el.innerHTML = LOGOS.map((l,i) =>
    `<div class="logo-card${i===selLogo?' sel':''}" onclick="pickLogo(${i})">
      <img src="${l.img}" alt="${l.name}"><span>${l.name}</span>
    </div>`
  ).join('');
}

function pickLogo(i) { selLogo=i; renderLogos(); save(); }

// ===== CATEGORIES =====
function addCat(val='') {
  const id=`c${catCount++}`;
  const list=document.getElementById('catList');
  const row=document.createElement('div');
  row.className='cat-row'; row.id=id;
  row.innerHTML=`<input type="text" value="${val}" placeholder="bijv. klussen">
    <button class="btn-rm-cat" onclick="rmCat('${id}')">×</button>`;
  list.appendChild(row);
}

function rmCat(id) {
  const rows=document.querySelectorAll('#catList .cat-row');
  if(rows.length<=1){alert('Minimaal één categorie vereist.');return;}
  document.getElementById(id).remove();
}

function getCats() {
  return Array.from(document.querySelectorAll('#catList .cat-row input')).map(i=>i.value).filter(Boolean);
}

// ===== LOCAL STORAGE =====
function gv(id){ return document.getElementById(id)?.value||''; }
function sv(id,v){ const e=document.getElementById(id);if(e)e.value=v; }

function getData() {
  return {
    selLogo, cats: getCats(),
    kBedrijf:gv('kBedrijf'), kKvk:gv('kKvk'), kContact:gv('kContact'), kPeriode:gv('kPeriode'),
    kAdres:gv('kAdres'), kPostcode:gv('kPostcode'), kPlaats:gv('kPlaats'), kLand:gv('kLand'),
    kTel:gv('kTel'), kMobiel:gv('kMobiel'), kEmail:gv('kEmail'), kWebsite:gv('kWebsite'), kPrijs:gv('kPrijs'),
    dDatum:gv('dDatum'), dSigner:gv('dSigner'), dIntro:gv('dIntro'), dSlot:gv('dSlot'),
    eBedrijf:gv('eBedrijf'), eAdres:gv('eAdres'), ePostcode:gv('ePostcode'), ePlaats:gv('ePlaats'), eLand:gv('eLand'),
    eEmail:gv('eEmail'), eTel:gv('eTel'), eIban:gv('eIban'), eBtw:gv('eBtw'), eKvk:gv('eKvk'), eWebsite:gv('eWebsite')
  };
}

function save() {
  try{ localStorage.setItem('bev_v4', JSON.stringify(getData())); }catch(e){}
}

function load() {
  try{
    const d=JSON.parse(localStorage.getItem('bev_v4')||'null');
    if(!d) return;
    applyData(d);
  }catch(e){}
}

function applyData(d) {
  selLogo=d.selLogo||0; renderLogos();
  ['kBedrijf','kKvk','kContact','kPeriode','kAdres','kPostcode','kPlaats','kLand','kTel','kMobiel','kEmail','kWebsite','kPrijs',
   'dDatum','dSigner','dIntro','dSlot',
   'eBedrijf','eAdres','ePostcode','ePlaats','eLand','eEmail','eTel','eIban','eBtw','eKvk','eWebsite']
  .forEach(k=>{ if(d[k]!==undefined && d[k]!=='') sv(k,d[k]); });
  if(d.cats&&d.cats.length){
    document.getElementById('catList').innerHTML=''; catCount=0;
    d.cats.forEach(c=>addCat(c));
  }
}

// ===== GENERATE =====
function esc(s){ return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

function generate() {
  const d=getData(); save();

  const cats=getCats();
  const catHtml = cats.length
    ? cats.map(c=>`<span style="display:block">: ${esc(c)}</span>`).join('')
    : '—';

  const postcodePlaats=[d.kPostcode,d.kPlaats].filter(Boolean).join(' ');
  const ePostcodePlaats=[d.ePostcode,d.ePlaats].filter(Boolean).join(' ');

  function row(label, value) {
    if(!value) return '';
    return `<tr><td>${esc(label)}:</td><td>${value}</td></tr>`;
  }

  const tableRows=[
    row('Bedrijfsnaam', esc(d.kBedrijf)),
    row('KvK/Kmo', esc(d.kKvk)),
    row('Opdrachtgever', d.kContact ? `T.a.v. ${esc(d.kContact)}` : ''),
    row('Contractperiode', esc(d.kPeriode)),
    row('Adres', esc(d.kAdres)),
    row('Postcode / Plaats', esc(postcodePlaats)),
    row('Land', esc(d.kLand)),
    row('Telefoon', esc(d.kTel)),
    row('Mobiel', esc(d.kMobiel)),
    row('E-mail', esc(d.kEmail)),
    row('Website', esc(d.kWebsite)),
    row('Prijs', d.kPrijs ? (d.kPrijs.startsWith('€') ? esc(d.kPrijs) : '€ ' + esc(d.kPrijs)) : ''),
    cats.length ? `<tr><td style="vertical-align:top;padding-top:4px">Categorie:</td><td>${catHtml}</td></tr>` : '',
  ].join('');

  document.getElementById('bevDoc').innerHTML=`
    <div class="bev-content">
      <div class="bev-header">
        <div class="bev-logo-area"><img src="${LOGOS[selLogo].img}" alt="${LOGOS[selLogo].name}"></div>
      </div>
      <div class="bev-mid">
        <div class="bev-client-addr">
          <div class="cn">${esc(d.kBedrijf||'')}</div>
          ${d.kContact?`<div>T.a.v. ${esc(d.kContact)}</div>`:''}
          ${d.kAdres?`<div>${esc(d.kAdres)}</div>`:''}
          ${postcodePlaats?`<div>${esc(postcodePlaats)}</div>`:''}
          ${d.kLand?`<div>${esc(d.kLand)}</div>`:''}
        </div>
        <div class="bev-title-block">
          <div class="bev-title">BEVESTIGING</div>
        </div>
      </div>
      <div class="bev-letter">
        <table class="bev-dtbl">${tableRows}</table>
      </div>
    </div>
    <div class="bev-closing-block">
      ${d.dIntro?`<p class="bev-intro" style="margin:0">${esc(d.dIntro)}</p>`:''}
    </div>
    <div class="bev-footer-info">
      <div class="bev-fi-block">
        ${d.eBedrijf?`<div class="bev-fi-name">${esc(d.eBedrijf)}</div>`:''}
        ${d.eAdres?`<div>${esc(d.eAdres)}</div>`:''}
        ${ePostcodePlaats?`<div>${esc(ePostcodePlaats)}</div>`:''}
        ${d.eLand?`<div>${esc(d.eLand)}</div>`:''}
      </div>
      <div class="bev-fi-block">
        ${d.eTel?`<div>T: ${esc(d.eTel)}</div>`:''}
        ${d.eEmail?`<div>E: ${esc(d.eEmail)}</div>`:''}
        ${d.eWebsite?`<div>W: ${esc(d.eWebsite)}</div>`:''}
      </div>
      <div class="bev-fi-block">
        ${d.eKvk?`<div>KvK/Kmo: ${esc(d.eKvk)}</div>`:''}
        ${d.eBtw?`<div>BTW: ${esc(d.eBtw)}</div>`:''}
        ${d.eIban?`<div>IBAN: ${esc(d.eIban)}</div>`:''}
      </div>
    </div>`;

  const btn = document.getElementById('btnSave');
  btn.textContent = currentId ? '💾 Bijwerken' : '💾 Opslaan';
  btn.disabled = false;

  document.getElementById('step1').style.display='none';
  document.getElementById('step2').style.display='block';
  window.scrollTo(0,0);
}

function goBack() {
  document.getElementById('step2').style.display='none';
  document.getElementById('step1').style.display='block';
  window.scrollTo(0,0);
}

// ===== TOAST =====
function showToast(msg, isErr=false) {
  const t=document.getElementById('toast');
  t.textContent=msg;
  t.className='ot-toast'+(isErr?' err':'');
  requestAnimationFrame(()=>{ requestAnimationFrame(()=>{ t.classList.add('show'); }); });
  setTimeout(()=>{ t.classList.remove('show'); }, 3200);
}

// ===== OPSLAAN =====
function saveToServer() {
  const d = getData();
  const btn = document.getElementById('btnSave');
  btn.disabled = true;
  btn.textContent = 'Bezig...';

  const method = currentId ? 'PUT' : 'POST';
  const url    = currentId ? `${API_BASE}/${currentId}` : API_BASE;

  fetch(url, {
    method,
    headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
    body: JSON.stringify({data: d})
  })
  .then(r => r.json())
  .then(res => {
    currentId = res.id;
    history.replaceState({}, '', `/admin/offerte-tool?id=${res.id}`);
    btn.textContent = '✓ Opgeslagen';
    setTimeout(() => {
      btn.textContent = '💾 Bijwerken';
      btn.disabled = false;
    }, 2000);
    showToast('✓ Bevestiging opgeslagen voor ' + res.titel);
  })
  .catch(() => {
    btn.textContent = '💾 ' + (currentId ? 'Bijwerken' : 'Opslaan');
    btn.disabled = false;
    showToast('Opslaan mislukt', true);
  });
}

// ===== OPSLAAN ALS PDF =====
function savePdf() {
  const btn = document.getElementById('btnPdf');
  btn.disabled = true;
  btn.textContent = 'Bezig...';

  const bedrijf = gv('kBedrijf') || 'bevestiging';
  const datum   = gv('dDatum')   || new Date().toLocaleDateString('nl-NL');
  const filename = `bevestiging-${bedrijf}-${datum}.pdf`.replace(/[^a-zA-Z0-9.\-_]/g, '_');

  html2pdf().set({
    margin:      0,
    filename:    filename,
    image:       { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2, useCORS: true, logging: false },
    jsPDF:       { unit: 'mm', format: 'a4', orientation: 'portrait' }
  }).from(document.getElementById('bevDoc')).save().then(() => {
    btn.textContent = '✓ PDF opgeslagen';
    setTimeout(() => {
      btn.textContent = '📄 Opslaan als PDF';
      btn.disabled = false;
    }, 2000);
  }).catch(() => {
    btn.textContent = '📄 Opslaan als PDF';
    btn.disabled = false;
    showToast('PDF genereren mislukt', true);
  });
}

// ===== LADEN VANUIT SERVER (?id=X) =====
function loadFromServer(id) {
  fetch(`${API_BASE}/${id}`, {headers:{'Accept':'application/json'}})
  .then(r => {
    if (!r.ok) throw new Error();
    return r.json();
  })
  .then(item => {
    applyData(item.data);
    document.getElementById('step1Title').textContent = `Factuur bewerken — ${item.titel}`;
    generate();
  })
  .catch(() => showToast('Kon bevestiging niet laden', true));
}
</script>
</x-base-layout>
