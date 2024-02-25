<div class="modal fade" id="exampleModalToggle6" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div id="modal-content-style" class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Ajouter une dépense</h1>
            </div>
            <div> <button type="button" class="btn-close position-absolute end-0 me-1 " data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-footer d-flex flex-column align-items-center mt-2">


                <form action="{{ route('Ajout_depense') }}" method="post">
                    @csrf
                    <input type="hidden" name="type" value="montantLibre">
                    <input type="text" class="form-control my-2" name="montant" placeholder="Montant depense"
                        required>
                    <input type="text" class="form-control my-2" name="nomProduit" placeholder="Nom depense"
                        required>



                    <!-- Catégorie du produit -->
                    <select class="form-select my-2" name="categorie" required>
                        <option value="">Catégorie de depense</option>
                        <option value="Frais de transport">Frais de transport</option>
                        <option value="Casse">Casse</option>
                        <option value="Entrtient">Entrtient</option>
                        <!-- Ajoutez plus de catégories ici si nécessaire -->
                    </select>

                    <div class="modal-footer">
                        <!--
                        <button id="confirm" class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal">Oui</button>
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Non</button> -->

                        <button id="confirm" class="btn btn-primary" 
                            data-bs-toggle="modal">Ajouter</button>


                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle"
                            data-bs-toggle="modal">Annuler</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
