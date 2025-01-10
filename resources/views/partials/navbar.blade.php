<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ route('home.index') }}" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <h1 class="m-0">ConnectFriend</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('home.index') }}"
                class="nav-item nav-link {{ Route::is('home.index') ? 'active' : '' }}">Home</a>
            <a href="{{ route('home.topup') }}" class="nav-item nav-link {{ Route::is('home.topup') ? 'active' : '' }}">Top up</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Friends</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="job-list.html" class="dropdown-item">Random</a>
                    <a href="job-detail.html" class="dropdown-item">Filter</a>
                </div>
            </div>
            <a href="contact.html" class="nav-item nav-link">Avatar</a>
        </div>
        @if (Auth::check())
            <a href="{{ route('home.profile') }}" class="btn rounded-0 py-4 px-lg-5 d-none d-lg-block" style="background-color: #3584ff">
                Profile
                <i class="fa fa-arrow-right ms-3">
                    <span class="badge text-bg-secondary bg-danger">{{ Auth::user()->friendRequests()->where('status', 'pending')->count() }}</span>
                </i>
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">
                Login
                <i class="fa fa-arrow-right ms-3"></i>
            </a>
        @endif
    </div>
</nav>
