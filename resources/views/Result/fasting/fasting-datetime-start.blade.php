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
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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

.toast-top-right {
    top: 80px;
    right: 12px;
}
</style>

@stop
@section('content')
<div class="fasting_mobile_top">
    <h1><span>EPIC </span> Nutrition</h1>
    <h2><span>Intermittent </span> Fasting</h2>
</div>
<div class="fasting_mobile_details">
    <div class="panel panel-white">



        <div class="fasting_personal">
            <h2 class="mobile-page-heading"><strong>Personal</strong> <br>Details </h2>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                    <div class="form-group">
                        <label>What Day Do You Want to Start?</label>
                        <div class="form-group">
                            <!-- <input type="date" id='fastingdate' class="current-date-calendar form-control" value=""> -->
                            <input type="text" id="date" class="date form-control" placeholder="Date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                    <div class="form-group">
                        <label>What Time Do You Want to Start?</label>
                        <!-- <input type="time" id='fastingtime' class="current-date-calendar form-control" value=""> -->
                        <input type="text" id="time" class="time form-control" placeholder="Time">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                    <div class="form-group">
                        <label>Automated OR DIY?</label>
                        <div class="fasting_input_radio">
                            <input type="radio" name="AutomaticORDIY" id="AutomaticF">
                            <label for="AutomaticF">Automated</label>
                            <input type="radio" name="AutomaticORDIY" id="DIYF">
                            <label for="DIYF">DIY</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="#" id='datetimeStartNext' class="btn save">Next</a>
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
{!! Html::script('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js?v='.time()) !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- End: NEW timepicker js -->
<script>
    $(document).on('click', '#datetimeStartNext', function() {
        // window.alert('fastingdate: ' + fastingdate.value + 'fastingtime: ' + fastingtime.value);
        var radios = document.getElementsByName('AutomaticORDIY');
        var cmode='';
        for (var radio of radios)
        {
            if (radio.checked) {
                if(radio.id=='DIYF'){
                    cmode='DIY';
                }                
                else{
                    cmode='AUTO';
                }
            }
        }
        if(!date.value){
            toastr.error("Please fill Start date"); 
            return false;
         } 
         if(!time.value){
            toastr.error("Please fill start time"); 
            return false;
         } 
         if(!cmode){
            toastr.error("Please fill Automatic Or DIY"); 
            return false;
         } 
        $.ajax({
            method: 'Post',
            url: public_url + 'fasting-clock-start-save',
            data: {
                'start_date': date.value+' '+time.value,
                'auto_diy':cmode,
               
            },
            success: function (data) {
                // location.reload();
                window.location.href='fasting-clock-controller';
            }
            
        })
    })

var mDate = new Date();
mDate.setDate(mDate.getDate()-30);

$('#date').bootstrapMaterialDatePicker({
    time:false,
    format : 'YYYY-M-D',
    lang : 'en',
    weekStart: 1,
    minDate:mDate,
});
$('#time').bootstrapMaterialDatePicker({
     date: false,
    format: 'HH:mm'
});
</script>


@stop