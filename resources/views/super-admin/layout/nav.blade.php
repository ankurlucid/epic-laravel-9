<?php
    $user = session()->get('adminData');
?>
<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex align-items-center text-wrap" href="">
            <img src="{{ asset('theme') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
              <span class="ms-2 font-weight-bold text-white"> {{app_name()}} </span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mb-2 mt-0">
                <a data-bs-toggle="collapse" href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav"
                    role="button" aria-expanded="false">
                    @if ($user->picture)
                    <img src="{{ dpSrc(isset($user->profile_picture)?$user->profile_picture: '', isset($user->gender) ? $user->gender: '' ) }}" alt="{{ session()->get('adminData')->fullName }}" alt="avatar" class="avatar">
                    @else
                    <img src="{{ asset('theme') }}/img/default-avatar.png" alt="avatar" class="avatar">
                    @endif
                    <span class="nav-link-text ms-2 ps-1">{{ $user->name }}</span>
                </a>
                <div class="collapse" id="ProfileNav" style="">
                    <ul class="nav ">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('auth.show') }}">
                                <span class="sidenav-mini-icon"> MP </span>
                                <span class="sidenav-normal  ms-3  ps-1"> My Profile </span>
                            </a>
                        </li>
                        <form method="POST" action="" class="d-none" id="logout-form">
                            @csrf
                        </form>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="{{route('superadmin.logout')}}" >
                                <span class="sidenav-mini-icon"> L </span>
                                <span class="sidenav-normal  ms-3  ps-1"> Logout </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <hr class="horizontal light mt-0">

            {{-- <li class="nav-item analytics ">
                <a class="nav-link text-white analytics @if( \Route::is('muscle.list') || \Route::is('muscle.create') || \Route::is('muscle.edit') ) active   @endif"
                href="{{ route('muscle.list') }}">
                <i class="fa fa-child"></i>
                <span class="sidenav-normal  ms-2  ps-1"> Muscle </span>
              </a>
            </li> --}}

            <li class="nav-item analytics">
                <a href="" class="nav-link text-white analytics">
                    <i class="material-icons-round opacity-10">dashboard</i>
                    <span class="sidenav-normal  ms-2  ps-1"> Dashboard </span>
                </a>
            </li>

            <li class="nav-item analytics">
                <a href="{{ route('superadmin.businessAccount.index') }}" class="nav-link text-white analytics {{ Route::is('superadmin.businessAccount.index') ? 'active' : '' }}">
                    <i class="material-icons-round opacity-10">dashboard</i>
                    <span class="sidenav-normal  ms-2  ps-1"> Business Accounts </span>
                </a>
            </li>

            <li class="nav-item analytics">
                <a href="{{ route('users-limit.index') }}" class="nav-link text-white analytics {{ Route::is('users-limit.index') ? 'active' : '' }}">
                    <i class="material-icons-round opacity-10">dashboard</i>
                    <span class="sidenav-normal  ms-2  ps-1"> Users Limit </span>
                </a>
            </li>
           

        </ul>
    </div>

</aside>
