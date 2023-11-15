<!-- FILEPATH: /c:/register/resources/views/prefecture_user/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $prefecture->name }} Overview</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        h1, h2 {
            color: #007bff;
        }

        .lead {
            font-size: 1.2em;
            color: #343a40;
        }

        .list-group-item {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-top: 10px;
        }

        .list-group-item a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #000000;
        }

        .list-group-item a:hover {
            background-color: #007bff;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div>
        <button style=" margin-top:10px; margin-left:500px; width:25%;"><a href="logout">Log Out</a></button>
    </div>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">{{ $prefecture->name }} Overview</h1>
            <p class="lead"> <strong>Total number of districts: </strong> {{ $prefecture->num_districts }}</p>
            <p class="lead"><strong> number of boroughs:</strong> {{ $prefecture->num_boroughs }}</p>
            <p class="lead"> <strong>Total number of fokontany:</strong> {{ $prefecture->num_fokontany }}</p>
        </div>
            <h2>List of districts:</h2>
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
