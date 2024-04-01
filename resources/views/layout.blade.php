<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.12.0/css/all.css">
    <title>@yield('title')</title>
</head>
<body>
    <header id="menu_area" class="menu-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light mainmenu">
                        <div class="container-fluid">
                            <div class="logo">
                                <a class="navbar-brand" href="{{url('/')}}">Blood Bank</a>
                            </div>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-lg-auto customNav">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        @if (Auth::check())
                                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <ul class="dropdown-menu">
                                            @if (Auth::user()->role == "hospital")
                                            <li><a class="dropdown-item" href="{{url('/add-blood')}}">Add Blood</a></li>
                                            @endif
                                            <li><a class="dropdown-item" href="{{url('/blood-request')}}">Blood Request</a></li>
                                            <li><a class="dropdown-item" href="{{url('/logout')}}">Logout</a></li>
                                        </ul>
                                        @else
                                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Guest</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{url('/login')}}">Login</a></li>
                                                <li><a class="dropdown-item" href="{{url('/register')}}">Register</a></li>
                                            </ul>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>


    <footer class="footer mt-4">
        <div class="footer-copyright text-center">&copy; Developed with <i class="fas fa-heart" aria-hidden="true"></i> by
            <a href="https://www.linkedin.com/in/gagan-dureja-557625a4/" target="_blank">Gagan Dureja</a>
        </div>
    </footer>



    @if (session('success'))
        <script>
            Swal.fire({
                text: "{{ session('success') }}",
                icon: "success",
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                text: "{{ session('error') }}",
                icon: "error",
            });
        </script>
    @endif

    @yield('js')


</body>
</html>