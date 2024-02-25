@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($errors->has('error'))
            <div class="alert alert-danger mt-5">
                {{ $errors->first('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success"> {{ session('success') }} </div>
        @endif


        {{-- Lien de retour à la caisse --}}
        <a href="{{ route('card.index') }}"><button type="button" class="btn btn-primary text-light btn-sm "> Retour à la
                caisse <span class="badge bg-primary text-light">{{ Cart::count() }}</span></button></a>

        {{-- la section de recherche --}}
        <div class="rechercheFlex">
            {{-- Formulaire de recherche --}}
            <form class="search" action="{{ route('articles.search') }}" method="GET">
                <div class="input-group mt-2 ">
                    <input type="text" name="query" class="form-control" placeholder="Rechercher un article">
                </div>
            </form>

            {{-- Formulaire de tri par catégorie --}}
            <form class="trie" action="{{ route('articles.index') }}" method="GET">
                <select name="category" onchange="this.form.submit()" class="custom-dropdown">
                    <option value="">Trier par catégorie</option>
                    {{-- Boucle pour afficher les options de catégorie --}}
                    @foreach ($categories as $category)
                        <option value="{{ $category->nomCategorie }}"
                            {{ request('category') == $category->nomCategorie ? 'selected' : '' }}>
                            {{ $category->nomCategorie }}
                        </option>
                    @endforeach
                </select>
            </form>

            {{-- Formulaire d'informations sur le stock --}}
            <form action="{{ route('articles.index') }}" method="GET">
                <div class="stock-info">
                    <p class="p1">Nombre d'article en stock: {{ $totalQuantity }}</p>
                    <p class="p2">Valeur du stock: {{ $totalValue }} € TTC</p>
                </div>
            </form>
        </div>


        <div class="table-responsive" id="catalogue-responsive">
            <table id="table" class="table table-secondary-emphasis table-striped mt-3 ">
                <thead class="custom-thead">
                    <tr>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Sous Catégorie</th>
                        <th scope="col">Réference</th>
                        <th scope="col">Article</th>
                        <th scope="col">photo</th>
                        <th scope="col">Marque</th>
                        <th scope="col">Stock</th>
                        <th scope="col">TTC</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td>{{ $article->sousCategorie->categorie->nomCategorie }}</td>
                            <td>{{ $article->sousCategorie->nomSousCategorie }}</td>
                            <td>{{ $article->reference }}</td>
                            <td>{{ $article->nomArticle }}</td>
                            <td> <img src="{{ $article->photo }}" alt=""></td>
                            <td>{{ $article->marque }}</td>
                            <td>{{ $article->stock }}</td>
                            <td>{{ $article->getprix() }}</td>
                            <td>
                                <form action="{{ route('article.show', $article->slug) }}">
                                    @csrf
                                    <input type="hidden" name="id_article" value=" {{ $article->id }} ">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Voir</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('card.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_article" value=" {{ $article->id }} ">
                                    <button type="submit" class="btn btn-primary btn-sm">ajouter</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


{{-- respensive mobile --}}

<script>   
        var articles = @json($articles); // Passez les données des articles à JavaScript

        window.onload = function() {
            if (window.innerWidth <= 577) {
                var container = document.createElement('div');

                // Vérifiez s'il y a des articles retournés
                if (articles.length > 0) {
                    articles.forEach(function(article) {
                        var card = document.createElement('div');
                        card.className = 'article-card';

                        // Ajoutez la photo, le prix et les boutons ici
                        var addToCartUrl = "{{ route('card.store') }}";
                        var addToCartUr2 = "{{ route('article.show', 'slug_placeholder') }}"; // Mettez un espace réservé pour le slug

                        card.innerHTML = ` <div class="article-image">
                            <img src="${article.photo}" alt="${article.nomArticle}">
                        </div>
                        <div class="article-info">
                            <div class="article-nom">${article.nomArticle}</div>
                            <div class="article-prix">${article.prixTTC}€</div>
                        </div>
                        <div class="article-actions">
                            <form action="${addToCartUr2.replace('slug_placeholder', article.slug)}" method="GET">
                                <button type="submit" class="btn btn-outline-primary btn-sm">Voir</button>
                            </form>
                            <form action="${addToCartUrl}" method="POST">
                                @csrf
                                <input type="hidden" name="id_article" value="${article.id}">
                                <button type="submit" class="btn btn-primary btn-sm">Ajouter</button>
                            </form>
                        </div>`;

                        container.appendChild(card);
                    });
                } else {
                    // Gérez le cas où aucun article n'est trouvé
                    var noArticlesMessage = document.createElement('div');
                    noArticlesMessage.innerText = 'Aucun article trouvé.';
                    container.appendChild(noArticlesMessage);
                }

                document.body.appendChild(container);
            }
        };
    

</script>