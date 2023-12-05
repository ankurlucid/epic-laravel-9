@extends('Result.masters.app')
@section('required-styles')
{!! Html::style('result/css/custom.css?v='.time()) !!}
<style type="text/css">
section#page-title {
    display: none;
}
.star-rate:not(:checked) > input{
    display: none;
    top: 0;
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
   <!--   <span>Personal</span> <br>Diary -->
   <span>Daily</span> <br>Diary 
    <div class="backtopage">
        <a @if($queryString =='Yes') href="{{url('calendar/daily-dairy?date='.$eventDate)}}" @else href="{{url('calendar/daily-dairy')}}" @endif><i class="fa fa-long-arrow-left"></i> Back </a>
    </div>
</div>
<input hidden value="{{$eventDate}}" class="event-date" name="eventDate">
<div class="personal_mobile_details">
    <div class="personal_dairy_section">
        <h2><strong>Personal</strong><br>Diary</h2>
        <div class="form-group">
            <h3>Journal</h3>
            <textarea name="diary_content" id="diaryContent" class="form-control textarea_height">{{$personalDiary['content']}}</textarea>
        </div>
        <div class="form-group">
            <h3>Stress <span>(1 Low - 5 High)</span></h3>
            <div class="persoanl_rating">
             <div class="star-rate"  id="stress_rate">
                <input type="radio" id="star5" name="stress_rate" value="5" @if($personalDiary['stress_rate'] == 5) checked @endif/>
                <label for="star5" title="text">
                    <span class="select-multiple">Very</span>
                </label>
                <input type="radio" id="star4" name="stress_rate" value="4"  @if($personalDiary['stress_rate'] == 4) checked @endif/>
                <label for="star4" title="text">
                    <span class="select-multiple">High</span>
                </label>
                <input type="radio" id="star3" name="stress_rate" value="3" @if($personalDiary['stress_rate'] == 3) checked @endif/>
                <label for="star3" title="text">
                    <span class="select-multiple">Moderate</span>
                </label>
                <input type="radio" id="star2" name="stress_rate" value="2" @if($personalDiary['stress_rate'] == 2) checked  @endif/>
                <label for="star2" title="text">
                    <span class="select-multiple">Low</span>
                </label>
                <input type="radio" id="star1" name="stress_rate" value="1" @if($personalDiary['stress_rate'] == 1) checked @endif/>
                <label for="star1" title="text">
                    <span class="select-multiple">Non</span>
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <h3>Humidity <span>(1 Low - 5 High)</span></h3>
        <div class="persoanl_rating">
            <div class="star-rate" id="humidity">                    
                <input type="radio" id="humidity5" name="humidity" value="5" @if($personalDiary['humidity'] == 5) checked @endif/>
                <label for="humidity5" title="text">
                    <span class="select-multiple">Humid</span>
                </label>
                <input type="radio" id="humidity4" name="humidity" value="4" @if($personalDiary['humidity'] == 4) checked @endif/>
                <label for="humidity4" title="text">
                    <span class="select-multiple">Hot</span>
                </label>
                <input type="radio" id="humidity3" name="humidity" value="3" @if($personalDiary['humidity'] == 3) checked @endif/>
                <label for="humidity3" title="text">
                    <span class="select-multiple">Moderate</span>
                </label>
                <input type="radio" id="humidity2" name="humidity" value="2" @if($personalDiary['humidity'] == 2) checked @endif/>
                <label for="humidity2" title="text">
                    <span class="select-multiple">Mid</span>
                </label>
                <input type="radio" id="humidity1" name="humidity" value="1" @if($personalDiary['humidity'] == 1) checked @endif/>
                <label for="humidity1" title="text">
                    <span class="select-multiple">Dry</span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <h3>Temperature</h3>
                @php
                     $tempNumber = [];
                     foreach (range(35, -10) as $number) {
                        $tempNumber[] = $number;
                       }
                @endphp
            <select class="form-control" id="temperatureEdit" name="temp">
                @foreach( $tempNumber as $num)
                    <option value="{{$num}}" {{ $personalDiary['temperature'] == $num ? "selected" : "" }}>{{$num}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12 col-ms-12 col-xs-12 text-center">
                    {{-- <button type="button" class="cancl-btn" data-dismiss="modal">Cancel</button> --}}
                    <button type="button" class="save-btn personalSaveStats">Save</button>
                </div>

            </div>
        </div>
    </div>
</div>

</div>
@stop
@section('required-script')
<script>
    $( document ).ready(function() {
        $('body').on('click','.personalSaveStats',function(){
            var formData = {};
            formData['event_date'] = $('input[name="eventDate"]').val();
            formData['diaryData'] = {};
            formData['diaryData']['content'] = $('#diaryContent').val();
            formData['diaryData']['stress_rate'] =$('input[name="stress_rate"]:checked').val();
            formData['diaryData']['humidity'] = $('input[name="humidity"]:checked').val();
            formData['diaryData']['temp'] = $('#temperatureEdit').val();
            console.log('formData ---',formData);
            $.post(public_url+'calendar/personal-dairy-store',formData,function(response){
                console.log('response==', response);
                if(response.status == 'ok'){
                    swal({
                        type: 'success',
                        title: 'Success!',
                        showCancelButton: false,
                        allowOutsideClick: false,
                        text: response.message,
                        showConfirmButton: true,     
                    }, 
                    function(isConfirm){
                        if(isConfirm)
                            StatsModal.modal('hide');
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
                            StatsModal.modal('hide');
                    });
                }
            },'json');
        });

    });
</script>
@stop