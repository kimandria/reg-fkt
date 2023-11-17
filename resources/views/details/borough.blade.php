@php
    use Illuminate\Support\Facades\Request;
    $path = Request::segment(1);
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>{{ $borough->name }} Overview</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="mt-3">
        <a href="{{ url()->previous() }}" class="btn btn-primary" style="margin-left: 500px; width:25%;">Cancel</a>
    </div>
    <br>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">{{ $borough->name }} Overview</h1>
            <p class="lead">Total number of fokontany: {{ $borough->num_fokontany }}</p>
        </div>
       <h2 class="mt-5">List of fokontany:</h2>
        <ul class="list-group">
            @foreach ($borough->fokontany as $fokontany)
                <li class="list-group-item"><a href="/{{ $path }}/fokontany/{{ $fokontany->id }}">{{ $fokontany->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
