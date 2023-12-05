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
        <a @if ($queryString == 'Yes') href="{{ url('calendar/daily-dairy?date=' . $eventDate) }}" @else href="{{ url('calendar/daily-dairy') }}" @endif><i class="fa fa-long-arrow-left"></i> Back</a>
    </div>
    <input hidden value="{{date('d M Y', strtotime($eventDate))}}" data-val="{{$eventDate}}" class="currentDate"> 
    <input type="hidden" id="fetchUserWeight" value="{{$weight}}" name="weight">
    <div class="modal fade" id="staticBackdropMob" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
      
              <h5 class="modal-title" id="staticBackdropLabel">Please Enter Your Weight</h5>
      
      
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <button type="button" class="btn btn-primary btn-o btn-sm p-y-0 bg-none mli-10 pull-right" id="convertPound">Show Imperial</button>
               <button type="button" class="btn btn-primary hidden btn-o btn-sm p-y-0 bg-none mli-10 pull-right" id="convertKg">Show Metric</button>
               <div class="input-group">
               
               <input type="text" class="form-control" id="weight_save" name="weight" value="">
               <span class="input-group-addon kg">Kg</span>
               <span class="input-group-addon pound hidden">Pounds</span>
               <input type="hidden" name="weightUnit" value="{{ isset($weightUnit) && $weightUnit !=null?$weightUnit:'Metric' }}">
      
               </div>
              
      
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary saveWeightMob">Save</button>
            </div>
          </div>
        </div>
      </div>

    {{--  --}}
</div>
<div class="personal_mobile_details">
    <div class="personal_dairy_section tab-pane" id="HydrationJournal">
       <h2 class="c-gray"><strong>HYDRATION</strong><br>JOURNAL</h2>

       <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="water-select-type">

             <div class="row">
                 <div class="col-xs-6">
                    <input type="radio" name="liquidtype" value="{{\App\HydrationJournal::WATER}}" id="waterType">
                    <label for="waterType">Water</label> 

                    <input type="radio" name="liquidtype" id="coffeeType" value="{{\App\HydrationJournal::COFFEE}}">
                    <label for="coffeeType">Coffee</label>              

                    <input type="radio" name="liquidtype" id="teaType" value="{{\App\HydrationJournal::TEA}}">
                    <label for="teaType">Tea</label>  

                    <input type="radio" name="liquidtype" id="MilkType" value="{{\App\HydrationJournal::MILK_ALCOHAL}}">
                    <label for="MilkType">Milk</label>                                          


                </div>
                <div class="col-xs-6">
                  <input type="radio" name="liquidtype" id="SodaType" value="{{\App\HydrationJournal::SODA}}">
                  <label for="SodaType">Soda</label> 


                  <input type="radio" name="liquidtype" id="JuiceType" value="{{\App\HydrationJournal::JUICE}}">
                  <label for="JuiceType">Juice</label>

                  <input type="radio" name="liquidtype" id="DrinkType" value="{{\App\HydrationJournal::SPORTS_DRINKS}}">
                  <label for="DrinkType">Sports Drink</label>

                  <input type="radio" name="liquidtype" id="AlcohalType" value="{{\App\HydrationJournal::ALCOHAL}}">
                  <label for="AlcohalType">Alcohal</label>
              </div>
          </div>
      </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
        <textarea class="form-control" id="hydr-journal-mob" name="hydration"></textarea>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="bottle-scroll-bar">
        <span class="range-slider-title">I Drank</span><br>
        <span class="range-slider_value">0</span>&nbsp;<span style="font-size: 17px !important;"> Millilitres</span>
        <div class="number">
            <div class="">
                <span class="minus" id="minusMob">-</span>
                <input class="range-slider_range" type="range" value="0" min="0" max="1000" step="100">
                <span class="plus" id="plusMob">+</span>
            </div>
        </div>

    </div>
</div>
   @php
    //   $hydrationJournalData['required_amount'] = 0;
    //   $hydrationJournalData['consumed'] =200;
      $consumedPer = ($hydrationJournalData['consumed']/($hydrationJournalData['required_amount'] * 1000)) * 100;
      if(is_nan($consumedPer) || $consumedPer == INF){
         $consumedPer = 0;
      }
      $consumedPer = number_format($consumedPer, 2, '.', '');
   @endphp
  <div class="col-xs-12">
    <div class="water-bottle-section">
        <hr class="orng-line">
        <div class="bottle-img">
            <div id="bottle" class="fill-bottle-img" style="height:{{$consumedPer}}%;"></div>
            <div class="blank-bottle-img"></div>
            <h2 class="consumed-per">{{$consumedPer}}%</h2>
        </div>
        <input type="hidden" name="required" value="{{$hydrationJournalData['required_amount']}}">
        <input type="hidden" name="consumed" value="{{$hydrationJournalData['consumed']}}">
        <div class="dateright">
            <div class="required-text">
                <span>Required</span>
                <strong class="requiredDrinkVolume">{{$hydrationJournalData['required_amount']}} L</strong> 
            </div>
            <div class="consumed-text">Consumed
                <h3 style="float:none;" class="consumedDrink">{{round($hydrationJournalData['consumed']/1000, 2)}}
                    L</h3>
              
            </div>
            <h4 class="view-history"><a @if ($queryString == 'Yes') href="{{url('calendar/hydration-history?date=' . $eventDate)}}" @else href="{{url('calendar/hydration-history')}}" @endif><strong>VIEW</strong>&nbsp;HISTORY</a></h4>
            
        </div>
    </div>
