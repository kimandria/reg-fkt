@extends('layout.master')
@section('content')
    <h1>Administration</h1>
    <a href="/admin/createuser" class="btn btn-primary">Create New User</a>
    @include('admin.users')
@endsection
