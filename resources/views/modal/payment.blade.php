  <!-- moyen de paiment -->
  <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
      tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header px-5 text-center">
                  <h1 class="modal-title fs-5 mx-auto">Moyen de paiement</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>


              <div class="modal-body">
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                          value="espece">
                      <label class="form-check-label" for="flexRadioDefault1">
                          Espèce
                      </label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault"
                          id="flexRadioDefault1"value="carte">
                      <label class="form-check-label" for="flexRadioDefault1">
                          Carte
                      </label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                          value="tpe">
                      <label class="form-check-label" for="flexRadioDefault1">
                          TPE
                      </label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                          value="cheque">
                      <label class="form-check-label" for="flexRadioDefault1">
                          Chèque
                      </label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                          value="autres" checked>
                      <label class="form-check-label" for="flexRadioDefault2">
                          Autres
                      </label>
                  </div>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" id="confirmerPaiement" data-bs-target="#exampleModalToggle2"
                      data-bs-toggle="modal">Confirmer</button>
                  <button class="btn btn-primary" data-bs-target="" data-bs-toggle="modal">Annuler</button>
              </div>

          </div>
      </div>
  </div>
  <!-- Confirmer l'encaissement -->
  <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
      tabindex="-1">
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

                  <button id="confirmPayment" class="btn btn-primary">Oui</button>

                  <button class="btn btn-secondary" data-bs-target="#exampleModalToggle"
                      data-bs-toggle="modal">Non</button>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal pour Éditer Ticket -->
  <div class="modal fade" id="modalEditerTicket" aria-hidden="true" aria-labelledby="modalEditerTicketLabel"
      tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="modalEditerTicketLabel">Encaissement enregistré !</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p id="typeDePaiementSelectionne"></p>
                  <p id="totalCommande">Total de la Commande : </p>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" id="btnEditerTicket">Éditer Ticket</button>
                  <button class="btn btn-primary" id="btnAnnuler" data-bs-target=""
                      data-bs-toggle="modal">Fermer</button>
              </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="modalTicketDeCaisse" aria-hidden="true" aria-labelledby="modalTicketDeCaisseLabel"
      tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="modalTicketDeCaisseLabel">Ticket de Caisse</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <table class="table">
                      <thead>
                          @foreach (Cart::content() as $article)
                              <div class="article"
                                  data-name="{{ $article->model ? $article->model->nomArticle : $article->name }}"
                                  data-qty="{{ $article->qty }}" data-subtotal="{{ $article->subtotal }}"
                                  data-total=" {{ getPrice(Cart::subtotal()) }} ">
                                  <!-- Affichage de l'article -->
                              </div>
                          @endforeach
                      </thead>
                      <tbody id="detailsCommande">
                          <!-- Les détails de la commande seront ajoutés ici -->
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>


  <script>
      document.getElementById('confirmPayment').addEventListener('click', function() {
          var moyenDePaiement = sessionStorage.getItem('moyenDePaiementChoisi');

          fetch('{{ route('paiement') }}', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                          'content')
                  },
                  body: JSON.stringify({
                      moyenDePaiement: moyenDePaiement // Ajouter le moyen de paiement ici
                  })
              })
              .then(response => response.json())
              .then(data => {
                  // Fermer le modal précédent
                  $('#exampleModalToggle2').modal('hide');

                  // Assurez-vous que le modal précédent est complètement fermé avant d'ouvrir le nouveau
                  $('#exampleModalToggle2').on('hidden.bs.modal', function(e) {
                      $('#modalEditerTicket').modal('show');
                  });
              })
              .catch(error => {
                  console.error('Erreur détaillée:', error);
                  alert('Une erreur est survenue: ' + error.message);
              });
      });
      //redirection vers la caisse
      document.getElementById('btnAnnuler').addEventListener('click', function() {
          window.location.href = '/';
      });

      document.getElementById('confirmerPaiement').addEventListener('click', function() {
          var moyenDePaiement = document.querySelector('input[name="flexRadioDefault"]:checked').value;

          // Enregistrer le moyen de paiement
          sessionStorage.setItem('moyenDePaiementChoisi', moyenDePaiement);
          // Fermer le modal de moyen de paiement
          $('#exampleModalToggle').modal('hide');
      });
      //mettre à jour l'information sur le moyen de paiement
      $('#modalEditerTicket').on('show.bs.modal', function(e) {
          var moyenDePaiementChoisi = sessionStorage.getItem('moyenDePaiementChoisi');
          var totalCommande = '{{ getPrice(Cart::subtotal()) }}';
          document.getElementById('typeDePaiementSelectionne').textContent = 'Moyen de paiement choisi : ' +
              moyenDePaiementChoisi;
          document.getElementById('totalCommande').textContent = 'Total de la Commande : ' + totalCommande;
      });

      document.getElementById('btnEditerTicket').addEventListener('click', function() {
          var detailsCommandeHTML = '';
          var articles = document.querySelectorAll('.article');

          articles.forEach(function(article) {
              var nomArticle = article.getAttribute('data-name');
              var quantity = article.getAttribute('data-qty');
              var total = article.getAttribute('data-total');

              var subtotal = article.getAttribute('data-subtotal');

              detailsCommandeHTML += `
          <tr>
            <td>${nomArticle}</td>
            
           
            <td>${quantity}</td>
            <td>${subtotal}</td>
            <td>${subtotal}</td>
            <td>${total}</td>
            
          </tr>
        `;
          });

          document.getElementById('detailsCommande').innerHTML = detailsCommandeHTML;
          $('#modalTicketDeCaisse').modal('show');
      });
  </script>
