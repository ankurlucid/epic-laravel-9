@extends('Result.masters.app')
@section('required-styles')
    {!! Html::style('result/css/custom.css?v='.time()) !!}
<style type="text/css">
    section#page-title {
        display: none;
    }
</style>

@stop
@section('content')
<div class="daily_dairy_menu">
    @php
        if ($_GET) {
            $queryString = 'Yes';
        } else {
            $queryString = 'No';
        }
   @endphp
    <ul>
        <li><a @if($queryString =='Yes') href="{{url('calendar/personal-dairy?date='.$clickDate)}}" @else href="{{url('calendar/personal-dairy')}}" @endif>Personal <span>Diary</span></a></li>
        <li><a @if($queryString =='Yes') href="{{url('calendar/personal-measurement?date='.$clickDate)}}"  @else href="{{url('calendar/personal-measurement')}}" @endif>Personal <span>Measurements</span></a></li>
        <li><a @if($queryString =='Yes') href="{{url('calendar/personal-stastic?date='.$clickDate)}}" @else href="{{url('calendar/personal-stastic')}}" @endif>Personal <span>Statistics</span></a></li>
        <li><a @if($queryString =='Yes') href="{{url('calendar/nutritional?date='.$clickDate)}}" @else href="{{url('calendar/nutritional')}}" @endif ><span>Nutritional</span> Journal</a></li>
        <li><a @if($queryString =='Yes') href="{{url('calendar/hydration?date='.$clickDate)}}" @else href="{{url('calendar/hydration')}}" @endif><span>Hydration</span> Journal</a></li>
        {{-- <li><a href="{{url('calendar/hydration')}}"><span>Hydration</span> Journal</a></li> --}}
        <li><a @if($queryString =='Yes') href="{{url('calendar/sleep?date='.$clickDate)}}" @else href="{{url('calendar/sleep')}}" @endif><span>Sleep</span> Journal</a></li>
    </ul>
</div>
@stop
@section('required-script')
@stop