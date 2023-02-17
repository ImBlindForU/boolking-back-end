<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image" href="{{ Vite::asset('public/logo.png') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.0/gsap.min.js" defer></script>
    @vite(['resources/js/app.js'])

</head>

<body>
    <header>

        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('user.estates.index') }}"><img class="logo"
                        src="{{ Vite::asset('resources/images/logo.png') }}" alt="" srcset=""></a>
                <div class="header-side">
                    <form class="d-inline" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn our-btn-header" type="submit">Logout</button>
                    </form>
                    <button class="btn our-btn-header" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <div class="d-flex align-items-center">
                <a href="">
                    <img class="logo" src="{{ Vite::asset('resources/images/logo.png') }}" alt=""
                        srcset="">
                </a>
                <h5 class="offcanvas-title " id="offcanvasScrollingLabel">Boolking</h5>

            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body ">
            <div class="side-bar-links d-flex flex-column">
                <a href="{{ route('user.dashboard') }}">Dashboard</a>
                <a href="{{ route('user.estates.index') }}">Proprietà</a>
                <a href="{{ route('user.leads.index') }}">Messaggi</a>
                <a href="">Statistiche</a>
                <a href="">Sponsorships</a>
                <a href="{{ route('homeFront') }}">Torna al sito</a>
            </div>
        </div>
    </div>
    @yield('content')
</body>

</html>
