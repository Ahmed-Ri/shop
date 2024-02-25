<div class="modal fade" id="exampleModalToggleRetour" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div id="modal-content" class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Ajouter un retour</h1>
            </div>
            <div> <button type="button" class="btn-close position-absolute end-0 me-1 " data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-footer d-flex flex-column align-items-center mt-2">
                <input type="text" id="articleRefInput" class="form-control" placeholder="Saisir désignation ou code"
                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                <button id="btnAjouter" class="btn btn-primary" data-bs-target="#exampleModalToggle10"
                    data-bs-toggle="modal">Montant libre</button>
                <a href="{{ route('index.retour') }}"> <button id="btnAjouter" class="btn btn-primary">Sélectionner
                        depuis le catalogue</button>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalToggle10" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
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
                <form action="{{ route('retour_Montant_Libre') }}" method="post">
                    @csrf
                    <input type="hidden" name="type" value="montantLibre">
                    <input type="text" class="form-control my-2" name="nomProduit" placeholder="Nom du produit"
                        required>
                    <input type="text" class="form-control my-2" name="montant" placeholder="Montant de retour"
                        required>
                    <!-- Catégorie de retour -->
                    <select class="form-select my-2" name="categorie" required>
                        <option value="">Catégorie de retour</option>
                        <option value="produit">Produit</option>
                        <option value="autre">Autres</option>
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
