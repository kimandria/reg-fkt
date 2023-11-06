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

        <h1>Fokontany Update</h1>
        <hr>
        <form action="{{ url('/fkt_update') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="well">
                <label for="fkt_name">Fokontany Name</label><br>
                <div class="input-group" style="width: 500px;">
                    <input id="fkt_id" type="text" value="{{$fkt->name}}" name="fkt_name"
                           placeholder="Enter Fokontany Name" class="form-control" required>
                    <div class="dropdown" style="margin-left: 10px;">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="boroughDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Borough
                        </button>
                        <ul class="dropdown-menu" style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;" aria-labelledby="boroughDropdown">
                            @foreach ($boroughs as $borough)
                                <li><a class="dropdown-item" href="#" data-id="{{ $borough->id }}" data-name="{{ $borough->name }}" onclick="selectBorough(this)">{{ $borough->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <input id="id" name="id" type="hidden" value="{{$fkt->id}}">
                <input type="hidden" name="borough_id" id="boroughId">
                <button type="submit" class="btn btn-danger" style="margin-top: 10px;">Update</button>
                <a href="/fonkotany" class="btn btn-danger" style="margin-top: 10px; ">Cancel</a>

            </div>
        </form>
        <script>
            function selectBorough(element) {
                let selectedId = element.getAttribute('data-id');
                let selectedName = element.getAttribute('data-name');
                let dropdownButton = document.getElementById('boroughDropdown');
                dropdownButton.innerText = selectedName;
                document.getElementById('boroughId').value = selectedId;
            }
        </script>
@endsection
