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
                <h1 style="text-align: center">Prefecture</h1>
                        <hr>
        <form action="{{ url('/prefecture_save') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-groupe">
                <label for="prefecture_name">Prefecture Name</label><br>
                <input id="prefecture_input" id="prefecture_name" type="text" name="prefecture_name"
                    placeholder="Enter Prefecture Name" style="width: 500px;" class="form-control" required><br>
                <button type="submit" class="btn btn-danger">Add Prefecture</button>
        </form>
        <hr>
        <table class="table table-hover text-center" style="width: 50%">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Prefecture list</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prefet as $prefets)
                    <tr>
                        <td><a href="/show/{{ $prefets->id }}">{{ $prefets->name }}</a></td>
                        <td>
                            <a href="/edit/{{ $prefets->id }}" class="link-dark"><i
                                    class="fa-solid fa-pen-to-square
                            fs-5 me-3"></i></a>
                            <a href="/delete/{{ $prefets->id }}" class="link-dark"
                                onclick="return confirm('Do you really want to delete this prefecture?')"><i
                                    class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-left: 155px">
            {{ $prefet->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
        </div>
    @endsection
