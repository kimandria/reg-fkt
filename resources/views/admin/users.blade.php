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
                {{Session::get ('message')}}
                {{Session::put ('message', null)}}
            </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger" role="combobox">
            {{Session::get ('error')}}
            {{Session::put ('error', null)}}
        </div>
    @endif

    <h1 style="text-align: center">Users</h1>
    <a href="/admin/createuser" class="btn btn-danger" style="margin-bottom: 10px">Create New User</a>
    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Is Admin</th>
                <th scope="col">Territory</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                    <td>{{ $user->territory_label }}</td>
                    <td>
                        <a href="/admin/edituser/{{ $user->id }}" class="link-dark"><i
                            class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                        <a href="/admin/deleteuser/{{ $user->id }}" class="link-dark"
                            onclick="return confirm('Do you really want to delete this Citizens?')"><i
                                class="fa-solid fa-trash fs-5"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-left: 500px">
            {{ $users->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
   </div>
@endsection
