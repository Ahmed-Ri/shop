@extends('layouts.app')
@section('content')
<div class="container">
@include('charts.navlink') <!-- Inclure la navigation si nécessaire -->

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>commandes </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($commandes as $commande)
        <tr>
            <td>{{ $commande->date }}</td>
            <td>{{ $commande->total }} €</td> <!-- Affichage en montant négatif -->
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection