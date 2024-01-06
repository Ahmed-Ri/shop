

<nav class="navbar navbar-expand-lg  fixed-top ">
  <a class="navbar-brand mr-4" href="#">
    <img class="logo" src="/assets/images/logo.png" width="120" height="120" alt="Your Logo">
  </a>

  <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link " href="#"><img src="/assets/images/menu.png"width="60" height="35"></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link " href="#" ><img src="/assets/images/Notification.png"width="60" height="35"  ></a>
      </li>
    </ul>
  </div>
</nav>
<!-- Modal Structure -->
<div id="menuModal" class="modale">
  <div id="modal-style" class="modal-content">
      <ul class="modal-grid">
          <a href="/"><img src="/assets/images/Catalogues.png"width="60" height="34"></a>
          <a href=""><img src="/assets/images/Commandes.png"width="60" height="35"></a>
          <a href="/paniers"><img src="/assets/images/Caisse.png"width="40" height="40"></a>
          <a href=""><img src="/assets/images/ReseauxSociaux.png"width="60" height="39"></a>
          <a href="/graphique/RecetteDepense"><img src="/assets/images/comptabilite.png"width="60" height="32"></a>
          <a href=""><img src="/assets/images/tandences.png"width="60" height="35"></a>
          <a href=""><img src="/assets/images/VoirMonSite.png"width="60" height="39"></a>
          <a href=""><img src="/assets/images/parametre.png"width="60" height="35"></a>
          <a href=""><img src="/assets/images/assistance.png"width="60" height="33"></a>
      </ul>
  </div>
</div>


<script>
document.querySelector('.nav-link').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('menuModal').style.display = 'block';
});

window.onclick = function(event) {
    if (event.target == document.getElementById('menuModal')) {
        document.getElementById('menuModal').style.display = "none";
    }
}

</script>
