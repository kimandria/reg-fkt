@extends('layout.master')

@section('content')
    <style>
        .btn-danger:hover {
            background-color: #00b33c;
            border:none;
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

     <h1 style="text-align: center">Movement list</h1>
    <hr>
    <table style="width: 55%; margin-left:250px;" class="table table-hover text-center">
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
                        <a href="/editmovement/{{$item ->id}}" class="link-dark"><i
                                class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                        <a href="/deleteMovement/{{$item ->id}}" class="link-dark"
                            onclick="return confirm('Do you really want to delete this Movement?')"><i
                                class="fa-solid fa-trash fs-5"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/movement" class="btn btn-danger" style="margin-left: 500px">Cancel</a>
    {{-- <div style="margin-left:500px">
        {{ $movement->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
    </div> --}}
@endsection
