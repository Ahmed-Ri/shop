@extends('layouts.app')

@section('content')


<div class="container">

    @if($errors->has('error'))
    <div class="alert alert-danger mt-5">
        {{ $errors->first('error') }}
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success"> {{ session('success') }} </div>
    @endif

   
    {{-- <a href="{{ route('card.index') }}"> <img src="/assets/images/caisse.png" alt=""><span class="badge bg-secondary mb-2 ">{{ Cart::count() }}</span> </a> --}}
        <a href="{{ route('card.index') }}"><button type="button" class="btn btn-primary text-light btn-sm "> Retour a la caisse <span class="badge bg-primary text-light">{{ Cart::count() }}</span></button></a>

    <form class="search" action="{{ route('articles.search') }}" method="GET">
        <div class="input-group mt-2 ">
            <input type="text" name="query" class="form-control" placeholder="Rechercher un article">
            {{-- <button  class="btn btn-primary " type="submit"><img src="/assets/images/search.png" alt="" ></button>  --}}
        </div>
    </form>
    <!-- <a href="{{ route('card.index') }}"><button type="button" class="btn btn-warning text-light btn-sm ">< Retour a la caisse<span class="badge bg-warning text-danger">{{ Cart::count() }}</span></button>
</a> -->


  <div class="table-responsive">
  <table id="tabl" class="table table-secondary-emphasis table-striped mt-3 ">


<thead class="custom-thead">

    <tr>
        <th scope="col">Categorie</th>
        <th scope="col">Sous Cat.</th>
        <th scope="col">Article</th>
        <th scope="col">Désignation</th>
        <th scope="col">photo</th>
        <th scope="col">Marque</th>
        <th scope="col">Stock</th>
        <th scope="col">TTC</th>
        <th scope="col"></th>
        <th scope="col"></th>

    </tr>
</thead>
<tbody>



    @foreach($articles as $article)
    <tr>

        <td>{{ $article->sousCategorie->categorie->nomCategorie }}</td>
        <td>{{ $article->sousCategorie->nomSousCategorie }}</td>
        <td>{{ $article->nomArticle }}</td>
        <td>{{ $article->designation }}</td>
        <td> {{ $article->image }}</td>
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