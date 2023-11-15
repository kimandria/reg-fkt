<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('message') }}.
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{Session::put ('message', null)}}
    </div>
@endif
<div class="container">

    <h1>List of Citizens</h1>
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Birth Date</th>
                    <th scope="col">Birth Place</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Job</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citizens as $citizen)
                    <tr>
                        <td>{{ $citizen->first_name }}</td>
                        <td>{{ $citizen->last_name }}</td>
                        <td>{{ $citizen->birth_date }}</td>
                        <td>{{ $citizen->birth_place }}</td>
                        <td>{{ $citizen->phone_num }}</td>
                        <td>{{ $citizen->job }}</td>
                        <td>
                            <a href="/fokontany/citizens/edit/{{ $citizen->id }}" class="link-dark"><i
                                    class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="/fokontany/citizens/delete/{{ $citizen->id }}" class="link-dark"
                                onclick="return confirm('Do you really want to delete this Citizens?')"><i
                                    class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-left: 500px; ">
            @if ($citizens->count())
            {{ $citizens->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
           @endif
        </div>
    </div>
    <div>
        <a href="/fokontany" class="btn btn-primary" style="margin-left: 350px; width:50%;">Cancel</a>
    </div>

</body>
</html>
