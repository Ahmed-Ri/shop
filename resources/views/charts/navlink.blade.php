<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<body>
    <h3>Comptabilité</h3>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 1px 2px 4px 1px rgba(0,0,0,0.2);">
        <h5>Filter</h5>
        <button class="navbar-toggler custom-toggler no-border" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end mt-custom" tabindex="-1"
            id="navbarNavDropdown"aria-labelledby="offcanvasNavbarLabel">


            <div class="offcanvas-body" class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown margin-left ">
                        <form method="GET">
                            <select class="btn dropdown-toggle bordered-dropdown" name="periode" id="periode-select"
                                onchange="this.form.submit()">
                                <option value="jour"{{ request('periode') == 'jour' ? ' selected' : '' }}>Jour
                                </option>
                                <option value="semaine"{{ request('periode') == 'semaine' ? ' selected' : '' }}>Semaine
                                </option>
                                <option value="mois"{{ request('periode') == 'mois' ? ' selected' : '' }}>Mois
                                </option>
                                <option value="annee"{{ request('periode') == 'annee' ? ' selected' : '' }}>Année
                                </option>
                                <option value="seconde"{{ request('periode') == 'seconde' ? ' selected' : '' }}>Détails
                                </option>
                            </select>
                        </form>
                    </li>

                    <li class="nav-item dropdown margin-left ">
                        <form method="GET">
                            <select class="btn dropdown-toggle bordered-dropdown" name="categorie" id="navbarDropdown"
                                onchange="redirectToPage(this)">
                                <option value="recettes_et_depenses" selected>Recette et Dépenses</option>
                                <option value="recettes">Recettes</option>
                                <option value="depenses">Dépenses</option>

                            </select>
                        </form>
                    </li>

                    <li class="nav-item dropdown margin-left">
                        <form method="GET" id="filters-form">
                            <input type="text" name="daterange" value="01/12/2023 - 31/12/2023" />

                            <!-- Ajoutez un bouton de soumission ou utilisez JavaScript pour soumettre le formulaire -->
                        </form>
                    </li>

                </ul>
            </div>
        </div>
        <div class="btn-group ml-auto" role="group" aria-label="Tableaux-Graphiques">
            <a href="#" class="btn btn-secondary btn-fixed-width"
                id="btnTableaux"data-href-depenses="/liste/depenses" data-href-recettes="/liste/recettes"
                data-href-RecettesDepenses="/liste/RecetteDepense">Liste</a>
            <a href="#" class="btn btn-secondary btn-fixed-width"
                id="btnGraphiques"data-href-depenses="/graphique/depenses" data-href-recettes="/graphique/recettes"
                data-href-RecettesDepenses="/graphique/RecetteDepense">Graph</a>
        </div>

    </nav>


</body>


