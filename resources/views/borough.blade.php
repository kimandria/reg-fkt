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

<h1 style="text-align: center">Borough</h1>

<hr>
<form action="{{ url('/borough_save') }}" method="POST" class="form-horizontal" onsubmit="return validateForm()">
    {{ csrf_field() }}
    <div class="well">
        <label for="borough_name">Borough Name</label><br>
        <div class="input-group" style="width: 500px;">
            <input id="borough_id" type="text" name="borough_name" placeholder="Enter Borough Name"
                class="form-control" required>
            <div class="dropdown" style="margin-left: 10px;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="districtDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Select District
                </button>
                <div class="dropdown-menu custom-dropdown" aria-labelledby="districtDropdown"
                    style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search"
                        style="margin-bottom: 10px;">
                    @foreach ($districts as $district)
                        <a class="dropdown-item" href="#" data-id="{{ $district->id }}"
                            data-name="{{ $district->name }}" onclick="selectDistrict(this)">{{ $district->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <input type="hidden" name="district_id" id="districtId">
        <button type="submit" class="btn btn-danger" style="margin-top: 10px;">Add Borough</button>
    </div>
</form>
<hr>
<table class="table table-hover text-center" style="width: 50%">
    <thead class="table-dark">
        <tr>
            <th scope="col">Borough list</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($boroughs as $item)
            <tr>
                <td><a href="/showborough/{{ $item->id }}">{{ $item->name }}</a></td>
                <td>
                    <a href="/editborough/{{ $item->id }}" class="link-dark"><i
                            class="fa-solid fa-pen-to-square
                            fs-5 me-3"></i></a>
                    <a href="/deleteborough/{{ $item->id }}" class="link-dark"
                        onclick="return confirm('Do you really want to delete this borough?')"><i
                            class="fa-solid fa-trash fs-5"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div style="margin-left: 155px">
    {{ $boroughs->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
</div>

<script>
    function selectDistrict(element) {
        let selectedId = element.getAttribute('data-id');
        let selectedName = element.getAttribute('data-name');
        let dropdownButton = document.getElementById('districtDropdown');
        dropdownButton.innerText = selectedName;
        document.getElementById('districtId').value = selectedId;
    }

    document.getElementById('searchInput').addEventListener('input', function() {
        const filter = this.value.toUpperCase();
        const dropdownMenu = document.querySelector('.custom-dropdown');
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
            var selectedFokontany = document.getElementById('districtId').value;
            if (!selectedFokontany) {
                alert("Please select a District");
                return false;
            }
            return true;
        }
</script>
@endsection
