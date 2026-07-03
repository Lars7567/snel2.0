<x-base-layout>
        <div class="company-container">
            <h2>Bedrijven</h2>
            @if(session('success'))
                <div style="background:#d1fae5; color:#065f46; border:1px solid #6ee7b7; border-radius:6px; padding:12px 16px; margin-bottom:16px;">
                    {{ session('success') }}
                </div>
            @endif
            <div class="company-inner">
                @foreach ($bedrijven as $bedrijf)
                    <div class="company-card">
                        <img src="{{ asset('images/' . $bedrijf->afbeelding) }}" alt="{{ $bedrijf->naam }}" class="company-image">

                        <div class="company-info">
                            <h3>{{ $bedrijf->naam }}</h3>
                            <p><strong>Korte beschrijving:</strong> {{ $bedrijf->beschrijving_kort }}</p>
                            <p><strong>Langere beschrijving:</strong> {{ $bedrijf->beschrijving_lang }}</p>
                            <p><strong>Adres:</strong> {{ $bedrijf->straat }} {{ $bedrijf->huisnummer }}, {{ $bedrijf->plaats }}, {{ $bedrijf->postcode }}</p>
                            <p><strong>Contact:</strong> {{ $bedrijf->telefoon }} / {{ $bedrijf->email }}</p>
                            <p><strong>Categorieën:</strong> {{ $bedrijf->categorieen->pluck('categorie')->implode(', ') ?: 'Onbekend' }}</p>
                        </div>

                        <div style="display:flex; flex-direction:column; gap:5px; padding:10px 16px;">
                            @php
                                $socials = [
                                    ['icon' => 'fa-google',      'url' => $bedrijf->website,   'label' => 'Website'],
                                    ['icon' => 'fa-facebook-f',  'url' => $bedrijf->facebook,  'label' => 'Facebook'],
                                    ['icon' => 'fa-linkedin-in', 'url' => $bedrijf->linkedin,  'label' => 'LinkedIn'],
                                    ['icon' => 'fa-instagram',   'url' => $bedrijf->instagram, 'label' => 'Instagram'],
                                ];
                            @endphp
                            @foreach($socials as $social)
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <span style="display:inline-flex; align-items:center; justify-content:center; width:20px; flex-shrink:0;">
                                        <i class="fa-brands {{ $social['icon'] }}" style="font-size:15px; color:{{ $social['url'] ? '#e00000' : '#d1d5db' }};"></i>
                                    </span>
                                    @if($social['url'])
                                        <a href="{{ Str::startsWith($social['url'], ['http://','https://']) ? $social['url'] : 'https://' . $social['url'] }}" target="_blank" rel="noopener" style="color:#e00000; font-size:13px; word-break:break-all;">{{ $social['url'] }}</a>
                                    @else
                                        <span style="color:#9ca3af; font-size:13px;">Geen {{ $social['label'] }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="company-details">
                            <p style="color: black" ><strong>Aangemaakt:</strong> {{ $bedrijf->created_at }}</p>
                            <a href="{{ url('/admin/edit/' . $bedrijf->id) . '?from_plaats=' . urlencode($bedrijf->plaats) }}">
                                <p style="color: black" ><strong>geüpdate:</strong> {{ $bedrijf->updated_at }}</p>
                            </a>
                            <form action="{{ url('/admin/delete/' . $bedrijf->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="from_plaats" value="{{ $bedrijf->plaats }}">
                                <button type="submit" style="background-color: red; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;" onclick="return adminConfirmSubmit(this.closest('form'), 'Weet je zeker dat je dit bedrijf wilt verwijderen?')">Verwijder</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-base-layout>