<x-base-layout>
        <div class="company">
            <div class="company__container">

                <h1>Bedrijf toevoegen</h1>

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

                <form action="{{ url('/admin/store') }}" method="POST" class="company__form" enctype="multipart/form-data">
                    @csrf

                    <div class="company__group">
                        <input type="text" name="naam" class="company__input" placeholder="Bedrijfsnaam">
                    </div>

                    <div class="company__group">
                        <input type="file" name="afbeelding" class="company__input" >
                    </div>

                    <div class="company__group">
                        <textarea name="beschrijving_kort" class="company__textarea" placeholder="Korte beschrijving"></textarea>
                    </div>

                    <div class="company__group">
                        <textarea name="beschrijving_lang" class="company__textarea" placeholder="Lange beschrijving"></textarea>
                    </div>

                    <div class="company__group company__group--half">
                        <input type="text" name="straat" class="company__input" placeholder="Straat">
                        <input type="text" name="huisnummer" class="company__input" placeholder="Huisnummer">
                    </div>

                    <div class="company__group company__group--half">
                        <input type="text" name="plaats" class="company__input" placeholder="Plaats">
                        <input type="text" name="postcode" class="company__input" placeholder="Postcode">
                    </div>

                    <div class="company__group">
                        <input type="text" name="telefoon" class="company__input" placeholder="Telefoonnummer">
                    </div>

                    <div class="company__group">
                        <input type="text" name="gsm" class="company__input" placeholder="GSM / Mobiel">
                    </div>

                    <div class="company__group">
                        <input type="email" name="email" class="company__input" placeholder="Email">
                    </div>

                    <div class="company__group">
                        <input type="url" name="website" class="company__input" placeholder="Website URL (optioneel)">
                    </div>

                    <div class="company__group">
                        <input type="url" name="facebook" class="company__input" placeholder="Facebook URL (optioneel)">
                    </div>

                    <div class="company__group">
                        <input type="url" name="linkedin" class="company__input" placeholder="LinkedIn URL (optioneel)">
                    </div>

                    <div class="company__group">
                        <input type="url" name="instagram" class="company__input" placeholder="Instagram URL (optioneel)">
                    </div>

                    <div class="company__group">
                        <label style="display:block; font-weight:600; margin-bottom:8px;">Categorieën <span style="color:#e53e3e">*</span></label>
                        <div style="display:flex; flex-wrap:wrap; gap:10px;">
                            @foreach($categorieen as $categorie)
                                <label style="display:flex; align-items:center; gap:6px; cursor:pointer;">
                                    <input type="checkbox" name="categorie_ids[]" value="{{ $categorie->id }}"
                                        {{ is_array(old('categorie_ids')) && in_array($categorie->id, old('categorie_ids')) ? 'checked' : '' }}>
                                    {{ $categorie->categorie }}
                                </label>
                            @endforeach
                        </div>
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