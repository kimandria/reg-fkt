@extends('layout.master')

@section('content')
    <style>
        .btn-danger:hover {
            background-color: #00b33c;
            border: none;
        }

        .btn-outline-success:hover {
            background-color: #00b33c;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #000000;
        }
    </style>

    @if (Session::has('message'))
        <div class="alert alert-success" role="combobox">
            {{ Session::get('message') }}
            {{ Session::put('message', null) }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger" role="combobox">
            {{ Session::get('error') }}
            {{ Session::put('error', null) }}
        </div>
    @endif
    <h1 style="text-align: center">Citizens List</h1>
    <hr>
    <table style="width: 75%; margin-left:150px;" class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Firstname</th>
                <th scope="col">Birthdate</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citizens as $item)
                <tr>
                    <td><a href="">{{ $item->last_name }}</a></td>
                    <td>{{ $item->first_name }}</td>
                    <td>{{ $item->birth_date }}</td>
                    <td>
                        <a href="/editcitizens/{{$item ->id}}" class="link-dark"><i
                                class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                        <a href="/deleteCitizens/{{$item ->id}}" class="link-dark"
                            onclick="return confirm('Do you really want to delete this Citizens?')"><i
                                class="fa-solid fa-trash fs-5"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-left: 500px">
         @if ($citizens->count())
             {{ $citizens->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
            @endif
    </div>
    <a href="/citizens" class="btn btn-danger" style="margin-top: 10px; margin-left:360px; width:35%;">Cancel</a>
@endsection
