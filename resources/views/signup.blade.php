<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign UP</title>
    <style>
        * {
        box-sizing: border-box;
    }

    body {
        background-size: cover;
        color: #fff;
        font-family: sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        overflow: hidden;
        margin: 0;
    }

    .container {
        background-color: rgba(0, 0, 0,0.4);
        padding: 20px 40px;
        border-radius: 5px;
    }

    .container h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    .container a {
        text-decoration: none;
        color: lightblue;
    }

    .btn {
        cursor: pointer;
        display: inline-block;
        width: 100%;
        background: lightblue;
        padding: 15px;
        font-family: inherit;
        font-size: 16px;
        border: 0;
        border-radius: 5px;
    }

    .btn:focus {
        outline: 0;
    }

    .btn:active {
        transform: scale(0.98);
    }

    .btn:hover {
        background-color: rgb(57, 82, 82);
    }
    .text {
        margin-top: 30px;
        margin-left: 40px;
    }

    .form-control {
        position: relative;
        margin: 20px 0 40px;
        width: 300px;
    }

    .form-control input {
        background-color: transparent;
        border: 0;
        border-bottom: 2px #fff solid;
        display: block;
        width: 100%;
        padding: 15px 0;
        font-size: 18px;
        color: #fff;
    }

    .form-control input:focus,
    .form-control input:valid {
        outline: 0;
        border-bottom-color: lightblue;
    }

    .form-control label {
        position: absolute;
        top: 15px;
        left: 0;
    }

    .form-control label span {
        display: inline-block;
        font-size: 18px;
        min-width: 5px;
        transition: 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .form-control input:focus + label span,
    .form-control input:valid + label span {
        color: lightblue;
        transform: translateY(-30px);
    }

    </style>
</head>
<body style="background-image: url(moon.jpg);">
    @if (Session::has('message'))
    <div class="alert alert-success" role="combobox">
        {{ Session::get('message') }}
        {{ Session::put('message', null) }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger" role="combobox">
        {{ Session::get('error') }}
        {{ Session::put('error', null) }}
    </div>
@endif
    <div class="container">
        <h1>Sign UP</h1>
        <form id="signupForm" action="{{url('/create_account')}}" method="POST">
            @csrf
           <div class="form-control">
                <input type="email" name="email" required>
                <label>Email</label>
           </div>

           <div class="form-control">
            <input type="password" name="password" required>
            <label>Password</label>
           </div>

           <button class="btn">Sign UP</button>
           <p class="text">Already have an account? <a href="/">Please Login</a></p>
        </form>
    </div>
</body>
<script>
    document.getElementById('signupForm').addEventListener('submit', function (event) {
        var password = document.getElementsByName('password')[0].value;

        if (password.length < 8) {
            alert('The password must be at least 8 characters long.');
            event.preventDefault();
        }
    });

    const labels = document.querySelectorAll('.form-control label')

labels.forEach(label => {
label.innerHTML = label.innerText
.split('')
.map((letter, idx) => `<span
style = "transition-delay:${idx * 50}ms">${letter}</span>`)
.join('')
})
</script>
</html>
