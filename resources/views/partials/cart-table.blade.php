<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <div class="row">
        <div class="col-lg-12 custom-col p-2  rounded shadow-sm mb-5 " id="myDiv">
          <div class="d-none d-lg-block col-lg-12"></div>
          <!-- Shopping cart table -->
          <div class="table-responsive" id="cart-responsive">
            
            <table class="table">
              <thead>
                <tr>
                   <th scope="col" class="border-0 bg-light text-center mobile-label" data-mobile-label="Art">
                                <div class="py-2  text-uppercase">Article</div>
                            </th>
                            <th scope="col" class="border-0 bg-light text-center mobile-label" data-mobile-label="QTE">
                                <div class="py-2 text-uppercase">Quantite</div>
                            </th>
                            <th scope="col" class="border-0 bg-light text-center mobile-label" data-mobile-label="TTC">
                                <div class="py-2  text-uppercase">Prix total ttc</div>
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
                      <button type="submit" class="btn btn-link btn-sm text-danger">
                        <i class="fa fa-trash"></i> 
                    </button>
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
          
        </div>
      </div>
      <script>
        // Responsive Caisse
        function updateThContent() {
          const screenWidth = window.innerWidth;
          const thElements = document.querySelectorAll(".mobile-label"); // Cibler uniquement les th avec la classe mobile-label
          
          thElements.forEach((th) => {
            const originalContent = th.getAttribute("data-original-content");
            let newContent = originalContent;
      
            if (screenWidth <= 420) {
              const labelMap = {
                "Article": "ART",
                "Quantite": "QTE",
                "Prix total ttc": "TTC",
                
              };
              newContent = labelMap[originalContent] || originalContent;
              th.textContent = newContent;
            }    
          });
        }
      
        // Appeler la fonction initiale pour configurer le contenu initial
        updateThContent();
      
        // Écouter les changements de taille d'écran et mettre à jour en conséquence
        window.addEventListener("resize", updateThContent);
      </script>
      

      