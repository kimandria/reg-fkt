<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Movement list</title>
</head>
<body>
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('message') }}.
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{Session::put ('message', null)}}
    </div>
@endif
    <div class="container mt-5">
        <h1 style="text-align: center">Movement list</h1>
        <hr>
        <table style="width: 75%; margin-left:150px;" class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Book ID</th>
                    <th scope="col">From the Fokontany</th>
                    <th scope="col">To the Fokontany</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movement as $item)
                    <tr>
                        <td><a href="">{{ $item->book->num }}</a></td>
                        <td>{{ $item->fromfokontany->name }}</td>
                        <td>{{ $item->tofokontany->name }}</td>
                        <td>
                            <a href="/fokontany/movement/edit/{{$item ->id}}" class="link-dark"><i
                                    class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="/fokontany/movement/delete/{{$item ->id}}" class="link-dark"
                                onclick="return confirm('Do you really want to delete this Movement?')"><i
                                    class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/fokontany/movement" class="btn btn-primary" style="margin-left: 430px; width:25%;">Cancel</a>
        <div style="margin-left:500px">
            {{ $movement->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
