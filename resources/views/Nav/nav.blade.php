<nav class="navbar navbar-expand-lg fixed-top">
    <a class="navbar-brand mr-4" href="/">
        <img class="logo" src="/assets/images/logo.png" width="120" height="120" alt="Your Logo">
    </a>

    <button class="navbar-toggler custom-toggler no-border" type="button"
        data-target="#menuModal"data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <img src="/assets/images/toggler.png" width="20" height="20" alt="Icône du menu"
            class="custom-toggler-image">
    </button>
    <div class="offcanvas offcanvas-end mt-custom" tabindex="-1" id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel">

        <div class="offcanvas-body" class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ">
                <a class="d-lg-none  mt-4 mb-4" href="/catalogue"><img src="/assets/images/voir.png" width="25"
                        height="15"style="margin-right: 25px;">Catalogue</a>
                <a class="d-lg-none  mb-4" href="/"><img src="/assets/images/voir.png" width="25"
                        height="15"style="margin-right: 25px;">caisse</a>
                <a class="d-lg-none  mb-4" href=""><img src="/assets/images/voir.png" width="25"
                        height="15"style="margin-right: 25px;">Réseaux Sociaux</a>
                <a class="d-lg-none  mb-4" href=""><img src="/assets/images/voir.png" width="25"
                        height="15"style="margin-right: 25px;">Tendances</a>
                <a class="d-lg-none  mb-4" href=""><img src="/assets/images/voir.png" width="25"
                        height="15"style="margin-right: 25px;">Commandes</a>
                <a class="d-lg-none  mb-4" href="/graphique/RecetteDepense"><img src="/assets/images/voir.png"
                        width="25" height="15"style="margin-right: 25px;">Comptabilité</a>
                <a class="d-lg-none  mb-4" href=""><img src="/assets/images/voir.png" width="25"
                        height="15"style="margin-right: 25px;">Assistance</a>
                <a class="d-lg-none  mb-4" href=""><img src="/assets/images/voir.png" width="25"
                        height="15"style="margin-right: 25px;">Paramètres</a>
                <a class="d-lg-none  mb-4" href=""><img src="/assets/images/voir.png" width="25"
                        height="15"style="margin-right: 25px;">Voir Mon Site</a>

            </ul>

        </div>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#"><img src="/assets/images/Menu.png" width="60"
                            height="35"></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#"><img src="/assets/images/Notification.png" width="60"
                            height="35"></a>
                </li>
            </ul>
        </div>
</nav>

<!-- Modal Options -->
<div id="menuModal" class="modale">
    <div id="modal-style" class="modal-content">
        <ul id="mobileMenu" class="modal-grid">
            <a href="/catalogue"><img src="/assets/images/Catalogues.png" width="60" height="34"></a>
            <a href=""><img src="/assets/images/Commandes.png" width="60" height="35"></a>
            <a href="/"><img src="/assets/images/Caisse.png" width="40" height="40"></a>
            <a href=""><img src="/assets/images/ReseauxSociaux.png" width="60" height="39"></a>
            <a href="/graphique/RecetteDepense"><img src="/assets/images/comptabilite.png" width="60"
                    height="32"></a>
            <a href=""><img src="/assets/images/tandences.png" width="60" height="35"></a>
            <a href=""><img src="/assets/images/VoirMonSite.png" width="60" height="39"></a>
            <a href=""><img src="/assets/images/parametre.png" width="60" height="35"></a>
            <a href=""><img src="/assets/images/assistance.png" width="60" height="33"></a>
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
