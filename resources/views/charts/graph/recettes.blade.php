@extends('layouts.app')
@section('content')

</head>
<body>
    
   
      {{-- <form action="" method="GET" style="margin-bottom: 20px;">
        <select name="periode" onchange="this.form.submit()">
            <option value="jour" {{ $periode == 'jour' ? 'selected' : '' }}>Jour</option>
            <option value="semaine" {{ $periode == 'semaine' ? 'selected' : '' }}>Semaine</option>
            <option value="mois" {{ $periode == 'mois' ? 'selected' : '' }}>Mois</option>
            <option value="annee" {{ $periode == 'annee' ? 'selected' : '' }}>Année</option>
        </select>
        <!-- Conserver la sélection de catégorie lors du changement de période -->
        <input type="hidden" name="categorie" value="{{ $categorieSelectionnee }}">
    </form>

    <!-- Formulaire pour la sélection de la catégorie -->
    <form action="" method="GET">
        <select name="categorie" onchange="this.form.submit()">
            <option value="">Toutes les catégories</option>
            @foreach($categories as $categorie)
                <option value="{{ $categorie }}" {{ $categorieSelectionnee == $categorie ? 'selected' : '' }}>{{ $categorie }}</option>
            @endforeach
        </select>
        <!-- Conserver la sélection de période lors du changement de catégorie -->
        <input type="hidden" name="periode" value="{{ $periode }}">
    </form>

    <!-- Affichage des résultats -->
    <h3>Résultats:</h3>
    <ul>
        @foreach ($registres as $registre)
            <li>Date: {{ $registre->date }}, Total MtCommandeTTC: {{ $registre->total }}</li>
        @endforeach
    </ul> --}}
    <div class="container" >
    
    
    @include('charts.navlink')
   
    <div id="graph" style="display: flex; width: 1100px; height: 300px;">
      <div style="flex: 1; padding: 10px; margin-left: 20px;margin-top: 20px; box-shadow: 1px 2px 4px 1px rgba(0,0,0,0.2);" class="card">
          <canvas id="myChart" style="width: 100%; height: 100%;"></canvas>
      </div>
      <div style="flex: 1; padding: 10px; margin-left: 400px;margin-top: 20px; box-shadow: 1px 2px 4px 1px rgba(0,0,0,0.2);" class="card">
          <canvas id="categorieChart" style="width: 100%; height: 100%;"></canvas>
      </div>
  </div>
  
  
  
  

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
          @foreach ($commandes as $commande)
              "{{ $commande->date }}",
          @endforeach
      ],
      datasets: [{
        label: 'TTC',
        data: [
          @foreach ($commandes as $commande)
              {{ $commande->total }},
          @endforeach
        ],
        borderWidth: 0,
        backgroundColor: "lightblue",
        hoverOffset: 10
      }]
    },
    options: {
      scales: {
        y: {
          suggestedMax: 100,
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
  const ctxCategorie = document.getElementById('categorieChart').getContext('2d');

new Chart(ctxCategorie, {
  type: 'pie',
  data: {
    labels: @json($totalParCategorie->pluck('categorie')),
    datasets: [{
      label: 'Total TTC par Catégorie',
      data: @json($totalParCategorie->pluck('total')),
      backgroundColor: [
        "rgba(255, 88, 132, 0.5)", 
    "rgba(54, 162, 235, 0.5)",  
    "rgba(70, 88, 189, 0.5)",   
    "rgba(80, 88, 289, 0.5)", 
      ],
      
      
    }]
  },
  options: {
    scales: {
      y: {
        display: false,
         
      },
      
    }
  }
});
  
</script>
</body>

@endsection
