@php

    $clientSelectedMenus = [];

    if(Auth::user()->account_type == 'Client') {
        $selectedMenus = \App\Models\ClientMenu::where('client_id', Auth::user()->account_id)->pluck('menues')->first();
        $clientSelectedMenus = $selectedMenus ? explode(',', $selectedMenus) : [];
    }
@endphp
<div id="mainnav" class="top_navigation">
    <ul class="main-navigation-menu">
        <li class="{{ Request::is('dashboard')?'active':'' }}">
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
        </li>
      
       
    </ul>
</div>