<x-base-layout>
        <div class="company">
            <div class="company__container" style="max-width:500px;">

                <h1>Categorie toevoegen</h1>

                @if(session('success'))
                    <div style="background:#d1fae5; color:#065f46; border:1px solid #6ee7b7; border-radius:6px; padding:12px 16px; margin-bottom:16px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="company__errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/admin/storeCategorie') }}" method="POST" class="company__form" enctype="multipart/form-data">
                    @csrf

                    <div class="company__group">
                        <input type="text" name="categorie" class="company__input" placeholder="Categorienaam">
                    </div>

                    <div class="company__group" style="display:flex; gap:10px; flex-wrap:wrap;">
                        <button type="submit" name="action" value="save" class="company__button">
                            Opslaan
                        </button>
                        <button type="submit" name="action" value="save_new" class="company__button" style="background:#6b7280;">
                            Opslaan en nieuwe maken
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-base-layout>