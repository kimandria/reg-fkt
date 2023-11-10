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

    <h1 style="text-align: center">Citizens</h1>
    <hr>
    <form action="{{ url('/citizens_update') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label><br>
                        <div class="input-group">
                            <input id="name_id" value="{{$citizens->last_name}}" type="text" name="name" placeholder="Enter name" class="form-control" required>
                        </div>
                        <label for="firstname">Firstname</label><br>
                        <div class="input-group">
                            <input id="firstname_id" value="{{$citizens->first_name}}"  type="text" name="firstname" placeholder="Enter firstname " class="form-control" required>
                        </div>
                        <label for="father">Father</label><br>
                        <div class="input-group">
                            <input id="father_id" type="text" value="{{$citizens->father}}"  name="father" placeholder="Enter father name" class="form-control" required>
                        </div>
                        <label for="mother">Mother</label><br>
                        <div class="input-group">
                            <input id="mother_id" type="text" value="{{$citizens->mother}}"  name="mother" placeholder="Enter mother name" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone_num">Phone Number</label><br>
                        <div class="input-group">
                            <input id="phone_num_id" type="text" value="{{$citizens->phone_num}}" name="phone_num" placeholder="Enter phone number" class="form-control" required maxlength="15">
                        </div>
                        <label for="email">Email</label><br>
                        <div class="input-group">
                            <input id="email_id" type="email" value="{{$citizens->email}}" name="email" placeholder="Enter email" class="form-control" style="width: 200px" required>
                        </div>
                        <label for="birth_place">Birthplace</label><br>
                        <div class="input-group">
                            <input id="birth_place_id" type="text" value="{{$citizens->birth_place}}"   name="birth_place" placeholder="Enter Birthplace" class="form-control"required>
                        </div>
                        <label for="birth_date">Birthdate</label><br>
                        <div class="input-group">
                            <input id="birth_date_id" type="date" value="{{$citizens->birth_date}}"  name="birth_date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="job">Job</label><br>
                            <input id="job_id" type="text" value="{{$citizens->job}}"  name="job" placeholder="Enter occupation" class="form-control" required>
                        </div>
                        <label for="cin">C.I.N Number</label><br>
                        <div class="input-group">
                            <input id="cin_id" type="text" value="{{$citizens->nic_num}}"  name="cin" placeholder="Enter C.I.N Number" class="form-control" required>
                        </div>
                        <label for="nic_place">Place of Issuance</label><br>
                        <div class="input-group">
                            <input id="nic_place_id" type="text" value="{{$citizens->nic_place}}"  name="nic_place" placeholder="Place of Issuance" class="form-control"required>
                        </div>
                        <label for="nic_date">Date of Manufacture</label><br>
                        <div class="input-group">
                            <input id="nic_date_id" value="{{$citizens->nic_date}}"  type="date" name="nic_date" class="form-control" required>
                        </div>
                        <input id="id" name="id" type="hidden" value="{{$citizens->id}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group" style="margin-top: 50px; margin-left: 600px">
            <div class="col-md-6">
                <button type="submit" class="btn btn-danger">Update</button>
                <a href="/citizenslist" class="btn btn-danger" style="margin-left: 5px;">Cancel</a>
            </div>
        </div>
    </form>
@endsection
