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

                <h1 style="text-align: center">District</h1>
                <hr>
                <form action="{{ url('/district') }}" method="POST" class="form-horizontal"  onsubmit="return validateForm()">
                    {{ csrf_field() }}
                 <div class="well">
                    <label for="district_name">District Name</label><br>
                     <div class="input-group" style="width: 500px;">
                     <input id="district_name" type="text" name="district_name"
                     placeholder="Enter District Name" class="form-control" required>
                    <div class="dropdown" style="margin-left: 10px;">
                     <button class="btn btn-secondary dropdown-toggle" type="button" id="prefectureDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Prefecture
                     </button>
                    <div class="dropdown-menu" style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;" aria-labelledby="prefectureDropdown" id="dropdownMenu">
                     <input type="text" class="form-control" id="searchInput" placeholder="Search">
                     @foreach ($prefectures as $prefecture)
                     <a class="dropdown-item" href="#" data-id="{{ $prefecture->id }}" data-name="{{ $prefecture->name }}" onclick="selectPrefecture(this)">{{ $prefecture->name }}</a>
                     @endforeach
                    </div>
                </div>
            </div>
                <input type="hidden" name="prefecture_id" id="prefectureId">
                <button type="submit" class="btn btn-danger" style="margin-top: 10px;">Add District</button>
            </div>
            </form>
            <hr>
            <div>
            <table class="table table-hover text-center" style="width: 50%">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">District list</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
            <tbody>
                @foreach ($districts as $item)
                    <tr>
                    <td><a href="/showdist/{{$item->id}}">{{$item->name}}</a></td>
                    <td>
                    <a href="/editdist/{{$item ->id}}" class="link-dark"><i class="fa-solid fa-pen-to-square
                                fs-5 me-3"></i></a>
                    <a href="/deleteDist/{{$item ->id}}" class="link-dark" onclick="return confirm('Do you really want to delete this district?')"><i class="fa-solid fa-trash fs-5"></i></a>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="margin-left: 155px">
                    {{ $districts->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
                </div>
            </div>

            <script>
                function selectPrefecture(element) {
                    let selectedId = element.getAttribute('data-id');
                    let selectedName = element.getAttribute('data-name');
                    let dropdownButton = document.getElementById('prefectureDropdown');
                    dropdownButton.innerText = selectedName;
                    document.getElementById('prefectureId').value = selectedId;
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
            var selectedFokontany = document.getElementById('prefectureId').value;
            if (!selectedFokontany) {
                alert("Please select a Prefecture");
                return false;
            }
            return true;
        }
            </script>

          @endsection

