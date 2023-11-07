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

<h1 style="text-align: center">Fokontany</h1>
<hr>

<form action="{{ url('/fkt_save') }}" method="POST" class="form-horizontal" onsubmit="return validateForm()">
    {{ csrf_field() }}
    <div class="well">
        <label for="fkt_name">Fokontany Name</label><br>
        <div class="input-group" style="width: 500px;">
            <input id="fkt_id" type="text" name="fkt_name" placeholder="Enter Fokontany Name" class="form-control" required>
            <div class="dropdown" style="margin-left: 10px;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="boroughDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Borough
                </button>
                <div class="dropdown-menu" style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;" aria-labelledby="boroughDropdown" id="dropdownMenu">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search" style="margin-bottom: 10px;">
                    @foreach ($boroughs as $borough)
                        <a class="dropdown-item" href="#" data-id="{{ $borough->id }}" data-name="{{ $borough->name }}" onclick="selectBorough(this)">{{ $borough->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <input type="hidden" name="borough_id" id="boroughId">
        <button type="submit" class="btn btn-danger" style="margin-top: 10px;">Add Fokontany</button>
    </div>
</form>
<hr>

<table class="table table-hover text-center" style="width: 50%">
    <thead class="table-dark">
        <tr>
            <th scope="col">Fokontany list</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fkt as $item)
            <tr>
                <td><a href="/showfkt/{{$item->id}}">{{$item->name}}</a></td>
                <td>
                    <a href="/editfkt/{{$item ->id}}" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                    <a href="/deletefkt/{{$item ->id}}" class="link-dark" onclick="return confirm('Do you really want to delete this Fokontany?')"><i class="fa-solid fa-trash fs-5"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-left: 155px">
    {{ $fkt->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
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
