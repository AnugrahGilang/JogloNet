<nav class="app-header navbar navbar-expand bg-body shadow-sm">
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <!-- Sidebar toggle button-->
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list fs-4"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="#" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            @if(Auth::check())
                @php
                    $user = Auth::user();
                @endphp
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <span class="fw-semibold">{{ $user->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 overflow-hidden">
                        <!--begin::User Info-->
                        <li class="user-header text-bg-primary text-center p-3">
                            <p class="mb-0 fw-bold">{{ $user->name }} - {{ ucfirst($user->role) }}</p>
                            <small>Login sebagai {{ $user->email }}</small>
                        </li>
                        <!--end::User Info-->

                        <!--begin::Menu Footer-->
                        <li class="user-footer d-flex justify-content-between p-2 bg-light">
                            <a href="{{ route('user.profile.index') }}" class="btn btn-sm btn-outline-primary">Profile</a>
                            <a href="{{ route('admin.logout') }}"
                               class="btn btn-sm btn-outline-danger"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sign out
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        <!--end::Menu Footer-->
                    </ul>
                </li>
            @endif
        </ul>
        <!--end::End Navbar Links-->
    </div>
</nav>
