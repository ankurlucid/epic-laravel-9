@extends('Result.masters.app')
@section('required-styles')
{!! Html::style('result/css/custom.css?v=' . time()) !!}

<style type="text/css">
section#page-title {
    display: none;
}

.confirm{
    background-color: #f94211 !important;
}
.panel{
    margin: 0 !important;
    border: 0px !important;
}
.personal-measurement-mobile{
    background: none !important;
}
.text-left{
    text-align: left !important;
}
.modal, .modal-dialog {
    z-index: 99999999 !important;
}

</style>

@stop
@section('content')
<div class="personal_mobile_top">
    @php
    if ($_GET) {
        $queryString = 'Yes';
    } else {
        $queryString = 'No';
    }
    @endphp
    <span>DAILY </span> <br>DIARY
    <div class="backtopage first-btn">
        <a @if ($queryString == 'Yes') href="{{ url('calendar/daily-dairy?date=' . $eventDate) }}" @else href="{{ url('calendar/daily-dairy') }}" @endif><i class="fa fa-long-arrow-left"></i> Back</a>
    </div>
    <div class="backtopage second-btn" style="display:none">
        <a href="javascript:void(0)"><i class="fa fa-long-arrow-left"></i> Back</a>
    </div>
</div>
<input hidden value="{{date('d M Y', strtotime($eventDate))}}" data-val="{{$eventDate}}" class="currentDate"> 
{{-- <input hidden value="{{date('d M Y', strtotime($eventDate))}}" data-val="{{$eventDate}}" class="currentDate">  --}}
<div class="personal_mobile_details ">
        <div class="personal_dairy_section personal-measurement-mobile sleep-journal-section second-section graph-div" style="display:none">
             <h2 class="c-gray"><strong>SLEEP</strong><br>JOURNAL</h2>
             {{-- <div class=graph-div> --}}
            
             <h6 class="measurement-heading" style="font-size: 13px;display: flex;"><strong>DAILY&nbsp;</strong>  JOURNAL 
                <a href="#" class="right-left-arrow arrow-btn-click" data-date="{{$date1}}" data-btn="pre-btn"><</a> {{ date('d', strtotime($date1))}} - {{ date('d M Y', strtotime($date2))}} <a href="#" class="right-left-arrow arrow-btn-click" data-date="{{$date2}}" data-btn="next-btn">></a>
             </h6>
            
             <div class="flex sleep-graph">    
                 @foreach($sleepArray as $key => $sleep)
                 <div><div class="weeks"><div class="progres-bar" @if($sleep['progresBar'] > 100 ) style="height: 100%;" @else style="height: {{$sleep['progresBar']}}%;" @endif><span>{{$sleep['hour']}} <br>hr <br><br>{{$sleep['minute']}}<br>min</span></div></div>{{$sleep['day']}}</div>
                 @endforeach           
             </div>
           {{-- </div> --}}
        {{-- 'avgAmoutGoToSleep','avgAmoutWakeUp','avgAmoutGoToBed --}}
            <div class="measurement-div">
                <h6 class="measurement-heading"><strong>AVERAGE AMOUNT  </strong> OF SLEEP?</h6>
                <h4 class="measure-value float-left m-0 f-40"><strong>{{$avgAmoutSleep}}</strong></h4>     
                <hr class="m-0">
            </div>
        
            <div class="measurement-div">
                <h6 class="measurement-heading"><strong>AVERAGE TIME </strong> GO TO BED?</h6>
                <h4 class="measure-value float-left m-0"><strong>@if($avgAmoutGoToBed){{date('h:i A', strtotime($avgAmoutGoToBed))}} @endif</strong></h4>
                {{-- <h4 class="measure-value float-left m-0"><strong>10:15 </strong>PM</h4>      --}}
                <hr class="m-0">
            </div>
            <div class="measurement-div">
                <h6 class="measurement-heading"><strong>AVERAGE TIME </strong> GO TO SLEEP?</h6>
                <h4 class="measure-value float-left m-0"><strong>@if($avgAmoutGoToSleep){{date('h:i A', strtotime($avgAmoutGoToSleep))}}@endif </strong></h4>     
                <hr class="m-0">
            </div>
            <div class="measurement-div">
                <h6 class="measurement-heading"><strong>AVERAGE TIME </strong> WAKE UP?</h6>
                <h4 class="measure-value float-left m-0"><strong>@if($avgAmoutWakeUp){{date('h:i A', strtotime($avgAmoutWakeUp))}}@endif </strong></h4>  
                {{-- <h4 class="measure-value float-left m-0"><strong>{{date('H:i A', strtotime($sleepData['wake_up']))}} </strong></h4>      --}}
                <hr class="m-0">
            </div>
    </div>
        

    <div class="personal_dairy_section personal-measurement-mobile sleep-journal-section first-section">
        <h2 class="c-gray" style="float: left; max-width: max-content;"><strong>SLEEP</strong><br>JOURNAL</h2> <a href="#"
                                class="float-right clock-img"> <img src="{{asset('assets/images/clock.png')}}" alt="" >
                               
                            </a>
        <hr class="m-0">
    <div class="measurement-div">
        <h6 class="measurement-heading"><strong>WHAT TIME </strong> DID YOU GO TO BED?</h6>
        {{-- <h4 class="measure-value float-left m-0"><strong>{{$sleepData['go_to_bed']}} </strong> PM</h4> --}}
        {{-- <h4 class="measure-value float-left m-0"><strong>{{date('H:i A', strtotime($sleepData['go_to_bed']))}} </strong></h4> --}}
        <h4 class="measure-value float-left m-0"><strong>@if($sleepData['go_to_bed']){{date('h:i A', strtotime($sleepData['go_to_bed']))}} @endif</strong></h4> 
        <a class="bodyEditBtn float-right sleepData" data-mainname="TO BED" data-name="go_to_bed" data-val="{{$sleepData['go_to_bed']}}"> <i class="fa fa-edit gray-c"></i><span>EDIT</span></a>
        <hr class="m-0">
    </div>
    <div class="measurement-div">
        <h6 class="measurement-heading"><strong>WHAT TIME </strong> DID YOU GO TO SLEEP?</h6>
        <h4 class="measure-value float-left m-0"><strong>@if($sleepData['go_to_sleep']){{date('h:i A', strtotime($sleepData['go_to_sleep']))}} @endif</strong></h4>
        <a class="bodyEditBtn float-right sleepData" data-mainname="TO SLEEP" data-name="go_to_sleep" data-val="{{$sleepData['go_to_sleep']}}"> <i class="fa fa-edit gray-c"></i><span>EDIT</span></a>
        <hr class="m-0"> 
    </div>
    <div class="measurement-div">
        <h6 class="measurement-heading"><strong>WHAT TIME </strong> DID YOU GO WAKE UP?</h6>
        <h4 class="measure-value float-left m-0"><strong>@if($sleepData['wake_up']){{date('h:i A', strtotime($sleepData['wake_up']))}} @endif</strong></h4>
        <a  class="bodyEditBtn float-right sleepData" data-mainname="WAKE UP" data-name="wake_up" data-val="{{$sleepData['wake_up']}}"> <i class="fa fa-edit gray-c"></i><span>EDIT</span></a>
        <hr class="m-0">
    </div>
    <div style="max-width: 94%;margin-left: -5px;">
        <h6 class="measurement-heading text-center mt-10 mb-10"><strong>HOW DID YOU FEEL WHEN YOU WOKE UP?</strong></h6>
        <div class="persoanl_rating">
             <div class="star-rate" id="stress_rate1">
                <input type="radio" id="star51" name="morning_woke_up" value="3" @if($sleepData['morning_woke_up'] == 3) checked @endif/>
                <label for="star51" title="text">
                    <span class="select-multiple">AWAKE</span>
                </label>
                <input type="radio" id="star41" name="morning_woke_up" value="2" @if($sleepData['morning_woke_up'] == 2) checked @endif/>
                <label for="star41" title="text">
                    <span class="select-multiple">MEDIOCRE</span>
                </label>
                <input type="radio" id="star31" name="morning_woke_up" value="1" @if($sleepData['morning_woke_up'] == 1) checked @endif/>
                <label for="star31" title="text">
                    <span class="select-multiple">TIRED</span>
                </label>               
            </div>
        </div>
        <h6 class="measurement-heading text-center mb-10"><strong>HOW DID YOU FEEL AT THE END OF THE DAY? </strong></h6>
            <div class="persoanl_rating">
                <div class="star-rate" id="stress_ratee1">
                    <input type="radio" id="star21" name="end_of_day" value="3" @if($sleepData['end_of_day'] == 3) checked @endif>
                    <label for="star21" title="text">
                        <span class="select-multiple">AWAKE</span>
                    </label>
                    <input type="radio" id="star11" name="end_of_day" value="2" @if($sleepData['end_of_day'] == 2) checked @endif>
                    <label for="star11" title="text">
                        <span class="select-multiple">MEDIOCRE</span>
                    </label>
                    <input type="radio" id="star01" name="end_of_day" value="1" @if($sleepData['end_of_day'] == 1) checked @endif>
                    <label for="star01" title="text">
                        <span class="select-multiple">TIRED</span>
                    </label>               
                </div>
            </div>
        </div>
        <div class="form-group">
            <h6 class="measurement-heading text-left"><strong>GENERAL</strong> NOTES</h6>
            <textarea class="form-control textarea_height">{{$sleepData['general_notes']}}</textarea>
        </div>
        <div class="form-group">
             <div class="col-xs-12"><!-- <button>CANCEL</button> --></div>
            <div class="col-xs-12"><button class="save sleepSaveForm">SAVE</button></div>
        </div>
    </div>
</div>


<!-- Edit popup model start -->
@include('Result.dailydiary.sleep-modal')
<!-- Edit popup model end -->


@stop
@section('required-script')
<script type="text/javascript">
     $(document).on('click','.bodyEditBtn',function(){
         var name = $(this).attr('data-name');
         var val = $(this).attr('data-val');       
         var title = $(this).attr('data-mainname');
         var currentDate = $('.currentDate').val();
         console.log('name===', name, val, title);
         $('.sleepTitle').html(title);
         $('.currentDate').html(currentDate);
        //  $('.sleepValue').text(moment(val, 'HH:mm a').format('hh:mm A'));
        if(val == ''){
            $('.sleepValue').text('');
            $('.sleepLabel').text('');
            $('.go_to_sleep').val('');
        } else {
            $('.sleepValue').text(moment(val, 'HH:mm a').format('hh:mm'));
            $('.sleepLabel').text(moment(val, 'HH:mm a').format('A'));
            $('.go_to_sleep').val(moment(val, 'HH:mm a').format('hh:mm A'));
        }
       
         $('.editSaveSleepBtn').attr('data-name',name);
         $('#edit-measurement').modal('show');
     });

     $(document).on('click','.clock-img',function(){
         $('.personal_dairy_section.first-section').hide();
         $('.personal_dairy_section.second-section').show();                    
         $('.backtopage.second-btn').show();
         $('.backtopage.first-btn').hide();
     });

    $(document).on('click','.backtopage.second-btn',function(){
       $('.personal_dairy_section.first-section').show();
       $('.personal_dairy_section.second-section').hide();                    
       $('.backtopage.second-btn').hide();
       $('.backtopage.first-btn').show();
     });

     $(document).on('click','.editSaveSleepBtn',function(){
        var editItemName = $(this).attr('data-name');
         var formData = {};
         formData['event_date'] = $('.currentDate').attr('data-val');
         $('.sleepData').each(function() {
                var item_name = $(this).attr('data-name');
                console.log('item_name', item_name);
                if (item_name == editItemName) {
                     formData[item_name] = $('.go_to_sleep').val();
                } else {
                     formData[item_name] = $(this).attr('data-val');
                }
            });
            formData['morning_woke_up'] = $('input[name="morning_woke_up"]:checked').val();
            formData['end_of_day'] = $('input[name="end_of_day"]:checked').val();
            formData['general_notes'] = $('.textarea_height').val();
            console.log('hello',formData);
            $.post(public_url + 'calendar/store-sleep', formData, function(response) {
                if (response.status == 'ok') {
                            swal({
                                    type: 'success',
                                    title: 'Success!',
                                    showCancelButton: false,
                                    allowOutsideClick: false,
                                    text: response.message,
                                    showConfirmButton: true,
                                },
                                function(isConfirm) {
                                    if (isConfirm)
                                        location.reload();
                                });
                } else {
                            swal({
                                    type: 'error',
                                    title: 'Error!',
                                    showCancelButton: false,
                                    allowOutsideClick: false,
                                    text: response.message,
                                    showConfirmButton: true,
                                },
                     function(isConfirm) {
                        if (!isConfirm)
                                  location.reload();
                        });
                    }
             }, 'json');
     });

     $(document).on('click','.sleepSaveForm',function(){
           var formData = {};
           formData['event_date'] = $('.currentDate').attr('data-val');
           $('.sleepData').each(function() {
                var item_name = $(this).attr('data-name');
                formData[item_name] = $(this).attr('data-val');
            });
            formData['morning_woke_up'] = $('input[name="morning_woke_up"]:checked').val();
            formData['end_of_day'] = $('input[name="end_of_day"]:checked').val();
            formData['general_notes'] = $('.textarea_height').val();
            console.log('hello',formData);
            $.post(public_url + 'calendar/store-sleep', formData, function(response) {
                if (response.status == 'ok') {
                            swal({
                                    type: 'success',
                                    title: 'Success!',
                                    showCancelButton: false,
                                    allowOutsideClick: false,
                                    text: response.message,
                                    showConfirmButton: true,
                                },
                                function(isConfirm) {
                                    if (isConfirm)
                                        location.reload();
                                });
                } else {
                            swal({
                                    type: 'error',
                                    title: 'Error!',
                                    showCancelButton: false,
                                    allowOutsideClick: false,
                                    text: response.message,
                                    showConfirmButton: true,
                                },
                     function(isConfirm) {
                        if (!isConfirm)
                                  location.reload();
                        });
                    }
             }, 'json');
     });
  
    $(document).on('click', '.arrow-btn-click',function(){
       var date = $(this).attr('data-date');
       var type = $(this).attr('data-btn');
       console.log('date==',date,type);
       $.ajax({
             url: public_url + 'filter-sleep-graph',
             method: "get",
             data: {'date':date,'type':type},
             success: function(data) {
                 if(data.status == 'ok'){
                    $(".graph-div").html(data.html);
                 }    
             }
        });
    });
   

</script>
 @stop