@php

$clientSelectedMenus = [];

if(Auth::user()->account_type == 'Client') {
$selectedMenus = \App\Models\ClientMenu::where('client_id', Auth::user()->account_id)->pluck('menues')->first();
$clientSelectedMenus = $selectedMenus ? explode(',', $selectedMenus) : [];
}
@endphp

<div class="sidebar app-aside" id="sidebarNew">
    <div class="sidebar-container perfect-scrollbar sidebar-left" data-perfect-scrollbar="" data-suppress-scroll-x="true">
        <nav class="">
            
            <ul class="main-navigation-menu">
                <li class="{{ Route::is('dashboard')?'active':'' }} nav-item">
                    <a href="{{route('dashboard')}}">                        
                        <div class="item-content">
                            <div class="item-media">
                                <img src="{{asset('result/images/dashboard.png')}}">
                            </div>
                            <div class="item-inner">
                                <span class="title"> Dashboard </span>
                            </div>
                        </div>
                    </a>
                    <div class="triangle"></div>
                </li>

                <!-- Calendars start -->
                <li class="{{ Route::is('meal_planner.calendar')?'active':'' }} nav-item"  data-item="calendar">
                    <a href="#">
                        <div class="item-content">
                            <div class="item-media">
                                <img src="{{asset('result/images/calendar.png')}}">
                            </div>
                            <div class="item-inner">
                                <span class="title"> Calendars </span>
                            </div>
                        </div>
                        <div class="triangle"></div>
                    </a>                    
                </li>
                <!-- Calendars end -->

                 {{-- Epic Process Start --}}
                <li class="{{ (Route::is('recipes.list') || Route::is('recipes.details') || Route::is('recipes.filtersuggestion') || Route::is('goals.goallisting') || Route::is('goal-buddy.create') || Route::is('goal-buddy.edit') || Route::is('recipes.calendarfilter'))?'active':'' }} nav-item" data-item="process">
                    <a href="#">
                        <div class="item-content">
                            <div class="item-media">
                                <img src="{{asset('result/images/Reward.png')}}">
                            </div>
                            <div class="item-inner">
                                <span class="title"> Epic Process</span>
                            </div>
                        </div>
                        <div class="triangle"></div>
                    </a>                    
                </li>
                 {{-- Epic Process .End --}}

                 <!-- Epic Process start -->
                @if(in_array('epic_social', $clientSelectedMenus))
                    <li class="{{ (Route::is('social.index') || Route::is('social.direct_message') || Route::is('social.all_message') || Route::is('message.search'))?'active':'' }} nav-item" data-item="epic_social">
                         <a href="#">
                            <div class="item-content">
                                <div class="item-media">
                                    <img src="{{asset('result/images/share_icon.png')}}">
                                </div>
                                <div class="item-inner">
                                    <span class="title"> Epic Social </span>
                                </div>
                            </div>
                            <div class="triangle"></div>
                        </a>                    
                    </li>
                @endif
                <!-- Epic Process end -->

            </ul>
                    
        </nav>
    </div>
    <!--  Sidebar menu second step start -->
    <div class="sidebar-left-secondary perfect-scrollbar" data-perfect-scrollbar="" data-suppress-scroll-x="true">
        
        {{-- Calendars submenu start --}}
        <ul class="topsub-menu childNav" data-parent="calendar">
            <div class="submenu_back">
                @if(in_array('meal_planner', $clientSelectedMenus))
                <li class="">
                    <a href="{{ route('meal_planner.calendar') }}" class="">
                        <div class="menuicon">
                            <img src="{{asset('result/images/Nutritional Calendar.png')}}">
                        </div>
                        <div class="item-inner">
                            <span class="title"> Nutritional Calender </span>
                        </div>
                    </a>
                </li>
                @endif
                @if(in_array('epic_goal', $clientSelectedMenus))
                <li class="">
                    <a href="{{in_array('epic_goal', $clientSelectedMenus)?route('goals.calendar'):"#"}}" class="{{in_array('epic_goal', $clientSelectedMenus)?'':'disable'}}">
                        <div class="menuicon">
                            <img src="{{asset('result/images/Goal Calendar.png')}}">
                        </div>
                        <div class="item-inner">
                            <span class="title"> Goal Calender </span>
                        </div>
                    </a>
                </li>
                @endif
            </div>
        </ul>
        {{-- Calendars submenu end --}}

        {{-- Trace & Replace submenu start --}}
        <ul class="topsub-menu childNav" data-parent="process">
            <div class="submenu_back">
                <li class="nav-item dropdown-sidemenu {{ (Route::is('recipes.list') || Route::is('recipes.details') || Route::is('recipes.filtersuggestion') || Route::is('recipes.calendarfilter') || Route::is('epic.measurements'))?'open':'' }}">                    
                    <a href="#">
                        <div class="menuicon">
                            <img src="{{asset('result/images/Balanced Diet.png')}}">
                        </div>
                        <div class="item-inner">
                            <span class="title"> Trace & Replace </span>
                        </div>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="submenu">
                        <div class="submenu_back"> 
                           
                            @if(in_array('recipes', $clientSelectedMenus))
                            <li class="">
                                <a href="{{ route('recipes.list') }}" class="">
                                    <div class="menuicon">
                                        <img src="{{asset('result/images/Recipes.png')}}">
                                    </div>
                                    <div class="item-inner">
                                        <span class="title">Recipes </span>
                                    </div>
                                </a>
                            </li> 
                            @endif
                        </div>
                    </ul>
                </li> 

                <li class="nav-item dropdown-sidemenu {{ (Route::is('goals.goallisting') || Route::is('goal-buddy.create') || Route::is('goal-buddy.create-old') || Route::is('goal-buddy.edit'))?'open':'' }}">
                    <a href="#">
                        <div class="menuicon">
                            <img src="{{ asset('result/images/Time Management.png') }}">
                        </div>
                        <div class="item-inner">
                            <span class="title"> Weight & Date </span>
                        </div>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <!-- start submenu submenu -->
                    <ul class="submenu">
                        <div class="submenu_back">
                            
                            <li class="">
                                <a href="{{ route('epic.measurements') }}">
                                    <div class="menuicon">
                                        <img src="{{asset('result/images/Weight Management.png')}}">
                                    </div>
                                    <div class="item-inner">
                                        <span class="title"> Measurements </span>
                                    </div>
                                </a>
                            </li>

                            @if (in_array('epic_goal', $clientSelectedMenus))
                                <li class="">
                                    <a href="{{ in_array('epic_goal', $clientSelectedMenus) ? route('goals.goallisting') : '#' }}"
                                        class="{{ in_array('epic_goal', $clientSelectedMenus) ? '' : 'disable' }}">
                                        <div class="menuicon">
                                            <img src="{{ asset('result/images/Goal.png') }}">
                                        </div>
                                        <div class="item-inner">
                                            <span class="title"> Epic Goal </span>
                                        </div>
                                    </a>
                                </li>
                            @endif
                        </div>
                    </ul>
                    <!-- end submenu submenu -->
                </li>

            </div>
        </ul>
        {{-- Trace & Replace submenu end --}}

        {{-- Social submenu start --}}
        <ul class="topsub-menu childNav" data-parent="epic_social">
            <div class="submenu_back">
                <li class="">
                    <a href="{{ route('social.index') }}">
                        <div class="menuicon">
                            <img src="{{asset('result/images/home.jpeg')}}">
                        </div>
                        <div class="item-inner">
                            <span class="title"> Home </span>
                        </div>
                    </a>
                </li> 
                <li class="">                    
                    <a href="{{ route('social.all_message') }}">
                        <div class="menuicon">
                            <img src="{{asset('result/images/messages-icon.png')}}">
                        </div>
                        <div class="item-inner">
                            <span class="title"> Direct Messages </span>
                        </div>
                    </a>
                   
                </li> 
            
            </div>
        </ul>
        {{-- Social submenu end --}}
    </div>
    
    <!--  Sidebar menu second step end -->
    <div class="sidebar-overlay"></div>
    <div class="mobile-sidebar-overlay"></div>
</div>
<!-- / sidebar-->
<script type="text/javascript">

 

</script>