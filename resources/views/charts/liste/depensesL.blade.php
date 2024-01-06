@extends('layouts.app')

@section('content')

<div class="container">
    @include('charts.navlink') <!-- Inclure la navigation si nécessaire -->

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Dépenses (Montants Négatifs)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($depenses as $depense)
            <tr>
                <td>{{ $depense->date }}</td>
                <td>{{ -$depense->total }} €</td> <!-- Affichage en montant négatif -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
