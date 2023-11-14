<!-- FILEPATH: /c:/register/resources/views/prefecture_user/index.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>{{ $prefecture->name }} Overview</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="display-4">{{ $prefecture->name }}</h1>
        <p class="lead">Total number of districts: {{ $prefecture->num_districts }}</p>
        <p class="lead">Total number of boroughs: {{ $prefecture->num_boroughs }}</p>
        <p class="lead">Total number of fokontany: {{ $prefecture->num_fokontany }}</p>
        <h2 class="mt-5">List of districts:</h2>
        <ul class="list-group">
            @foreach ($prefecture->districts as $district)
                <li class="list-group-item"><a href="/prefectures/district/{{ $district->id }}">{{ $district->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
