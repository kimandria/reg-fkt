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
    <h1 style="text-align: center">Register List</h1>
    <hr>
    <table style="margin-left:260px; width: 55%;" class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">Register Number</th>
                <th scope="col">Sector</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($register as $item)
                <tr>
                    <td><a href="">{{ $item->num }}</a></td>
                    <td>{{ $item->sector }}</td>
                    <td>
                        <a href="/editRegister/{{ $item->id }}" class="link-dark"><i
                                class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                        <a href="/deleteRegister/{{ $item->id }}" class="link-dark"
                            onclick="return confirm('Do you really want to delete this Register?')"><i
                                class="fa-solid fa-trash fs-5"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-left: 500px">
        @if ($register->count())
            {{-- Pagination links --}}
            {{ $register->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
        @endif
    </div>
    <a href="/register" class="btn btn-danger" style="margin-top: 10px; margin-left:360px; width:35%;">Cancel</a>
@endsection
