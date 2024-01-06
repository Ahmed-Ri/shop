
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

                <input type="text" class="form-control" placeholder="Montant" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                <input type="text" class="form-control" placeholder="Nom du produit" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                <div  class="dropdown ">
                    <button id="btnDropdown1" class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                       Origine de la vente
                    </button>
                    <ul class="dropdown-menu">
                        <li><a id="dropdown-item1" class="dropdown-item" href="#">Shop Radar</a></li>
                        <li><a id="dropdown-item1" class="dropdown-item" href="#">Site</a></li>
                        <li><a id="dropdown-item1" class="dropdown-item" href="#">Instagram</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button id="btnDropdown2" class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Catégorie du produit
                    </button>
                    <ul class="dropdown-menu">
                        <li><a id="dropdown-item2" class="dropdown-item" href="#">Vetements</a></li>
                        <li><a id="dropdown-item2" class="dropdown-item" href="#">Chaussures</a></li>
                        <li><a id="dropdown-item2" class="dropdown-item" href="#">Accessoires</a></li>
                    </ul>
                </div>

            </div>
            <div class="modal-footer">
              <!-- 
              <button id="confirm" class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal">Oui</button>
              <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Non</button> -->
              <form action="" method="post">
                @csrf
                <button id="confirm" class="btn btn-primary" data-bs-target="" data-bs-toggle="modal">Ajouter</button>

              </form>
              <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-primary " data-bs-target="#exampleModalToggle4" data-bs-toggle="modal">Ajouter article +</button>


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