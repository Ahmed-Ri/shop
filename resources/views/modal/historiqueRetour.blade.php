<!-- Modal Historique des Retours -->
<div class="modal fade" id="historiqueRetoursModal" tabindex="-1" aria-labelledby="historiqueRetoursModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="historiqueRetoursModalLabel">Historique des Retours</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="table table-centered table-striped table-hover table-responsive">
        <!-- Tableau pour l'historique des retours -->
        <table class="table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Article</th>
              <th>Montant</th>
              <th>Catégorie</th>
            </tr>
          </thead>
          <tbody id="historiqueRetoursBody">
           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      // Attacher un écouteur d'événement pour le bouton qui ouvre le modal
      document.getElementById('historiqueRetours').addEventListener('click', function () {
          fetch('/historique-retours')
              .then(response => response.json())
              .then(data => {
                  let tbody = document.getElementById('historiqueRetoursBody');
                  tbody.innerHTML = ''; // Effacer les données existantes
                  data.forEach(retour => {
                    let date = new Date(retour.created_at);
            let formattedDate = date.toLocaleDateString('fr-FR');
                      let row = `<tr>
                          <td>${formattedDate}</td> <!-- Adaptez selon vos champs -->
                          <td>${retour.nomArticle}</td>
                          <td>${retour.MontantRetour} €</td>
                          <td>${retour.categorieRetour}</td>
                      </tr>`;
                      tbody.innerHTML += row;
                  });
              });
      });
  });
  </script>
  