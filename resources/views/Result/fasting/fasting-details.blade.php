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
        .modal, .modal-dialog {
            z-index: 99999999 !important;
        }
    }
</style>

@stop
@section('content')
<div class="fasting_mobile_top">
    <h1><span>EPIC </span> Nutrition</h1>
    <h2><span>Intermittent </span> Fasting</h2>
</div>
<div class="panel panel-white">
    <!-- Start mobile view -->

    
    <div class="fasting_mobile_details">
        <!-- Personal Details Start -->
        <div class="fasting_personal">
            <h2 class="mobile-page-heading"><strong>Personal</strong> <br>Details </h2>        
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>What Day Do You Want to Start?</label>
                        <div class="form-group">
                            <input type="date" class="current-date-calendar form-control"  value="">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>What Time Do You Want to Start?</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Automatic OR DIY?</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="#" class="btn save">Next</a>
                </div>
            </div>
        </div>
        <!-- Personal Details End -->
        <!-- You are Fasting Start -->
        <div class="time_fasting">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <h2 class="mobile-page-heading"><strong>You are</strong> <br>Fasting! </h2>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="fasting_back text-right" style="padding-top: 15px;">
                        <a href="{{ url('fasting') }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>You have selected the 16/8 3 meal protocol. <br>!6 Feeding window and 8 fasting window.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="start_action text-center">
                        <p><strong>Start Fast</strong><br>Today, 03:30 PM</p>
                        <a href="#">Edit Start Fast</a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="start_action text-center">
                        <p><strong>End Fast</strong><br>Tomorrow, 07:30 AM</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="#" class="btn endfast">End Fast</a>
                </div>
            </div>
        </div>
        <!-- You are Fasting End -->
        <!-- Fasting Start -->
        <div class="complete_fasting">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <h2 class="mobile-page-heading"><strong>Fasting</strong> <br>Completed! </h2>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="fasting_back text-right" style="padding-top: 15px;">
                        <a href="{{ url('fasting') }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>You successfully fasted for <strong>16 hours, and 35 minutes</strong>.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                    <a href="#">Share Fast Data</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <p><strong>Fast Summary:</strong></p>
                    <div class="form-group">
                        <div class="fast_summery">
                            <p><strong>Start Fast</strong><br>Today, 03:30 PM</p>
                            <a href="#">Edit Start Fast</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fast_summery">
                            <p><strong>End Fast</strong><br>Tomorrow, 07:30 AM</p>
                        <a href="#">Edit Start Fast</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>How am I feeling?</strong></label>
                        <div class="fasting-range-slider">
                          <input class="range-slider__range" type="range" value="100" min="0" max="500">
                          <span class="range-slider__value">0</span>
                      </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="#" class="btn endfast">Save Fast</a>
                </div>
            </div>
        </div>
        <!-- Fasting End -->
    </div>
</div>
@stop
@section('required-script')
<script type="text/javascript">
    var rangeSlider = function(){
  var slider = $('.fasting-range-slider'),
      range = $('.range-slider__range'),
      value = $('.range-slider__value');
    
  slider.each(function(){

    value.each(function(){
      var value = $(this).prev().attr('value');
      $(this).html(value);
    });

    range.on('input', function(){
      $(this).next(value).html(this.value);
    });
  });
};

rangeSlider();
</script>
@stop