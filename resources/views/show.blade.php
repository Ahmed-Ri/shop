@extends('layouts.app')
@section('content')


<div class="container">

    <div class="badge badge-pill badge-info">{{ $stock }}</div>
    <table class="table table-text-secondary-emphasis table-striped">


        <thead>

            <tr>

                <th scope="col">Article</th>

                <th scope="col">photo</th>
                <th scope="col">Désignation</th>
                <th scope="col">Prix TTC</th>

            </tr>
        </thead>
        <tbody>




            <tr>


                <td>{{ $article->nomArticle }}</td>

                <td> {{ $article->image }}</td>
                <td>{{ $article->designation }}</td>

                <td>{{ $article->getprix() }}</td>



            </tr>




        </tbody>

    </table>

    <div class="showBtn">
        <form action="{{ route('card.store') }}" method="post">
            @csrf
            <input type="hidden" name="id_article" value="{{ $article->id }}">
            <button type="submit" class="btn btn-dark">Ajouter</button>
        </form>
        <a href="{{ route('articles.index') }}"> <button class="btn btn-primary">Retour</button>
    </div>

</div>
@endsection