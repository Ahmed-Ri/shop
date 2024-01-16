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
                    @if($article->options->maxQty ?? false)
                        <!-- Sélecteur pour montant libre -->
                        <select class="custom-select-montant-libre" name="qty" id="qty{{ $article->rowId }}" data-id="{{ $article->rowId }}">
                            @for ($i = 1; $i <= $article->options->maxQty; $i++)
                                <option value="{{ $i }}" {{ $article->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    @elseif ($article->model && isset($article->model->stock))
                        <!-- Sélecteur pour articles normaux -->
                        <select class="custom-select" name="qty" id="qty{{ $article->rowId }}" data-id="{{ $article->rowId }}" data-stock="{{ $article->model->stock }}">
                            @for ($i = 1; $i <= $article->model->stock; $i++) 
                                <option value="{{ $i }}" {{ $article->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @else
                    {{ $article->qty }}
                    @endif
                </td>
                
                  <td class="border-0 align-middle text-center">
                    <strong>{{ getPrice($article->subtotal()) }}</strong>
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
      <script>
        
      </script>