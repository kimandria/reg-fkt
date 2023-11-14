@extends('layout.master')

@section('content')
<div class="container mt-4">
        <h5 class="mb-4">Details for Prefecture: {{ $prefecture->name }}</h5>

    <div class="row">
        <div class="col-md-3">
            <h6 class="mb-3">Districts:</h6>
            <ul>
                @foreach ($districts as $district)
                    <li>{{ $district->name }}</li>
                @endforeach
            </ul>
            {{ $districts->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
        </div>

        <div class="col-md-3">
            <h6 class="mb-3">Boroughs:</h6>
            <ul>
                @foreach ($boroughs as $borough)
                    <li>{{ $borough->name }}</li>
                @endforeach
            </ul>
            {{ $boroughs->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
        </div>

        <div class="col-md-3">
            <h6 class="mb-3">Fokontanies:</h6>
            <ul>
                @foreach ($fokontanies as $fokontany)
                    <li>{{ $fokontany->name }}</li>
                @endforeach
            </ul>
            {{ $fokontanies->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
        </div>

        <div class="col-md-3">
            <h6 class="mb-3">Citizens:</h6>
            <ul>
                @foreach ($citizens as $citizen)
                    <li>{{ $citizen->last_name }}</li>
                @endforeach
            </ul>
            {{ $citizens->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
        </div>
    </div>
  <!-- Mouvements et Bar Chart -->
  <div>
    <div>
        <h6 class="mb-3">Movements list</h6>
        <div class="table-responsive">
            <table class="table table-hover text-center" style="width: 100%;" >
                <thead class="table-dark">
                    <tr>
                        <th scope="col">From Fokontany</th>
                        <th scope="col" >To Fokontany</th>
                        <th scope="col">Book Number</th>
                        <th scope="col">Departure Date</th>
                        <th scope="col">Arrival Date</th>
                        <th scope="col">Pending</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movements as $movement)
                        <tr>
                            <td>{{ $movement->from_fkt->name }}</td>
                            <td>{{ $movement->to_fkt->name }}</td>
                            <td>{{ $movement->book->num }}</td>
                            <td>{{ $movement->departure_date }}</td>
                            <td>{{ $movement->arrival_date }}</td>
                            <td>{{ $movement->pending }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div style="margin-left:500px">
    {{ $movements->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
</div>

    <!-- Bar Chart -->
    <div >
        <div >
            <h6 class="mb-3">Movements Distribution</h6>
            <div class="text-center">
                <canvas id="confirmedChart" width="150" height="50" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px;"></canvas>
            </div>

        <script>
            // Vos données PHP
            var confirmedMovements = {{ $confirmedMovements }};
            var unconfirmedMovements = {{ $unconfirmedMovements }};

            // Script pour dessiner le Bar Chart
            var ctx = document.getElementById('confirmedChart').getContext('2d');
            var confirmedChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Confirmed', 'Not confirmed'],
                    datasets: [{
                        data: [confirmedMovements, unconfirmedMovements],
                        backgroundColor: ['#66bb6a', '#ef5350'],
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
    </div>
</div>
</div>
@endsection
