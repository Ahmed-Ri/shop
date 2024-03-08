<div class="modal fade" id="exampleModalToggle4" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div id="modal-content" class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Ajouter article</h1>
            </div>
            <div> <button type="button" class="btn-close position-absolute end-0 me-1 " data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-footer d-flex flex-column align-items-center mt-2">

                <input type="text" id="articleRefInput" class="form-control" placeholder="Saisir désignation ou code"
                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">

                <button id="btnAjouter" class="btn btn-primary" data-bs-target="#exampleModalToggle5"
                    data-bs-toggle="modal">Montant libre</button>
                <a href="{{ route('articles.index') }}"> <button id="btnAjouter" class="btn btn-primary">Sélectionner
                        depuis le catalogue</button>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalToggle5" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div id="modal-content-style" class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Montant libre</h1>
            </div>
            <div> <button type="button" class="btn-close position-absolute end-0 me-1 " data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-footer d-flex flex-column align-items-center mt-2">

                <!-- Formulaire pour saisir les informations de Montant Libre -->
                <form action="{{ route('card.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="type" value="montantLibre">
                    <input type="text" class="form-control my-2" name="montant" placeholder="Montant" required>
                    <input type="text" class="form-control my-2" name="nomProduit" placeholder="Nom du produit"
                        required>

                    <!-- Origine de la vente -->
                    <select class="form-select my-2" name="origineDeVente" required>
                        {{-- <option value="">Choisir l'origine de la vente</option> --}}
                        <option value="Shop Radar">Shop Radar</option>
                        <option value="Site">Site</option>
                        <option value="Instagram">Instagram</option>
                        <!-- Ajoutez plus d'options ici si nécessaire -->
                    </select>

                    <!-- Catégorie du produit -->
                    <select class="form-select my-2" name="categorie" required>
                        {{-- <option value="">Choisir la catégorie du produit</option> --}}
                        <option value="Vetements">Vêtements</option>
                        <option value="Chaussures">Chaussures</option>
                        <option value="Accessoires">Accessoires</option>
                        <!-- Ajoutez plus de catégories ici si nécessaire -->
                    </select>

                    <div class="modal-footer">

                        <button id="confirm" class="btn btn-primary" data-bs-target=""
                            data-bs-toggle="modal">Ajouter</button>
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle"
                            data-bs-toggle="modal">Annuler</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<button class="btn btn-primary " data-bs-target="#exampleModalToggle4" data-bs-toggle="modal">Ajouter article +</button>


<!-- Modal Article -->
<div class="modal" id="articleModal" tabindex="-1">
    <div class="modal-dialog modal-custom">
        <div class="modal-content">
            <div class="modal-header mb-2">
                <h3 class="modal-title text-center w-100">Détails de l'Article</h3>
                <button type="button" class="btn-close mb-4" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex" id="articleModalBody">

            </div>
            <div class="modal-footer justify-content-center">
                <form action="{{ route('AjoutArticle') }}" method="post">
                    @csrf
                    <input type="hidden" name="id_article">
                    <button type="submit" class="btn btn-dark">Ajouter</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>


{{-- <script>
    document.getElementById('articleRefInput').addEventListener('keypress', function(event) {

        if (event.key === 'Enter') {
            // Empêcher le comportement par défaut du formulaire si nécessaire
            event.preventDefault();
            // Appeler la fonction de recherche
            fetchArticleData();
        }
    });
    // Récupère la valeur de l'élément input avec l'ID 'articleRefInputAdd', qui contient la référence de l'article
    function fetchArticleData() {
        var ref = document.getElementById('articleRefInput').value;
        // Utilise l'API fetch pour envoyer une requête GET à '/fetch-article/' avec la référence de l'article ajoutée à l'URL

        fetch('/fetch-ajout/{ref}' + ref)
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
        // Ajouter l'ID de l'article au formulaire
        var inputHidden = document.querySelector('input[name="id_article"]');
        if (inputHidden) {
            inputHidden.value = article.id;
        }

        // Affichage du modal
        $('#articleModal').modal('show');
        $('#exampleModalToggleRetour').modal('hide');
    }
</script> --}}

<script>
    // Sélectionner tous les éléments de la liste déroulante
    document.querySelectorAll('#dropdown-item1').forEach(item => {
        item.addEventListener('click', function() {
            // Mettre à jour le texte du bouton avec le texte de l'élément cliqué
            document.getElementById('btnDropdown1').textContent = this.textContent;
        });

    });
    document.querySelectorAll('#dropdown-item2').forEach(item => {
        item.addEventListener('click', function() {
            // Mettre à jour le texte du bouton avec le texte de l'élément cliqué
            document.getElementById('btnDropdown2').textContent = this.textContent;
        });

    });
</script>
