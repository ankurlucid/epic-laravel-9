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
                    <h2 class="mobile-page-heading" id='mode'>Fasting! </h2>
                </div>

                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4 text-right">
                    <div class="fasting_back text-right" style="padding-top: 15px;">
                        <a href="{{ url('epic/measurements') }}">Back</a>
                    </div>
                </div>
            </div>
            @php

                //   dd($fastingData, $fastingData->protocol, $fastingData->auto_diy);
               $protocol = explode('/',$fastingData->protocol);
               $firstPart = $protocol[0];
               $protocol1 = explode(' (', $protocol[1]);
               $secondPart = $protocol1[0];
            @endphp
            <input type="hidden" class="clientProtocol" data-status="{{$fastingData->auto_diy}}" data-protocol="{{$fastingData->protocol}}">
            <div class="row">
                <div class="col-md-12">
                    @if($fastingData->protocol == "Other")
                    <p>You have selected the Custom protocol.</p>
                    @else
                    <p>You have selected the {{$fastingData->protocol}} protocol. <br>{{$secondPart}} Feeding window and {{$firstPart}} fasting window.</p>
                    @endif
                </div>
            </div>
            <div class="row">
                    
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">

                    <div class="fasting_pie_body" id='fasting_pie_body' style='display:none'>
                        @if($mode == 'fasting')

                            <div id="timeing_div"></div>
                            <?php 

                                if ($fastingData->protocol == 'Other') {
                                    
                                    $protocolOther = json_decode($fastingData->protocol_other);
                                    $otherDays = $protocolOther->days;
                                    $otherHours = $protocolOther->fasting_hours;
                                    $totalHours = $otherDays * 24 + $otherHours;

                                    $numericCheck = $totalHours;

                                }else{

                                    $numericCheck = $firstPart;
                                }
                            ?>

                        @else
                            
                        @endif



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
            <div class="row margin-bottom-25">
                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                    <div class="fasting_clock_menu">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                                <a href="{{url('get-mood-history')}}"><img src="{{asset('result/images/Mood-icon.png')}}">
                                <span>Mood History</span>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                                <a href="{{url('fasting-history')}}"><img src="{{asset('result/images/fasting-icon.png')}}">
                                <span>Fasting History</span>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                                <a href="{{url('fasting-setting')}}"><img src="{{asset('result/images/setting-icon.png')}}">
                                <span>Setting</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <div class="start_action text-center">
                        <p><strong class="startTitle">Start Fast</strong><br><span id='showStart'>{{getFastingEatingTimeFormate($cycle_start)}}</span></p>
                        <?php /*<a data-toggle="modal" class="edit-start-fast" data-target="#EditStartFast" href="#">Edit Start Fast</a> */ ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6">
                    <div class="start_action text-center">
                        <p><strong class="endTitle">End Fast</strong><br><span id='showEnd'>{{getFastingEatingTimeFormate($esti_cycle_end ?? '')}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a id='endStartFast' class="btn endfast">End Fast</a>
                    {{-- <a data-toggle="modal" data-target="#endStartFastPopup" href="#" id='endStartFast' class="btn endfast">End Fast</a> --}}
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
<div id="endStartFastPopup" class="modal fade mobile_popup_fixed" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content animate-bottom">
            <!-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div> -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h4>Are you sure you want to end this cycle? Clicking Yes will end your current cycle and you need to start the process again.</h4>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <button type="button" class="btn btn-default confirmationBtn" data-dismiss="modal" data-val="no">No</button>
                        <button type="button" class="btn btn-primary setting-status confirmationBtn" data-val="yes">Yes</button>
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

    $(document).ready(function(){

        if ('{{$mode}}' == 'fasting') {

            createFields();
            distributeFields();
            topAddClassForShowHide();
        }

    });

    // setTimeout(topAddClassForShowHide, 3000);

    function topAddClassForShowHide()
    {   
        
        var totalHoursOfFasting = "{{$numericCheck ?? ''}}";
        var arrayTime = [3,6,12,18,24,36,48,72];
        
         var textData = $("#number_icon_"+totalHoursOfFasting).text();

         var trueFalseClass = false;
         // console.log("parse"+parseInt(textData));
        for (var i = 0; i < arrayTime.length; i++) {

            if (arrayTime[i] != parseInt(textData)) {
                
                trueFalseClass = true;

            }else{
                
                trueFalseClass = false;
                break;
            }
        }

        // alert("trueFalseClass"+trueFalseClass);
        if (trueFalseClass == true) {

            $("#number_icon_"+textData).addClass('hide');
        }
    } 

  function createFields() {

    $('.field-class').remove();
    var container = $('#timeing_div');
    
    var totalHoursOfFasting = "{{$numericCheck ?? ''}}";
    
    for(var i = 0; i < +totalHoursOfFasting+1; i++) {

        var arrayTime = [ 3,6,12,18,24,36,48,72 ];
                        

        if (i == 0) {

            if (arrayTime.includes(i,parseInt(totalHoursOfFasting))) {

                var addShowHideTopClass = '';
                var titleHover = getHoverTilte(parseInt(totalHoursOfFasting));

            }else{

                var addShowHideTopClass = ' hide';
                var titleHover = '';
            }

            $('<div/>', {
                'class': 'field-class'+addShowHideTopClass+'',
                'id':'number_icon_'+totalHoursOfFasting,
                'data-id':totalHoursOfFasting,
                'text': totalHoursOfFasting,
                'title':titleHover 
            }).appendTo(container);    

        }else{

            if (arrayTime.includes(i)) {

                var addShowHideClass = '';
                var titleHover = getHoverTilte(i);

            }else{

                var addShowHideClass = ' hide';
                var titleHover = '';
            }

            var numberClass = i;
            $('<div/>', {
                'class': 'field-class'+addShowHideClass+'',
                'id':'number_icon_'+numberClass,
                'data-id':numberClass,
                'text': i,
                'title':titleHover 
            }).appendTo(container);

        }
    }
}

function getHoverTilte(number){

    var title = '';

    if (number == 3) {

        title = 'Digesting And Absorbing Nutrients';

    }else if(number == 6){

        title = 'Body Breaking Down Glycogen For Fuel';

    }else if(number == 12){

        title = 'Increase Spike Growth Hormone';

    }else if(number == 18){

        title = 'Autophagy Recycling Proteins HGH Spikes';
        
    }else if(number == 24){

        title = 'Deplete Glycogen Reserve Ketones Start';

    }else if(number == 36){

        title = 'Autophagy Spikes';

    }else if(number == 48){

        title = 'Stimulate Stem Cells Reduced Inflammation Response';

    }else if(number == 72){

        title = 'Spike In Stem Cells';
    }

    return title;

}
function distributeFields() {
    
    var center = $('#fasting_pie_body');
    var fields = $('.field-class'), container = $('#fasting_pie_body'),
        width = center.width()*0.96, height = center.height()*0.96,
        angle = 0, step = (2*Math.PI) / (fields.length-1);
    var radius = width/2;
    var containerLength= "{{$numericCheck ?? ''}}";
    angle = -90*Math.PI/180;
   
    fields.each(function() {
        
        var x = Math.round(width + radius * Math.cos(angle));
        var y = Math.round(height + radius * Math.sin(angle));
            $(this).css({
            right: x + 'px',
            top: y + 'px'
        });
        angle -= step;

    });
}
 

</script>

<script>

    var nnumber = "{{$numericCheck ?? ''}}";

    setInterval(fastingClockRunBackground, 10000);

    function fastingClockRunBackground(){
        
       var data = {};
       var $fastingData = '{!! $fastingData ?? null !!}';
       var $esti_cycle_end = '{!! $esti_cycle_end ?? null !!}';
       var $cmode = '{!! $cmode ?? null  !!}';
        // Check if the variable exists and is not empty, and then add it to the data object
        if (typeof $fastingData !== 'undefined' && $fastingData !== null) {
            data.intermediate_id = $fastingData.id;
        }

        if (typeof $esti_cycle_end !== 'undefined' && $esti_cycle_end !== null) {
            data.esti_cycle_end = $esti_cycle_end;
        }

        if (typeof $cmode !== 'undefined' && $cmode !== null) {
            data.cmode = $cmode;
        }

        console.log(data)
        // Make the Ajax request
        $.ajax({
            method: 'POST',
            url: "{{ route('fasting.clock.fastingClockRunBackground') }}",
            data: data,
            success: function(data) {
                console.log(data.url);
                if (data.status == true) {
                    if (typeof data.url != 'undefined' && data.url != null) {
                        window.location = data.url;
                    } else {
                        location.reload();
                    }
                }
            }
        });

    }

    var clicked=0;
    var cmode='Manual';
    $(document).ready(function() {
        if('{{$cmode}}'=='DIY')
        {    // document is loaded and DOM is ready
            if('{{$mode}}' == 'fasting') {
                document.getElementById("headtext").innerHTML = 'TIME FASTING';
                document.getElementById("endStartFast").innerHTML = 'End Fast';
            }
            
            else {
                
                document.getElementById("headtext").innerHTML = 'TIME EATING';
                document.getElementById("endStartFast").innerHTML = 'End Eat';
                $('.startTitle').html('start eat');
                $('.endTitle').html('end eat');
                $('.edit-start-fast').html('Edit Start Eat');
            }
            
            document.getElementById("mode").innerHTML = '{{$mode}}!';
            
            showCountDown();
        }
        else{

            //   var protocol = '{{$fastingData->protocol}}';
            //   var autoStatus = '{{$fastingData->auto_diy}}';
            if('{{$mode}}' == 'fasting') {
                document.getElementById("headtext").innerHTML = 'TIME FASTING';
                document.getElementById("endStartFast").innerHTML = 'End Fast';
            }
            
            else {
                document.getElementById("headtext").innerHTML = 'TIME EATING';
                document.getElementById("endStartFast").innerHTML = 'End Eating';
                $('.startTitle').html('start eat');
                $('.endTitle').html('end eat');
                $('.edit-start-fast').html('Edit Start Eat');
            }
            document.getElementById("mode").innerHTML = '{{$mode}}!';

            document.getElementById("pietime").addEventListener("click", showCountDownAuto);
            showCountDownAuto();
        }
    });

    function showCountDown() {

        // document.getElementById("mode").innerHTML ="{{$mode}}!";

        var startDate="{{$cycle_start}}";
        var clockMode = 'Manual';
        var bothDT = startDate.split(' ');
        var dateDay = parseInt(bothDT[0].split('-')[2]);
        var dateMon = parseInt(bothDT[0].split('-')[1])-1;
        var dateYear = parseInt(bothDT[0].split('-')[0]);


        var timeHours = parseInt(bothDT[1].split(':')[0]);
        var timeMins = parseInt(bothDT[1].split(':')[1]);
        // var timeSecs = parseInt(bothDT[1].split(':')[2]);

        // if(timeSecs == '' || timeSecs == null){
        //     timeSecs = 0;
        // }

        var timeSecs = 0;

        // var countDownDate = new Date("Mar 21, 2022 15:37:25");

        var countDownDate= new Date(dateYear, dateMon, dateDay, timeHours, timeMins, timeSecs);
        // countDownDate.setDate(dateYear, dateMon, dateDay, timeHours, timeMins,timeSecs);

        var x = setInterval(function() {


            var now = changeTimeZone(new Date(), '{{$fastingData->timezone}}');
            var distance = now-countDownDate;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);


            // document.getElementById("fastclock").innerHTML = hours + " : " +
            //     minutes + " : " + seconds;

            
            if(clockMode=='Manual'){

                var getIconLenght = $(".field-class").length;

                if (getIconLenght > 0) {

                    $(".field-class").each(function(){

                        var attrId = $(this).attr('data-id');
                        var totalHours = (days*24)+hours;
                        if (attrId <= totalHours) {

                            $(this).css("color", "#f00");
                        }

                    });
                }
            
                document.getElementById("fasting-pie").style = "--percentage:calc(100%);"
                document.getElementById("percentage_data").style.display='none';
                document.getElementById("pietime").innerHTML = "<span>" + hours + "</span>" + " : " +
                minutes + " : " + seconds;
            }

            if (distance < 0) {
                
                document.getElementById("pietime").innerHTML = "YET TO START";
                document.getElementById("endStartFast").style.display='none';
            } else{
                document.getElementById("endStartFast").style.display='inline-block'; 
            }

            document.getElementById("fasting_pie_body").style='display:block';
            
        }, 1000);
    }


    function changeTimeZone(date, timeZone) {
      if (typeof date === 'string') {
        return new Date(
          new Date(date).toLocaleString('en-US', {
            timeZone,
          }),
        );
      }

      return new Date(
        date.toLocaleString('en-US', {
          timeZone,
        }),
      );
    }

    // $(document).on('click','#pietime',function(){
    //     showCountDownAuto();
    // })
    var x1;
    var x2;
    function showCountDownAuto(){

        var estiEnd="{{$esti_cycle_end ?? ''}}";
        var startAt="{{$cycle_start}}";
        var now = changeTimeZone(new Date(), '{{$fastingData->timezone}}');
        
        if(clicked==0){

            clearInterval(x2); 
            var startDate="{{$cycle_start}}";
            var clockMode = 'Manual';
            var bothDT = startDate.split(' ');
            var dateDay = parseInt(bothDT[0].split('-')[2]);
            var dateMon = parseInt(bothDT[0].split('-')[1])-1;
            var dateYear = parseInt(bothDT[0].split('-')[0]);


            var timeHours = parseInt(bothDT[1].split(':')[0]);
            var timeMins = parseInt(bothDT[1].split(':')[1]);
            // var timeSecs = parseInt(bothDT[1].split(':')[2]);

            // if(timeSecs == '' || timeSecs == null){
            //     timeSecs = 0;
            // }

            var timeSecs = 0;

            // var countDownDate = new Date("Mar 21, 2022 15:37:25");

            var countDownDate= new Date(dateYear, dateMon, dateDay, timeHours, timeMins, timeSecs);
            // countDownDate.setDate(dateYear, dateMon, dateDay, timeHours, timeMins,timeSecs);

            var bothDT = estiEnd.split(' ');
            var dateDay = parseInt(bothDT[0].split('-')[2]);
            var dateMon = parseInt(bothDT[0].split('-')[1])-1;
            var dateYear = parseInt(bothDT[0].split('-')[0]);


            var timeHours = parseInt(bothDT[1].split(':')[0]);
            var timeMins = parseInt(bothDT[1].split(':')[1]);
            // var timeSecs = parseInt(bothDT[1].split(':')[2]);

            // if(timeSecs == '' || timeSecs == null){
            //     timeSecs = 0;
            // }

            var timeSecs = 0;

            // var countDownDate = new Date("Mar 21, 2022 15:37:25");

            var estiEndDate= new Date(dateYear, dateMon, dateDay, timeHours, timeMins, timeSecs);
            // countDownDate.setDate(dateYear, dateMon, dateDay, timeHours, timeMins,timeSecs);

            var estiTotal = estiEndDate - countDownDate;
            var percent = 0;

            x1 = setInterval(function() {


                var now = changeTimeZone(new Date(), '{{$fastingData->timezone}}');
                var distance = now-countDownDate;
                percent=(distance/estiTotal)*100;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);



                if('{{$mode}}' == 'fasting') {

                    $("#headtext").html("TIME FASTING");

                }else{

                    $("#headtext").html("TIME EATING");
                }

                $("#fasting-pie").removeClass('fasting-pie-chart-left');


                createFields();
                distributeFields();
                topAddClassForShowHide();
            
                var getIconLenght = $(".field-class").length;
                var totalHours = (days*24)+hours;
                
                if (getIconLenght > 0) {

                    $(".field-class").each(function(){
                        $(this).css("color", "");
                    });

                    $(".field-class").each(function(){

                        var attrId = $(this).attr('data-id');
                        if (attrId <= totalHours) {

                            $(this).css("color", "#f00");
                        }

                    });
                }

                var getCountLength = $("")    
                document.getElementById("fasting-pie").style = "--percentage:calc("+percent+"%);"
                // document.getElementById("percentage_data").style.display='none';
                document.getElementById("percentage_data").innerHTML = '<strong>(</strong>'+ percent.toFixed(2)+'%<strong>)</strong>';
                document.getElementById("pietime").innerHTML = "<span>" + totalHours + "</span>" + " : " +
                minutes + " : " + seconds;
                

                if (distance < 0) {
                    
                    document.getElementById("pietime").innerHTML = "YET TO START";
                    document.getElementById("endStartFast").style.display='none';
                } else {
                    document.getElementById("endStartFast").style.display='inline-block';
                }

                 /*  */
                if( Date.parse(now) > Date.parse(estiEnd) ) {
                        var protocol = '{{$fastingData->protocol}}';
                        var autoStatus = '{{$fastingData->auto_diy}}';
                        if(protocol == 'Other' && autoStatus == 'AUTO'){
                                document.getElementById('endStartFast').style.display = "none";
                                $('#pietime').html('Ended');
                                $('#percentage_data').html('');
                        }
                }
            /*  */

                document.getElementById("fasting_pie_body").style='display:block';
                
            }, 1000);

            clicked =1;
        }
        else{

            $("#headtext").html('TIME LEFT');
            $("#fasting-pie").addClass('fasting-pie-chart-left');
            clearInterval(x1);
            var startDate="{{$esti_cycle_end ?? ''}}";
        
        var bothDT = startDate.split(' ');
        var dateDay = parseInt(bothDT[0].split('-')[2]);
        var dateMon = parseInt(bothDT[0].split('-')[1])-1;
        var dateYear = parseInt(bothDT[0].split('-')[0]);


        var timeHours = parseInt(bothDT[1].split(':')[0]);
        var timeMins = parseInt(bothDT[1].split(':')[1]);
        // var timeSecs = parseInt(bothDT[1].split(':')[2]);

        // if(timeSecs == '' || timeSecs == null){
        //     timeSecs = 0;
        // }

        var timeSecs = 0;
        
        // var countDownDate = new Date("Mar 21, 2022 15:37:25");

        var countDownDate= new Date(dateYear, dateMon, dateDay, timeHours, timeMins, timeSecs);
        // countDownDate.setDate(dateYear, dateMon, dateDay, timeHours, timeMins,timeSecs);

        var startedDate="{{$cycle_start}}";
        // var clockMode = 'Manual';
        var bothDT = startedDate.split(' ');
        var dateDay = parseInt(bothDT[0].split('-')[2]);
        var dateMon = parseInt(bothDT[0].split('-')[1])-1;
        var dateYear = parseInt(bothDT[0].split('-')[0]);


        var timeHours = parseInt(bothDT[1].split(':')[0]);
        var timeMins = parseInt(bothDT[1].split(':')[1]);
        // var timeSecs = parseInt(bothDT[1].split(':')[2]);

        // if(timeSecs == '' || timeSecs == null){
        //     timeSecs = 0;
        // }

        var timeSecs = 0;

        // var countDownDate = new Date("Mar 21, 2022 15:37:25");

        var startedAtDate= new Date(dateYear, dateMon, dateDay, timeHours, timeMins, timeSecs);
        // countDownDate.setDate(dateYear, dateMon, dateDay, timeHours, timeMins,timeSecs);
        
        var bothDT = estiEnd.split(' ');
        var dateDay = parseInt(bothDT[0].split('-')[2]);
        var dateMon = parseInt(bothDT[0].split('-')[1])-1;
        var dateYear = parseInt(bothDT[0].split('-')[0]);


        var timeHours = parseInt(bothDT[1].split(':')[0]);
        var timeMins = parseInt(bothDT[1].split(':')[1]);
        // var timeSecs = parseInt(bothDT[1].split(':')[2]);

        // if(timeSecs == '' || timeSecs == null){
        //     timeSecs = 0;
        // }

        var timeSecs = 0;
        
        // var countDownDate = new Date("Mar 21, 2022 15:37:25");

        var estiEndDate= new Date(dateYear, dateMon, dateDay, timeHours, timeMins, timeSecs);
        // countDownDate.setDate(dateYear, dateMon, dateDay, timeHours, timeMins,timeSecs);
        var estiTotal = estiEndDate - startedAtDate;
        var percent = 0;

        x2 = setInterval(function() {


            var now = changeTimeZone(new Date(), '{{$fastingData->timezone}}');
            var distance = countDownDate-now;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);


            // document.getElementById("fastclock").innerHTML = hours + " : " +
            //     minutes + " : " + seconds;

            percent=(distance/estiTotal)*100;
            
            var getIconLenght = $(".field-class").length;
            var totalHours = (days*24)+hours;
            if (getIconLenght > 0) {

                $(".field-class").each(function(){
                        $(this).css("color", "");
                });

                $(".field-class").each(function(){
                    $(this).addClass('hide');
                    var attrId = $(this).attr('data-id');
                    if (attrId >= totalHours) {

                        $(this).css("color", "#f00");
                    }

                });
            }
            
            // console.log("percent"+percent);
            // var original = 100-percent;
            // console.log(original);
            var abcd = "100% - "+percent+"%";
            document.getElementById("fasting-pie").style = "--percentage:calc("+abcd+");"
            // document.getElementById("percentage_data").style.display='none';
            document.getElementById("percentage_data").innerHTML = percent.toFixed(2)+'%';
            document.getElementById("pietime").innerHTML = "<span>" + totalHours + "</span>" + " : " +
            minutes + " : " + seconds;
           
         
            if (distance < 0) {
                
                document.getElementById("pietime").innerHTML = "YET TO START";
                document.getElementById("endStartFast").style.display='none';
            } else {
                 document.getElementById("endStartFast").style.display='inline-block';
            }
            /*  */
            if( Date.parse(now) > Date.parse(estiEnd) ) {
                     var protocol = '{{$fastingData->protocol}}';
                     var autoStatus = '{{$fastingData->auto_diy}}';
                     if(protocol == 'Other' && autoStatus == 'AUTO'){
                            document.getElementById('endStartFast').style.display = "none";
                            $('#pietime').html('Ended');
                            $('#percentage_data').html('');
                       }
            }
          /*  */
            document.getElementById("fasting_pie_body").style='display:block';
            
        }, 1000);
        clicked=0;
        }
    }

    $(document).on('click','#endStartFast',function(e){

        $(this).remove();

        var dataStatus =  $('.clientProtocol').attr('data-status');
        var dataProtocol =  $('.clientProtocol').attr('data-protocol');
        // var autoCycle = 'no';
        if(dataStatus == 'AUTO' && dataProtocol=='Other'){
            $('#endStartFastPopup').modal('show');
            $('.confirmationBtn').click(function(){
                 var btnValue = $(this).attr('data-val');
                 if(btnValue == 'no'){
                    $('#endStartFastPopup').modal('hide');
                     return false;
                 }

                 var now = changeTimeZone(new Date(), '{{$fastingData->timezone}}');
                var yearr = now.getFullYear();
                var monthh = now.getMonth() + 1;
                var dayy = now.getDate();
                var hourss = now.getHours();
                var mintutess = now.getMinutes();
                var secondss = now.getSeconds();
                var nowDateFormatted = yearr+'-'+monthh+'-'+dayy+' '+hourss+':'+mintutess+':'+secondss;
                var mode = '{{$mode}}';
                $.ajax({
                    method: 'Post',
                    url: public_url + 'fasting-cycle-end',
                    data: {
                            'current_time':nowDateFormatted,
                            'mode':mode,
                            'cycle_status':btnValue
                        },
                    success: function (data) {
                            window.location.href = data.url;
                    }
             });
                 
          });
        } else {
            var now = changeTimeZone(new Date(), '{{$fastingData->timezone}}');
            var yearr = now.getFullYear();
            var monthh = now.getMonth() + 1;
            var dayy = now.getDate();
            var hourss = now.getHours();
            var mintutess = now.getMinutes();
            var secondss = now.getSeconds();
            var nowDateFormatted = yearr+'-'+monthh+'-'+dayy+' '+hourss+':'+mintutess+':'+secondss;
            var mode = '{{$mode}}';
                $.ajax({
                    method: 'Post',
                    url: public_url + 'fasting-cycle-end',
                    data: {
                        'current_time':nowDateFormatted,
                        'mode':mode,
                    },
                    success: function (data) {
                        
                        window.location.href = data.url;
                    }
                });

        } 
    })


    $(document).on('click','#ssave',function(){
        var now = changeTimeZone(new Date(), '{{$fastingData->timezone}}');
        var yearr = now.getFullYear();
        var monthh = now.getMonth();
        var dayy = now.getDate();
        var hourss = now.getHours();
        var mintutess = now.getMinutes();
        var secondss = now.getSeconds();

        var nowDateFormatted = yearr+'-'+monthh+'-'+dayy+' '+hourss+':'+mintutess+':'+secondss;
        $.ajax({
            method: 'Post',
            url: public_url + 'update-start-time',
            data: {
                'current_time':nowDateFormatted,
            },
            success: function (data) {
                window.location.href = data.url;
            }
        });
    })

    function preEndFasting(){
        var now = changeTimeZone(new Date(), '{{$fastingData->timezone}}');
        var yearr = now.getFullYear();
        var monthh = now.getMonth();
        var dayy = now.getDate();
        var hourss = now.getHours();
        var mintutess = now.getMinutes();
        var secondss = now.getSeconds();

        var nowDateFormatted = yearr+'-'+monthh+'-'+dayy+' '+hourss+':'+mintutess+':'+secondss;
        $.ajax({
            method: 'Post',
            url: public_url + 'pre-end-fast',
            data: {
                'current_time':nowDateFormatted,
            },
            success: function (data) {
                window.location.href = data.url;
            }
        });
    }

    function preEndEating(){
        var now = changeTimeZone(new Date(), '{{$fastingData->timezone}}');
        var yearr = now.getFullYear();
        var monthh = now.getMonth();
        var dayy = now.getDate();
        var hourss = now.getHours();
        var mintutess = now.getMinutes();
        var secondss = now.getSeconds();

        var nowDateFormatted = yearr+'-'+monthh+'-'+dayy+' '+hourss+':'+mintutess+':'+secondss;
        $.ajax({
            method: 'Post',
            url: public_url + 'pre-end-eating',
            data: {
                'current_time':nowDateFormatted,
            },
            success: function (data) {
                window.location.href = data.url;
            }
        });
    }




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