@extends('Result.masters.app')
@section('required-styles')
<!-- start: Bootstrap datepicker --> 
{!! Html::style('assets/plugins/datepicker/css/datepicker.css?v='.time()) !!}
<!-- end: Bootstrap datepicker -->

<!-- Start: NEW timepicker css -->  
{{-- {!! Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css?v='.time()) !!} --}}
<!-- End: NEW timepicker css -->

<!-- Start: NEW datetimepicker css -->
{!! Html::style('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css?v='.time()) !!}
{!! Html::style('assets/plugins/bootstrap-material-datetimepicker/css/custom-css-style.css?v='.time()) !!}
<!-- End: NEW datetimepicker css -->
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
        <div class="time_fasting">

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                    <h2 class="mobile-page-heading" style="margin-bottom: 0px;"><strong>You are</strong></h2>
                    <h2 class="mobile-page-heading">Eating! </h2>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4 text-right">
                    <div class="fasting_back text-right" style="padding-top: 15px;">
                        <a href="{{ url('epic/measurements') }}">Back</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p>You have selected the Custom protocol.</p>                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">

                    <div class="fasting_pie_body" id=''>
                        <div class="fire_icon fireicon1"><img src="{{asset('result/images/fire-icon.png')}}" class="img-fluid"></div>
                        <div class="fire_icon fireicon2"><img src="{{asset('result/images/fire-icon.png')}}" class="img-fluid"></div>
                        <div class="fire_icon fireicon3"><img src="{{asset('result/images/fire-icon.png')}}" class="img-fluid"></div>
                        <div class="fire_icon fireicon4"><img src="{{asset('result/images/fire-icon.png')}}" class="img-fluid"></div>
                        <div class="fasting-pie-chart" id="fasting-pie" style="--percentage:calc(100% - 25%);">
                            <div class="fasting_pie_data">
                                <p id='headtext'>TIME FASTING</p>
                                <div class="pietime" id='pietime'><span>05</span>:05:05</div>
                                <div class="percentage_data" id='percentage_data'><strong>(</strong>25%<strong>)</strong></div>
                            </div>
                        </div>
                        <div class="pie_chart_white"></div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <div class="start_action text-center">
                        <p><strong>Start Fast</strong><br><span id='showStart'>Today, 03:30 PM</span></p>
                        <a data-toggle="modal" data-target="#EditStartFast" href="#">Edit Start Fast</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6">
                    <div class="start_action text-center">
                        <p><strong>End Fast</strong><br><span id='showEnd'>Tomorrow, 07:30 AM</span></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="#" id='' class="btn endfast">End Eating</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="EditStartFast" class="modal fade mobile_popup_fixed" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content animate-bottom">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Edit <span class="theme_color">Start Fast</span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input type="text" id="sdate" class="date form-control" placeholder="Date">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input type="text" id="stime" class="date form-control" placeholder="Time">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <a class="savePersonalStats pop_save" data-name="" id='ssave'><i class="fa fa-check"></i> Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('required-script')
<!-- Start:  NEW datetimepicker js -->
{!! Html::script('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js?v='.time()) !!}
<!-- End: NEW datetimepicker js -->

<!-- Start:  NEW timepicker js -->
{!! Html::script('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js?v='.time()) !!} -->
<!-- End: NEW timepicker js -->
<script>
$('#sdate').bootstrapMaterialDateTimePicker({
    time:false,
    format : 'YYYY-M-D',
    lang : 'en',
    weekStart: 1
});
$('#stime').bootstrapMaterialDateTimePicker({
    time:false,
    format : 'HH:mm',
    lang : 'en',
    weekStart: 1
});

</script>
@stop