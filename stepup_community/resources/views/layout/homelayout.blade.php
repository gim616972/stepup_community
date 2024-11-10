<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StepUp @yield('site_title')</title>
    <link rel="shortcut icon" href="https://stepup.community/wp-content/uploads/2024/03/ff.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/main.content.css') }}">
    @yield('css_file')
</head>
<body>
    <nav class="fixed-top">
        <div class="container-fluid d-flex align-items-center nav_bar">
            <div class="d-xl-none sidebarBtn" id="sidebarShowbtn">
                <i class="fa-solid fa-bars p-2 text-dark"></i>
            </div>
            <div class="pe-3">
                <a href="{{ route('dashboard') }}"  class="d-flex">
                    <img class="d-md-none" width="41" height="36" src="{{ asset('img/logo.jpg') }}">
                    <img class="d-none d-md-block" width="100%" height="50" src="{{ asset('img/long_logo.png') }}">
                    {{-- <h3 class="d-none d-md-block" style="color: #FF4500;">reddit</h3> --}}
                </a>
            </div>
            <div class="grow auto-margin">
                <div class="searchBar">
                    <i class="fa-solid fa-magnifying-glass text-muted"></i>
                    <input type="text" placeholder="Search Post">
                </div>
            </div>
            <div class="dropdown ps-3">
                <button class="profile" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{-- <i class="fa fa-user" aria-hidden="true"></i> --}}
                    <img class="rounded-circle" src="{{ asset('profileImage').'/'.Auth::user()->avatar }}" width="42px" height="42px">
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="fa fa-user pe-2"></i>
                            <span data-key="t-dashboard">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="fa fa-sign-out pe-2"></i>
                            <span data-key="t-dashboard">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- sidebar area -->
     <section>
        <div id="d-flex">
            <div class="sidebar" id="fixSidebar">
                <div class="sidebarContent d-flex flex-column">
                    <a class="active" href="{{ route('dashboard') }}"><i class="fa-solid fa-house pe-1"></i> Home</a>
                    <a href="{{ route('savedPost') }}"><i class="fa-solid fa-signs-post pe-1"></i> Saved Post</a>
                    <p class="footer-text text-muted text-center mb-0">© 2024 Stepup Technology Ltd. All Rights Reserved.</p>
                </div>
            </div>
            <div class="overlay"></div>
            <div class="content">
                @yield('content_section')
            </div>
        </div>
     </section>
</body>
</html>
<script src="{{ asset('js/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>