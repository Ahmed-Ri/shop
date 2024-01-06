@extends('layouts.app')


@section('content')
<div class="container">
    @include('charts.navlink') <!-- Inclure la navigation si nécessaire -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <!-- Ligne pour les recettes -->
            @if ($item['totalRecettes'] != '0 €')
                <tr>
                    <td>{{ $item['date'] }}</td>
                    <td>{{ $item['totalRecettes'] }}</td>
                </tr>
            @endif
            <!-- Ligne pour les dépenses -->
            @if ($item['totalDepenses'] != '0 €')
                <tr>
                    <td>{{ $item['date'] }}</td>
                    <td class="text-danger">{{ $item['totalDepenses'] }}</td>
                </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    
    
    
</div>
@endsection
