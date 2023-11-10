@extends('layout.master')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 550px;
            height: auto;
            margin-left: 350px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
    </style>
      <div class="chart-container">
         <h2>Détails de la préfecture {{ $prefecture->name }}</h2>
         <canvas id="myChart"></canvas>
     </div>

     <script>
         var ctx = document.getElementById('myChart').getContext('2d');
         var myChart = new Chart(ctx, {
             type: 'bar',
             data: {
                 labels: ['Districts', 'Boroughs', 'Fokontanies'],
                 datasets: [{
                     label: 'Nombre d\'entités',
                     data: [{{ count($districts) }}, {{ count($boroughs) }}, {{ count($fokontanies) }}],
                     backgroundColor: [
                         'rgba(255, 99, 132, 0.2)',
                         'rgba(54, 162, 235, 0.2)',
                         'rgba(255, 206, 86, 0.2)'
                     ],
                     borderColor: [
                         'rgba(255, 99, 132, 1)',
                         'rgba(54, 162, 235, 1)',
                         'rgba(255, 206, 86, 1)'
                     ],
                     borderWidth: 1
                 }]
             },
             options: {
                 scales: {
                     y: {
                         beginAtZero: true
                     }
                 }
             }
         });
     </script>
     @endsection

     {{-- <div class="chart-container">
        <h2>Détails de la préfecture {{ $prefecture->name }}</h2>
        <canvas id="myChart"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Districts', 'Boroughs', 'Fokontanies'],
                datasets: [{
                    label: 'Nombre d\'entités',
                    data: [{{ count($districts) }}, {{ count($boroughs) }}, {{ count($fokontanies) }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script> --}}
