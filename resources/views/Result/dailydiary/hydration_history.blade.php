@extends('Result.masters.app')
@section('required-styles')
{!! Html::style('result/css/custom.css?v='.time()) !!}
<style type="text/css">
section#page-title {
    display: none;
}

.confirm{
    background-color: #f94211 !important;
}
.modal, .modal-dialog {
    z-index: 99999999 !important;
}
.personal-measurement-mobile .col-xs-12 {
    width: 100% !important;
}
</style>

@stop
@section('content')
<div class="personal_mobile_top hydrationpage">
    @php
    if ($_GET) {
        $queryString = 'Yes';
    } else {
        $queryString = 'No';
    }
    @endphp
    <span>Daily </span> <br>Diary
    <div class="backtopage">
        {{-- <a href="{{url('calendar/hydration')}}"><i class="fa fa-long-arrow-left"></i> Back</a> --}}
        <a @if ($queryString == 'Yes') href="{{url('calendar/hydration?date=' . $eventDate)}}" @else href="{{url('calendar/hydration')}}"@endif><i class="fa fa-long-arrow-left"></i> Back</a>
    </div>
    
</div>
<div class="personal_mobile_details" id="HydrationJournalHistory">
    <div class="personal_dairy_section tab-pane" id="HydrationJournal">
        <h2 class="c-gray m-0"><strong>HYDRATION</strong><br>JOURNAL</h2>
        <h6 class="measurement-heading"><strong>HYDRATION </strong> HISTORY</h6>
        <div class="consume-history">
            @foreach($consumedHistory as $data)
             <span class="non-edit"> {{$data['liquidType']}}-{{date('h:i a', strtotime($data['time']))}} - {{$data['volume']}}ml , {{$data['text']}} 
                <i class="fa fa-pencil editDataMob" data-id="{{$data['id']}}" data-time="{{$data['time']}}" data-name="{{$data['liquidType']}}" data-volume="{{$data['volume']}}" data-msg="{{$data['text']}}" data-drinkid="{{$data['drinkType']}}"></i></span>     
            @endforeach
        </div>
        <!-- <table width="100%" class="hydration-history-table">
          @foreach($consumedHistory as $data)
          <tr>
            {{-- {{date('h:i A', strtotime($sleepData['wake_up']))}} --}}
            <td>{{date('h:i a', strtotime($data['time']))}} &#8212;</td>
            <td> {{$data['liquidType']}} &#8212;</td>
            <td> {{$data['volume']}}ml </td>
          </tr>
          @endforeach
        </table> -->
    </div>
</div>
@stop
@section('required-script')
<script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click','.editDataMob',function(){
                 var HydrationJournalHistory = $('#HydrationJournalHistory');
                var hydrationJournalId = $(this).data('id');
                var hydrationJournalTime = $(this).data('time');
                // var hydrationJournalLiquidType = $(this).data('name');
                var hydrationJournalVolume = $(this).data('volume');
                var hydrationJournalText= $(this).data('msg');
                var hydrationJournalDrinkID= $(this).data('drinkid');
                console.log(hydrationJournalVolume,hydrationJournalId);
                HydrationJournalHistory.find($(this).closest('.non-edit').after("<span class='edit'><input type='hidden' name='hydrationJournalId' value='"+hydrationJournalId+"'><select class='name'><option class='hydration-name-"+hydrationJournalId+"' value='1'>water</option><option class='hydration-name-"+hydrationJournalId+"' value='2'>Coffee</option><option class='hydration-name-"+hydrationJournalId+"' value='3'>Tea</option><option class='hydration-name-"+hydrationJournalId+"' value='4'>Juice</option><option class='hydration-name-"+hydrationJournalId+"' value='5'>Soda</option><option class='hydration-name-"+hydrationJournalId+"' value='6'>Milk</option><option class='hydration-name-"+hydrationJournalId+"' value='7'>Alcohal</option><option class='hydration-name-"+hydrationJournalId+"' value='8'>Sports Drink</option></select><label class='time'><span class='showtime'> "+moment(hydrationJournalTime, 'HH:mm a').format('hh:mm A')+" </span>&nbsp;<a href='javascript:void(0)' class='nav-link hydrationEditDatetimePickerChange'>Change</a></label><select class='ml-l ml'><option class='hydration-volume-"+hydrationJournalId+"' value='100'>100</option><option class='hydration-volume-"+hydrationJournalId+"' value='200'>200</option><option class='hydration-volume-"+hydrationJournalId+"' value='300'>300</option><option class='hydration-volume-"+hydrationJournalId+"' value='400'>400</option><option class='hydration-volume-"+hydrationJournalId+"' value='500'>500</option><option class='hydration-volume-"+hydrationJournalId+"' value='600'>600</option><option class='hydration-volume-"+hydrationJournalId+"' value='700'>700</option><option class='hydration-volume-"+hydrationJournalId+"' value='800'>800</option><option class='hydration-volume-"+hydrationJournalId+"' value='900'>900</option><option class='hydration-volume-"+hydrationJournalId+"' value='1000'>1000</option></select><span class='value-l'>ml</span><br><textarea class='hydrationText' placeholder='Message'>"+hydrationJournalText+"</textarea><div class='form-group'><button class='update-btn updateHydrationHistory'>Update</button></div></span>"));
                HydrationJournalHistory.find($(this).closest('.non-edit').remove());
                $("option[class='hydration-name-"+hydrationJournalId+"'][value='"+hydrationJournalDrinkID+"']").attr('selected','selected');
                $("option[class='hydration-volume-"+hydrationJournalId+"'][value='"+hydrationJournalVolume+"']").attr('selected','selected');
                    $('.hydrationEditDatetimePickerChange').bootstrapMaterialDatePicker({
                    date: false,
                    shortTime: true,
                    format: 'HH:mm:ss',
                    currentDate: '09:00 AM'
                }).change(function(e, date) {
                    var time = date.format("hh:mm A");
                    var timeHH = date.format("HH:mm:ss");
                    var displayTime= $(this).closest('.time');
                    displayTime.find('.showtime').text(time);                     
                });
          });

          
        $('body').on('click','.updateHydrationHistory',function(){
            $('#waitingShield').removeClass('hidden');
           var editForm= $(this).closest('.edit');
           var formData={};
            formData['id'] = $('input[name="hydrationJournalId"]').val();
            formData['liquidType'] = editForm.find('.name').val();
            formData['drank'] = editForm.find('.ml').val();
            formData['time'] = moment(editForm.find('.showtime').text(), 'HH:mm a').format('HH:mm:ss');
            formData['hydrationText'] =  editForm.find('.hydrationText').val();
            console.log('formData=', formData);
            $.post(public_url+"update-hydration-data",formData,function(response){
                  $('#waitingShield').addClass('hidden');
                    if(response.status == 'ok'){
                        swal({
                            type: 'success',
                            title: 'Success!',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            text: 'Data update successfully',
                            showConfirmButton: true,     
                        }, 
                        function(isConfirm){
                            if(isConfirm)
                             location.reload();
                        });
                    }else{
                        swal({
                            type: 'error',
                            title: 'Error!',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            text: response.message,
                            showConfirmButton: true,     
                        }, 
                        function(isConfirm){
                            if(!isConfirm)
                              location.reload();
                        });
                    }
                });
            });
        });
</script>
@stop
