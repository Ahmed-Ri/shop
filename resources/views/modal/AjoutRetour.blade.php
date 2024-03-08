<!-- Modal Article -->
<div class="modal" id="articleModal" tabindex="-1">
    <div class="modal-dialog modal-custom">
        <div class="modal-content">
            <div class="modal-header mb-4">
                <h3 class="modal-title text-center w-100">Détails de l'Article</h3>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex" id="articleModalBody">

            </div>
            <div class="modal-footer justify-content-center">
                <form action="{{ route('retourArticle') }}" method="post">
                    @csrf
                    <input type="hidden" name="id_article" >
                    <button type="submit" class="btn btn-dark">Ajouter</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('articleRefInput').addEventListener('keypress', function(event) {

        if (event.key === 'Enter') {
            // Empêcher le comportement par défaut du formulaire si nécessaire
            event.preventDefault();
            // Appeler la fonction de recherche
            fetchArticleData();
        }
    });
    // Récupère la valeur de l'élément input avec l'ID 'articleRefInput', qui contient la référence de l'article
    function fetchArticleData() {
        var ref = document.getElementById('articleRefInput').value;
        // Utilise l'API fetch pour envoyer une requête GET à '/fetch-article/' avec la référence de l'article ajoutée à l'URL

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
            <div  style="width: 250px; height: 100px; overflow: auto;">
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
        // Ajouter l'ID de l'article au formulaire
        var inputHidden = document.querySelector('input[name="id_article"]');
        if (inputHidden) {
            inputHidden.value = article.id;
        }

        // Affichage du modal
        $('#articleModal').modal('show');
        $('#exampleModalToggle4').modal('hide');
    }
</script>
