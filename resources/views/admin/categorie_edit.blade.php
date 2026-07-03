<x-base-layout>
        <div class="company">
            <div class="company__container" style="max-width:500px;">

                <h1>Categorie bewerken</h1>

                @if($errors->any())
                    <div class="company__errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.updateCategorie', $categorie->id) }}" method="POST" class="company__form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="company__group">
                        <input type="text" name="categorie" class="company__input" placeholder="Categorienaam" value="{{ $categorie->categorie }}">
                    </div>

                    <div class="company__group">
                        <button type="submit" class="company__button">
                            Categorie bijwerken
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-base-layout>