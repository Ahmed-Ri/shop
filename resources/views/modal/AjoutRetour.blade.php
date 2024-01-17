<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!-- Modal Article -->
<div class="modal" id="articleModal" tabindex="-1">
    <div class="modal-dialog modal-custom">
        <div class="modal-content">
            <div class="modal-header mb-4">
                <h3 class="modal-title text-center w-100">Détails de l'Article</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex" id="articleModalBody">
                <!-- Les détails de l'article seront remplis ici via JavaScript -->
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary">Ajouter</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
  




</body>
</html>
<script>
    function fetchArticleData() {
        var ref = document.getElementById('articleRefInput').value;
        fetch('/fetch-article/' + ref)
            .then(response => response.json())
            .then(data => {
                // Maintenant, remplissez le modal avec les données
                populateModal(data);
            });
    }

    function populateModal(article) {
        // En supposant que vous avez un élément avec l'ID 'articleModalBody' dans votre modal
        var modalBody = document.getElementById('articleModalBody');
          // Créer le contenu HTML avec les informations de l'article
          var content = `
        <div class="flex-shrink-0" style="max-width: 30%;">
            <img src="${article.photo}" alt="Photo" style="max-width:100%;height:auto;">
        </div>
        <div class="flex-grow-1 ms-3">
            <div  style="width: 350px; height: 100px; overflow: auto;">
                <div class="card-body">
                    <p class="card-title">${article.nomArticle}</p>
                    <p class="card-text">Prix TTC : ${article.prixTTC} €</p>
                    <p class="card-text">Stock : ${article.stock}</p>
                </div>
            </div>
        </div>
    `;
    // Mettre à jour le contenu du modal
    modalBody.innerHTML = content;

        // Ouvrir le modal, en supposant que vous utilisez Bootstrap
        $('#articleModal').modal('show');
        $('#exampleModalToggleRetour').modal('hide');
    }
</script>