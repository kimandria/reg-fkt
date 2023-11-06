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

        <h1>Borough Update</h1>
        <hr>
        <form action="{{ url('/borough_update') }}" method="POST" class="form-horizontal">
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
                        <ul class="dropdown-menu" style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;" aria-labelledby="districtDropdown">
                            @foreach ($districts as $district)
                                <li><a class="dropdown-item" href="#" data-id="{{ $district->id }}" data-name="{{ $district->name }}" onclick="selectDistrict(this)">{{ $district->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <input id="id" name="id" type="hidden" value="{{$borough->id}}">
                <input type="hidden" name="district_id" id="districtId">
                <button type="submit" class="btn btn-danger" style="margin-top: 10px;">Update</button>
                <a href="/borough" class="btn btn-danger" style="margin-top: 10px; ">Cancel</a>
            </div>
        </form>
        <script>
            function selectDistrict(element) {
                let selectedId = element.getAttribute('data-id');
                let selectedName = element.getAttribute('data-name');
                let dropdownButton = document.getElementById('districtDropdown');
                dropdownButton.innerText = selectedName;
                document.getElementById('districtId').value = selectedId;
            }
        </script>
@endsection
