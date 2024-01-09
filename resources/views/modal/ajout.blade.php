
<div class="modal fade" id="exampleModalToggle4" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div id="modal-content" class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Ajouter article</h1>
            </div>
            <div> <button type="button" class="btn-close position-absolute end-0 me-1 " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer d-flex flex-column align-items-center mt-2">

                <input type="text" class="form-control" placeholder="Saisir désignation ou code" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                <button id="btnAjouter" class="btn btn-primary" data-bs-target="#exampleModalToggle5" data-bs-toggle="modal">Montant libre</button>
                <a href="{{ route('articles.index') }}"> <button id="btnAjouter" class="btn btn-primary">Sélectionner depuis le catalogue</button>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalToggle5" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div id="modal-content-style" class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Montant libre</h1>
            </div>
            <div> <button type="button" class="btn-close position-absolute end-0 me-1 " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer d-flex flex-column align-items-center mt-2">

                 <!-- Formulaire pour saisir les informations de Montant Libre -->
                 <form action="{{ route('card.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="type" value="montantLibre">
                    <input type="text" class="form-control my-2" name="montant" placeholder="Montant" required>
                    <input type="text" class="form-control my-2" name="nomProduit" placeholder="Nom du produit" required>

                    <!-- Origine de la vente -->
                    <select class="form-select my-2" name="origineDeVente" required>
                        <option value="">Choisir l'origine de la vente</option>
                        <option value="Shop Radar">Shop Radar</option>
                        <option value="Site">Site</option>
                        <option value="Instagram">Instagram</option>
                        <!-- Ajoutez plus d'options ici si nécessaire -->
                    </select>

                    <!-- Catégorie du produit -->
                    <select class="form-select my-2" name="categorie" required>
                        <option value="">Choisir la catégorie du produit</option>
                        <option value="Vetements">Vêtements</option>
                        <option value="Chaussures">Chaussures</option>
                        <option value="Accessoires">Accessoires</option>
                        <!-- Ajoutez plus de catégories ici si nécessaire -->
                    </select>

                    <div class="modal-footer">
                        <!-- 
                        <button id="confirm" class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal">Oui</button>
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Non</button> -->
                        
                          <button id="confirm" class="btn btn-primary" data-bs-target="" data-bs-toggle="modal">Ajouter</button>
          
                        
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Annuler</button>
                      </div>                </form>
            </div>
           
        </div>
    </div>
</div>
<button class="btn btn-primary " data-bs-target="#exampleModalToggle4" data-bs-toggle="modal">Ajouter article +</button>

{{-- 
<div class="modal fade" id="exampleModalToggle4" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Ajouter Montant Libre</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer d-flex flex-column align-items-center mt-2">
                <!-- Formulaire pour saisir les informations de Montant Libre -->
                <form action="{{ route('card.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="type" value="montantLibre">
                    <input type="text" class="form-control my-2" name="montant" placeholder="Montant" required>
                    <input type="text" class="form-control my-2" name="nomProduit" placeholder="Nom du produit" required>

                    <!-- Origine de la vente -->
                    <select class="form-select my-2" name="origineDeVente" required>
                        <option value="">Choisir l'origine de la vente</option>
                        <option value="Shop Radar">Shop Radar</option>
                        <option value="Site">Site</option>
                        <option value="Instagram">Instagram</option>
                        <!-- Ajoutez plus d'options ici si nécessaire -->
                    </select>

                    <!-- Catégorie du produit -->
                    <select class="form-select my-2" name="categorie" required>
                        <option value="">Choisir la catégorie du produit</option>
                        <option value="Vetements">Vêtements</option>
                        <option value="Chaussures">Chaussures</option>
                        <option value="Accessoires">Accessoires</option>
                        <!-- Ajoutez plus de catégories ici si nécessaire -->
                    </select>

                    <button id="btnAjouterMontantLibre" type="submit" class="btn btn-primary mt-2">Ajouter au Panier</button>
                </form>
                <!-- Fin du Formulaire -->
            </div>
        </div>
    </div>
</div>
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalToggle4">Ajouter Montant Libre +</button> --}}

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