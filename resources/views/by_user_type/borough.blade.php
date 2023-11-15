<!-- FILEPATH: /c:/register/resources/views/borough_user/index.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>{{ $borough->name }} Overview</title>
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
        <button style="margin-top:10px; margin-left:500px; width:25%;"><a href="logout">Log Out</a></button>
    </div>
    <div class="container">
        <h1 class="display-4">{{ $borough->name }}</h1>
        <p class="lead">Total number of fokontany: {{ $borough->num_fokontany }}</p>
        <h2 class="mt-5">List of fokontany:</h2>
        <ul class="list-group">
            @foreach ($borough->fokontany as $fokontany)
                <li class="list-group-item"><a href="/boroughs/fokontany/{{ $fokontany->id }}">{{ $fokontany->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
