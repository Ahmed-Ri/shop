@extends('layouts.app')
@section('content')


<div class="container">
    @if (session('success'))
    <div class="alert alert-success "> {{ session('success') }} </div>
    @endif
    <div>
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Encaissement enregistré!</h1>
    </div>
    
    <div>
        <p>Montant = {{ getPrice(Cart::subtotal()) }}</p>
        <p>Moyen de paiement =</p>
    </div>
    <div>
        <a href="{{ route('registre.Ticket') }}"><button>Editer ticket</button></a>
        <a href="{{ route('card.index') }}"><button>Retour</button></a>
    </div>
   
</div>
@endsection