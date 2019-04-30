<div class="header py-4">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/images/logos/logo-control-the-work-150x72.png') }}" class="header-brand-img" alt="Control the work logo">
            </a>
            <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                        <span class="avatar" style="background-image: url({{ asset('assets/images/icons/user-male.svg') }})"></span>
                        <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">{{ Auth::user()->name }} {{ Auth::user()->surname }}</span>
                      <small class="text-muted d-block mt-1">{{ __(Auth::user()->roles()->first()->name) }}</small>
                    </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="{{ route('users.show', ['id' => Auth::user()->id]) }}">
                            <i class="dropdown-icon fe fe-user"></i> {{ __('Profile') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="dropdown-icon fe fe-log-out"></i> {{ __('Sign out') }}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </div>
                </div>
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
            </a>
        </div>
    </div>
</div>
<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link active"><i class="fe fe-home"></i> {{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-clock"></i> {{ __('Time control') }}</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="#" class="dropdown-item "> {{ __('Check in & check out') }}</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>