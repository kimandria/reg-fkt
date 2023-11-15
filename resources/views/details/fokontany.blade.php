@php
    use App\Models\Citizens;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $fokontany->name }} Overview</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <a href="{{ url()->previous() }}" class="btn btn-secondary" style="margin-left: 500px; margin-top:10px; width:25%;">Cancel</a>
    <div class="container">
        <h1>{{ $fokontany->name }}</h1>
        <p>Number of citizens: {{ $fokontany->num_citizens }}</p>
        <p>Number of movements: {{ $fokontany->num_movements }}</p>

        <h2>Citizens</h2>
        <table class="table text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Birthdate</th>
                    <th scope="col">Birth place</th>
                    <th scope="col">Family head</th>
                    <th scope="col">Family 2nd head</th>
                    <th scope="col"># NIC</th> <!-- National Identity Card -->
                    <th scope="col">Job</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fokontany->citizens as $citizen)
                <tr>
                    <td>{{ $citizen['first_name'] }}</td>
                    <td>{{ $citizen['last_name'] }}</td>
                    <td>{{ $citizen['birth_date'] }}</td>
                    <td>{{ $citizen['birth_place'] }}</td>
                    <td>{{ $citizen['father'] }}</td>
                    <td>{{ $citizen['mother'] }}</td>
                    <td>{{ $citizen['nic_num'] }}</td>
                    <td>{{ $citizen['job'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Movements</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Citizen</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Date</th>
                    <th>Pending</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fokontany->arrivals as $arrival)
                <tr>
                    <td>Arrival</td>
                    <td>
                @if($arrival->citizen)
                    {{ $arrival->citizen->first_name }} {{ $arrival->citizen->last_name }}
                @else
                    N/A
                @endif</td>
                    <td>{{ $arrival->from_fkt_name }}</td>
                    <td>{{ $arrival->to_fkt_name }}</td>
                    <td>{{ $arrival->date }}</td>
                    <td>{{ $arrival->pending ? 'Yes' : 'No' }}</td>
                </tr>
                @endforeach
                @foreach($fokontany->departures as $departure)
                <tr>
                    <td>Departure</td>
                    <td> @if($departure->citizen)
                        {{ $departure->citizen->first_name }} {{ $departure->citizen->last_name }}
                    @else
                        N/A
                    @endif</td>
                    <td>{{ $departure->from_fkt_name }}</td>
                    <td>{{ $departure->to_fkt_name }}</td>
                    <td>{{ $departure->date }}</td>
                    <td>{{ $departure->pending ? 'Yes' : 'No' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
