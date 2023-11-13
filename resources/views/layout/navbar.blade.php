<style>
    .navbar-light .navbar-nav .nav-link:hover {
        color: white;
    }
    .navbar-light .navbar-nav .nav-item .dropdown-menu a {
        color: #0f0f0f;
    }

    /* Couleur au survol des liens de la liste déroulante */
    .navbar-light .navbar-nav .nav-item .dropdown-menu a:hover {
        color: #00b33c;
    }

    /* Couleur des liens actifs dans la liste déroulante */
    .navbar-light .navbar-nav .nav-item .dropdown-menu a.active {
        color: #e6eee9;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #00b33c;">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images.jpg')}}" alt="logo" style="width: 50px" class="rounded-pill">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb2">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/index">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="territoryDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Territory
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="territoryDropdown">
                        <a class="dropdown-item" href="{{ url('prefecture') }}">Prefecture</a>
                        <a class="dropdown-item" href="{{ url('district') }}">District</a>
                        <a class="dropdown-item" href="{{ url('borough') }}">Borough</a>
                        <a class="dropdown-item" href="{{ url('fonkotany') }}">Fokontany</a>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{url('prefecture')}}">Prefecture</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('district')}}">District</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('borough')}}">Borough</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('fonkotany')}}">Fokontany</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{url('citizens')}}">Citizens</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('book')}}">Book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('movement')}}">Movement</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
