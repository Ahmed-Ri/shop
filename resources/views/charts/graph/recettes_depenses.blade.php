@extends('layouts.app')
@section('content')

</head>
<body>
    

    <div class="container" >
      @include('charts.navlink')
   
    <div id="graph" style="display: flex; width: 1100px; height: 300px;">
      <div style="flex: 1; padding: 10px;margin-left: 20px;margin-top: 20px;box-shadow:1px 1px 1px 1px rgba(181, 181, 181, 0.2);"class="card">
          <canvas id="myChart" style="width: 100%; height: 100%;"></canvas>
      </div>
      <div id="marginnone" style="flex: 1; padding: 10px; margin-left: 400px;margin-top: 20px;box-shadow: 1px 1px 1px 1px rgba(165, 165, 165, 0.2);"class="card">
          <canvas id="RDChart" style="width: 100%; height: 100%;"></canvas>
      </div>
  </div>
  
  
  
  

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    function adjustStylesForMobile() {
        var graph = document.getElementById('graph');
        var divs = graph.getElementsByTagName('div');

        // Vérifie si la largeur de l'écran est inférieure ou égale à 
        if (window.innerWidth <= 720) {
            graph.style.flexDirection = 'column';
            graph.style.width = '100%';

            for (var i = 0; i < divs.length; i++) {
                divs[i].style.marginLeft = '0';
                divs[i].style.width = '100%';
                divs[i].style.boxSizing = 'border-box';
                divs[i].style.height = '100%';
                
            }
        } else {
            // Style pour les écrans plus larges
            graph.style.flexDirection = 'row';
            graph.style.width = '1100px';

            // Vous pouvez réajuster les styles pour les écrans plus larges ici si nécessaire
        }
    }

    // Ajuster les styles lors du chargement initial
    adjustStylesForMobile();

    // Ajuster les styles lors du redimensionnement de la fenêtre
    window.onresize = adjustStylesForMobile;


 const ctx = document.getElementById('myChart');

// Préparation des données
const dataMap = new Map();

// Traiter les dépenses
@foreach ($depenses as $depense)
if (!dataMap.has("{{ $depense->date }}")) {
    dataMap.set("{{ $depense->date }}", { depenses: 0, recettes: 0 });
}
dataMap.get("{{ $depense->date }}").depenses += {{ $depense->total }};
@endforeach

// Traiter les recettes
@foreach ($recettes as $recette)
if (!dataMap.has("{{ $recette->date }}")) {
    dataMap.set("{{ $recette->date }}", { depenses: 0, recettes: 0 });
}
dataMap.get("{{ $recette->date }}").recettes += {{ $recette->total }};
@endforeach

// Trier les dates et préparer les données pour le graphique
const sortedDates = Array.from(dataMap.keys()).sort();
const labels = [];
const depensesData = [];
const recettesData = [];

sortedDates.forEach(date => {
    labels.push(date);
    const data = dataMap.get(date);
    depensesData.push(data.depenses);
    recettesData.push(data.recettes);
});

// Configuration du graphique
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Dépenses',
            data: depensesData,
            backgroundColor: "rgba(255, 88, 132, 0.5)",
            hoverOffset: 10
        }, {
            label: 'Recettes',
            data: recettesData,
            backgroundColor: "lightblue",
            hoverOffset: 10
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    font: {
                        size: 15
                    }
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 10
                    }
                }
            }
        }
    }
});
    // Graphique en secteurs pour recettes et dépenses
    const rdCtx = document.getElementById('RDChart').getContext('2d');

    new Chart(rdCtx, {
        type: 'pie',
        data: {
            labels: ['Recettes', 'Dépenses'],
            datasets: [{
                label: 'Répartition des Recettes et Dépenses',
                data: [
                    @php $totalRecettes = $recettes->sum('total'); @endphp
                    {{ $totalRecettes }},
                    @php $totalDepenses = $depenses->sum('total'); @endphp
                    {{ $totalDepenses }}
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 99, 132, 0.5)'
                ],
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
</body>

@endsection
