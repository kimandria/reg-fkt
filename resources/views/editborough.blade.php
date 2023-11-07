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
    <div class="alert alert-success" role="combobox">
        {{ Session::get ('message') }}
        {{ Session::put ('message', null) }}
    </div>
@endif

<div style="width: 50%; margin: 0 auto;">
    <h1>Borough Update</h1>
    <hr>
    <form action="{{ url('/borough_update') }}" method="POST" class="form-horizontal" onsubmit="return validateForm()">
        {{ csrf_field() }}
        <div class="well">
            <label for="borough_name">Borough Name</label><br>
            <div class="input-group" style="width: 500px;">
                <input id="borough_id" type="text" value="{{ $borough->name }}" name="borough_name"
                       placeholder="Enter Borough Name" class="form-control" required>
                <div class="dropdown" style="margin-left: 10px;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="districtDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Select District
                    </button>
                    <div class="dropdown-menu custom-dropdown" style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;" aria-labelledby="districtDropdown">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search" style="margin-bottom: 10px;">
                        @foreach ($districts as $district)
                            <a class="dropdown-item" href="#" data-id="{{ $district->id }}" data-name="{{ $district->name }}" onclick="selectDistrict(this)">{{ $district->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <input id="id" name="id" type="hidden" value="{{$borough->id}}">
            <input type="hidden" name="district_id" id="districtId">
            <button type="submit" class="btn btn-danger" style="margin-top: 10px;">Update</button>
            <a href="/borough" class="btn btn-danger" style="margin-top: 10px; ">Cancel</a>
        </div>
    </form>
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
