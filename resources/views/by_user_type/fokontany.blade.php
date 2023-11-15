@php
    use App\Models\Citizens;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Register</title>
    <li class="nav-item">
        <a href="{{url('logout')}}"><i class="fas fa-power-off" style="color: #000000;
        margin-top: 5px; margin-left: 1280px; font-size: 30px;"
            ></i>
        </a>
    </li>
</head>

<body>
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('message') }}.
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{Session::put ('message', null)}}
    </div>
@endif
<div>
    <button style="width:20%; margin-top:10px; margin-left:550px "><a href="/fokontany/citizens">Go to the Citizens list</a></button>
    <button style="width:20%; margin-top:10px; margin-left:550px "><a href="/fokontany/book">Add Book</a></button>
    <button style="width:20%; margin-top:10px; margin-left:550px "><a href="/fokontany/movement">Manage Movement</a></button>
</div>
<div class="container mt-5">
    <form action="{{ url('/fokontany/citizens') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name_id" type="text" name="name" placeholder="Enter name" class="form-control"
                        required>
                </div>
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input id="firstname_id" type="text" name="firstname" placeholder="Enter firstname"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="father">Father</label>
                    <input id="father_id" type="text" name="father" placeholder="Enter father name"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="mother">Mother</label>
                    <input id="mother_id" type="text" name="mother" placeholder="Enter mother name"
                        class="form-control" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone_num">Phone Number</label>
                    <input id="phone_num_id" type="text" name="phone_num" placeholder="Enter phone number"
                        class="form-control" required maxlength="15">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email_id" type="email" name="email" placeholder="Enter email" class="form-control"
                        required>
                </div>
                <div class="form-group">
                    <label for="birth_place">Birthplace</label>
                    <input id="birth_place_id" type="text" name="birth_place" placeholder="Enter Birthplace"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="birth_date">Birthdate</label>
                    <input id="birth_date_id" type="date" name="birth_date" class="form-control" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="job">Job</label>
                    <input id="job_id" type="text" name="job" placeholder="Enter occupation"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cin">C.I.N Number</label>
                    <input id="cin_id" type="text" name="cin" placeholder="Enter C.I.N Number"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nic_place">Place of Issuance</label>
                    <input id="nic_place_id" type="text" name="nic_place" placeholder="Place of Issuance"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nic_date">Date of Manufacture</label>
                    <input id="nic_date_id" type="date" name="nic_date" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="form-group mt-4">
            <div class="col-md-6">
                <button class="btn btn-primary btn-block" style="margin-left: 500px; width:20%;">Add
                    Citizen</button>
            </div>
        </div>
    </form>
</div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
