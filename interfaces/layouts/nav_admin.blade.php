<aside style="overflow: scroll;" class="sidebar">
    <!-- Logo -->
    <div class="sidebar-header text-center">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('logo.png') }}" alt="FlatMate Logo" class="sidebar-logo">
        </a>
        <h4 class="mt-2">Admin Panel</h4>
    </div>

    <ul>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Manage Users
            </a>
        </li>
        <li>
            <a href="{{ route('admin.packages') }}" class="{{ request()->routeIs('admin.packages') ? 'active' : '' }}">
                <i class="fas fa-dollar"></i> Packages
            </a>
        </li>
        <li>
            <a href="{{ route('admin.listings') }}" class="{{ request()->routeIs('admin.listings') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Manage Ads
            </a>
        </li>
        <li>
            <a href="{{ route('admin.reviews') }}" class="{{ request()->routeIs('admin.reviews') ? 'active' : '' }}">
                <i class="fas fa-star"></i> Manage Reviews
            </a>
        </li>
        <li>
            <a href="{{ route('admin.reports') }}" class="{{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Reports & Analytics
            </a>
        </li>
        <li>
            <a href="{{ route('admin.profile') }}" class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Profile
            </a>
        </li>
        <li>
            <a target="_blank" href="{{ route('chat.index') }}" class="">
                <i class="fas fa-comments"></i> Chat
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
