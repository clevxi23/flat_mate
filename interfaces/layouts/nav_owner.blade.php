<aside class="sidebar">
    <!-- Logo -->
    <div class="sidebar-header text-center">
        <a href="{{ route('website.home') }}">
            <img src="{{ asset('logo.png') }}" alt="FlatMate Logo" class="sidebar-logo">
        </a>
        <h4 class="mt-2">House Owner</h4>
    </div>

    <ul>
        <li>
            <a href="{{ route('owner.dashboard') }}" class="{{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('owner.unit_ads.index') }}" class="{{ request()->routeIs('owner.unit_ads.*') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Unit Ads
            </a>
        </li>
        <li>
            <a href="{{route('owner.roommate_requests.index')}}" class="{{ request()->is('owner/roommate-requests*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Roommate Requests
{{--                <span class="badge bg-danger ms-2">5</span> <!-- Static notification badge -->--}}
            </a>
        </li>
        <li>
            <a href="{{route('owner.reports.index')}}" class="{{ request()->is('owner/reports*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Reports
            </a>
        </li>
        <li>
            <a target="_blank" href="{{ route('chat.index') }}" class="">
                <i class="fas fa-comments"></i> Chat
            </a>
        </li>
        <li>
            <a href="{{ route('owner.profile') }}" class="{{ request()->routeIs('owner.profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i> My Profile
            </a>
        </li>
        <li>
            <a href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>

    <!-- Back to Website Link -->
    <div class="text-center mt-4">
        <a href="{{ route('website.home') }}" class="btn btn-outline-danger text-danger">
            <i class="fas fa-arrow-left"></i> Back to Website
        </a>
    </div>
</aside>
