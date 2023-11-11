<style>
    .navbar-light .navbar-nav .nav-link:hover {
        color: white;
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
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
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
                </li>
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
