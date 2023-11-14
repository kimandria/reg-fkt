<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">Create User</div>

                    <div class="card-body">
                        <form method="POST" action="/admin/createuser">
                            @csrf

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="is_admin" class="col-md-4 col-form-label text-md-right">Is Admin</label>
                                <div class="col-md-6">
                                    <input id="is_admin" type="checkbox" class="form-control @error('is_admin') is-invalid @enderror" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}>
                                    @error('is_admin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fokontany" class="col-md-4 col-form-label text-md-right">Fokontany</label>
                                <div class="col-md-6">
                                    <select id="fokontany" class="form-control @error('fokontany') is-invalid @enderror" name="fokontany" onchange="clearOtherFields('fokontany')">
                                        <option value="">-- Select Fokontany --</option>
                                        @foreach($fokontanies as $fokontany)
                                            <option value="{{ $fokontany->id }}" {{ old('fokontany') == $fokontany->id ? 'selected' : '' }}>{{ $fokontany->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('fokontany')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="borough" class="col-md-4 col-form-label text-md-right">Borough</label>
                                <div class="col-md-6">
                                    <select id="borough" class="form-control @error('borough') is-invalid @enderror" name="borough" onchange="clearOtherFields('borough')">
                                        <option value="">-- Select Borough --</option>
                                        @foreach($boroughs as $borough)
                                            <option value="{{ $borough->id }}" {{ old('borough') == $borough->id ? 'selected' : '' }}>{{ $borough->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('borough')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="district" class="col-md-4 col-form-label text-md-right">District</label>
                                <div class="col-md-6">
                                    <select id="district" class="form-control @error('district') is-invalid @enderror" name="district" onchange="clearOtherFields('district')">
                                        <option value="">-- Select District --</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}" {{ old('district') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('district')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="prefecture" class="col-md-4 col-form-label text-md-right">Prefecture</label>
                                <div class="col-md-6">
                                    <select id="prefecture" class="form-control @error('prefecture') is-invalid @enderror" name="prefecture" onchange="clearOtherFields('prefecture')">
                                        <option value="">-- Select Prefecture --</option>
                                        @foreach($prefectures as $prefecture)
                                            <option value="{{ $prefecture->id }}" {{ old('prefecture') == $prefecture->id ? 'selected' : '' }}>{{ $prefecture->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('prefecture')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function clearOtherFields(field) {
            if (field === 'fokontany') {
                document.getElementById('borough').selectedIndex = 0;
                document.getElementById('district').selectedIndex = 0;
                document.getElementById('prefecture').selectedIndex = 0;
            } else if (field === 'borough') {
                document.getElementById('fokontany').selectedIndex = 0;
                document.getElementById('district').selectedIndex = 0;
                document.getElementById('prefecture').selectedIndex = 0;
            } else if (field === 'district') {
                document.getElementById('fokontany').selectedIndex = 0;
                document.getElementById('borough').selectedIndex = 0;
                document.getElementById('prefecture').selectedIndex = 0;
            } else if (field === 'prefecture') {
                document.getElementById('fokontany').selectedIndex = 0;
                document.getElementById('borough').selectedIndex = 0;
                document.getElementById('district').selectedIndex = 0;
            }
        }
    </script>
</body>
</html>

