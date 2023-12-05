{{-- Beginner --}}
<div class="row beginner">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group achieve_form">
            {{-- <input type="radio" name="protocol" class="hidden" value="12/12 (Basic)" id="ChooseMealsOne" @if($fastingData->protocol) {{ ($fastingData->protocol=="14/30 (3 Meals)")? "checked" : "" }} @endif> --}}
            <input type="radio" checked name="protocol" class="hidden protocol-click" value="12/12 (Basic)" id="ChooseMealsOneBeginner" data-experienced="Beginner" @if($fastingData->protocol) {{ ($fastingData->protocol=="12/12 (Basic)")? "checked" : "" }} @endif>
            <label for="ChooseMealsOneBeginner">
                <strong>12/12 (BASIC)</strong>
                <span>Or daytime fast allows your eating window to start at sunrise and to start fasting at sunset. This is beneficial to healthy sleeping. This usually includes anything from 3 to 6 meals within a day.</span>
            </label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group achieve_form">
            <input type="radio" name="protocol" class="hidden protocol-click" value="14/10 (3 Meals)" id="ChooseMealsTwoBeginner" data-experienced="Beginner" @if($fastingData->protocol) {{ ($fastingData->protocol=="14/10 (3 Meals)")? "checked" : "" }} @endif>
            <label for="ChooseMealsTwoBeginner">
                <strong>14/10 (3 MEALS)</strong>
                <span>Daily fast of 14 hours with a 10 hour eating window, during this window you may have 3 meals.</span>
            </label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group achieve_form">
            <input type="radio" name="protocol" class="hidden protocol-click" value="14/10 (2 Meals)" id="ChooseMealsThreeBeginner" data-experienced="Beginner" @if($fastingData->protocol) {{ ($fastingData->protocol=="14/10 (2 Meals)")? "checked" : "" }} @endif>
            <label for="ChooseMealsThreeBeginner">
                <strong>14/10 (2 MEALS)</strong>
                <span>Daily fast of 14 hours with a 10 hour eating window, during this window you may have 2 meals.</span>
            </label>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group achieve_form">
            <input type="radio" name="protocol" class="hidden protocol-click" value="16/8 (3 Meals)" id="ChooseMealsOneIntermediate" data-experienced="Intermediate" @if($fastingData->protocol) {{ ($fastingData->protocol=="16/8 (3 Meals)")? "checked" : "" }} @endif>
            <label for="ChooseMealsOneIntermediate">
                <strong>16/8 (3 MEALS)</strong>
                <span>Daily fast of 16 hours with a 8 hour eating window, during this window you may have 3 meals.</span>
            </label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group achieve_form">
            <input type="radio" name="protocol" class="hidden protocol-click" value="16/8 (2 Meals)" id="ChooseMealsThreeIntermediate" data-experienced="Intermediate" @if($fastingData->protocol) {{ ($fastingData->protocol=="16/8 (2 Meals)")? "checked" : "" }} @endif>
            <label for="ChooseMealsThreeIntermediate">
                <strong>16/8 (2 MEALS)</strong>
                <span>Daily fast of 16 hours with a 8 hour eating window, during this window you may have 2 meals.</span>
            </label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group achieve_form">
            <input type="radio" name="protocol" class="hidden protocol-click" value="18/6 (3 meals)" id="ChooseMealsTwoIntermediate" data-experienced="Intermediate"  @if($fastingData->protocol) {{ ($fastingData->protocol=="18/6 (3 meals)")? "checked" : "" }} @endif>
            <label for="ChooseMealsTwoIntermediate">
                <strong>18/6 (3 MEALS)</strong>
                <span>Daily fast of 18 hours with a 6 hour eating window, during this window you may have 3 meals.</span>
            </label>
        </div>
    </div>


     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group achieve_form">
            <input type="radio" name="protocol" class="hidden protocol-click" value="18/6 (2 meals)" id="ChooseMealsOneAdvanced" data-experienced="Advanced" @if($fastingData->protocol) {{ ($fastingData->protocol=="18/6 (2 meals)")? "checked" : "" }} @endif>
            <label for="ChooseMealsOneAdvanced">
                <strong>18/6 (2 MEALS)</strong>
                <span>Daily fast of 18 hours with a 6 hour eating window, during this window you may have 2 meals.</span>
            </label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group achieve_form">
            <input type="radio" name="protocol" class="hidden protocol-click" value="20/4 (3 Meals)" id="ChooseMealsTwoAdvanced" data-experienced="Advanced"  @if($fastingData->protocol) {{ ($fastingData->protocol=="20/4 (3 Meals)")? "checked" : "" }} @endif>
            <label for="ChooseMealsTwoAdvanced">
                <strong>20/4 (3 MEALS)</strong>
                <span>Daily fast of 20 hours with a 4 hour eating window, during this window you may have 3 meals.</span>
            </label>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group achieve_form">
            <input type="radio" name="protocol" class="hidden protocol-click" value="20/4 (2 Meals)" id="ChooseMealsThreeAdvanced" data-experienced="Advanced" @if($fastingData->protocol) {{ ($fastingData->protocol=="20/4 (2 Meals)")? "checked" : "" }} @endif>
            <label for="ChooseMealsThreeAdvanced">
                <strong>20/4 (2 MEALS)</strong>
                <span>Daily fast of 20 hours with a 4 hour eating window, during this window you may have 2 meals.</span>
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