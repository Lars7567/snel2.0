<x-base-layout>
        <div class="company">
            <div class="company__container">

                <h1>Bedrijf bewerken</h1>

                @if($errors->any())
                    <div class="company__errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.update', $bedrijf->id) }}" method="POST" class="company__form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="from_plaats" value="{{ request('from_plaats') }}">

                    <div class="company__group">
                        <input type="text" name="naam" class="company__input" placeholder="Bedrijfsnaam" value="{{$bedrijf->naam}}">
                    </div>

                    <div class="company__group">
                        @if($bedrijf->afbeelding)
                            <div style="margin-bottom: 15px;">
                                <p style="margin: 0 0 8px 0; font-weight: 600;">Huidige afbeelding:</p>
                                <img src="/images/{{ $bedrijf->afbeelding }}" style="max-width: 200px; max-height: 150px; border: 1px solid #ddd; border-radius: 4px;">
                            </div>
                        @endif
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Kies nieuwe afbeelding (optioneel):</label>
                        <input type="file" name="afbeelding" class="company__input" accept="image/*">
                    </div>

                    <div class="company__group">
                        <textarea name="beschrijving_kort" class="company__textarea" placeholder="Korte beschrijving">{{$bedrijf->beschrijving_kort}}</textarea>
                    </div>

                    <div class="company__group">
                        <textarea name="beschrijving_lang" class="company__textarea" placeholder="Lange beschrijving">{{$bedrijf->beschrijving_lang}}</textarea>
                    </div>

                    <div class="company__group company__group--half">
                        <input type="text" name="straat" class="company__input" placeholder="Straat" value="{{$bedrijf->straat}}">
                        <input type="text" name="huisnummer" class="company__input" placeholder="Huisnummer" value="{{$bedrijf->huisnummer}}">
                    </div>

                    <div class="company__group company__group--half">
                        <input type="text" name="plaats" class="company__input" placeholder="Plaats" value="{{$bedrijf->plaats}}">
                        <input type="text" name="postcode" class="company__input" placeholder="Postcode" value="{{$bedrijf->postcode}}">
                    </div>

                    <div class="company__group">
                        <input type="text" name="telefoon" class="company__input" placeholder="Telefoonnummer" value="{{$bedrijf->telefoon}}">
                    </div>

                    <div class="company__group">
                        <input type="text" name="gsm" class="company__input" placeholder="GSM / Mobiel" value="{{$bedrijf->gsm}}">
                    </div>

                    <div class="company__group">
                        <input type="email" name="email" class="company__input" placeholder="Email" value="{{$bedrijf->email}}">
                    </div>

                    <div class="company__group">
                        <input type="url" name="website" class="company__input" placeholder="Website URL (optioneel)" value="{{$bedrijf->website}}">
                    </div>

                    <div class="company__group">
                        <input type="url" name="facebook" class="company__input" placeholder="Facebook URL (optioneel)" value="{{$bedrijf->facebook}}">
                    </div>

                    <div class="company__group">
                        <input type="url" name="linkedin" class="company__input" placeholder="LinkedIn URL (optioneel)" value="{{$bedrijf->linkedin}}">
                    </div>

                    <div class="company__group">
                        <input type="url" name="instagram" class="company__input" placeholder="Instagram URL (optioneel)" value="{{$bedrijf->instagram}}">
                    </div>

                    <div class="company__group">
                        <label style="display:block; font-weight:600; margin-bottom:8px;">Categorieën <span style="color:#e53e3e">*</span></label>
                        @php $geselecteerd = old('categorie_ids', $bedrijf->categorieen->pluck('id')->toArray()); @endphp
                        <div style="display:flex; flex-wrap:wrap; gap:10px;">
                            @foreach($categorieen as $categorie)
                                <label style="display:flex; align-items:center; gap:6px; cursor:pointer;">
                                    <input type="checkbox" name="categorie_ids[]" value="{{ $categorie->id }}"
                                        {{ in_array($categorie->id, $geselecteerd) ? 'checked' : '' }}>
                                    {{ $categorie->categorie }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="company__group">
                        <button type="submit" class="company__button">
                            Bedrijf bijwerken
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-base-layout>