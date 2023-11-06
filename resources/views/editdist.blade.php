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

        <h1>District Update</h1>
        <hr>

    <form action="{{ url('/district_update')}}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    <div class="well">
        <label for="district_name">District Name</label><br>
        <div class="input-group" style="width: 500px;">
            <input id="district_name" type="text" value="{{ $district->name }}" name="district_name"
                   placeholder="Enter District Name" class="form-control" required>
            <div class="dropdown" style="margin-left: 10px;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="prefectureDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Prefecture
                </button>
                <ul class="dropdown-menu" style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;" aria-labelledby="prefectureDropdown">
                    @foreach ($prefectures as $prefecture)
                        <li><a class="dropdown-item" href="#" data-id="{{ $prefecture->id }}" data-name="{{ $prefecture->name }}" onclick="selectPrefecture(this)">{{ $prefecture->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <input id="id" name="id" type="hidden" value="{{$district->id}}">
        <input type="hidden" name="prefecture_id" id="prefectureId">
        <button type="submit" class="btn btn-danger" style="margin-top: 10px;">Update</button>
        <a href="/district" class="btn btn-danger" style="margin-top: 10px; ">Cancel</a>
    </div>
  </form>

  <script>
    function selectPrefecture(element) {
        let selectedId = element.getAttribute('data-id');
        let selectedName = element.getAttribute('data-name');
        let dropdownButton = document.getElementById('prefectureDropdown');
        dropdownButton.innerText = selectedName;
        document.getElementById('prefectureId').value = selectedId;
    }
</script>
@endsection
