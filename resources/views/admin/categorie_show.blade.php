<x-base-layout>

<style>
.cs *:not(i) { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

.cs-wrap  { display: flex; justify-content: center; padding: 50px 20px 100px; }
.cs-inner { width: 100%; max-width: 900px; }

/* Topbar */
.cs-topbar {
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: 12px;
    margin-bottom: 32px;
}
.cs-back {
    display: inline-flex; align-items: center; gap: 8px;
    color: #6b7280; font-size: 13px; font-weight: 600;
    text-decoration: none;
    padding: 8px 14px; border: 1.5px solid #e5e7eb; border-radius: 50px;
    transition: border-color 0.15s, color 0.15s;
}
.cs-back:hover { border-color: #1a1a1a; color: #1a1a1a; }
.cs-back i { font-size: 11px; }

.cs-head { display: flex; flex-direction: column; gap: 4px; }
.cs-title {
    font-size: 1.7rem; font-weight: 900; color: #111;
    letter-spacing: -0.03em; margin: 0;
}
.cs-title span { color: #8b7355; }
.cs-meta { font-size: 13px; color: #9ca3af; margin: 0; }

.cs-actions { display: flex; gap: 8px; align-items: center; }
.cs-btn-edit {
    display: inline-flex; align-items: center; gap: 7px;
    background: #1a1a1a; color: #fff; text-decoration: none;
    font-size: 13px; font-weight: 700;
    padding: 10px 20px; border-radius: 8px;
    transition: background 0.15s;
}
.cs-btn-edit:hover { background: #333; }

.cs-btn-del {
    display: inline-flex; align-items: center; gap: 7px;
    background: none; color: #dc2626;
    border: 1.5px solid #fecaca; border-radius: 8px;
    padding: 10px 18px; font-size: 13px; font-weight: 700;
    cursor: pointer; transition: background 0.15s, border-color 0.15s;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.cs-btn-del:hover { background: #fef2f2; border-color: #dc2626; }
.cs-btn-del:disabled, .cs-btn-del--disabled {
    opacity: 0.4; cursor: not-allowed;
    pointer-events: none;
}

/* Info banner */
.cs-notice {
    background: #fefce8; border: 1.5px solid #fde68a; border-radius: 10px;
    padding: 12px 18px; margin-bottom: 20px;
    font-size: 13.5px; color: #92400e; font-weight: 500;
    display: flex; align-items: center; gap: 10px;
}

/* Bedrijven sectie */
.cs-section {
    background: #fff; border: 1.5px solid #e5e7eb; border-radius: 14px;
    overflow: hidden;
}
.cs-section-head {
    padding: 16px 22px;
    background: #fafafa;
    border-bottom: 1px solid #e5e7eb;
    display: flex; align-items: center; justify-content: space-between;
}
.cs-section-titel {
    font-size: 14px; font-weight: 700; color: #374151; margin: 0;
    display: flex; align-items: center; gap: 8px;
}
.cs-section-titel i { color: #8b7355; font-size: 13px; }
.cs-count-badge {
    background: #f5f0e8; color: #8b7355;
    font-size: 11px; font-weight: 800;
    padding: 3px 9px; border-radius: 50px;
}

/* Lijst */
.cs-list { list-style: none; margin: 0; padding: 0; }
.cs-list-item {
    display: flex; justify-content: space-between; align-items: center;
    padding: 14px 22px;
    border-bottom: 1px solid #f3f4f6;
    transition: background 0.12s;
}
.cs-list-item:last-child { border-bottom: none; }
.cs-list-item:hover { background: #fafafa; }

.cs-list-naam {
    font-size: 14px; font-weight: 600; color: #1a1a1a;
    display: flex; align-items: center; gap: 10px;
}
.cs-list-naam i { color: #d4c9b8; font-size: 13px; }

.cs-list-del {
    background: none; border: none; cursor: pointer;
    color: #d1d5db; font-size: 13px; font-weight: 600;
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 10px; border-radius: 6px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: background 0.12s, color 0.12s;
}
.cs-list-del:hover { background: #fef2f2; color: #dc2626; }

.cs-empty {
    padding: 48px 20px; text-align: center; color: #c4bdb3;
}
.cs-empty i { font-size: 36px; margin-bottom: 12px; display: block; }
.cs-empty p { font-size: 14px; font-weight: 500; margin: 0; }
</style>

<div class="cs-wrap">
<div class="cs-inner">

    <div class="cs-topbar">
        <div style="display:flex;align-items:center;gap:20px;flex-wrap:wrap;">
            <a href="{{ route('admin.index') }}" class="cs-back">
                <i class="fa-solid fa-arrow-left"></i> Terug
            </a>
            <div class="cs-head">
                <h1 class="cs-title">Categorie: <span>{{ $categorie->categorie }}</span></h1>
                <p class="cs-meta">{{ $bedrijven->count() }} {{ $bedrijven->count() === 1 ? 'bedrijf' : 'bedrijven' }} gekoppeld</p>
            </div>
        </div>
        <div class="cs-actions">
            <a href="{{ route('admin.editCategorie', $categorie->id) }}" class="cs-btn-edit">
                <i class="fa-solid fa-pen"></i> Bewerken
            </a>
            @if($bedrijven->isEmpty())
                <form action="{{ route('admin.destroyCategorie', $categorie->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="cs-btn-del"
                        onclick="return adminConfirmSubmit(this.closest('form'), 'Weet je zeker dat je de categorie &quot;{{ addslashes($categorie->categorie) }}&quot; wilt verwijderen?')">
                        <i class="fa-solid fa-trash"></i> Verwijderen
                    </button>
                </form>
            @else
                <button class="cs-btn-del cs-btn-del--disabled" title="Verwijder eerst alle bedrijven uit deze categorie">
                    <i class="fa-solid fa-trash"></i> Verwijderen
                </button>
            @endif
        </div>
    </div>

    @if(!$bedrijven->isEmpty())
        <div class="cs-notice">
            <i class="fa-solid fa-circle-info"></i>
            Je kunt een categorie pas verwijderen als er geen bedrijven meer aan gekoppeld zijn.
        </div>
    @endif

    <div class="cs-section">
        <div class="cs-section-head">
            <p class="cs-section-titel">
                <i class="fa-solid fa-building"></i>
                Bedrijven in deze categorie
            </p>
            <span class="cs-count-badge">{{ $bedrijven->count() }}</span>
        </div>
        <ul class="cs-list">
            @forelse($bedrijven as $bedrijf)
                <li class="cs-list-item">
                    <span class="cs-list-naam">
                        <i class="fa-solid fa-building"></i>
                        {{ $bedrijf->naam }}
                    </span>
                    <form action="{{ route('admin.destroy', $bedrijf->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cs-list-del"
                            onclick="return adminConfirmSubmit(this.closest('form'), 'Weet je zeker dat je {{ addslashes($bedrijf->naam) }} wilt verwijderen?')">
                            <i class="fa-solid fa-trash"></i> Verwijderen
                        </button>
                    </form>
                </li>
            @empty
                <li class="cs-empty">
                    <i class="fa-solid fa-folder-open"></i>
                    <p>Geen bedrijven gekoppeld aan deze categorie.</p>
                </li>
            @endforelse
        </ul>
    </div>

</div>
</div>

</x-base-layout>
