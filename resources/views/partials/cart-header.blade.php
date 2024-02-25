<div class="ajout">
    <div>
      <h1 class="caisse">Caisse</h1>
    </div>
    <div class="autres-options">
      <div class="dropdown opt">
        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Autres options
        </button>
        <ul class="dropdown-menu ">
          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalCalculatrice">Calculatrice</a></li>
          
          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModalToggleRetour">Ajouter un retour</a></li>
          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModalToggle6">Ajouter une dépense</a></li>
          <li><a class="dropdown-item" href="#" id="historiqueRetours" data-bs-toggle="modal" data-bs-target="#historiqueRetoursModal">Historique des retours</a></li>
        </ul>
      </div>
    
      <div class="BtnModal" >@include('modal.ajout')</div>
    </div>
  </div>
 