<x-base-layout>

        <div class="locations">
            <div class="locations__inner">
                <h2 class="locations__title">Bedrijven per plaats</h2>

                <ul class="locations__list">
                    @foreach ($bedrijven->filter(fn($b) => $b->plaats)->groupBy('plaats')->sortKeys() as $plaats => $bedrijvenInPlaats)
                        <a href="{{ route('admin.show', $plaats) }}" class="locations__item">
                            <span class="locations__name">{{ $plaats }}</span>
                            <span class="locations__count">{{ $bedrijvenInPlaats->count() }}</span>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="categories">
            <div class="categories__inner">
                <h2 class="categories__title">Categorieën</h2>

                <ul class="categories__list">
                    @foreach ($categorieen as $categorie)
                        <a href="{{ route('admin.showCategorie', $categorie->id) }}" class="categories__item">
                            <span class="categories__name">{{ $categorie->categorie }}</span>
                            <span class="categories__count">{{ $categorie->bedrijven->count() }}</span>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>

    </x-base-layout>