<script>
    $(function() {
        // Fonction pour lire une date du stockage local
        function getDateFromLocalStorage(key, defaultValue) {
            var storedValue = localStorage.getItem(key);
            return storedValue ? moment(storedValue, 'YYYY-MM-DD').format('DD/MM/YYYY') : defaultValue;
        }

        // Initialiser les dates de début et de fin
        var startDate = getDateFromLocalStorage('startDate', '28/12/2023');
        var endDate = getDateFromLocalStorage('endDate', '03/01/2024');

        // Initialiser le daterangepicker
        $('input[name="daterange"]').daterangepicker({
            opens: 'center',
            autoApply: true,
            locale: {
                format: 'DD/MM/YYYY',
                separator: ' - ',
                applyLabel: 'Appliquer',
                cancelLabel: 'Annuler',
                fromLabel: 'De',
                toLabel: 'À',
                customRangeLabel: 'Personnalisé',
                weekLabel: 'Sem',
                daysOfWeek: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
                monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août',
                    'Septembre', 'Octobre', 'Novembre', 'Décembre'
                ],
                firstDay: 1
            },
            startDate: startDate,
            endDate: endDate
        }, function(start, end, label) {
            // Mettre à jour le localStorage avec les nouvelles dates
            localStorage.setItem('startDate', start.format('YYYY-MM-DD'));
            localStorage.setItem('endDate', end.format('YYYY-MM-DD'));

            // Mise à jour immédiate du daterangepicker avec les nouvelles dates
            $('input[name="daterange"]').data('daterangepicker').setStartDate(start.format(
                'DD/MM/YYYY'));
            $('input[name="daterange"]').data('daterangepicker').setEndDate(end.format('DD/MM/YYYY'));

            // Empêcher la soumission immédiate du formulaire
            setTimeout(function() {
                $('#filters-form').submit();
            }, 100); // Retarder légèrement la soumission pour permettre la mise à jour des dates
        });
    });





    function redirectToPage(select) {
        var value = select.value;
        switch (value) {
            case 'recettes':
                window.location.href = '/graphique/recettes';
                break;
            case 'depenses':
                window.location.href = '/graphique/depenses';
                break;
            case 'recettes_et_depenses':
                window.location.href = '/graphique/RecetteDepense';
                break;
        }
    }

    function setCurrentPageSelection() {
        var path = window.location.pathname;
        var select = document.getElementById('navbarDropdown');

        if (path.includes('/graphique/recettes') || path.includes('/liste/recettes')) {
            select.value = 'recettes';
        } else if (path.includes('/graphique/depenses') || path.includes('/liste/depenses')) {
            select.value = 'depenses';
        } else if (path.includes('/graphique/RecetteDepense') || path.includes('/liste/RecetteDepense')) {
            select.value = 'recettes_et_depenses';
        }
    }

    document.addEventListener('DOMContentLoaded', setCurrentPageSelection);

    //setActiveButton
    function setActiveButton() {
        var path = window.location.pathname;
        var btnTableaux = document.getElementById('btnTableaux');
        var btnGraphiques = document.getElementById('btnGraphiques');

        // Reset classes
        btnTableaux.classList.remove('btn-active', 'btn-inactive');
        btnGraphiques.classList.remove('btn-active', 'btn-inactive');

        // Check for dépenses
        if (path.includes('/liste/depenses') || path.includes('/graphique/depenses')) {
            if (path.includes('/liste/depenses')) {
                btnTableaux.classList.add('btn-active');
                btnGraphiques.classList.add('btn-inactive');
            } else if (path.includes('/graphique/depenses')) {
                btnGraphiques.classList.add('btn-active');
                btnTableaux.classList.add('btn-inactive');
            }
        }
        // Check for recettes
        else if (path.includes('/liste/recettes') || path.includes('/graphique/recettes')) {
            if (path.includes('/liste/recettes')) {
                btnTableaux.classList.add('btn-active');
                btnGraphiques.classList.add('btn-inactive');
            } else if (path.includes('/graphique/recettes')) {
                btnGraphiques.classList.add('btn-active');
                btnTableaux.classList.add('btn-inactive');
            }
        }
        // Check for RecettesDepenses
        else if (path.includes('/liste/RecetteDepense') || path.includes('/graphique/RecetteDepense')) {
            if (path.includes('/liste/RecetteDepense')) {
                btnTableaux.classList.add('btn-active');
                btnGraphiques.classList.add('btn-inactive');
            } else if (path.includes('/graphique/RecetteDepense')) {
                btnGraphiques.classList.add('btn-active');
                btnTableaux.classList.add('btn-inactive');
            }
        }
    }

    // Définir le bouton actif au chargement de la page
    document.addEventListener('DOMContentLoaded', setActiveButton);

    document.addEventListener('DOMContentLoaded', function() {
        var path = window.location.pathname;
        var btnTableaux = document.getElementById('btnTableaux');
        var btnGraphiques = document.getElementById('btnGraphiques');

        if (path.includes('recettes')) {
            // Si la page concerne les recettes, utiliser les URLs de recettes
            btnTableaux.href = btnTableaux.getAttribute('data-href-recettes');
            btnGraphiques.href = btnGraphiques.getAttribute('data-href-recettes');
        } else if (path.includes('depenses')) {
            // Si la page concerne les dépenses, utiliser les URLs de dépenses
            btnTableaux.href = btnTableaux.getAttribute('data-href-depenses');
            btnGraphiques.href = btnGraphiques.getAttribute('data-href-depenses');
        } else if (path.includes('RecetteDepense')) {
            // Si la page concerne les Recettesdépenses, utiliser les URLs de Recettesdépenses
            btnTableaux.href = btnTableaux.getAttribute('data-href-RecettesDepenses');
            btnGraphiques.href = btnGraphiques.getAttribute('data-href-RecettesDepenses');
        }
    });
</script>
