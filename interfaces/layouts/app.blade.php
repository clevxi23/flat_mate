<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/flaticon/font/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    @stack('css')
    <title>FlatMate</title>
</head>
<body>
<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<!-- Navbar -->
<nav class="site-nav" id="navbar">
    <div class="container">
        <div class="menu-bg-wrap" id="navbar1">
            <div class="site-navigation">
                <a href="/" class="logo m-0 float-start">
                    <strong id="logo-text">FlatMate</strong>
                    <img src="{{ asset('logo.png') }}" alt="FlatMate" id="nav-logo" style="display: none;">
                </a>

                <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                    <li class="{{ request()->routeIs('website.home') ? 'active' : '' }}">
                        <a href="{{ route('website.home') }}">Home</a>
                    </li>
                    <li class="{{ request()->is('unit-ad*') ? 'active' : '' }}">
                        <a href="{{ route('website.unit_ads') }}">Unit Ads</a>
                    </li>
                    <li class="{{ request()->routeIs('website.find_roommates') ? 'active' : '' }}">
                        <a href="{{ route('website.find_roommates') }}">Find Roommates</a>
                    </li>
                    <li class="{{ request()->routeIs('website.packages') ? 'active' : '' }}">
                        <a href="{{ route('website.packages') }}">Packages</a>
                    </li>
                    <li class="{{ request()->routeIs('website.about') ? 'active' : '' }}">
                        <a href="{{ route('website.about') }}">About</a>
                    </li>
                    <li class="{{ request()->routeIs('website.contact') ? 'active' : '' }}">
                        <a href="{{ route('website.contact') }}">Contact Us</a>
                    </li>

                    @guest
                        <li class="{{ request()->routeIs('login') ? 'active' : '' }}">
                            <a href="{{ route('website.login') }}">Login</a>
                        </li>
                        <li class="{{ request()->routeIs('website.register') ? 'active' : '' }}">
                            <a href="{{ route('website.register') }}">Sign Up</a>
                        </li>
                    @else
                        <li class="has-children {{ request()->is('roommates/*') || request()->is('house-owners/*') || request()->is('admin/*') ? 'active' : '' }}">
                            <a href="#" class="d-flex align-items-center">
                                <i class="fas fa-user-friends me-2"></i> <span style="margin-right: 9px;">Welcome, {{ Auth::user()->acc_name }}</span>
                            </a>
                            <ul class="dropdown shadow-sm">
                                @if(Auth::user()->acc_type == 'roommate')
                                    <li class="{{ request()->is('roommates/profile') ? 'active' : '' }}">
                                        <a href="{{ route('roommate.profile') }}"><i class="fas fa-user me-2"></i> My Profile</a>
                                    </li>
                                    <li class="{{ request()->is('roommates/requests') ? 'active' : '' }}">
                                        <a href="{{ route('roommate.requests') }}"><i class="fas fa-envelope me-2"></i> My Requests</a>
                                    </li>
                                    <li class="{{ request()->is('roommates/joining-requests') ? 'active' : '' }}">
                                        <a style="font-size: 13px;" href="{{ route('roommate.my_applications') }}"><i class="fas fa-user-plus me-2"></i> My Applications</a>
                                    </li>
                                    <li class="{{ request()->is('roommates/earnings') ? 'active' : '' }}">
                                        <a href="{{ route('roommate.earnings') }}"><i class="fas fa-coins me-2"></i> My Points</a>
                                    </li>
                                    <li class="{{ request()->is('chat') ? 'active' : '' }}">
                                        <a href="{{ route('chat.index') }}">
                                            <i class="fas fa-comments me-2"></i> Messages
                                            @php
                                                $todayMessages = \App\Models\Message::where('receiver_id',auth()->id())
                                                    ->whereDate('ma_date_time', today())
                                                    ->where('is_read', 0)
                                                    ->count();
                                            @endphp
                                            @if($todayMessages > 0)
                                                <span class="badge bg-danger rounded-pill">{{ $todayMessages }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @elseif(Auth::user()->acc_type == 'house_owner')
                                    <li class="{{ request()->is('house-owners/dashboard') ? 'active' : '' }}">
                                        <a href="{{ route('owner.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                                    </li>
                                    <li class="{{ request()->is('chat') ? 'active' : '' }}">
                                        <a href="{{ route('chat.index') }}">
                                            <i class="fas fa-comments me-2"></i> Messages
                                            @php
                                                $todayMessages = \App\Models\Message::where('receiver_id', auth()->id())
                                                    ->whereDate('ma_date_time', today())
                                                    ->where('is_read', 0)
                                                    ->count();
                                            @endphp
                                            @if($todayMessages > 0)
                                                <span class="badge bg-danger rounded-pill">{{ $todayMessages }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @elseif(Auth::user()->acc_type == 'admin')
                                    <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                                        <a href="/admin/dashboard"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                                    </li>
                                    <li class="{{ request()->is('chat') ? 'active' : '' }}">
                                        <a href="{{ route('chat.index') }}">
                                            <i class="fas fa-comments me-2"></i> Messages
                                            @php
                                                $todayMessages = \App\Models\Message::where('receiver_id', Auth::id())
                                                    ->whereDate('ma_date_time', today())
                                                    ->where('is_read', 0)
                                                    ->count();
                                            @endphp
                                            @if($todayMessages > 0)
                                                <span class="badge bg-danger rounded-pill">{{ $todayMessages }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="#" onclick="logoutAction()" class="text-danger">
                                        <i class="fas fa-power-off me-2"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>

                <a href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none">
                    <span></span>
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="content">
    @yield('content')
</div>


<div class="site-footer">
    <div class="container">
        <div class="row">
            <!-- Contact Section -->
            <div class="col-lg-4">
                <div class="widget">
                    <h3>Contact</h3>
                    <address class="text-white">Jubail, Saudi Arabia</address>
                    <ul class="list-unstyled links">
                        <li><a class="text-white"  href="tel://+966123456789">+966-123-456-789</a></li>
                        <li><a class="text-white" href="mailto:info@flatmate.com">info@flatmate.com</a></li>
                    </ul>
                </div>
            </div>

            <!-- Sources Section -->
            <div class="col-lg-4">
                <div class="widget">
                    <h3>Quick Links</h3>
                    <ul class="list-unstyled float-start links">
                        <li><a class="text-white" href="#">About Us</a></li>
                        <li><a class="text-white" href="#">Services</a></li>
                    </ul>
                </div>
            </div>

            <!-- Useful Links & Social Media -->
            <div class="col-lg-4">
                <div class="widget">
                    <h3> Follow Us</h3>
                    <ul class="list-unstyled social">
                        <li><a href="#"><span class="icon-instagram"></span></a></li>
                        <li><a href="#"><span class="icon-twitter"></span></a></li>
                        <li><a href="#"><span class="icon-facebook"></span></a></li>
                        <li><a href="#"><span class="icon-linkedin"></span></a></li>
                        <li><a href="#"><span class="icon-pinterest"></span></a></li>
                        <li><a href="#"><span class="icon-dribbble"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="row">
            <div class="col-12 text-center">
                <p class="text-white">
                    Copyright &copy;
                    <script>document.write(new Date().getFullYear());</script>
                    . All Rights Reserved. &mdash; Designed with love by FlatMate.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- End Footer -->
<!-- End Footer -->

<!-- Preloader -->
<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/js/aos.js') }}"></script>
<script src="{{ asset('assets/js/navbar.js') }}"></script>
<script src="{{ asset('assets/js/counter.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script>
    window.addEventListener('scroll', function() {
        let navbar = document.getElementById('navbar');
        let navbar1 = document.getElementById('navbar1');
        let logoText = document.getElementById('logo-text');
        let navLogo = document.getElementById('nav-logo');

        if (window.scrollY > 50) {
            navbar.classList.add('fixed-nav');
            navbar1.classList.add('menu-bg-wrap-foxed');
            navLogo.style.display = 'block'; // Show logo image
            logoText.style.display = 'none'; // Hide text
        } else {
            navbar.classList.remove('fixed-nav');
            navbar1.classList.remove('menu-bg-wrap-foxed');
            navLogo.style.display = 'none'; // Hide logo image
            logoText.style.display = 'block'; // Show text
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#dataTable').DataTable();
    });
    function logoutAction() {
        event.preventDefault();
        if (confirm('Are you sure you want to log out?')) {
            document.getElementById('logout-form').submit();
        }
    }
</script>
@stack('js')
</body>
</html>
