@extends('layouts.app')
@section('content')


<body>
    

  <div class="container">
    @include('charts.navlink')

    <div id="graph" style="display: flex; width: 1100px; height: 300px;">
        
        <!-- Première carte pour le premier canvas -->
        <div style="flex: 1; padding: 10px; margin-left: 20px;margin-top: 20px; box-shadow: 1px 2px 4px 1px rgba(0,0,0,0.2);" class="card">
            <canvas id="myChart" style="width: 100%; height: 100%;"></canvas>
        </div>

        <!-- Deuxième carte pour le deuxième canvas -->
        <div style="flex: 1; padding: 10px; margin-left: 400px;margin-top: 20px; box-shadow: 1px 2px 4px 1px rgba(0,0,0,0.2);" class="card">
            <canvas id="categorieChart" style="width: 100%; height: 100%;"></canvas>
        </div>

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
    labels: @json($totalParCategorie->pluck('CategorieDepense')),
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
