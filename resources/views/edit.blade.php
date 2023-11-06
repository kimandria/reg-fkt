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
</style>

        @if (Session::has('message'))
            <div class="alert alert-success">
                {{Session::get ('message')}}
                {{Session::put ('message', null)}}
            </div>
        @endif

        <h1>Prefecture Update</h1>
        <hr>
        <form action="{{url('/prefecture')}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

        <div class="form-groupe">
        <label for="prefecture_name">Edit Prefecture</label><br>
        <input id="prefecture_input" type="text" id="prefecture_name" name="prefecture_name" value="{{$prefet->name}}" placeholder="Enter Prefecture Name"
                style="width: 300px;" class="form-control"  required><br>
        <input id="id" name="id" type="hidden" value="{{$prefet->id}}" />
        </div>
        <button type="submit" class="btn btn-danger">Update</button>
        <a href="/prefecture" class="btn btn-danger">Cancel</a>
        </form>
@endsection

