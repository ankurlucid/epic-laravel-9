@extends('Result.masters.app')
@section('required-styles')
{!! Html::style('result/css/custom.css?v='.time()) !!}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style type="text/css">
    section#page-title {
        display: none;
    }

 .toast-top-right {
    top: 80px;
    right: 12px;
}

</style>



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
                    <a href="{{ url('fasting') }}">Back</a>
                </div>
                <!-- <div class="step_count">
                    <span></span> 1/1
                </div> -->
            </div>
            <form name="formPQ" action="#" role="form" id="fasting-wizard">
                <input hidden value="{{$fastingData->id ?? ''}}" id="fastingID">
            {{-- <div id="fasting-wizard"> --}}       
                <div class="step">
                    <div class="fasting_heading_section">
                        <h2><strong>What Do You</strong> <br>Want to Achieve? </h2>
                        <p>Having a clear & concise idea of what your desired result is will keep you motivated and focused. This information also helps us provide a unique plan for your specific Lifestyle Design Journey.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group achieve_form">
                                <input type="radio" name="achieve" value="manage weight" class="hidden" id="ManageWeight" @if($fastingData->achieve) {{ $fastingData->achieve == "manage weight" ? 'checked' : '' }} @endif>
                                <label for="ManageWeight">
                                    <strong>Manage</strong>
                                    <span>Weight</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group achieve_form">
                                <input type="radio" name="achieve" value="gain muscle" class="hidden" id="GainMuscle" @if($fastingData->achieve) {{ $fastingData->achieve == "gain muscle" ? 'checked' : '' }} @endif>
                                <label for="GainMuscle">
                                    <strong>Gain</strong>
                                    <span>Muscle</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group achieve_form">
                                <input type="radio" name="achieve" value="increase energy" class="hidden" id="IncreaseEnergy" @if($fastingData->achieve) {{ $fastingData->achieve == "increase energy" ? 'checked' : '' }} @endif>
                                <label for="IncreaseEnergy">
                                    <strong>Increase</strong>
                                    <span>Energy</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group achieve_form">
                                <input type="radio" name="achieve" value="mental clarity" class="hidden" id="MentalClarity" @if($fastingData->achieve) {{ $fastingData->achieve == "mental clarity" ? 'checked' : '' }} @endif>
                                <label for="MentalClarity">
                                    <strong>Mental</strong>
                                    <span>Clarity</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group achieve_form">
                                <input type="radio" name="achieve" value="improved sleep" class="hidden" id="ImprovedSleep" @if($fastingData->achieve) {{ $fastingData->achieve == "improved sleep" ? 'checked' : '' }} @endif>
                                <label for="ImprovedSleep">
                                    <strong>Improved</strong>
                                    <span>Sleep</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
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
                        <div class="col-md-12">
                            {{-- <div class="form-group age_date"> --}}
                                <div class="form-group">
                                <input type="date" class="form-control" name="date_of_birth" @if($fastingData->date_of_birth) value="{{$fastingData->date_of_birth}}" @else value="{{$personal_detail->birthday}}" @endif>
                            </div>
                        </div>
                    </div>
                   @php
                      if($fastingData->date_of_birth){
                            $dateOfBirth = $fastingData->date_of_birth;
                            $today = date("Y-m-d");
                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                            $age = $diff->format('%y');
                      } else {
                            $dateOfBirth = $personal_detail->birthday;
                            $today = date("Y-m-d");
                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                            $age = $diff->format('%y');
                      }
                     
                   @endphp
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="tatal_age">
                                {{ $age}} <br><span>Year Old</span>
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
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="gender" value="Male" class="hidden" id="Male" @if($fastingData->gender) {{ ($fastingData->gender=="Male")? "checked" : "" }} @else{{ ($personal_detail->gender=="Male")? "checked" : "" }} @endif>
                                <label for="Male"><strong>Male</strong></label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="gender"  value="Female"  class="hidden" id="Female" @if($fastingData->gender) {{ ($fastingData->gender=="Female")? "checked" : "" }} @else{{ ($personal_detail->gender=="Female")? "checked" : "" }} @endif>
                                <label for="Female"><strong>Female</strong></label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="gender" value="Other" class="hidden" id="Other" @if($fastingData->gender) {{ ($fastingData->gender=="Other")? "checked" : "" }} @else {{ ($personal_detail->gender!="Male" && $personal_detail->gender!="Female")? "checked" : "" }} @endif >
                                <label for="Other"><strong>Other</strong></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step">
                    <div class="fasting_heading_section">
                        <h2><strong>What is your</strong> <br>Exprience to fasting </h2>
                        <p>Please provide your personal experience to intermittent Fasting?.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="experience" data-val="biginner" value="Biginner" class="hidden" id="Biginner" @if($fastingData->experience) {{ ($fastingData->experience=="Biginner")? "checked" : "" }} @endif>
                                <label for="Biginner">
                                    <strong>Beginner</strong>
                                    <span>New to fasting and the benefits</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="experience" data-val="intermediate" value="Intermediate" class="hidden" id="Intermediate" @if($fastingData->experience) {{ ($fastingData->experience=="Intermediate")? "checked" : "" }} @endif>
                                <label for="Intermediate">
                                    <strong>Intermediate</strong>
                                    <span>Have dabbled in the past but want to know more.</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
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
                {{-- {{dd($measurement)}} --}}
                @php
                

                    $weight = $measurement['weight'];
                    if($measurement['weightUnit'] == 'Imperial'){
                        $weightInKg = ($weight / 2.2046226218);
                        $weight = round($weightInKg, 0);
                    } 
                    $height = $measurement['height'];
                    if($measurement['heightUnit'] == 'inches'){
                        $heightInCm = ($height / 0.393701);
                        $height = round($heightInCm, 0);
                    }

                @endphp
                
                <div class="step">
                    <div class="fasting_heading_section">
                        <h2><strong>How much do you weight</strong> <br>& how tall are you? </h2>
                        <p>Please provide this is accurately as possible as this is critical to setting the correct protocol.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group weight_height">
                                
                                <label for="Weight">
                                    <strong>Weight</strong>
                                    <span>
                                    <input type="text" name="weight" @if($fastingData->weight) value="{{$fastingData->weight}}" @else value="{{ $weight}}" @endif class="" id="Weight">
                                     kg</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group weight_height">                                
                                <label for="Height">
                                    <strong>Height</strong>
                                    <span>
                                    <input type="text" name="height" class="" @if($fastingData->height) value="{{$fastingData->height}}" @else value="{{ $height}}" @endif  id="Height">
                                    cm</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="submit step" id="end">
                    <div class="fasting_heading_section">
                        <h2><strong>Choose the best</strong> <br>Protocol for yourself?</h2>
                        <p>This is based on your specific lifestyle and routines, we have recommended a few plans, choose the most appropriate one that suits you.</p>
                    </div>
                    {{-- Biginner --}}
                    <div class="row biginner hidden">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                {{-- <input type="radio" name="protocol" class="hidden" value="12/12 (Basic)" id="ChooseMealsOne" @if($fastingData->protocol) {{ ($fastingData->protocol=="14/30 (3 Meals)")? "checked" : "" }} @endif> --}}
                                <input type="radio" name="protocol" class="hidden" value="12/12 (Basic)" id="ChooseMealsOneBiginner" >
                                <label for="ChooseMealsOneBiginner">
                                    <strong>12/12 (Basic)</strong>
                                    <span>Or daytime fast allows your eating window to start at sunrise and to start fasting at sunset. This is beneficial to healthy sleeping. This usually includes anything from 3 to 6 meals within a day.</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="protocol" class="hidden" value="14/10 (3 Meals)" id="ChooseMealsTwoBiginner">
                                <label for="ChooseMealsTwoBiginner">
                                    <strong>14/10 (3 Meals)</strong>
                                    <span>Daily fast of 14 hours with a 10 hour eating window, during this window you may have 3 meals.</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="protocol" class="hidden" value="14/10 (2 Meals)" id="ChooseMealsThreeBiginner" >
                                <label for="ChooseMealsThreeBiginner">
                                    <strong>14/10 (2 Meals)</strong>
                                    <span>Daily fast of 14 hours with a 10 hour eating window, during this window you may have 2 meals.</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- Intermediate  --}}
                    <div class="row intermediate hidden">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="protocol" class="hidden" value="16/8 (3 Meals)" id="ChooseMealsOneIntermediate" >
                                <label for="ChooseMealsOneIntermediate">
                                    <strong>16/8 (3 Meals)</strong>
                                    <span>Daily fast of 16 hours with a 8 hour eating window, during this window you may have 3 meals.</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="protocol" class="hidden" value="18/6 (3 meals)" id="ChooseMealsTwoIntermediate" >
                                <label for="ChooseMealsTwoIntermediate">
                                    <strong>18/6 (3 meals)</strong>
                                    <span>Daily fast of 16 hours with a 8 hour eating window, during this window you may have 2 meals.</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="protocol" class="hidden" value="16/8 (2 Meals)" id="ChooseMealsThreeIntermediate" >
                                <label for="ChooseMealsThreeIntermediate">
                                    <strong>16/8 (2 Meals)</strong>
                                    <span>Daily fast of 18 hours with a 6 hour eating window, during this window you may have 3 meals.</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    {{--  Advanced --}}
                    <div class="row advanced hidden">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="protocol" class="hidden" value="18/6 (2 meals)" id="ChooseMealsOneAdvanced" >
                                <label for="ChooseMealsOneAdvanced">
                                    <strong>18/6 (2 meals)</strong>
                                    <span>Daily fast of 18 hours with a 6 hour eating window, during this window you may have 2 meals.</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="protocol" class="hidden" value="20/4 (3 Meals)" id="ChooseMealsTwoAdvanced" >
                                <label for="ChooseMealsTwoAdvanced">
                                    <strong>20/4 (3 Meals)</strong>
                                    <span>Daily fast of 20 hours with a 4 hour eating window, during this window you may have 3 meals.</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group achieve_form">
                                <input type="radio" name="protocol" class="hidden" value="20/4 (2 Meals)" id="ChooseMealsThreeAdvanced" >
                                <label for="ChooseMealsThreeAdvanced">
                                    <strong>20/4 (2 Meals)</strong>
                                    <span>Daily fast of 20 hours with a 4 hour eating window, during this window you may have 2 meals.</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- end Advanced --}}
                </div>
            {{-- </div> --}}
            </form>
            <!-- /middle-wizard -->

        </div>
    </div>
    @stop
    @section('required-script')
    {!! Html::script('result/plugins/jQuery-Smart-Wizard/js/jquery.smartWizard.js') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // toastr.options.positionClass = 'toast-top-center'
            //  toastr.options.timeOut = 150000; 
            // Smart Wizard
            $('#fasting-wizard').smartWizard({
                labelFinish: 'Complete',
                 onLeaveStep: leaveAFastingStepCallback,
            });

            
            $('.buttonFinish').on('click',function(){
                if($("input[name='protocol']:checked").length == 0){
                        toastr.error("Please select option");
                        return false;
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
                console.log('formData', formData);
                $.ajax({
                    url: public_url + 'fasting-save',
                    type: 'POST',
                    data: {'data': formData},
                    success: function(data) {
                        
                    }
                });
            });

            function leaveAFastingStepCallback(obj, context) {
                var currentStep = context.fromStep;
                if(currentStep == 1){
                   if($("input[name='achieve']:checked").length == 0){
                        toastr.error("Please select option");
                   } else {
                      return true;
                   }
                }  else if(currentStep == 2){
                    if($("input[name='date_of_birth']").val()){
                        return true; 
                   } else {
                      toastr.error("Please fill date of birth");
                   }
                } else if(currentStep == 3){
                    if($("input[name='gender']:checked").length == 0){
                        toastr.error("Please select option");
                   } else {
                         return true; 
                   }
                } else if(currentStep == 4){
                    if($("input[name='experience']:checked").length == 0){
                        toastr.error("Please select option");
                   } else {
                         return true; 
                   }
                } else if(currentStep == 5){ 
                    if($("input[name='weight']").val() && $("input[name='height']").val()){
                         return true; 
                   } else {
                      if($("input[name='weight']").length == 0){
                        toastr.error("Please fill weight"); 
                      } 
                      if($("input[name='height']").length == 0){
                        toastr.error("Please fill height"); 
                      } 
                   }
                } 
                // else if(currentStep == 6){
                //     if($("input[name='protocol']:checked").length == 0){
                //         toastr.error("Please select option");
                //    } else {
                //          return true; 
                //    }
                // }
            }

            function onFinishCallback(objs, context){
                // if(validateAllSteps()){
                    $.ajax({
                    url: public_url + 'epicfastcontroller/nextstep',
                    type: 'POST',
                    data: {
                        // 'fromStep': context.fromStep,
                        'formData':$('#fasting-wizard').serialize()

                    },
                    success: function(data) {
                        
                    }
                });
                // }
            }

          

            function showCountDown() {
                var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();

                
                var x = setInterval(function() {

                    
                    var now = new Date().getTime();

                    
                    var distance = countDownDate - now;

                    
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                  
                    document.getElementById("someid").innerHTML = hours + " : " +
                        minutes + " : " + seconds;

                    
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "EXPIRED";
                    }
                }, 1000);
            }

        });
    </script>
    @stop