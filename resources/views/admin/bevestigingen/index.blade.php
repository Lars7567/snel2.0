<x-base-layout>
<style>
.app-wrap{max-width:960px;margin:0 auto;padding:24px 20px;color:#111827}
.app-wrap .card{display:block;overflow:visible;padding:22px 24px;flex:none}
.app-wrap .card p,.app-wrap .card h3{padding:0;color:inherit}

.back-bar{margin-bottom:16px}
.back-bar a{color:var(--color-primary);text-decoration:none;font-size:13px;font-weight:600}
.back-bar a:hover{text-decoration:underline}

.page-header{background:#1a1a2e;color:#fff;padding:20px 28px;border-radius:10px;margin-bottom:22px;display:flex;align-items:center;justify-content:space-between;gap:16px}
.page-header h1{font-size:18px;font-weight:700;color:#fff}
.page-header p{font-size:13px;opacity:.65;margin-top:2px;color:#fff}
.btn-new{background:var(--color-primary);color:#fff;border:none;padding:12px 22px;border-radius:6px;font-size:14px;font-weight:700;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:all .2s;white-space:nowrap;font-family:var(--font-family,inherit)}
.btn-new:hover{background:var(--color-primary-hover);transform:translateY(-1px)}

.card{background:#fff;border-radius:8px;padding:22px 24px;margin-bottom:18px;box-shadow:0 1px 4px rgba(0,0,0,.06),0 4px 12px rgba(0,0,0,.04)}

.empty-state{text-align:center;padding:48px 20px;color:#94a3b8}
.empty-state svg{width:56px;height:56px;margin-bottom:16px;opacity:.4}
.empty-state h3{font-size:15px;font-weight:600;color:#64748b;margin-bottom:6px}
.empty-state p{font-size:13px}

.bev-row{display:flex;align-items:center;gap:14px;padding:14px 16px;border:1.5px solid #e2e8f0;border-radius:8px;margin-bottom:10px;background:#fafafa;transition:border-color .15s,box-shadow .15s}
.bev-row:last-child{margin-bottom:0}
.bev-row:hover{border-color:var(--color-primary)}
.bev-icon{width:40px;height:40px;border-radius:8px;background:color-mix(in srgb,var(--color-primary) 10%,white);border:1.5px solid color-mix(in srgb,var(--color-primary) 30%,white);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:18px}
.bev-info{flex:1;min-width:0}
.bev-title{font-size:14px;font-weight:700;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.bev-meta{display:flex;gap:12px;margin-top:3px;flex-wrap:wrap}
.bev-meta span{font-size:11.5px;color:#64748b}
.bev-meta span strong{font-weight:600;color:#475569}
.bev-actions{display:flex;gap:8px;flex-shrink:0}
.btn-open{background:var(--color-primary);color:#fff;border:none;padding:8px 18px;border-radius:6px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:5px;font-family:var(--font-family,inherit)}
.btn-open:hover{background:var(--color-primary-hover)}
.btn-del{background:none;border:1.5px solid #fca5a5;color:#dc2626;padding:8px 11px;border-radius:6px;font-size:14px;cursor:pointer;line-height:1;transition:background .15s}
.btn-del:hover{background:#fef2f2}

.count-badge{background:var(--color-primary);color:#fff;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;margin-left:8px}

.bev-toast{position:fixed;bottom:24px;right:24px;background:#1a1a2e;color:#fff;padding:14px 20px;border-radius:8px;font-size:13px;font-weight:600;box-shadow:0 4px 20px rgba(0,0,0,.25);z-index:9998;transform:translateY(80px);opacity:0;transition:all .3s}
.bev-toast.show{transform:translateY(0);opacity:1}
.bev-toast.err{background:#b91c1c}
</style>

<div class="app-wrap">

  <div class="back-bar">
    <a href="{{ route('admin.index') }}">← Terug naar dashboard</a>
  </div>

  <div class="page-header">
    <div>
      <h1>Opdracht Bevestigingen <span class="count-badge" id="countBadge">{{ count($bevestigingen) }}</span></h1>
      <p>Overzicht van alle opgeslagen bevestigingen</p>
    </div>
    <a href="{{ route('admin.offerte_tool') }}" class="btn-new">+ Nieuwe Bevestiging</a>
  </div>

  <div class="card">
    @if($bevestigingen->isEmpty())
      <div class="empty-state">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
        </svg>
        <h3>Nog geen bevestigingen</h3>
        <p>Maak je eerste bevestiging via de knop hierboven.</p>
      </div>
    @else
      <div id="bevList">
        @foreach($bevestigingen as $bev)
          @php
            $d = $bev->data;
            $contact = $d['kContact'] ?? '';
            $prijs   = $d['kPrijs'] ?? '';
            $datum   = $d['dDatum'] ?? '';
            $periode = $d['kPeriode'] ?? '';
          @endphp
          <div class="bev-row" id="row-{{ $bev->id }}">
            <div class="bev-icon">📄</div>
            <div class="bev-info">
              <div class="bev-title">{{ $bev->titel }}</div>
              <div class="bev-meta">
                <span><strong>Opgeslagen:</strong> {{ $bev->created_at->format('d-m-Y H:i') }}</span>
                @if($contact)<span><strong>Contact:</strong> {{ $contact }}</span>@endif
                @if($prijs)<span><strong>Prijs:</strong> {{ $prijs }}</span>@endif
                @if($periode)<span><strong>Periode:</strong> {{ $periode }}</span>@endif
              </div>
            </div>
            <div class="bev-actions">
              <a href="{{ route('admin.offerte_tool') }}?id={{ $bev->id }}" class="btn-open">Openen</a>
              <button class="btn-del" onclick="deleteBev({{ $bev->id }})" title="Verwijderen">×</button>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>

</div>

<div class="bev-toast" id="toast"></div>

<script>
const CSRF = '{{ csrf_token() }}';

function showToast(msg, isErr=false) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.className = 'bev-toast' + (isErr ? ' err' : '');
  requestAnimationFrame(() => { requestAnimationFrame(() => { t.classList.add('show'); }); });
  setTimeout(() => { t.classList.remove('show'); }, 3000);
}

function deleteBev(id) {
  adminConfirm('Bevestiging verwijderen?', function() {
    fetch('/admin/bevestigingen/' + id, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(() => {
      const row = document.getElementById('row-' + id);
      if (row) row.remove();
      const badge = document.getElementById('countBadge');
      if (badge) badge.textContent = Math.max(0, parseInt(badge.textContent) - 1);
      const list = document.getElementById('bevList');
      if (list && !list.querySelector('.bev-row')) {
        list.innerHTML = `<div class="empty-state">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
          <h3>Geen bevestigingen meer</h3><p>Maak een nieuwe via de knop hierboven.</p></div>`;
      }
      showToast('Bevestiging verwijderd');
    })
    .catch(() => showToast('Verwijderen mislukt', true));
  });
}
</script>
</x-base-layout>
