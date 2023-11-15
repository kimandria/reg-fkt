<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Add Movement</title>
</head>
<body>
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('message') }}.
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{Session::put ('message', null)}}
    </div>
@endif
<div class="container mt-5">
    <a href="{{ url('/fokontany') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-arrow-left"></i></a>
   <h1 style="text-align: center">Movement</h1>
    <hr>
    <a href="/fokontany/movement/list">
        <button style="margin-left: 490px">Go To Movement List</button>
    </a>
    <hr>
    <form action="{{ url('/fokontany/movement') }}" method="POST" class="form-horizontal" onsubmit="return validateForm()">
        {{ csrf_field() }}
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pending">Status :</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="pending" name="pending">
                            <label class="form-check-label" for="pending">
                               Confirmed
                            </label>
                            </div>
                            <label for="arrival_date">Arrival date</label><br>
                            <div class="input-group">
                                <input id="arrival_date_id" type="date" name="arrival_date" class="form-control">
                            </div>
                        <label for="departure_date" style="margin-top: 14px">Departure date</label>
                        <div class="input-group">
                            <input id="departure_date_id" type="Date" name="departure_date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="margin-top: 45px">
                <div class="dropdown" style="margin-left: 10px;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="fktDropdown" data-toggle="dropdown" aria-expanded="false">
                        Select Fokontany
                    </button>
                    <div class="dropdown-menu" style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;" aria-labelledby="fktDropdown" id="fktDropdownMenu">
                        <input type="text" class="form-control" id="fktSearchInput" placeholder="Search" style="margin-bottom: 10px;">
                        @foreach ($fkt as $fokontany)
                            <a class="dropdown-item" href="#" data-id="{{ $fokontany->id }}" data-name="{{ $fokontany->name }}" onclick="selectItem(this, 'fkt_Id', 'fktDropdown')">{{ $fokontany->name }}</a>
                        @endforeach
                    </div>
                </div>
                <br>
            <div class="dropdown" style="margin-left: 10px;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="fokontanyDropdown" data-toggle="dropdown" aria-expanded="false">
                    Select Fokontany
                </button>
                <div class="dropdown-menu" style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;" aria-labelledby="fokontanyDropdown" id="fokontanyDropdownMenu">
                    <input type="text" class="form-control" id="fokontanySearchInput" placeholder="Search" style="margin-bottom: 10px;">
                    @foreach ($fkt as $fokontany)
                        <a class="dropdown-item" href="#" data-id="{{ $fokontany->id }}" data-name="{{ $fokontany->name }}" onclick="selectItem(this, 'fokontanyID', 'fokontanyDropdown')">{{ $fokontany->name }}</a>
                    @endforeach
                </div>
            </div>
            <br>
        <div class="dropdown" style="margin-left: 10px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="bookDropdown" data-toggle="dropdown" aria-expanded="false">
                Select Book ID
            </button>
            <div class="dropdown-menu" style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;" aria-labelledby="bookDropdown" id="bookDropdownMenu">
                <input type="text" class="form-control" id="bookSearchInput" placeholder="Search" style="margin-bottom: 10px;">
                @foreach ($book as $books)
                    <a class="dropdown-item" href="#" data-id="{{ $books->id }}" data-name="{{ $books->num }}" onclick="selectItem(this, 'bookID', 'bookDropdown')">{{ $books->num }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <input type="hidden" name="book_id" id="bookID">
    <input type="hidden" name="fokontany_id" id="fokontanyID">
    <input type="hidden" name="fkt_id" id="fkt_Id">
    <div>
        <button type="submit" class="btn btn-primary" style="margin-top:50px; margin-left:400px; width:30%">Add Movement</button>
    </div>
 </form>
 <script>
    function selectItem(element, inputFieldId, dropdownId) {
        let selectedId = element.getAttribute('data-id');
        let selectedName = element.getAttribute('data-name');
        let dropdownButton = document.getElementById(dropdownId);
        dropdownButton.innerText = selectedName;
        document.getElementById(inputFieldId).value = selectedId;
    }
    function filterItems(inputId, menuId) {
        const filter = document.getElementById(inputId).value.toUpperCase();
        const dropdownMenu = document.getElementById(menuId);
        const items = dropdownMenu.getElementsByTagName('a');
        for (let i = 0; i < items.length; i++) {
            const textValue = items[i].textContent || items[i].innerText;
            if (textValue.toUpperCase().indexOf(filter) > -1) {
                items[i].style.display = '';
            } else {
                items[i].style.display = 'none';
            }
        }
    }
    function validateForm() {
        var selectedFokontany = document.getElementById('fkt_Id').value;
        var selectedFkt = document.getElementById('fokontanyID').value;
        var selectedbook = document.getElementById('bookID').value;
        if (!selectedFokontany || !selectedFkt || !selectedbook) {
            alert("Please select a Fokotany");
            return false;
        }
        if (selectedFokontany == selectedFkt) {
            alert("Please select a different Fokotany for the second dropdown menu");
            return false;
        }
        if (!selectedbook) {
            alert("Please select a Book");
            return false;
        }
        return true;
    }
    document.getElementById('fktSearchInput').addEventListener('input', function() {
        filterItems('fktSearchInput', 'fktDropdownMenu');
    });
    document.getElementById('fokontanySearchInput').addEventListener('input', function() {
        filterItems('fokontanySearchInput', 'fokontanyDropdownMenu');
    });
    document.getElementById('bookSearchInput').addEventListener('input', function() {
        filterItems('bookSearchInput', 'bookDropdownMenu');
    });
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</div>
</body>
</html>
