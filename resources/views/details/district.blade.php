@php
    use Illuminate\Support\Facades\Request;
    $path = Request::segment(1);
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $district->name }} Overview</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .list-group-item {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="mt-3">
        <a href="{{ url()->previous() }}" class="btn btn-primary" style="margin-left: 500px; width:25%;">Cancel</a>
    </div>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">{{ $district->name }} Overview</h1>
            <p class="lead">Total number of boroughs: {{ $district->num_boroughs }}</p>
            <p class="lead">Total number of fokontany: {{ $district->num_fokontany }}</p>
        </div>

        <h2>List of boroughs:</h2>
        <ul class="list-group">
            @forelse ($district->boroughs as $borough)
                <li class="list-group-item"><a href="/{{ $path }}/borough/{{ $borough->id }}">{{ $borough->name }}</a></li>
            @empty
                <li class="list-group-item">No boroughs found.</li>
            @endforelse
        </ul>


    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
