<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edit Citizens</title>
</head>
<body>
    <h1 style="text-align: center">Citizens</h1>
    <hr>
    <form action="{{ url('/fokontany/citizens/update') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label><br>
                        <div class="input-group">
                            <input id="name_id" value="{{$citizen->last_name}}" type="text" name="name" placeholder="Enter name" class="form-control" required>
                        </div>
                        <label for="firstname">Firstname</label><br>
                        <div class="input-group">
                            <input id="firstname_id" value="{{$citizen->first_name}}"  type="text" name="firstname" placeholder="Enter firstname " class="form-control" required>
                        </div>
                        <label for="father">Father</label><br>
                        <div class="input-group">
                            <input id="father_id" type="text" value="{{$citizen->father}}"  name="father" placeholder="Enter father name" class="form-control" required>
                        </div>
                        <label for="mother">Mother</label><br>
                        <div class="input-group">
                            <input id="mother_id" type="text" value="{{$citizen->mother}}"  name="mother" placeholder="Enter mother name" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone_num">Phone Number</label><br>
                        <div class="input-group">
                            <input id="phone_num_id" type="text" value="{{$citizen->phone_num}}" name="phone_num" placeholder="Enter phone number" class="form-control" required maxlength="15">
                        </div>
                        <label for="email">Email</label><br>
                        <div class="input-group">
                            <input id="email_id" type="email" value="{{$citizen->email}}" name="email" placeholder="Enter email" class="form-control" style="width: 200px" required>
                        </div>
                        <label for="birth_place">Birthplace</label><br>
                        <div class="input-group">
                            <input id="birth_place_id" type="text" value="{{$citizen->birth_place}}"   name="birth_place" placeholder="Enter Birthplace" class="form-control"required>
                        </div>
                        <label for="birth_date">Birthdate</label><br>
                        <div class="input-group">
                            <input id="birth_date_id" type="date" value="{{$citizen->birth_date}}"  name="birth_date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="job">Job</label><br>
                            <input id="job_id" type="text" value="{{$citizen->job}}"  name="job" placeholder="Enter occupation" class="form-control" required>
                        <label for="cin">C.I.N Number</label>
                        <div class="input-group">
                            <input id="cin_id" type="text" value="{{$citizen->nic_num}}"  name="cin" placeholder="Enter C.I.N Number" class="form-control" required>
                        </div>
                        <label for="nic_place">Place of Issuance</label><br>
                        <div class="input-group">
                            <input id="nic_place_id" type="text" value="{{$citizen->nic_place}}"  name="nic_place" placeholder="Place of Issuance" class="form-control"required>
                        </div>
                        <label for="nic_date">Date of Manufacture</label><br>
                        <div class="input-group">
                            <input id="nic_date_id" value="{{$citizen->nic_date}}"  type="date" name="nic_date" class="form-control" required>
                        </div>
                        <input id="id" name="id" type="hidden" value="{{$citizen->id}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="margin-left: 600px ">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/fokontany/citizens" class="btn btn-primary" style="margin-left: 5px;">Cancel</a>
        </div>
    </form>
</body>
</html>
