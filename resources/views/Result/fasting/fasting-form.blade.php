@extends('Result.masters.app')
@section('required-styles')
<!-- start: Bootstrap datepicker --> 
{!! Html::style('assets/plugins/datepicker/css/datepicker.css?v='.time()) !!}
<!-- end: Bootstrap datepicker -->

{{-- <!-- Start: NEW timepicker css -->  
{!! Html::style('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css?v='.time()) !!} --}}
<!-- End: NEW timepicker css -->

<!-- Start: NEW datetimepicker css -->
{!! Html::style('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css?v='.time()) !!}
{!! Html::style('assets/plugins/bootstrap-material-datetimepicker/css/custom-css-style.css?v='.time()) !!}
<!-- End: NEW datetimepicker css -->
{!! Html::style('result/css/custom.css?v='.time()) !!}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
body>.new-loader{
            z-index: 999999999999;
            background: white;
        }
        body>.new-loader div{
            display: block;
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

        <div id="wizard_container">
            <!-- /top-wizard -->
            <div class="step_count_section">
                <div class="fasting_back">
                    <!-- <a href="javascript:void(0)">Back</a> -->
                    <a style="color:#FF571B" data-toggle="modal" data-target="#fastingBack" href="" class="fastingBack">Back</a>
                </div>
            </div>

            <div id="fastingBack" class="modal fade mobile_popup_fixed" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content animate-bottom">
                        <!-- <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div> -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h4> Are you sure you want to go back ? </h4>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <button type="button" class="btn btn-primary fasting-back-yes">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <form name="formPQ" action="#" role="form" id="fasting-wizard">
                <input hidden value="{{$fastingData->id ?? ''}}" id="fastingID">
                <input type="hidden" name="protocol_ajax_call" id="protocol_ajax_call" value="0">
            {{-- <div id="fasting-wizard"> --}}       
                <div class="step">
                    <div class="fasting_heading_section">
                        <h2><strong>What Do You</strong> <br>Want to Achieve? </h2>
                        <p>Having a clear & concise idea of what your desired result is will keep you motivated and focused. This information also helps us provide a unique plan for your specific Lifestyle Design Journey.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <div class="form-group achieve_form">
                                <input type="radio" name="achieve" value="manage weight" class="hidden" id="ManageWeight" @if($fastingData->achieve) {{ $fastingData->achieve == "manage weight" ? 'checked' : '' }} @endif>
                                <label for="ManageWeight">
                                    <strong>Manage</strong>
                                    <span>Weight</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <div class="form-group achieve_form">
                                <input type="radio" name="achieve" value="gain muscle" class="hidden" id="GainMuscle" @if($fastingData->achieve) {{ $fastingData->achieve == "gain muscle" ? 'checked' : '' }} @endif>
                                <label for="GainMuscle">
                                    <strong>Gain</strong>
                                    <span>Muscle</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <div class="form-group achieve_form">
                                <input type="radio" name="achieve" value="increase energy" class="hidden" id="IncreaseEnergy" @if($fastingData->achieve) {{ $fastingData->achieve == "increase energy" ? 'checked' : '' }} @endif>
                                <label for="IncreaseEnergy">
                                    <strong>Increase</strong>
                                    <span>Energy</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <div class="form-group achieve_form">
                                <input type="radio" name="achieve" value="mental clarity" class="hidden" id="MentalClarity" @if($fastingData->achieve) {{ $fastingData->achieve == "mental clarity" ? 'checked' : '' }} @endif>
                                <label for="MentalClarity">
                                    <strong>Mental</strong>
                                    <span>Clarity</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <div class="form-group achieve_form">
                                <input type="radio" name="achieve" value="improved sleep" class="hidden" id="ImprovedSleep" @if($fastingData->achieve) {{ $fastingData->achieve == "improved sleep" ? 'checked' : '' }} @endif>
                                <label for="ImprovedSleep">
                                    <strong>Improved</strong>
                                    <span>Sleep</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <div class="form-group achieve_form">
                                <input type="radio" name="achieve" value="healthy lifestyle" class="hidden" id="HealthyLifestyle" @if($fastingData->achieve) {{ $fastingData->achieve == "healthy lifestyle" ? 'checked' : '' }} @endif>
                                <label for="HealthyLifestyle">
                                    <strong>Healthy</strong>
                                    <span>Lifestyle</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step">
                    <div class="fasting_heading_section">
                        <h2><strong>How Old</strong> <br>Are You? </h2>
                        <p>Please provide your date of birth, including, year, month and day.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-8 col-md-12">
                            {{-- <div class="form-group age_date"> --}}
                                <div class="form-group">
                                  @if($fastingData->date_of_birth)
                                    <input type="text" id="date" name="date_of_birth"  class="date form-control datepicker" placeholder="Date" @if($fastingData->date_of_birth != "0000-00-00" ) value="{{date('d-m-Y', strtotime($fastingData->date_of_birth))}}" @else value="" @endif>
                                   @else
                                     <input type="text" id="date" name="date_of_birth"  class="date form-control datepicker" placeholder="Date" @if($personal_detail->birthday != "0000-00-00") value="{{date('d-m-Y', strtotime($personal_detail->birthday))}}" @else value="" @endif>
                                   @endif
                                {{-- <input type="date" class="form-control datepicker"  name="date_of_birth"  @if($fastingData->date_of_birth) value="{{$fastingData->date_of_birth}}" @else value="{{$personal_detail->birthday}}" @endif> --}}
                                 {{-- <input type="text" id="date" name="date_of_birth"  class="date form-control datepicker" placeholder="Date" @if($fastingData->date_of_birth) value="{{date('d-m-Y', strtotime($fastingData->date_of_birth))}}" @else value="{{date('d-m-Y', strtotime($personal_detail->birthday))}}" @endif> --}}
                                 {{-- <input type="text" id="date" name="date_of_birth"  class="date form-control datepicker" placeholder="Date" @if($fastingData->date_of_birth) value="{{$fastingData->date_of_birth}}" @else value="{{$personal_detail->birthday}}" @endif> --}}
                            </div>
                        </div>
                    </div>
                   @php
                      if($fastingData->date_of_birth){
                            if($fastingData->date_of_birth != "0000-00-00"){
                            $dateOfBirth = $fastingData->date_of_birth;
                            $today = date("Y-m-d");
                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                            $age = $diff->format('%y');
                            if($age < 10){
                                $age = "0". $age;
                            }
                        } else {
                            $age = 0;
                        }
                            
                      } else {
                           if($personal_detail->birthday != "0000-00-00"){
                                $dateOfBirth = $personal_detail->birthday;
                                $today = date("Y-m-d");
                                $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                $age = $diff->format('%y');
                                if($age < 10){
                                    $age = "0". $age;
                                 }
                           } else {
                                $age = 0;
                           }
                            
                      }
                     
                   @endphp
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-8 col-md-12 text-center">
                            <div class="form-group">
                                <div class="tatal_age">
                                     <span class="show-age">{{ $age}}</span> <span>YEARS OLD</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step">
                    <div class="fasting_heading_section">
                        <h2><strong>How Do You</strong> <br>Identify your Gender? </h2>
                        <p>Please provide your biological gender as fasting is gender specific.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="gender" value="Male" class="hidden" id="Male" @if($fastingData->gender) {{ ($fastingData->gender=="Male")? "checked" : "" }} @else{{ ($personal_detail->gender=="Male")? "checked" : "" }} @endif>
                                <label for="Male"><strong>Male</strong></label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="gender"  value="Female"  class="hidden" id="Female" @if($fastingData->gender) {{ ($fastingData->gender=="Female")? "checked" : "" }} @else{{ ($personal_detail->gender=="Female")? "checked" : "" }} @endif>
                                <label for="Female"><strong>Female</strong></label>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="gender" value="Other" class="hidden" id="Other" @if($fastingData->gender) {{ ($fastingData->gender=="Other")? "checked" : "" }} @else {{ ($personal_detail->gender!="Male" && $personal_detail->gender!="Female")? "checked" : "" }} @endif >
                                <input type="radio" name="gender" value="Other" class="hidden" id="Other" @if($fastingData->gender) {{ ($fastingData->gender=="Other")? "checked" : "" }} @endif >
                                <label for="Other"><strong>Other</strong></label>
                            </div>
                        </div> --}}                        
                    </div>
                </div>
                 @php
                    $weight = $measurement['weight'];

                    if($measurement['weightUnit'] == 'Imperial'){

                        $weightInKg = ($weight / 2.2046226218);
                        $weight = round($weightInKg, 0);

                    }elseif($measurement['weightUnit'] == 'Metric'){

                        $weight = round($weight,0);
                    } 
                    
                    $height = $measurement['height'];
                    if($measurement['heightUnit'] == 'inches'){
                        $heightInCm = ($height / 0.393701);
                        $height = round($heightInCm, 0);
                    }
                @endphp    
                <div class="step">
                    <div class="fasting_heading_section">
                        <h2><strong>How much do you weigh</strong> <br>& how tall are you? </h2>
                        <p>Please provide this as accurately as possible as this is critical to setting the correct protocol.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form weight_height weightactive">
                                
                                <label for="Weight">
                                    <strong>Weight</strong>
                                    <span>
                                    {{-- <input type="text" name="weight" class="" id="Weight" onkeypress="this.style.width = ((this.value.length + 1) * 25) + 'px';"> --}}
                                    <input type="number" name="weight" @if(isset($weight)) value="{{$weight}}" @else value="{{ $fastingData->weight }}" @endif class="" id="Weight" onkeypress="this.style.width = ((this.value.length + 1) * 25) + 'px';">
                                     kg</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form weight_height heightactive">                               
                                <label for="Height">
                                    <strong>Height</strong>
                                    <span>
                                    <input type="number" name="height" class="" @if($fastingData->height) value="{{$fastingData->height}}" @else value="{{ $height}}" @endif  id="Height" onkeypress="this.style.width = ((this.value.length + 1) * 25) + 'px';">
                                    cm</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step">
                    <div class="fasting_heading_section">
                        <h2><strong>What is your</strong> <br>Experience to fasting </h2>
                        <p>Please provide your personal experience to intermittent Fasting?.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="experience" data-val="beginner" value="Beginner" class="hidden" id="Beginner" @if($fastingData->experience) {{ ($fastingData->experience=="Beginner")? "checked" : "" }} @endif>
                                <label for="Beginner">
                                    <strong>Beginner</strong>
                                    <span>New to fasting and the benefits</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="experience" data-val="intermediate" value="Intermediate" class="hidden" id="Intermediate" @if($fastingData->experience) {{ ($fastingData->experience=="Intermediate")? "checked" : "" }} @endif>
                                <label for="Intermediate">
                                    <strong>Intermediate</strong>
                                    <span>Have dabbled in the past but want to know more.</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="experience" data-val="advanced" value="Advanced" class="hidden" id="Advanced" @if($fastingData->experience) {{ ($fastingData->experience=="Advanced")? "checked" : "" }} @endif>
                                <label for="Advanced">
                                    <strong>Advanced</strong>
                                    <span>Intermittent fast for some time on a regular basis and know what is best for me.</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="step">
                    
                    <div class="fasting_heading_section">
                        <h2><strong>Choose the best</strong> <br>Protocol for yourself?</h2>
                        <p>This is based on your specific lifestyle and routines, we have recommended a few plans, choose the most appropriate one that suits you.</p>
                    </div>

                    <div class="all_protocol_div">
                        
                        {{-- Beginner --}}
                        <div class="row beginner hidden">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group achieve_form">
                                    {{-- <input type="radio" name="protocol" class="hidden" value="12/12 (Basic)" id="ChooseMealsOne" @if($fastingData->protocol) {{ ($fastingData->protocol=="14/30 (3 Meals)")? "checked" : "" }} @endif> --}}
                                    <input type="radio" name="protocol" class="hidden protocol-click" value="12/12 (Basic)" id="ChooseMealsOneBeginner" @if($fastingData->protocol) {{ ($fastingData->protocol=="12/12 (Basic)")? "checked" : "" }} @endif>
                                    <label for="ChooseMealsOneBeginner">
                                        <strong>12/12 (BASIC)</strong>
                                        <span>Or daytime fast allows your eating window to start at sunrise and to start fasting at sunset. This is beneficial to healthy sleeping. This usually includes anything from 3 to 6 meals within a day.</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group achieve_form">
                                    <input type="radio" name="protocol" class="hidden protocol-click" value="14/10 (3 Meals)" id="ChooseMealsTwoBeginner" @if($fastingData->protocol) {{ ($fastingData->protocol=="14/10 (3 Meals)")? "checked" : "" }} @endif>
                                    <label for="ChooseMealsTwoBeginner">
                                        <strong>14/10 (3 MEALS)</strong>
                                        <span>Daily fast of 14 hours with a 10 hour eating window, during this window you may have 3 meals.</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group achieve_form">
                                    <input type="radio" name="protocol" class="hidden protocol-click" value="14/10 (2 Meals)" id="ChooseMealsThreeBeginner" @if($fastingData->protocol) {{ ($fastingData->protocol=="14/10 (2 Meals)")? "checked" : "" }} @endif>
                                    <label for="ChooseMealsThreeBeginner">
                                        <strong>14/10 (2 MEALS)</strong>
                                        <span>Daily fast of 14 hours with a 10 hour eating window, during this window you may have 2 meals.</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group achieve_form">
                                    <input type="radio" name="protocol" class="hidden otherClick" value="Other" id="ChooseMealsOtherBeginner" @if($fastingData->protocol && $fastingData->experience == "Beginner") {{ ($fastingData->protocol=="Other")? "checked" : "" }} @endif>
                                    <label for="ChooseMealsOtherBeginner">
                                        <strong>Custom</strong>
                                        {{-- Custom field start --}}
                                        @php                   
                                            $protocol =  json_decode($fastingData->protocol_other);
                                        @endphp
                                        @if($fastingData)
                                       
                                        <div class="otherShow @if($fastingData->protocol && $fastingData->protocol!="Other") hidden @endif">
                                            @else
                                            <div class="otherShow hidden">
                                                @endif
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <div class="form-group manual_input">
                                                            <label>Days</label>
                                                            <div class="number">
                                                                <span class="minus Daysminus">-</span>
                                                                <input name="myInputDay" onkeypress='validateCustom(event)' type="text" @if($fastingData->protocol_other && $fastingData->experience == "Beginner") value="{{ $protocol->days}}" @else value="1" @endif class="quantity days Beginner-days myInputDay" />
                                                                <span class="plus Daysplus">+</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <div class="form-group manual_input">
                                                            <label>Hours</label>
                                                            <div class="number">
                                                                <span class="minus Hoursminus">-</span>
                                                                <input name="myInputHours" onkeypress='validateCustom(event)' type="text" @if($fastingData->protocol_other && $fastingData->experience == "Beginner") value="{{ $protocol->fasting_hours}}" @else value="1" @endif class="quantity hours Beginner-hours myInputHours" onkeyup="if(value > 23) value=23;" />
                                                                <span class="plus Hoursplus">+</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Custom field start --}}
                                    </label>
                                {{-- </div> --}}
                            </div>
                        </div>
                        {{-- Intermediate  --}}
                        <div class="row intermediate hidden">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group achieve_form">
                                    <input type="radio" name="protocol" class="hidden protocol-click" value="16/8 (3 Meals)" id="ChooseMealsOneIntermediate" @if($fastingData->protocol) {{ ($fastingData->protocol=="16/8 (3 Meals)")? "checked" : "" }} @endif>
                                    <label for="ChooseMealsOneIntermediate">
                                        <strong>16/8 (3 MEALS)</strong>
                                        <span>Daily fast of 16 hours with a 8 hour eating window, during this window you may have 3 meals.</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group achieve_form">
                                    <input type="radio" name="protocol" class="hidden protocol-click" value="16/8 (2 Meals)" id="ChooseMealsThreeIntermediate" @if($fastingData->protocol) {{ ($fastingData->protocol=="16/8 (2 Meals)")? "checked" : "" }} @endif>
                                    <label for="ChooseMealsThreeIntermediate">
                                        <strong>16/8 (2 MEALS)</strong>
                                        <span>Daily fast of 16 hours with a 8 hour eating window, during this window you may have 2 meals.</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group achieve_form">
                                    <input type="radio" name="protocol" class="hidden protocol-click" value="18/6 (3 meals)" id="ChooseMealsTwoIntermediate"  @if($fastingData->protocol) {{ ($fastingData->protocol=="18/6 (3 meals)")? "checked" : "" }} @endif>
                                    <label for="ChooseMealsTwoIntermediate">
                                        <strong>18/6 (3 MEALS)</strong>
                                        <span>Daily fast of 18 hours with a 6 hour eating window, during this window you may have 3 meals.</span>
                                    </label>
                                </div>
                            </div>
                           
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group achieve_form">
                                    <input type="radio" name="protocol" class="hidden otherClick" value="Other" id="ChooseMealsOtherIntermediate" @if($fastingData->protocol && $fastingData->experience == "Intermediate") {{ ($fastingData->protocol=="Other")? "checked" : "" }} @endif>
                                    <label for="ChooseMealsOtherIntermediate">
                                        <strong>Custom</strong>
                                        {{-- Custom field start --}}
                                        @php                   
                                            $protocol =  json_decode($fastingData->protocol_other);
                                            // $fastingData->experience == "Intermediate"
                                        @endphp
                                        @if($fastingData)
                                        <div class="otherShow @if($fastingData->protocol && $fastingData->protocol!="Other") hidden @endif">
                                            @else
                                            <div class="otherShow hidden">
                                                @endif
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <div class="form-group manual_input">
                                                            <label>Days</label>
                                                            <div class="number">
                                                                <span class="minus Daysminus">-</span>
                                                                <input name="intermediateInputDay" onkeypress='validateCustom(event)' type="text" @if($fastingData->protocol_other && $fastingData->experience == "Intermediate") value="{{ $protocol->days}}" @else value="1" @endif class="quantity days Intermediate-days intermediateInputDay" />
                                                                <span class="plus Daysplus">+</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <div class="form-group manual_input">
                                                            <label>Hours</label>
                                                            <div class="number">
                                                                <span class="minus Hoursminus">-</span>
                                                                <input name="intermediateInputHours" onkeypress='validateCustom(event)' type="text" @if($fastingData->protocol_other && $fastingData->experience == "Intermediate") value="{{ $protocol->fasting_hours}}" @else value="1" @endif class="quantity hours Intermediate-hours intermediateInputHours" onkeyup="if(value > 23) value=23;" />
                                                                <span class="plus Hoursplus">+</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Custom field start --}}
                                    </label>
                                {{-- </div> --}}
                            </div>   
                        </div>
                        {{--  Advanced --}}
                        <div class="row advanced hidden">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group achieve_form">
                                    <input type="radio" name="protocol" class="hidden protocol-click" value="18/6 (2 meals)" id="ChooseMealsOneAdvanced" @if($fastingData->protocol) {{ ($fastingData->protocol=="18/6 (2 meals)")? "checked" : "" }} @endif>
                                    <label for="ChooseMealsOneAdvanced">
                                        <strong>18/6 (2 MEALS)</strong>
                                        <span>Daily fast of 18 hours with a 6 hour eating window, during this window you may have 2 meals.</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group achieve_form">
                                    <input type="radio" name="protocol" class="hidden protocol-click" value="20/4 (3 Meals)" id="ChooseMealsTwoAdvanced"  @if($fastingData->protocol) {{ ($fastingData->protocol=="20/4 (3 Meals)")? "checked" : "" }} @endif>
                                    <label for="ChooseMealsTwoAdvanced">
                                        <strong>20/4 (3 MEALS)</strong>
                                        <span>Daily fast of 20 hours with a 4 hour eating window, during this window you may have 3 meals.</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group achieve_form">
                                    <input type="radio" name="protocol" class="hidden protocol-click" value="20/4 (2 Meals)" id="ChooseMealsThreeAdvanced" @if($fastingData->protocol) {{ ($fastingData->protocol=="20/4 (2 Meals)")? "checked" : "" }} @endif>
                                    <label for="ChooseMealsThreeAdvanced">
                                        <strong>20/4 (2 MEALS)</strong>
                                        <span>Daily fast of 20 hours with a 4 hour eating window, during this window you may have 2 meals.</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group achieve_form">
                                    <input type="radio" name="protocol" class="hidden otherClick" value="Other" id="ChooseMealsOtherAdvanced" @if($fastingData->protocol && $fastingData->experience == "Advanced") {{ ($fastingData->protocol=="Other")? "checked" : "" }} @endif>
                                    <label for="ChooseMealsOtherAdvanced">
                                        <strong>Custom</strong>
                                        {{-- Custom field start --}}
                                        @php                   
                                            $protocol =  json_decode($fastingData->protocol_other);
                                        @endphp
                                        @if($fastingData)
                                        <div class="otherShow @if($fastingData->protocol && $fastingData->protocol!="Other") hidden @endif">
                                            @else
                                            <div class="otherShow hidden">
                                                @endif
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <div class="form-group manual_input">
                                                            <label>Days</label>
                                                            <div class="number">
                                                                <span class="minus Daysminus">-</span>
                                                                <input name="advancedInputDay" onkeypress='validateCustom(event)' type="text" @if($fastingData->protocol_other && $fastingData->experience == "Advanced") value="{{ $protocol->days}}" @else value="1" @endif class="quantity days Advanced-days advancedInputDay" />
                                                                <span class="plus Daysplus">+</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <div class="form-group manual_input">
                                                            <label>Hours</label>
                                                            <div class="number">
                                                                <span class="minus Hoursminus">-</span>
                                                                <input name="advancedInputHours" onkeypress='validateCustom(event)' type="text" @if($fastingData->protocol_other && $fastingData->experience == "Advanced") value="{{ $protocol->fasting_hours}}" @else value="1" @endif class="quantity hours Advanced-hours advancedInputHours" onkeyup="if(value > 23) value=23;" />
                                                                <span class="plus Hoursplus">+</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Custom field start --}}
                                    </label>
                                </div>
                            </div>
                            <div class="fastin" style="text-align: center;font-size: 20px;">
                                <a href="javascript:void(0)" id="protocolShowMore">
                                    <i class="fa fa-angle-down" style="font-size:36px;color: #f94211;"></i><br>
                                Show More
                                </a>
                            </div>    
                        </div>
                        {{-- end Advanced --}}  
    

                    </div>

                    
                

                <div class="submit step" id="end">
                   
                    <div class="fasting_heading_section">
                        <h2><strong>PERSONAL</strong> DETAILS </h2>
                        <p>Please provide your start date ,time and Fasting type.</p>
                    </div>
                    <?php 

                        $timezones  = \TimeZone::getTimeZone();
                        $parq = \App\Models\Parq::where('client_id',\Auth::user()->account_id)->first();        
                    ?>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                            <div class="form-group">
                                <label>Timezone</label>
                                <div class="form-group">
                                    <select id="timezone" name="timezone" class="form-control" required data-live-search = 'true'>
                                        <option value="">-- Select --</option>
                                        <?php 
                                        foreach($timezones as $country => $timezone){
                                            echo '<optgroup label="'.$country.'">';
                                            foreach($timezone as $key => $value){
                                            echo '<option value="'.$key.'" '.($parq->timezone == $key?'selected':'').'>'.$value.'</option>';
                                        }
                                        echo '</optgroup>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                            <div class="form-group">
                                <label>What Day Do You Want to Start?</label>
                                <div class="form-group">
                                    <input type="text" name="start_date" id="datepersonal" class="date form-control" placeholder="Date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                            <div class="form-group">
                                <label>What Time Do You Want to Start?</label>
                                <input type="text" id="time" name="start_time" class="time form-control" placeholder="Time">
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
            </form>
            </div>
        </div>
    </div>


    <div id="overridePopup" class="modal fade mobile_popup_fixed" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content animate-bottom">
                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div> -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h4 id="overrideText">You are about to override previous data between 01 July - 05 July. Do you want to continue ?</h4>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal" data-val="no">No</button>
                            <button type="button" class="btn btn-primary setting-status confirmOverride" data-val="yes">Yes</button>
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
    {!! Html::script('result/plugins/jQuery-Smart-Wizard/js/modifyjquery.smartWizard.js') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <style type="text/css">
        
    </style>
    <script type="text/javascript">
        
        $(document).on("click","#protocolShowMore",function(){
            
            $('.new-loader').removeClass('hidden');
            $.ajax({
                url: public_url + 'get-all-protocol',
                type: 'POST',
                data: {'fastingId': "{{ $fastingData->id }}"},
                success: function(data) {
                    
                    $('.new-loader').addClass('hidden');
                    $("#protocol_ajax_call").val(1);
                    $('.all_protocol_div').html(data);

                }
            });

        });

        $(document).ready(function() {
            setTimeout(function() {
                $('.new-loader').addClass('hidden');
               }, 2000); 
            
            $('#fasting-wizard').smartWizard({
                labelFinish: 'Complete',
                 onLeaveStep: leaveAFastingStepCallback,
            });

            $(document).on('click','.otherClick',function(){

                if($('.otherShow').hasClass('hidden')){
                   $('.otherShow').removeClass('hidden');
                }
            });

            $("input[name='experience']").on('click',function(){
               if(!$('.otherShow').hasClass('hidden')){
                   $('.otherShow').addClass('hidden');
               }
               $("input[name='protocol']").prop('checked', false);

            });

            $(document).on('click','.protocol-click',function(){

                if(!$('.otherShow').hasClass('hidden')){
                    $('.otherShow').addClass('hidden');
                }

            });
            
            $('.buttonFinish').on('click',function(e){

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

                var timezone = $("#timezone").val();

                @if(!isset($parq) && empty($parq->timezone))


                    if (timezone == '' || timezone == undefined) {

                        toastr.error("Please select timezone"); 
                        return false;
                    }

                @endif

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

                var start_date = $("input[name='start_date']").val();
                var start_time = $("input[name='start_time']").val();

                $.ajax({
                    url: public_url + 'override-confirm-popup',
                    type: 'POST',
                    data: {'start_date': start_date,'start_time':start_time},
                    success: function(data) {
                        
                        $('.new-loader').addClass('hidden');
                        
                        if (data.status == 422) {

                            $("#overrideText").html(data.message)
                            $("#overridePopup").modal('show');

                        }else{

                            callSaveFasting();
                        }
                    }
                });                 

            });


            $(document).on('click',".confirmOverride",function(){

                $(this).removeClass('confirmOverride');
                $("#overridePopup").modal('hide');
                callSaveFasting();

            });

            /** 
             * This funcion is used to save fasting data
            * **/
            function callSaveFasting(){

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


                var timezone = $("#timezone").val();

                @if(!isset($parq) && empty($parq->timezone))


                    if (timezone == '' || timezone == undefined) {

                        toastr.error("Please select timezone"); 
                        return false;
                    }

                @endif

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

                var experience = $("input[name='experience']:checked").val();
                
                var isAjaxProtocolCall = $('#protocol_ajax_call').val();

                if (isAjaxProtocolCall == 1) {

                    experience = 'Beginner';
                }

                
                var formData={};
                formData['id'] = $("#fastingID").val();
                formData['achieve'] = $("input[name='achieve']:checked").val();
                formData['gender'] = $("input[name='gender']:checked").val();
                formData['experience'] = $("input[name='experience']:checked").val();
                formData['protocol'] = $("input[name='protocol']:checked").val();
                formData['date_of_birth'] = $("input[name='date_of_birth']").val();
                formData['weight'] = $("input[name='weight']").val();
                formData['height'] = $("input[name='height']").val();
                if(formData['protocol'] == 'Other'){
                    formData['days']  =  $('.'+experience+'-days').val();
                    formData['fasting_hours']  =  $('.'+experience+'-hours').val();
                }

                formData['protocolCustom'] = $("input[name='protocol']:checked").attr('data-experienced');

                formData['start_date'] = $("input[name='start_date']").val();
                formData['start_time'] = $("input[name='start_time']").val();
                formData['auto_diy'] = cmode;
                formData['timezone'] = timezone;

                $('.new-loader').removeClass('hidden');
                $('.buttonFinish').empty();
                
                $.ajax({
                    url: public_url + 'fasting-save',
                    type: 'POST',
                    data: {'data': formData},
                    success: function(data) {
                        $('.new-loader').addClass('hidden');
                        if(data.status =="ok"){
                            window.location.href = public_url+"fasting-clock-controller"; 
                        }
                        
                    }
                });
            }

            function scrollToGoalTop() {
                var targetElm = document.querySelector("#wizard_container"); 
                targetElm.scrollIntoView();
             }

             function abcd() {
                 $('.new-loader').addClass('hidden');
                $('.buttonNext').removeAttr('disabled');
             }

            function leaveAFastingStepCallback(obj, context) {

                $('.new-loader').removeClass('hidden');
                $('.buttonNext').attr('disabled',true);
                
                $('#waitingShield').removeClass('hidden');
                var currentStep = context.fromStep;

                if(currentStep == 1){
                   if($("input[name='achieve']:checked").length == 0){
                      $('#waitingShield').addClass('hidden');
                        toastr.error("Please select option");
                        $('.new-loader').addClass('hidden');
                        setTimeout( function(){ 
                            abcd()
                        }  , 1000);
                       
                   } else {
                      scrollToGoalTop();
                      $('#waitingShield').addClass('hidden');
                      setTimeout( function(){ 
                            abcd()
                        }  , 1000);

                      return true;
                   }
                }  else if(currentStep == 2){
                    if($("input[name='date_of_birth']").val()){
                        scrollToGoalTop();
                        $('#waitingShield').addClass('hidden');
                        setTimeout( function(){ 
                            abcd()
                        }  , 1000);
                        return true; 
                   } else {
                      toastr.error("Please fill date of birth");
                      $('#waitingShield').addClass('hidden');
                      $('.new-loader').addClass('hidden');
                      setTimeout( function(){ 
                            abcd()
                        }  , 1000);
                   }
                } else if(currentStep == 3){
                    if($("input[name='gender']:checked").length == 0){
                        toastr.error("Please select option");
                        $('#waitingShield').addClass('hidden');
                        $('.new-loader').addClass('hidden');
                        setTimeout( function(){ 
                            abcd()
                        }  , 500);

                   } else {
                         scrollToGoalTop();
                         $('#waitingShield').addClass('hidden');
                        
                        setTimeout( function(){ 
                            abcd()
                        }  , 1000);

                         return true; 
                   }
                } else if(currentStep == 4){
                    
                    if($("input[name='weight']").val() && $("input[name='height']").val()){
                        scrollToGoalTop();
                        $('#waitingShield').addClass('hidden');
                        setTimeout( function(){ 
                            abcd()
                        }  , 1000);
                         return true; 
                   } else {
                      if($("input[name='weight']").val() == '' || $("input[name='weight']").val() == null){
                        toastr.error("Please fill weight"); 
                        $('#waitingShield').addClass('hidden');
                            $('.new-loader').addClass('hidden');
                        setTimeout( function(){ 
                            abcd()
                        }  , 500);

                      } 
                    //   if($("input[name='height']").length == 0){
                     if($("input[name='height']").val() == '' || $("input[name='height']").val() == null){
                        toastr.error("Please fill height"); 
                        $('#waitingShield').addClass('hidden');
                        $('.new-loader').addClass('hidden');
                        setTimeout( function(){ 
                            abcd()
                        }  , 500);

                      } 

                      setTimeout( function(){ 
                            abcd()
                        }  , 1000);
                   }
                   
                } else if(currentStep == 5){ 

                    if($("input[name='experience']:checked").length == 0){
                        toastr.error("Please select option");
                        $('#waitingShield').addClass('hidden');
                        $('.new-loader').addClass('hidden');
                        setTimeout( function(){ 
                            abcd()
                        }  , 500);

                    } else {
                         var className = $("input[name='experience']:checked").attr('data-val');
                         $('.'+className).removeClass('hidden');
                         scrollToGoalTop();
                         $('#waitingShield').addClass('hidden');
                         
                         setTimeout( function(){ 
                            abcd()
                        }  , 1000);

                        return true; 
                    }

                }  else if(currentStep == 6){ 

                    $('.buttonNext').hide();
                    $('.anchor').hide();
                    
                    console.log("protocol"+$("input[name='protocol']:checked").length);
                    if($("input[name='protocol']:checked").length == 0){
                        toastr.error("Please select option");
                        $('#waitingShield').addClass('hidden');
                        $('.new-loader').addClass('hidden');

                        setTimeout( function(){ 
                            abcd()
                        }  , 500);

                        return false;
                    }

                    var experience = $("input[name='experience']:checked").val();
                     
                    var isAjaxProtocolCall = $('#protocol_ajax_call').val();

                    if (isAjaxProtocolCall == 1) {

                        experience = 'Beginner';
                    }

                     if($("input[name='protocol']:checked").val() == 'Other'){
                        if( $('.'+experience+'-days').val() == '' || $('.'+experience+'-days').val() == null){
                            toastr.error("Please fill days"); 
                            $('.new-loader').addClass('hidden');
                            setTimeout( function(){ 
                                abcd()
                            }  , 500);

                            return false;
                          } 
                        //  if($(".hours").val() == '' || $(".hours").val() == null){
                        if($('.'+experience+'-hours').val() == '' || $('.'+experience+'-hours').val() == null){
                            toastr.error("Please fill hours"); 
                            $('.new-loader').addClass('hidden');
                            setTimeout( function(){ 
                                abcd()
                            }  , 500);

                            return false;
                          } 
                     } 

                    scrollToGoalTop();
                    $('#waitingShield').addClass('hidden');
                    $('.new-loader').addClass('hidden');
                    setTimeout( function(){ 
                        abcd()
                    }  , 1000);
                    return true; 
                     
                } 

            }

            $(document).on('click','.Daysminus',function(){

                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                if (count == -1 || $input.val() == '') {

                    count = 1;

                }else{
                    
                    count = (count < 1 || count < -1) ? 0 : count;

                }
                $input.val(count);
                $input.change();
                return false;

            });

            $(document).on('click','.Daysplus',function(){

                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });

            $(document).on('click','.Hoursminus',function(){

                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                if (count == -1 || $input.val() == '') {

                    count = 1;

                }else{
                    
                    count = (count < 1 || count < -1) ? 0 : count;

                }
                $input.val(count);
                $input.change();
                return false;

            });

            $(document).on('click','.Hoursplus',function(){

                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) + 1;
                count = count > 23 ? 23 : count;
                $input.val(count);
                // $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;

            });

            /* end ready function */
  
        });


      
$('#date').bootstrapMaterialDatePicker({
    // format : 'DD/MM/YYYY HH:mm',
    format : 'DD-MM-YYYY',
    // format : 'YYYY-MM-DD',
    maxDate : new Date(),
    lang : 'fr',
    // weekStart: 1
    }).on('change', function(e, date) {
         var date_of_birth =  $("input[name='date_of_birth']").val();
        // var birthDate = new Date(date_of_birth);
        var birthDate = new Date(date);
        var today = new Date();
        var age = Math.floor((today-birthDate) / (365.25* 24 * 60 * 60 * 1000));
          if(age < 10){
              if(age < 0){
                age = 0;
              } 
                age = "0"+age;
            }
          $('.show-age').html(age); 
});

    $(".weightactive input").focus(function(){
        $('.heightactive').removeClass("active");
        $('.weightactive').addClass("active");
    });
    $(".heightactive input").focus(function(){
        $('.weightactive').removeClass("active");
        $('.heightactive').addClass("active");
    });

    var mDate = new Date();
    mDate.setDate(mDate.getDate()-30);

    $('#datepersonal').bootstrapMaterialDatePicker({
        time:false,
        format : 'YYYY-M-D',
        lang : 'en',
        weekStart: 1,
        minDate:mDate,

    });
    $('#time').bootstrapMaterialDatePicker({
         date: false,
        format: 'HH:mm',
        shortTime: true,
    });

    $(document).on('click','.fasting-back-yes',function(){

        window.location.href = "{{url('fasting')}}";
    }); 


    function validateCustom(evt) {
      var theEvent = evt || window.event;
        
      // Handle paste
      if (theEvent.type === 'paste') {
          key = event.clipboardData.getData('text/plain');
      } else {
      // Handle key press
          var key = theEvent.keyCode || theEvent.which;
          key = String.fromCharCode(key);
      }

      var regex = /^[0-9]+$/;
      if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
      }
    }
    
    $(document).ready(function(){

       $(document).on('.myInputDay','cut copy paste',function(){

            e.preventDefault();
       });

        
       $(document).on('cut copy paste','.myInputHours',function(){

       });

       $(document).on("change keypress keydown",".myInputDay",function(){

            var dayValue = $(this).val();
            var hoursValue = $(".myInputHours").val();

            if ((dayValue == 0 || dayValue == '') && (hoursValue == 0 || hoursValue == '')) {

                $(".myInputHours").val(1);
            } 

       });

       $(document).on("change keypress keydown",".myInputHours",function(){

            var hourValue = $(this).val();
            var dayValue = $(".myInputDay").val(); 

            if ((dayValue == 0 || dayValue == '') && (hourValue == 0 || hourValue == '')) {

                $(".myInputDay").val(1); 
            }

            
       });

    });

    // Intermediate

    $(document).ready(function(){

       $(document).on('cut copy paste','.intermediateInputDay',function(){
            e.preventDefault();
       });

       $(document).on('cut copy paste','.intermediateInputHours',function(){
            e.preventDefault();
       });


       $(document).on("change keypress keydown",".intermediateInputDay",function(){

            var dayValue = $(this).val();
            var hoursValue = $(".intermediateInputHours").val();

            if ((dayValue == 0 || dayValue == '') && (hoursValue == 0 || hoursValue == '')) {

                $(".intermediateInputHours").val(1);
            } 

       });

       $(document).on("change keypress keydown",".intermediateInputHours",function(){

            var hourValue = $(this).val();
            var dayValue = $(".intermediateInputDay").val(); 

            if ((dayValue == 0 || dayValue == '') && (hourValue == 0 || hourValue == '')) {

                $(".intermediateInputDay").val(1); 
            }

            
       });

    });

    // advanced

    $(document).ready(function(){
       
       $(document).on('cut copy paste','.advancedInputDay',function(){

            e.preventDefault();
       });

       $(document).on('cut copy paste','.advancedInputHours',function(){

            e.preventDefault();
       });

       $(document).on("change keypress keydown",".advancedInputDay",function(){

            var dayValue = $(this).val();
            var hoursValue = $(".advancedInputHours").val();

            if ((dayValue == 0 || dayValue == '') && (hoursValue == 0 || hoursValue == '')) {

                $(".advancedInputHours").val(1);
            } 

       });

       $(document).on("change keypress keydown",".advancedInputHours",function(){

            var hourValue = $(this).val();
            var dayValue = $(".advancedInputDay").val(); 

            if ((dayValue == 0 || dayValue == '') && (hourValue == 0 || hourValue == '')) {

                $(".advancedInputDay").val(1); 
            }

            
       });

    });


</script>
    @stop