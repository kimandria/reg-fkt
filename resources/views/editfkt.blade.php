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
        {{ Session::get('message') }}
        {{ Session::put('message', null) }}
    </div>
@endif

<div style="width: 50%; margin: 0 auto;">
    <h1 style="text-align: center">Fokontany Update</h1>
    <hr>

    <form action="{{ url('/fkt_update') }}" method="POST" class="form-horizontal" onsubmit="return validateForm()">
        {{ csrf_field() }}
        <label for="fkt_name">Fokontany Name</label><br>
        <div class="well" style="display: flex; align-items: center;">
            <div class="input-group" style="width: 500px;">
                <input id="fkt_id" type="text" value="{{$fkt->name}}" name="fkt_name" placeholder="Enter Fokontany Name" class="form-control" required>
            </div>
            <div class="dropdown" style="margin-left: 10px;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="boroughDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                   Select Borough
                </button>
                <div class="dropdown-menu custom-dropdown" style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;" aria-labelledby="boroughDropdown" id="dropdownMenu">
                    <input type="text" class="form-control" id="searchInput" oninput="filterFunction()" placeholder="Search" style="margin-bottom: 10px;">
                    @foreach ($boroughs as $borough)
                        <a class="dropdown-item" href="#" data-id="{{ $borough->id }}" data-name="{{ $borough->name }}" onclick="selectBorough(this)">{{ $borough->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <input id="id" name="id" type="hidden" value="{{$fkt->id}}">
        <input type="hidden" name="borough_id" id="boroughId">

        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12" style="display: flex;">
                <button type="submit" class="btn btn-danger">Update</button>
                <a href="/fonkotany" class="btn btn-danger" style="margin-left: 5px;">Cancel</a>
            </div>
        </div>
    </form>
</div>

<script>
    function selectBorough(element) {
        let selectedId = element.getAttribute('data-id');
        let selectedName = element.getAttribute('data-name');
        let dropdownButton = document.getElementById('boroughDropdown');
        dropdownButton.innerText = selectedName;
        document.getElementById('boroughId').value = selectedId;
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
            var selectedFokontany = document.getElementById('boroughId').value;
            if (!selectedFokontany) {
                alert("Please select a Borough");
                return false;
            }
            return true;
        }
    </script>
@endsection
