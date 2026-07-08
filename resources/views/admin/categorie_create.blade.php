<x-base-layout>

<style>
.af *:not(i) { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
.af-wrap  { display: flex; justify-content: center; padding: 50px 20px 100px; }
.af-inner { width: 100%; max-width: 480px; }
.af-topbar { display: flex; align-items: center; gap: 20px; margin-bottom: 32px; flex-wrap: wrap; }
.af-back {
    display: inline-flex; align-items: center; gap: 8px;
    color: #6b7280; font-size: 13px; font-weight: 600; text-decoration: none;
    padding: 8px 14px; border: 1.5px solid #e5e7eb; border-radius: 50px;
    transition: border-color 0.15s, color 0.15s; flex-shrink: 0;
}
.af-back:hover { border-color: #1a1a1a; color: #1a1a1a; }
.af-back i { font-size: 11px; }
.af-title { font-size: 1.7rem; font-weight: 900; color: #111; letter-spacing: -0.03em; margin: 0; }

.af-alert-ok  { background: #f0fdf4; border: 1.5px solid #bbf7d0; color: #166534; border-radius: 10px; padding: 12px 18px; margin-bottom: 20px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
.af-alert-err { background: #fef2f2; border: 1.5px solid #fecaca; color: #991b1b; border-radius: 10px; padding: 12px 18px; margin-bottom: 20px; font-size: 14px; }
.af-alert-err ul { margin: 4px 0 0 18px; padding: 0; }
.af-alert-err li { font-size: 13px; }

.af-card { background: #fff; border: 1.5px solid #e5e7eb; border-radius: 14px; padding: 26px; margin-bottom: 16px; }
.af-field { margin-bottom: 16px; }
.af-field:last-child { margin-bottom: 0; }
.af-label { display: block; font-size: 12px; font-weight: 700; color: #374151; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 7px; }
.af-input {
    width: 100%; padding: 10px 14px;
    border: 1.5px solid #e5e7eb; border-radius: 8px;
    font-size: 14px; color: #1a1a1a;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #fafafa; outline: none;
    transition: border-color 0.15s, background 0.15s;
}
.af-input:focus { border-color: #1a1a1a; background: #fff; }

.af-footer { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 8px; }
.af-btn-primary {
    display: inline-flex; align-items: center; gap: 8px;
    background: #1a1a1a; color: #fff; border: none; cursor: pointer;
    font-size: 14px; font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif;
    padding: 12px 28px; border-radius: 8px; transition: background 0.15s;
}
.af-btn-primary:hover { background: #333; }
.af-btn-secondary {
    display: inline-flex; align-items: center; gap: 8px;
    background: #fff; color: #6b7280;
    border: 1.5px solid #e5e7eb; cursor: pointer;
    font-size: 14px; font-weight: 600; font-family: 'Plus Jakarta Sans', sans-serif;
    padding: 12px 22px; border-radius: 8px;
    transition: border-color 0.15s, color 0.15s;
}
.af-btn-secondary:hover { border-color: #9ca3af; color: #1a1a1a; }
</style>

<div class="af-wrap">
<div class="af-inner">

    <div class="af-topbar">
        <a href="{{ route('admin.index') }}" class="af-back"><i class="fa-solid fa-arrow-left"></i> Terug</a>
        <h1 class="af-title">Categorie toevoegen</h1>
    </div>

    @if(session('success'))
        <div class="af-alert-ok"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="af-alert-err">
            <strong>Controleer de volgende velden:</strong>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ url('/admin/storeCategorie') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="af-card">
            <div class="af-field">
                <label class="af-label">Categorienaam</label>
                <input type="text" name="categorie" class="af-input" placeholder="Bijv. Elektricien" value="{{ old('categorie') }}" autofocus>
            </div>
        </div>

        <div class="af-footer">
            <button type="submit" name="action" value="save" class="af-btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Opslaan
            </button>
            <button type="submit" name="action" value="save_new" class="af-btn-secondary">
                <i class="fa-solid fa-plus"></i> Opslaan en nieuwe maken
            </button>
        </div>
    </form>

</div>
</div>

</x-base-layout>
