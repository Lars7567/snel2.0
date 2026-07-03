<x-base-layout>
    <div class="company">
        <div class="company__container">

            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px;">
                <h1 style="margin:0; font-size:1.8rem; font-weight:700; color:#111827;">Categorie: {{ $categorie->categorie }}</h1>
                <div style="display:flex; gap:10px; align-items:center;">
                    <a href="{{ route('admin.editCategorie', $categorie->id) }}" class="company__button">Bewerken</a>
                    @if ($bedrijven->isEmpty())
                        <form action="{{ route('admin.destroyCategorie', $categorie->id) }}" method="POST" style="display:inline;" onsubmit="return adminConfirmSubmit(this, 'Weet je zeker dat je deze categorie wilt verwijderen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="company__button" style="background:#e00000;">Verwijderen</button>
                        </form>
                    @else
                        <span class="company__button" style="opacity:0.4; cursor:not-allowed;" title="Verwijder eerst alle bedrijven uit deze categorie">Verwijderen</span>
                    @endif
                </div>
            </div>

            @if(!$bedrijven->isEmpty())
                <p style="color:#6b7280; font-size:14px; margin-bottom:16px;">
                    <i class="fa-solid fa-circle-info" style="margin-right:6px;"></i>
                    Je kan een categorie pas verwijderen als er geen bedrijven meer aan gekoppeld zijn.
                </p>
            @endif

            <div style="background:#fff; border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                <div style="padding:16px 20px; background:#f9fafb; border-bottom:1px solid #e5e7eb; font-weight:600; color:#374151;">
                    Bedrijven in deze categorie
                </div>
                <ul style="margin:0; padding:0; list-style:none;">
                    @forelse ($bedrijven as $bedrijf)
                        <li style="display:flex; justify-content:space-between; align-items:center; padding:12px 20px; border-bottom:1px solid #f3f4f6;">
                            <span style="color:#111827; font-size:15px;">{{ $bedrijf->naam }}</span>
                            <form action="{{ route('admin.destroy', $bedrijf->id) }}" method="POST" style="display:inline;" onsubmit="return adminConfirmSubmit(this, 'Weet je zeker dat je dit bedrijf wilt verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color:#e00000; font-weight:600; background:none; border:none; cursor:pointer; font-size:14px; font-family:var(--font-family);">Verwijderen</button>
                            </form>
                        </li>
                    @empty
                        <li style="padding:20px; color:#9ca3af; text-align:center; font-size:15px;">
                            Geen bedrijven gekoppeld aan deze categorie.
                        </li>
                    @endforelse
                </ul>
            </div>

            <div style="margin-top:20px;">
                <a href="{{ route('admin.index') }}" class="company__button" style="background:#6b7280;">
                    <i class="fa-solid fa-arrow-left" style="margin-right:8px;"></i>Terug
                </a>
            </div>

        </div>
    </div>
</x-base-layout>
