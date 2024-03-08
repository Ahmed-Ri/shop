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
                          value="ESPECE">
                      <label class="form-check-label" for="flexRadioDefault1">
                          ESPECE
                      </label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault"
                          id="flexRadioDefault1"value="CARTE BANCAIRE">
                      <label class="form-check-label" for="flexRadioDefault1">
                          CARTE BANCAIRE
                      </label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                          value="TPE">
                      <label class="form-check-label" for="flexRadioDefault1">
                          TPE
                      </label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                          value="CHEQUE">
                      <label class="form-check-label" for="flexRadioDefault1">
                          CHEQUE
                      </label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                          value="AUTRES" checked>
                      <label class="form-check-label" for="flexRadioDefault2">
                          AUTRES
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
                  <button class="btn btn-primary" id="btnEditerTicket" data-bs-target="#exampleModalToggle9">Éditer
                      Ticket</button>
                  <button class="btn btn-primary" id="btnAnnuler" data-bs-target=""
                      data-bs-toggle="modal">Fermer</button>
              </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="modalTicketDeCaisse" aria-hidden="true" aria-labelledby="modalTicketDeCaisseLabel"
      tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="modalTicketDeCaisseLabel">SHOP RADAR</h5>
                  <button type="button" class="btn-close mb-3" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <h4 class="modal-title text-center" style="font-weight: 400;">PLACE DU PONT, 69000</h4>
              <h4 class="modal-title text-center" style="font-weight: 400;">DUPLICATA TIKCET</h4>
              <div class="modal-body">
                  <table class="table">
                      <thead>
                          @foreach (Cart::content() as $article)
                              <div class="article"
                                  data-name="{{ $article->model ? $article->model->nomArticle : $article->name }}"
                                  data-qty="{{ $article->qty }}" data-subtotal="{{ $article->subtotal }}"
                                  data-total=" {{ getPrice(Cart::subtotal()) }} "
                                  data-prixht="{{ $article->model ? $article->model->prixHT : $article->prixHT }}"
                                  data-prixttc="{{ $article->model ? $article->model->prixTTC : $article->prixTTC }}"
                                  data-tva="{{ $article->model ? $article->model->TVA : $article->TVA }}">

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
          var moyenDePaiementChoisi = sessionStorage.getItem('moyenDePaiementChoisi');

          // Commencez par définir le contenu HTML pour le <thead> et le début du <tbody>
          detailsCommandeHTML += `
    <table>
        <thead>
            <tr>
                <th>Qté</th>             
                <th>ARTICLE</th>
                <th>PU</th>
                <th>TTC</th>
            </tr>
        </thead>
        <tbody>`;

          // Boucle pour ajouter les lignes du <tbody>

          articles.forEach(function(article) {
              var nomArticle = article.getAttribute('data-name');
              var quantity = article.getAttribute('data-qty');
              var prixTTC = article.getAttribute('data-prixttc');
              var subtotal = article.getAttribute('data-subtotal');

              detailsCommandeHTML += `
            <tr>
                <td>${quantity}X</td>
                <td>${nomArticle}</td>
                <td>${prixTTC}</td>
                <td>${subtotal}</td>
            </tr>`;
          });
          var totalGeneral = 0;
          articles.forEach(function(article) {
              var subtotal = parseFloat(article.getAttribute('data-subtotal'));
              totalGeneral += subtotal;
          });
          totalGeneral = totalGeneral.toFixed(2);
          // Ajout de la ligne pour afficher le total général
          detailsCommandeHTML += `
    <tr>
        <td colspan="2" style="font-size: 17px;font-weight: 100;" ><strong>TOTAL TTC EUR</strong></td>
        <td></td>
        <td><strong style="font-size: 17px;font-weight: 100;" >${totalGeneral}</strong></td>
    </tr>`;
          detailsCommandeHTML += `
        </tbody>
    </table>`;


          // 2ème table
          detailsCommandeHTML += `
    <table>
        <thead>
            <tr>
                <th>TX TVA</th>
                <th>HT</th>
                <th>TVA</th>
                <th>TTC</th>
            </tr>
        </thead>
        <tbody>`
          // Initialisation des totaux
          var totalHT = 0;
          var totalTVA = 0;
          var totalTTC = 0;

          // Calcul des totaux HT, TVA et TTC et ajout des lignes pour chaque article
          articles.forEach(function(article) {
              var ht = parseFloat(article.getAttribute('data-prixht'));
              var quantity = parseFloat(article.getAttribute('data-qty'));
              var tva = parseFloat(article.getAttribute('data-tva'));
              var subtotal = parseFloat(article.getAttribute('data-subtotal'));

              var montantTVA = (tva / 100) * (ht * quantity);
              montantTVA = montantTVA.toFixed(2);

              detailsCommandeHTML += `
        <tr>
            <td>${tva}</td>
            <td>${ht * quantity}</td>
            <td>${montantTVA}</td>
            <td>${subtotal}</td>
        </tr>`;

              totalHT += ht * quantity;
              totalTVA += (tva / 100) * (ht * quantity);
              totalTTC += subtotal;

          });
          totalHT = totalHT.toFixed(2);
          totalTVA = totalTVA.toFixed(2);
          totalTTC = totalTTC.toFixed(2);

          // Ajout de la ligne pour afficher les totaux avec alignement
          detailsCommandeHTML += `
    <tr>
        <td><strong>TOTAUX</strong></td>
        <td><strong>${totalHT}</strong></td>
        <td><strong>${totalTVA}</strong></td>
        <td><strong>${totalTTC}</strong></td>
    </tr>`;


          detailsCommandeHTML += `
    <tr>
        <td colspan="2" style="font-size: 17px;font-weight: 100;" ><strong>${moyenDePaiementChoisi}</strong></td>
        <td></td>
        <td style="font-size: 17px;font-weight: 100;"><strong>${totalTTC}</strong></td>
    </tr>`;
          // Fermez le <tbody> et la table
          detailsCommandeHTML += `
    </tbody>
</table>`;
          document.getElementById('detailsCommande').innerHTML = detailsCommandeHTML;
          $('#modalTicketDeCaisse').modal('show');
      });
  </script>
