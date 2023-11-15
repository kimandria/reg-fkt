<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Book</title>
</head>
<body>
    <div class="container mt-5">

    <h1 style="text-align: center">Book Update</h1>
    <hr>
    <form action="{{ url('/fokontany/book/update') }}" method="POST" class="form-horizontal" onsubmit="return validateForm()">
        {{ csrf_field() }}
        <div class="well">
            <label for="book_num">Book ID</label><br>
            <div class="input-group" style="width: 500px;">
                <input id="book_num_id" type="text" value="{{ $book->num }}" name="book_num"
                    placeholder="Enter Book Number" class="form-control" required>
                <div class="dropdown" style="margin-left: 10px;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="fktDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        Select Fokontany
                    </button>
                    <div class="dropdown-menu"
                        style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;"
                        aria-labelledby="fktDropdown" id="fktDropdownMenu">
                        <input type="text" class="form-control" id="fktSearchInput" placeholder="Search"
                            style="margin-bottom: 10px;">
                        @foreach ($fkt as $fokontany)
                            <a class="dropdown-item" href="#" data-id="{{ $fokontany->id }}"
                                data-name="{{ $fokontany->name }}"
                                onclick="selectItem(this, 'fkt_Id', 'fktDropdown')">{{ $fokontany->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <label for="first_head_id" style="margin-top: 20px; display: inline-block;">Select First Head</label>
        <div class="dropdown" style="display: inline-block; margin-left:60px;">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="firstDropdown" data-toggle="dropdown" aria-expanded="false">
                Select Name
            </button>
            <div class="dropdown-menu"
                style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;"
                aria-labelledby="firstDropdown" id="firstDropdownMenu">
                <input type="text" class="form-control" id="firstSearchInput" placeholder="Search"
                    style="margin-bottom: 10px;">
                @foreach ($citizens as $citizen)
                    <a class="dropdown-item" href="#" data-id="{{ $citizen->id }}"
                        data-name="{{ $citizen->last_name }}"
                        onclick="selectItem(this, 'firstHeadId', 'firstDropdown')">{{ $citizen->last_name }}</a>
                @endforeach
            </div>
        </div>
        <br>
        <label for="second_head_id" style="margin-top: 20px; display: inline-block;">Select Second Head</label>
        <div class="dropdown" style="display: inline-block; margin-left:38px;">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="secondDropdown"
                data-toggle="dropdown" aria-expanded="false">
                Select Name
            </button>
            <div class="dropdown-menu"
                style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;"
                aria-labelledby="secondDropdown" id="secondDropdownMenu">
                <input type="text" class="form-control" id="secondSearchInput" placeholder="Search"
                    style="margin-bottom: 10px;">
                @foreach ($citizens as $citizen)
                    <a class="dropdown-item" href="#" data-id="{{ $citizen->id }}"
                        data-name="{{ $citizen->last_name }}"
                        onclick="selectItem(this, 'secondHeadId', 'secondDropdown')">{{ $citizen->last_name }}</a>
                @endforeach
            </div>
        </div>
        <br>
        <label for="children_head_id" style="margin-top: 20px; display: inline-block;">Select Children</label>
        <div class="dropdown" style="display: inline-block; margin-left:71px;">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="childrenDropdown"
                data-toggle="dropdown" aria-expanded="false">
                Select Names
            </button>
            <div class="dropdown-menu"
                style="max-height: 200px; overflow-y: auto; background-color: #d3e0de; color: #010407;"
                aria-labelledby="childrenDropdown" id="childrenDropdownMenu" style="width: 300px;">
                <input type="text" class="form-control" id="childrenSearchInput" placeholder="Search"
                    style="margin-bottom: 10px;">
                @foreach ($citizens as $citizen)
                    <a class="dropdown-item" href="#" data-type="childitem" data-id="{{ $citizen->id }}"
                        data-name="{{ $citizen->last_name }}" onclick="selectChild(this)">{{ $citizen->last_name }}</a>
                @endforeach
            </div>
        </div>
        <div style="margin-top: 10px;" id="selectedChildren">
            Selected Children:
        </div>
        <input type="hidden" name="selectedChildrenIds" id="selectedChildrenIds">
        <br>
        <input type="hidden" name="first_head_id" id="firstHeadId">
        <input type="hidden" name="second_head_id" id="secondHeadId">
        <input type="hidden" name="fkt_id" id="fkt_Id">
        <input id="id" name="id" type="hidden" value="{{ $book->id }}">
        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Update</button>
        <a href="/fokontany/book" class="btn btn-primary" style="margin-left: 5px; margin-top: 10px;">Cancel</a>
    </form>
    <script>
        function selectItem(element, inputFieldId, dropdownId) {
            let selectedId = element.getAttribute('data-id');
            let selectedName = element.getAttribute('data-name');
            let dropdownButton = document.getElementById(dropdownId);
            dropdownButton.innerText = selectedName;
            document.getElementById(inputFieldId).value = selectedId;
        }

        function validateForm() {
            var selectedFokontany = document.getElementById('fkt_Id').value;
            if (!selectedFokontany) {
                alert("Please select a Fokotany");
                return false;
            }
            return true;
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

        document.getElementById('fktSearchInput').addEventListener('input', function() {
            filterItems('fktSearchInput', 'fktDropdownMenu');
        });

        document.getElementById('firstSearchInput').addEventListener('input', function() {
            filterItems('firstSearchInput', 'firstDropdownMenu');
        });

        document.getElementById('secondSearchInput').addEventListener('input', function() {
            filterItems('secondSearchInput', 'secondDropdownMenu');
        });
        document.getElementById('childrenSearchInput').addEventListener('input', function() {
            filterItems('childrenSearchInput', 'childrenDropdownMenu');
        });

        let selectedChildren = [];

        function toggleSelection(element) {
            let selectedId = element.getAttribute('data-id');
            let selectedName = element.getAttribute('data-name');
            console.log('Toggle Selection:', selectedId, selectedName);
            if (selectedChildren.includes(selectedId)) {
                selectedChildren = selectedChildren.filter(id => id !== selectedId);
            } else {
                selectedChildren.push(selectedId);
            }
            displaySelectedChildren();
            document.getElementById('selectedChildrenIds').value = JSON.stringify(selectedChildren);
        }

        function displaySelectedChildren() {
            let selectedChildrenContainer = document.getElementById('selectedChildren');
            let childrenNames = selectedChildren.map(id => {
                let childElement = document.querySelector(`[data-type="childitem"][data-id="${id}"]`);
                let selectedName = childElement ? childElement.getAttribute('data-name') : '';
                return selectedName;
            });
            selectedChildrenContainer.innerText = 'Selected Children: ' + childrenNames.join(', ');

            let dropdownButton = document.getElementById('childrenDropdown');
            dropdownButton.innerText = childrenNames.length > 0 ? childrenNames.join(', ') : '-- Select Names --';
        }

        function selectChild(element) {

            let selectedId = element.getAttribute('data-id');
            let selectedName = element.getAttribute('data-name');
            if (selectedChildren.includes(selectedId)) {
                selectedChildren = selectedChildren.filter(id => id !== selectedId);
            } else {
                selectedChildren.push(selectedId);
            }
            displaySelectedChildren();
            document.getElementById('selectedChildrenIds').value = JSON.stringify(selectedChildren);

            let dropdownButton = document.getElementById('childrenDropdown');
            dropdownButton.innerText = selectedChildren.length > 0 ? selectedName : '-- Select Names --';

            console.log("Selected children:", selectedChildren);
            console.log("Selected children IDs:", selectedChildrenIds);
        }
    </script>
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </div>
</body>
</html>
