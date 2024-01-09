view card:
@extends('layouts.app')
@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
@if (Cart::count()>0)
<div class="px-4 px-lg-0">


  <div class="pb-5">
    <div class="container">
      @if (session('success'))
      <div class="alert alert-success "> {{ session('success') }} </div>
      @endif
      @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <div class="ajout">
        <div>
          <h1 class="caisse">Caisse</h1>
        </div>
        <div class="btnAjout">@include('modal.ajout')</div>
      </div>
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light text-center">
                    <div class="py-2  text-uppercase">Article</div>
                  </th>
                  <th scope="col" class="border-0 bg-light text-center">
                    <div class="py-2 text-uppercase">Quantité</div>
                  </th>
                  <th scope="col" class="border-0 bg-light text-center">
                    <div class="py-2  text-uppercase">Prix</div>
                  </th>

                  <th scope="col" class="border-0 bg-light  text-center">
                    <div class="py-2 text-uppercase"></div>
                  </th>

                </tr>
              </thead>
              <tbody>

                @foreach (Cart::content() as $article)
                <tr>
                  <td class="border-0 align-middle text-center">
                    <strong>
                      {{ $article->model ? $article->model->nomArticle : $article->name }}
                    </strong>
                  </td>
                  <td class="border-0 align-middle text-center">
                    @if($article->model && isset($article->model->stock))
                    <select class="custom-select" name="qty" id="qty{{ $article->rowId }}" data-id="{{ $article->rowId }}" data-stock="{{ $article->model->stock }}">
                      @for ($i = 1; $i <= $article->model->stock; $i++)
                        <option value="{{ $i }}" {{ $article->qty == $i ? 'selected' : '' }}>
                          {{ $i }}
                        </option>
                      @endfor
                    </select>
                    @else
                    {{ $article->qty }}
                    @endif
                  </td>
                  <td class="border-0 align-middle text-center">
                    <strong>{{ $article->subtotal() }}</strong>
                  </td>
                  <td class="border-0 align-middle text-center">
                    <form action="{{ route('card.destroy', $article->rowId) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                  </td>
                </tr>
                @endforeach
                
                <div>
                  <tr>
                    <th scope="col" class="border-0 bg-light text-center">
                      <div class="py-2  text-uppercase">TOTAL</div>
                    </th>
                    <th scope="col" class="border-0 bg-light  text-center">
                      <div class="py-2 text-uppercase">{{ Cart::count() }}</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center ">
                      <div class="py-2  text-uppercase"><strong>{{ getPrice(Cart::subtotal()) }}</strong></div>
                    </th>

                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase"></div>
                    </th>
                  </tr>
                </div>


              </tbody>

            </table>

          </div>
          <!-- End -->
        </div>
      </div>
      <!-- moyen de paiment -->
      <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header px-5 text-center">
              <h1 class="modal-title fs-5 mx-auto">Moyen de paiement</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

           <!-- <form action="{{ route('enregistrerPaiement') }}" method="post"> </form> -->
           <div class="modal-body">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="espece">
                <label class="form-check-label" for="flexRadioDefault1">
                  Espèce
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"value="carte" >
                <label class="form-check-label" for="flexRadioDefault1">
                  Carte
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="tpe" >
                <label class="form-check-label" for="flexRadioDefault1">
                  TPE
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="cheque">
                <label class="form-check-label" for="flexRadioDefault1">
                  Chèque
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="autres" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                  Autres
                </label>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Confirmer</button>
              <button class="btn btn-primary" data-bs-target="" data-bs-toggle="modal">Annuler</button>
            </div>
          
          </div>
        </div>
      </div>
      <!-- Confirmer l'encaissement -->
      <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Confirmer l'encaissement</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Avez-vous bien encaisser le montant de la vente ?
            </div>
            <div class="modal-footer">
              <!-- 
              <button id="confirm" class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal">Oui</button>
              <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Non</button> -->
              <form action="{{ route('paiement') }}" method="post">
                @csrf
                <button id="confirm" class="btn btn-primary" data-bs-target="" data-bs-toggle="modal">Oui</button>

              </form>
              <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Non</button>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-end ">
        <button class="btn btn-warning ms-auto" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Encaisser</button>

      </div>
      <!-- <div class="row py-5 p-4 bg-white rounded shadow-sm">
        <div class="col-lg-6">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon cod</div>
          <div class="p-4">
            <p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
            <div class="input-group mb-4 border rounded-pill p-2">
              <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
              <div class="input-group-append border-0">
                <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Apply coupon</button>
              </div>
            </div>
          </div>
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for seller</div>
          <div class="p-4">
            <p class="font-italic mb-4">If you have some information for the seller you can leave them in the box below</p>
            <textarea name="" cols="30" rows="2" class="form-control"></textarea>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">detail commande </div>
          <div class="p-4">
            <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
            <ul class="list-unstyled mb-4">
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sous Total </strong><strong>{{ getPrice(Cart::subtotal()) }}</strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong>{{ getPrice(Cart::tax()) }}</strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                <h5 class="font-weight-bold">{{ getPrice(Cart::total()) }}</h5>
              </li>
            </ul><a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
          </div>
        </div>
      </div> -->

    </div>

  </div>
</div>
@else

<div class="px-4 px-lg-0">


  <div class="pb-5">
    <div class="container">


      <div class="ajout">
        <div>
          <h1 class="caisse">Caisse</h1>
        </div>
        <div>@include('modal.ajout')</div>
      </div>
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light text-center">
                    <div class="py-2  text-uppercase">Article</div>
                  </th>
                  <th scope="col" class="border-0 bg-light text-center">
                    <div class="py-2 text-uppercase">Quantité</div>
                  </th>
                  <th scope="col" class="border-0 bg-light text-center">
                    <div class="py-2  text-uppercase">Prix</div>
                  </th>

                  <th scope="col" class="border-0 bg-light  text-center">
                    <div class="py-2 text-uppercase"></div>
                  </th>

                </tr>
              </thead>

              <tbody>
                <tr>
                  <td colspan="4" class="text-center">
                    <div class="vide">
                      <p>Aucun article sélectionné.</p>
                      <p>Veuillez ajouter des articles en cliquant sur le bouton "Ajouter article".</p>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- End -->
        </div>
      </div>
        <div class="d-flex justify-content-end ">
        <button class="btn btn-warning ms-auto disabled" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Encaisser</button>
      </div>
    </div>
  </div>
</div>
@endif
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