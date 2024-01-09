@extends('layouts.app')


@section('content')
<div class="container">
    @include('charts.navlink') <!-- Inclure la navigation si nécessaire -->
    <div class="card shadow mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered no-vertical-lines">
                   
                    <tbody>
                        @php
                        $totalRecettes = 0;
                        $totalDepenses = 0;
                        @endphp
    
                        @foreach ($data as $item)
                        <!-- Ligne pour les recettes -->
                        @if ($item['totalRecettes'] != '0 €')
                            @php $totalRecettes += floatval(str_replace(' €', '', $item['totalRecettes'])); @endphp
                            <tr>
                                <td>{{ $item['date'] }}</td>
                                <td class="right-aligned">{{ $item['totalRecettes'] }}</td>
                            </tr>
                        @endif
                        <!-- Ligne pour les dépenses -->
                        @if ($item['totalDepenses'] != '0 €')
                            @php $totalDepenses += floatval(str_replace(' €', '', $item['totalDepenses'])); @endphp
                            <tr>
                                <td>{{ $item['date'] }}</td>
                                <td class="right-aligned text-danger">-{{ $item['totalDepenses'] }}</td>
                            </tr>
                        @endif
                        @endforeach
    
                        <!-- Row for Total -->
                        <tr class="no-bottom-border">
                            <td><strong>Total</strong></td>
                            <td class="right-aligned"><strong>{{ $totalRecettes - $totalDepenses }} €</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    
    
    
</div>
@endsection
