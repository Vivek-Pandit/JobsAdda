<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JobsAdda') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Css and JS Files  -->
    <link rel="stylesheet" href="{{asset('asset/css/custom-bs.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/fonts/line-icons/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/quill.snow.css')}}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body id="top">

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
    

<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    

    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="{{ url('/home') }}">JobsAdda</a></div>

                    <nav class="mx-auto site-navigation">
                        <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
                            <li style="padding-left: 600px;"><a href="{{ url('/home') }}" class="nav-link active">Home</a></li>
                            <li><a href="{{route('about')}}">About</a></li>
                            <li><a href="{{route('contact')}}">Contact</a></li>
                            @guest
                            @if (Route::has('login'))
                            <li class=""><a href="{{ route('login') }}">Log In</a></li>
                            @endif
                            @if (Route::has('register'))
                            <li class=""><a href="{{ route('register') }}">Register</a></li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        Profile
                                    </a>

                                    <a class="dropdown-item" href="{{ route('edit.details') }}">
                                        Update Details
                                    </a>

                                    <a class="dropdown-item" href="{{ route('edit.cv') }}">
                                        Update CV
                                    </a>

                                    <a class="dropdown-item" href="{{ route('applications') }}">
                                        Applications
                                    </a>
                                    <a class="dropdown-item" href="{{ route('saved.jobs') }}">
                                        Saved Jobs
                                    </a>



                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>



                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            @endguest
                        </ul>
                    </nav>


                    <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
                     
                        <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
                    </div>

                </div>
            </div>
        </header>
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer class="site-footer">
        <a href="#top" class="smoothscroll scroll-top">
            <span span class="icon-keyboard_arrow_up"></span>
        </a>

        <div class="container">
            <div class="row mb-5">

                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <div class="footer-social">
                        <img src="{{asset('asset/images/mainlogo.png')}}" alt="">
                        <br>
                        <h3>Connect With Us</h3>
                        <a href="#"><span class="icon-facebook"></span></a>
                        <a href="#"><span class="icon-twitter"></span></a>
                        <a href="#"><span class="icon-instagram"></span></a>
                        <a href="#"><span class="icon-linkedin"></span></a>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <h3>Search Trending</h3>
                    <ul class="list-unstyled">
                        <li><a href="#">Full Stack Developer</a></li>
                        <li><a href="#">Graphics Designer</a></li>
                        <li><a href="#">Web Developers</a></li>
                        <li><a href="#">Python Developers</a></li>
                        <li><a href="#">Software Developers</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <h3>Company</h3>
                    <ul class="list-unstyled">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Career</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Resources</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <h3>Support</h3>
                    <ul class="list-unstyled">
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-center">
                <div class="col-12">
                    <p class="copyright"><small>

                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | Developed by <a href="https://portfolio-vivek-pandit.vercel.app/" target="_blank">Vivek Pandit</a></small></p>
                </div>
            </div>
        </div>
    </footer>
    </div>

    <!-- SCRIPTS -->
    <script src="{{asset('asset/js/jquery.min.js')}}"></script>
    <script src="{{asset('asset/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('asset/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('asset/js/stickyfill.min.js')}}"></script>
    <script src="{{asset('asset/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('asset/js/jquery.easing.1.3.js')}}"></script>

    <script src="{{asset('asset/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('asset/js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{asset('asset/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('asset/js/quill.min.js')}}"></script>

    <script src="{{asset('asset/js/bootstrap-select.min.js')}}"></script>

    <script src="{{asset('asset/js/custom.js')}}"></script>
</body>

</html>