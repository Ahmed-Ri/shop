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
      <div style="flex: 1; padding: 10px; margin-left: 400px;margin-top: 20px;box-shadow: 1px 1px 1px 1px rgba(165, 165, 165, 0.2);"class="card">
          <canvas id="RDChart" style="width: 100%; height: 100%;"></canvas>
      </div>
  </div>
  
  
  
  

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
          @foreach ($depenses as $depense)
              "{{ $depense->date }}",
          @endforeach
      ],
      datasets: [{
        label: 'Dépences',
        data: [
          @foreach ($depenses as $depense)
              {{ $depense->total }},
          @endforeach
        ],
        
        borderWidth: 0,
        backgroundColor: "rgba(255, 88, 132, 0.5)",
        hoverOffset: 10
      },
      {
        label: 'recettes',
        data: [
          @foreach ($recettes as $recette)
              {{ $recette->total }},
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
