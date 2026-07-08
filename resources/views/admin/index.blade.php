<x-base-layout>

<style>
.adm *:not(i) { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

.adm-wrap  { display: flex; justify-content: center; padding: 50px 20px 100px; }
.adm-inner { width: 100%; max-width: 900px; }

.adm-title { font-size: 2rem; font-weight: 700; margin: 0 0 6px; color: #111; letter-spacing: -0.02em; }
.adm-sub   { font-size: 14px; color: #9ca3af; margin: 0 0 32px; }

/* Sectie header */
.adm-section { margin-bottom: 28px; }
.adm-section-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
    padding-bottom: 14px;
    border-bottom: 2px solid #f3f4f6;
}
.adm-section-titel { font-size: 1rem; font-weight: 700; color: #111; margin: 0; }
.adm-add-btn {
    display: inline-flex; align-items: center; gap: 7px;
    background: #1a1a1a; color: #fff; text-decoration: none;
    font-size: 12.5px; font-weight: 700; letter-spacing: 0.02em;
    padding: 8px 16px; border-radius: 50px;
    transition: background 0.15s, transform 0.15s;
}
.adm-add-btn:hover { background: #333; transform: translateY(-1px); }

/* Categorie kaarten */
.adm-cat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 12px;
}
@media (max-width: 480px) { .adm-cat-grid { grid-template-columns: 1fr 1fr; } }

.adm-cat-kaart {
    background: #fff;
    border: 1.5px solid #e5e7eb;
    border-radius: 14px;
    padding: 20px 18px 16px;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    gap: 12px;
    transition: border-color 0.18s, box-shadow 0.18s, transform 0.18s;
    position: relative;
    overflow: hidden;
}
.adm-cat-kaart:hover {
    border-color: #1a1a1a;
    box-shadow: 0 8px 24px rgba(0,0,0,0.09);
    transform: translateY(-2px);
}

.adm-cat-kaart__top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
}
.adm-cat-kaart__ico {
    width: 38px; height: 38px; flex-shrink: 0;
    background: #f5f0e8;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; color: #8b7355;
}
.adm-cat-kaart__badge {
    background: #1a1a1a;
    color: #fff;
    font-size: 11px;
    font-weight: 800;
    padding: 3px 9px;
    border-radius: 50px;
    letter-spacing: 0.02em;
    flex-shrink: 0;
}
.adm-cat-kaart__naam {
    font-size: 14px;
    font-weight: 700;
    color: #1a1a1a;
    line-height: 1.3;
    letter-spacing: -0.01em;
    margin: 0;
}
.adm-cat-kaart__link {
    font-size: 11.5px;
    color: #b0a898;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: auto;
    transition: color 0.15s;
}
.adm-cat-kaart:hover .adm-cat-kaart__link { color: #1a1a1a; }
.adm-cat-kaart__link i { font-size: 9px; transition: transform 0.15s; }
.adm-cat-kaart:hover .adm-cat-kaart__link i { transform: translateX(3px); }

/* Plaatsen */
.adm-plaats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 10px;
}
@media (max-width: 480px) { .adm-plaats-grid { grid-template-columns: 1fr 1fr; } }

.adm-plaats-item {
    background: #fff;
    border: 1.5px solid #e5e7eb;
    border-radius: 10px;
    padding: 12px 16px;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    transition: border-color 0.15s, background 0.15s;
}
.adm-plaats-item:hover {
    border-color: #1a1a1a;
    background: #fafafa;
}
.adm-plaats-item__naam {
    font-size: 13.5px;
    font-weight: 600;
    color: #1a1a1a;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.adm-plaats-item__count {
    background: #f5f0e8;
    color: #8b7355;
    font-size: 11px;
    font-weight: 800;
    padding: 2px 8px;
    border-radius: 50px;
    flex-shrink: 0;
}
</style>

<div class="adm-wrap">
<div class="adm-inner">

    <h1 class="adm-title">Dashboard</h1>
    <p class="adm-sub">Beheer je bedrijven, categorieën en instellingen.</p>

    {{-- Categorieen --}}
    <div class="adm-section">
        <div class="adm-section-head">
            <h2 class="adm-section-titel"><i class="fa-solid fa-tag" style="color:#8b7355;margin-right:8px;font-size:.9em;"></i>Categorieën</h2>
            <a href="{{ route('admin.newCategorie') }}" class="adm-add-btn">
                <i class="fa-solid fa-plus"></i> Nieuwe categorie
            </a>
        </div>

        <div class="adm-cat-grid">
            @foreach ($categorieen as $categorie)
            <a href="{{ route('admin.showCategorie', $categorie->id) }}" class="adm-cat-kaart">
                <div class="adm-cat-kaart__top">
                    <div class="adm-cat-kaart__ico"><i class="fa-solid fa-folder"></i></div>
                    <span class="adm-cat-kaart__badge">{{ $categorie->bedrijven->count() }}</span>
                </div>
                <p class="adm-cat-kaart__naam">{{ $categorie->categorie }}</p>
                <span class="adm-cat-kaart__link">Bekijken <i class="fa-solid fa-arrow-right"></i></span>
            </a>
            @endforeach
        </div>
    </div>

    {{-- Plaatsen --}}
    <div class="adm-section">
        <div class="adm-section-head">
            <h2 class="adm-section-titel"><i class="fa-solid fa-location-dot" style="color:#8b7355;margin-right:8px;font-size:.9em;"></i>Bedrijven per plaats</h2>
        </div>

        <div class="adm-plaats-grid">
            @foreach ($bedrijven->filter(fn($b) => $b->plaats)->groupBy('plaats')->sortKeys() as $plaats => $bedrijvenInPlaats)
            <a href="{{ route('admin.show', $plaats) }}" class="adm-plaats-item">
                <span class="adm-plaats-item__naam">{{ $plaats }}</span>
                <span class="adm-plaats-item__count">{{ $bedrijvenInPlaats->count() }}</span>
            </a>
            @endforeach
        </div>
    </div>

</div>
</div>

</x-base-layout>