</div>
<div class="col-xs-12 text-center">
    <button class="save-btn saveHydrationData">SAVE</button>
</div>

</div>
</div>
</div>
@stop
@section('required-script')
<script type="text/javascript">
        $(document).ready(function() {
            var weight = $('#fetchUserWeight').val();
            console.log('weight=', weight);
            if(weight == 0){
                $('#staticBackdropMob').modal('show');
            }
        // var eventDate = moment().format('YYYY-MM-DD');
        // $('.currentDate').attr('data-val',eventDate);
        // console.log('eventDate', eventDate);
        $('#minusMob').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 100;
            count = count < 0 ? 0 : count;
            $input.val(count);
            $input.trigger('input');
            $('#HydrationJournal').find('.range-slider_value').text(count);
            return false;
        });
        $('#plusMob').click(function () {
            var $input = $(this).parent().find('input');
            // console.log('hii', $input);
            var count = parseInt($input.val()) + 100;
            count = count > 1000 ? 1000 : count;
            $input.val(count);
            $input.trigger('input');
            $('#HydrationJournal').find('.range-slider_value').text(count);
            return false;
        });

        $(document).on('input', '.range-slider_range', function() {
            $('.range-slider_value').text( $(this).val());
            var consumed =  $('#HydrationJournal').find('input[name="consumed"]').val();
            var updatedConsumed = parseFloat(consumed) + parseFloat($(this).val());
            $('#HydrationJournal').find('.consumedDrink').text((updatedConsumed/1000).toFixed(1)+' L');
            var requiredVoluume = $('#HydrationJournal').find('input[name="required"]').val();
            var consumedPer = (updatedConsumed/(requiredVoluume * 1000)) * 100;
            consumedPer = consumedPer.toFixed(2);
            if(consumedPer == 'Infinity' || consumedPer == 'NaN'){
                consumedPer = '0.00';
            }
            console.log('consumedPer==', consumedPer);
            $('#HydrationJournal').find('.consumed-per').text(consumedPer+"%");
            $("#bottle").css({
                height: function( index, value ) {
                    return consumedPer+"%";
                }
            });
         });

         $('body').on('click','.saveHydrationData',function(){
            var formData = {};
            formData['event_date'] =  $('.currentDate').attr('data-val');
            formData['liquidType'] = $('#HydrationJournal').find('input[name="liquidtype"]:checked').val();
            formData['hydrationText'] = $('#HydrationJournal').find('#hydr-journal-mob').val();
            formData['drank'] = $('#HydrationJournal').find('.range-slider_range').val();
            formData['time'] = moment().format('HH:mm:ss');
            console.log(formData);
            if(formData['liquidType'] != '' && formData['liquidType'] != undefined){
                $('#waitingShield').removeClass('hidden');
                $.post(public_url+"calendar/store-hydration-data-mob",formData,function(response){
                    $('#waitingShield').addClass('hidden');
                    if(response.status == 'ok'){
                        swal({
                            type: 'success',
                            title: 'Success!',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            text: 'Data saved successfully',
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
                }else{
                    swal({
                        type: 'error',
                        title: 'Error!',
                        showCancelButton: false,
                        allowOutsideClick: false,
                        text: "Please Select drink type",
                        showConfirmButton: true,     
                    }, 
                    function(isConfirm){
                        if(!isConfirm)
                            swal.close();
                    });
                }
            });

           $('body').on('click','.saveWeightMob',function(){
                var formData = {};   
                formData['weight']  = $('#staticBackdropMob').find('#weight_save').val();
                formData['weightUnit']  = $('#staticBackdropMob').find('input[name="weightUnit"]').val();
                formData['event_date'] = $('.currentDate').attr('data-val');
                $.post(public_url+'store-weight-data',formData,function(response){
                    if(response.status == 'ok'){
                        $('#staticBackdropMob').modal('hide');
                        swal({
                            type: 'success',
                            title: 'Success!',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            text: 'Data saved successfully',
                            showConfirmButton: true,     
                        }, 
                        function(isConfirm){
                            if(isConfirm){
                                // resetStatisticModal();
                                location.reload();
                                // formData['eventDate'] = StatsModal.find('input[name="eventDate"]').val();
                                // $.get(public_url+'get-statistics-data',formData,function(response){
                                //     populateStatisticsData(response);
                                // },'json');
                            }
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
