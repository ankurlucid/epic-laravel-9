@extends('Result.masters.app')
@section('required-styles')
    {!! Html::style('result/css/custom.css?v='.time()) !!}
<style type="text/css">
    @media (max-width: 767px){
        section#page-title {
            display: none;
        }
        #app > footer{
            display: none;
        }
    }
</style>

@stop
@section('content')
<div class="fasting_mobile_top">
    <h1><span>EPIC </span> Nutrition</h1>
    <h2><span>Intermittent </span> Fasting</h2>
</div>
<div>
    <!-- testing -->
</div>
<div class="panel panel-white">
    <!-- Start mobile view -->

    
    <div class="fasting_mobile_details">
        <div class="fasting-about">
            <h2>About</h2>
            <p>Intermittent Fasting is the eating pattern that cycles between periods of feeding followed by fasting. It does not dictate what you should eat and more when you should eat.</p>            
        </div>
        <div class="started_cta">
            <h3><span>EPIC</span> FIT</h3>
            <p>Ulimate Intermittent</p>
            <a href="{{ url('fasting-form') }}" class="btn">Get Started Now</a>
            <div class="fasting_clock_menu" style="width: 90%;margin: 0px auto;margin-top: 20px;">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                        <a href="{{url('get-mood-history')}}"><img src="{{asset('result/images/Mood-icon.png')}}">
                            <span>Mood History</span>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                        <a href="{{url('fasting-history')}}"><img src="{{asset('result/images/fasting-icon.png')}}">
                            <span>Fasting History</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('required-script')
@stop