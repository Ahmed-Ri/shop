@extends('layouts.app')
@section('content')
<div class="container">
@include('charts.navlink') <!-- Inclure la navigation si nécessaire -->

<div class="card shadow mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered no-vertical-lines">
                
                <tbody>
                    @foreach ($commandes as $commande)
                    <tr>
                        <td>{{ $commande->date }}</td>
                        <td class="right-aligned">{{ $commande->total }} €</td>
                    </tr>
                    @endforeach
                    <!-- Row for Total -->
                    <tr class="no-bottom-border">
                        <td><strong>Total de la période</strong></td>
                        <td class="right-aligned"><strong>{{ $commandes->sum('total') }} €</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection