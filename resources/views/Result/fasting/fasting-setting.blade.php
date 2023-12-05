@extends('Result.masters.app')
@section('required-styles')
{!! Html::style('result/css/custom.css?v='.time()) !!}
<style type="text/css">
    @media (max-width: 767px) {
        section#page-title {
            display: none;
        }

        #app>footer {
            display: none;
        }

        .modal,
        .modal-dialog {
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
        <div class="fasting_setting_section">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
                    <h2 class="mobile-page-heading"><strong>Setting</strong> </h2>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 text-right">
                    <div class="fasting_back text-right">
                        <a href="{{ url('fasting-clock-controller') }}">Back</a>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                    <fieldset class="padding-15">
                        <legend>Summary</legend>
                        {{-- {{dd($fastingData)}} --}}
                        <div class="form-group">
                            <label class="strong" for="goalWantTobe">What do you want to achieve </label><br>
                            {{$fastingData->achieve}}
                        </div>

                        <div class="form-group">
                            <label class="strong" for="goalWantfeel">Age </label><br>
                            {{\Carbon\Carbon::parse($fastingData->date_of_birth)->age}} years old
                        </div>

                        <div class="form-group">
                            <label class="strong" for="goalWantHave">Gender </label><br>
                            {{$fastingData->gender}}   
                        </div>
                        <div class="form-group">
                            <label class="strong" for="supportFamily">Experience level </label><br>
                            {{$fastingData->experience}}
                        </div>

                        <div class="form-group">
                            <label class="strong" for="supportFriends">Weight </label><br>
                            {{$fastingData->weight}}
                        </div>

                        <div class="form-group">
                            <label class="strong" for="supportWork">Height </label><br>
                            {{$fastingData->height}}
                        </div>
                        {{-- @php                   
                            $protocol =  json_decode($fastingData->protocol_other);
                        @endphp --}}
                        <div class="form-group">
                            <label class="strong">Meal type</label><br>
                            @if($fastingData->protocol != 'Other'){{$fastingData->protocol}} 
                            @else
                             Custom
                            @endif  
                        </div>
                        <div class="form-group">
                            <label class="strong" for="smartGoalNotes">Start day</label><br>
                             @if($fastingClockArray){{date('d/m/Y', strtotime($fastingClockArray['start_fast']))}} @endif
                        </div>
                        <div class="form-group">
                            <label class="strong" for="smartGoalNotes">Start time</label><br>
                            @if($fastingClockArray){{date('h:i A', strtotime($fastingClockArray['start_fast']))}} @endif
                        </div>
                        <div class="form-group">
                            <label class="strong" for="smartGoalNotes">Type of fasting</label><br>
                            {{$fastingData->auto_diy}} 
                        </div>                        
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <a data-toggle="modal" data-target="#startOver" href="" class="start_over">Start Over</a>
                        <a data-toggle="modal" data-target="#stopCycle" href="" class="start_over btn-default">Stop cycle</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div id="startOver" class="modal fade mobile_popup_fixed" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content animate-bottom">
            <!-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div> -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h4>Are you sure you want to start the configuration process again?</h4>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary setting-status">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="stopCycle" class="modal fade mobile_popup_fixed" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content animate-bottom">
            <!-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div> -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h4>Are you sure you want to stop this cycle? </h4>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary stop-cycle">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('required-script')
<script>
$('.setting-status').on('click',function(){
    $.ajax({
        url: public_url + 'fasting-setting-status',
        type: 'GET',
        // data: {'data': formData},
        success: function(data) {
            if(data.status =="ok"){
               window.location.href = public_url+"fasting-form"; 
            }
            
        }
    });
});

  $(document).on('click','.stop-cycle',function(){

        $.ajax({
            url: public_url + 'stop-cycle',
            type: 'POST',
            // data: {'data': formData},
            success: function(data) {

                if(data.status =="ok"){

                   window.location.href = public_url+"fasting"; 
                }
                
            }
        });

  });

</script>
@stop 