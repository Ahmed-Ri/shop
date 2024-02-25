@extends('layouts.app')

@section('content')

<div class="container">
    @include('charts.navlink') <!-- Inclure la navigation si nécessaire -->
    <div class="card shadow mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered no-vertical-lines">
                    <tbody>
                        @foreach ($depenses as $depense)
                        <tr >
                            <td>{{ $depense->date }}</td>
                            <td class="right-aligned text-danger">{{ -$depense->total }} €</td>
                        </tr>
                        @endforeach
                        <!-- Row for Total -->
                        <tr class="no-bottom-border">
                            <td><strong>Total de la période</strong></td>
                            <td class="right-aligned text-danger"><strong>{{ -$depenses->sum('total') }} €</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    
    
</div>

@endsection
