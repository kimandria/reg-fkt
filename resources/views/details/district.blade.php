@php
    use Illuminate\Support\Facades\Request;
    $path = Request::segment(1);
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>{{ $district->name }} Overview</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="display-4">{{ $district->name }}</h1>
        <p class="lead">Total number of boroughs: {{ $district->num_boroughs }}</p>
        <p class="lead">Total number of fokontany: {{ $district->num_fokontany }}</p>
        <h2 class="mt-5">List of boroughs:</h2>
        <ul class="list-group">
            @foreach ($district->boroughs as $borough)
                <li class="list-group-item"><a href="/{{ $path }}/borough/{{ $borough->id }}">{{ $borough->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
