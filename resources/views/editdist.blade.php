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

<div style="width: 50%; margin: 0 auto;">
    <h1 style="text-align: center">District Update</h1>
    <hr>

    <label for="district_name">District Name</label> <br>
    <form action="{{ url('/district_update')}}" method="POST" class="form-horizontal"  onsubmit="return validateForm()">
        {{ csrf_field() }}
        <div class="well" style="display: flex; align-items: center;">
            <div class="input-group" style="flex: 1;">
                <input id="district_name" type="text" value="{{ $district->name }}" name="district_name" placeholder="Enter District Name" class="form-control" required>
            </div>

            <div class="dropdown" style="margin-left: 10px;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="prefectureDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                   Select Prefecture
                </button>
                <div class="dropdown-menu custom-dropdown" style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;" aria-labelledby="prefectureDropdown">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search" style="margin-bottom: 10px;" onkeyup="filterFunction()">
                    @foreach ($prefectures as $prefecture)
                        <a class="dropdown-item" href="#" data-id="{{ $prefecture->id }}" data-name="{{ $prefecture->name }}" onclick="selectPrefecture(this)">{{ $prefecture->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>

        <input id="id" name="id" type="hidden" value="{{$district->id}}">
        <input type="hidden" name="prefecture_id" id="prefectureId">

        <div style="margin-top: 10px; display: flex;">
            <button type="submit" class="btn btn-danger">Update</button>
            <a href="/district" class="btn btn-danger" style="margin-left: 5px">Cancel</a>
        </div>
    </form>
</div>

<script>
    function selectPrefecture(element) {
        let selectedId = element.getAttribute('data-id');
        let selectedName = element.getAttribute('data-name');
        let dropdownButton = document.getElementById('prefectureDropdown');
        dropdownButton.innerText = selectedName;
        document.getElementById('prefectureId').value = selectedId;
    }

    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        div = document.querySelector('.custom-dropdown');
        a = div.getElementsByTagName('a');
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = '';
            } else {
                a[i].style.display = 'none';
            }
        }
    }
    function validateForm() {
            var selectedFokontany = document.getElementById('prefectureId').value;
            if (!selectedFokontany) {
                alert("Please select a Prefecture");
                return false;
            }
            return true;
        }
</script>
@endsection
