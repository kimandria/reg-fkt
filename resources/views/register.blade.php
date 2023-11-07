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

    <h1 style="text-align: center">Register</h1>
    <hr>
    <a href="/register_list"><button style="margin-left: 490px">Go To Register List</button></a> <hr>
    <form action="{{ url('/register_save') }}" method="POST" class="form-horizontal" onsubmit="return validateForm()">
        {{ csrf_field() }}
        <div class="well">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="register_num">Register Number</label><br>
                        <div class="input-group">
                            <input id="register_id" type="text" name="register_num" placeholder="Enter register number" class="form-control" required maxlength="7">
                        </div>
                        <label for="adress">Address</label><br>
                        <div class="input-group">
                            <input id="adress_id" type="text" name="adress" placeholder="Enter Address" class="form-control" required>
                        </div>
                        <label for="phone_num">Phone Number</label><br>
                        <div class="input-group">
                            <input id="phone_id" type="text" name="phone_num" placeholder="Enter Phone number" class="form-control" required maxlength="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sector_name">Sector</label><br>
                        <div class="input-group">
                            <input id="field_id" type="text" name="sector_name" placeholder="Enter Sector name" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="carnet_num">Carnet Number</label><br>
                        <div class="input-group">
                            <input id="carnet_id" type="text" name="carnet_num" placeholder="Enter Carnet number" class="form-control" required maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label><br>
                            <div class="input-group">
                                <input id="email_id" type="email" name="email_name" placeholder="Enter Email" class="form-control" style="width: 200px" required>
                            </div>
                        </div>
                    <div class="form-group">
                        <label for="origin_name">Origin Fokontany</label><br>
                        <div class="input-group">
                            <input id="origin_id" type="text" name="origin_name" placeholder="Enter Origin Fokontany name" class="form-control" required>
                        </div>
                        <div class="dropdown" style="margin-top: 24px;">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="fktDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Fokontany
                                    </button>
                                    <div class="dropdown-menu" style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;" aria-labelledby="fktDropdown" id="dropdownMenu">
                                        <input type="text" class="form-control" id="searchInput" placeholder="Search" style="margin-bottom: 10px;">
                                        @foreach ($fkts as $item)
                                            <a class="dropdown-item" href="#" data-id="{{ $item->id }}" data-name="{{ $item->name }}" onclick="selectfkt(this)">{{ $item->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
        <label for="modified_name" style="display: inline-block; width: 150px; margin-top:10px;">Modified at</label>
        <div class="input-group" style="display: inline-block; width: 200px;">
            <input id="modified_id" type="date" name="modified_name" required>
        </div><br>

        <label for="arrival_name" style="display: inline-block; width: 150px; margin-top:10px;">Arrival date</label>
        <div class="input-group" style="display: inline-block; width: 200px;">
            <input id="arrival_id" type="date" name="arrival_name" required>
        </div><br>

        <label for="departure_name" style="display: inline-block; width: 150px; margin-top:10px;">Departure date</label>
        <div class="input-group" style="display: inline-block; width: 200px;">
            <input id="departure_id" type="date" name="departure_name">
        </div><br>
        <input type="hidden" name="fkt_id" id="fktId">
        <div class="form-groupe" style="margin-top: 10px;">
        <div class="col-md-6">

        <div class="col-md-6">
            <button  class="btn btn-danger" style="margin-left:500px; width:50%;">Add Register</button>
        </div>
    </form>
    <script>
        function selectfkt(element) {
            let selectedId = element.getAttribute('data-id');
            let selectedName = element.getAttribute('data-name');
            let dropdownButton = document.getElementById('fktDropdown');
            dropdownButton.innerText = selectedName;
            document.getElementById('fktId').value = selectedId;
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            const filter = this.value.toUpperCase();
            const dropdownMenu = document.getElementById('dropdownMenu');
            const items = dropdownMenu.getElementsByTagName('a');
            for (let i = 0; i < items.length; i++) {
                const textValue = items[i].textContent || items[i].innerText;
                if (textValue.toUpperCase().indexOf(filter) > -1) {
                    items[i].style.display = '';
                } else {
                    items[i].style.display = 'none';
                }
            }
        });
        function validateForm() {
    var selectedFokontany = document.getElementById('fktId').value;
    if (!selectedFokontany) {
        alert("Please select a Fokontany");
        return false;
    }
    return true;
}
    </script>
@endsection
