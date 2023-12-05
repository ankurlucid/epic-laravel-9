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

    span#sliderValue {

        font-size: 16px;
        color:#FF571B;
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
        
        <!-- Fasting Start -->
        <div class="complete_fasting">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <h2 class="mobile-page-heading"><strong>Eating</strong> <br>Completed! </h2>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                    {{-- <div class="fasting_back text-right" style="padding-top: 15px;">
                        <a href="{{ url('fasting') }}">Back</a>
                    </div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>You successfully eated for <strong> <span id='showHours'></span> hours and <span id='showMinutes'></span> minutes</strong>.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                    <a href="#">Share Fast Data</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <p><strong>Eating Summary:</strong></p>
                    <div class="form-group">
                        <div class="fast_summery">
                            <p><strong>Start Eating</strong><br><span id='showStart'>{{getFastingEatingTimeFormate($start_fast)}}</span></p>
                            <a data-toggle="modal" data-target="#EditStartFastSummary" href="#">Edit Start Eating</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fast_summery">
                            <p><strong>End Eating</strong><br><span id='showEnd'>{{getFastingEatingTimeFormate($end_fast)}}</span></p>
                        <a data-toggle="modal" data-target="#EditEndFastSummary" href="#">Edit End Eating</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>How am I feeling?</strong></label>
                        <div class="fasting-range-slider">
                          <input class="range-slider__range" type="range" value="0" min="0" max="10">
                          <span class="range-slider__value" id='sliderValue'>0</span>
                      </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="#" class="btn endfast" id='saveFastButton'>Save Eating</a>
                </div>
            </div>
        </div>
        <!-- Fasting End -->
    </div>
</div>
<div id="EditStartFastSummary" class="modal fade mobile_popup_fixed" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content animate-bottom">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Edit <span class="theme_color">Start Eating</span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input type="text" id="StartFastDate" class="time form-control" placeholder="Date">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input type="text" id="StartFastTime" class="time form-control" placeholder="Time">
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <a class="savePersonalStats EditStartFast pop_save" data-dismiss="modal"><i class="fa fa-check"></i> Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="EditEndFastSummary" class="modal fade mobile_popup_fixed" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content animate-bottom">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Edit <span class="theme_color">End Eating</span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input type="text" id="EndFastDate" class="time form-control" placeholder="Date">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input type="text" id="EndFastTime" class="time form-control" placeholder="Time">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <a class="savePersonalStats EditEndFast pop_save" data-dismiss="modal"><i class="fa fa-check"></i> Save</a>
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


$(document).ready(function(){
    
    // window.alert("{{$diff}}");
    var arr1= "{{$start_fast}}".split(" ");
    var arr2= "{{$end_fast}}".split(" ");
    // var diff = Date.parse("{{$start_fast}}")-Date.parse("{{$end_fast}}");
    // window.alert(diff);

    var diff = parseInt( "{{$diff}}");
    var diffHours = parseInt(diff/(60*60));

    document.getElementById('showHours').innerHTML = diffHours;
    document.getElementById('showMinutes').innerHTML = parseInt(diff/(60)) - diffHours*60;

    // document.getElementById('showStart').innerHTML = "{{$start_fast}}";
    // document.getElementById('showEnd').innerHTML = "{{$end_fast}}";


    document.getElementById('StartFastDate').value=arr1[0];
    document.getElementById('StartFastTime').value=arr1[1];
    document.getElementById('EndFastDate').value=arr2[0];
    document.getElementById('EndFastTime').value=arr2[1];
})


$(document).on("click","#saveFastButton",function(){

    $.ajax({
        method: 'Post',
        url: public_url + 'save-eating-summary',
        data: {
            'start_fast':document.getElementById('StartFastDate').value+' '+document.getElementById('StartFastTime').value,
            'end_fast':document.getElementById('EndFastDate').value+' '+document.getElementById('EndFastTime').value,
            'mood':document.getElementById('sliderValue').innerHTML,
            'fasting_clock_id': "{{$getData->id}}"
        },
        success: function (data) {
            
            window.location.href = "fasting-clock-controller";
        }
    });

})

$(document).on("click",".EditStartFast",function(){
    var startFast = document.getElementById('StartFastDate').value+' '+document.getElementById('StartFastTime').value;
    $('#showStart').html(startFast);
});


$(document).on("click",".EditEndFast",function(){
    var endFast= document.getElementById('EndFastDate').value+' '+document.getElementById('EndFastTime').value;
    $('#showEnd').html(endFast);
});

$('#StartFastDate').bootstrapMaterialDatePicker({
    time:false,
    format: 'YYYY-M-D',
    cancelText: 'Cancel',
    clearText: 'Clear',
    lang: 'en'
}).on('change', function(e, date) {
    $('#EndFastDate').bootstrapMaterialDatePicker('setMinDate', date);
});
$('#StartFastTime').bootstrapMaterialDatePicker({
    
    date:false,
    format: 'HH:mm',
    cancelText: 'Cancel',
    clearText: 'Clear',
    lang: 'en'
});
$('#EndFastDate').bootstrapMaterialDatePicker({
    time:false,
    format: 'YYYY-M-D',
    cancelText: 'Cancel',
    clearText: 'Clear',
    lang: 'en',
    minDate : '{{$start_fast}}',
});
$('#EndFastTime').bootstrapMaterialDatePicker({
    date:false,
    format: 'HH:mm',
    cancelText: 'Cancel',
    clearText: 'Clear',
    lang: 'en'
});
</script>
@stop