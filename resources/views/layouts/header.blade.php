<header class="app-header" style="border-bottom: 1px solid #dcdeee">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none" style="color: black">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="bi bi-list fs-8 dark"></i>
                </a>
            </li>
        </ul>
        @if (Auth()->check())
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/images/logos/userIcon.png') }}" alt="" width="35"
                                height="35" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    @if (Auth()->check())
                                    <p class="mb-0 fs-3">{{Auth::user()->name}}</p>
                                    @else
                                    <p class="mb-0 fs-3">Mi perfil</p>
                                    @endif
                                    

                                </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-primary mx-3 mt-2 d-block">Cerrar sesión</button>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        @endif
    </nav>
</header>
