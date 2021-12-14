
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <span class="mr-2 d-none d-lg-inline text-white nav-menu-size">Home</span>
            </a>
        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-white nav-menu-size">Services</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('service') }}">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    All Services
                </a>
                <div class="dropdown-divider"></div>
                @if($services->count() > 0)
                    @foreach($services as $service)
                        <a class="dropdown-item" href="{{ route('service', ['category'=>$service->id]) }}">
                            {{ $service->name }}
                        </a>
                    @endforeach
                @endif
            </div>
        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-white nav-menu-size">Events</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('event') }}">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    All Events
                </a>
                <div class="dropdown-divider"></div>
                @if($events->count() > 0)
                    @foreach($events as $event)
                        <a class="dropdown-item" href="{{ route('event', ['category'=>$event->id]) }}">
                            {{ $event->name }}
                        </a>
                    @endforeach
                @endif
            </div>
        </li>
        {{-- Check if user is logged in --}}
        @if (Auth::check())
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-white nav-menu-size">
                        {{ auth()->user()->name }}
                        @if(auth()->user()->isAdmin())
                            (Admin)
                        @endif
                        @if(auth()->user()->isUser())
                            (User)
                        @endif
                        @if(auth()->user()->isVendor())
                            (Vendor)
                        @endif
                    </span>
                    <img class="img-profile rounded-circle"
                        src="/img/undraw_profile.svg">
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    @if(auth()->user()->isAdmin())
                        <a class="dropdown-item" href="{{ route('admin.dashaboard') }}">
                            <i class="fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Admin Dashboard
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <div class="dropdown-divider"></div>
                    @elseif (auth()->user()->isVendor())
                        <a class="dropdown-item" href="{{ route('vendor.dashboard') }}">
                            <i class="fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Dashboard
                        </a>
                        <a class="dropdown-item" href="{{ route('vendor.profile') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('vendor.password') }}">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <div class="dropdown-divider"></div>
                    @endif

                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    <span class="mr-2 d-none d-lg-inline text-white nav-menu-size">Login</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">
                    <span class="mr-2 d-none d-lg-inline text-white nav-menu-size">Register</span>
                </a>
            </li>
        @endif
    </ul>
