@extends('layouts.app')
@section('extra-meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    {{-- Vérification des articles dans le panier --}}
    @if (Cart::count() > 0)
        <div class="px-4 px-lg-0">
            <div class="pb-5">
                <div class="container">


                    {{-- Messages de session pour la gestion des succès et erreurs --}}
                    @include('partials.session-messages')
                    {{-- En-tête du panier et menu déroulant des options supplémentaires --}}
                    @include('partials.cart-header')


                    {{-- Tableau des articles dans le panier --}}
                    @include('partials.cart-table')

                    {{-- Modal de paiement --}}
                    @include('modal.payment')
                    {{-- Bouton de passage à la caisse --}}
                    <div class="d-flex justify-content-end ">
                        <button class="btn btn-warning ms-auto" data-bs-target="#exampleModalToggle"
                            data-bs-toggle="modal">Encaisser</button>

                    </div>


                </div>

            </div>
        </div>
    @else
        <div class="px-4 px-lg-0">


            <div class="pb-5">
                <div class="container">


                    {{-- Messages de session pour la gestion des succès et erreurs --}}
                    @include('partials.session-messages')
                    {{-- En-tête du panier et menu déroulant des options supplémentaires --}}
                    @include('partials.cart-header')
                    {{-- Message de panier vide --}}
                    @include('partials.empty-cart')
                    {{-- Bouton de passage à la caisse disabled --}}
                    <div class="d-flex justify-content-end ">
                        <button class="btn btn-secondary ms-auto disabled" data-bs-target="#exampleModalToggle"
                            data-bs-toggle="modal">Encaisser</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @include('modal.calculatrice')
    @include('modal.depense')
    @include('modal.retour')
    @include('modal.historiqueRetour')
    @include('modal.AjoutRetour')
@endsection
@section('extra-js')
    <script>
        var qty = document.querySelectorAll('.custom-select');
        console.log(qty);
        Array.from(qty).forEach((element) => {
            element.addEventListener('change', function() {
                var rowId = element.getAttribute('data-id');
                var stock = element.getAttribute('data-stock');
                if (!stock) {
                    return;
                }
                var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                console.log(rowId);
                console.log(token);
                console.log(`/panier/${rowId}`);

                fetch(`/panier/${rowId}`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    method: 'post',
                    body: JSON.stringify({
                        qty: this.value,
                        stock: stock
                    })
                }).then((data) => {
                    console.log(data);
                    location.reload();
                }).catch((error) => {
                    console.log(error);
                });
            });
        });
    </script>
@endsection
