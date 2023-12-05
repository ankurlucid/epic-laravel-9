@extends('Result.masters.app')
@section('required-styles')
    {!! Html::style('result/css/custom.css?v=' . time()) !!}
    <style type="text/css">
        section#page-title {
            display: none;
        }


        .accordion-toggle.collapsed:after {
            content: "\f105";

            font-family: 'FontAwesome';
        }

        .accordion-toggle:after {
            content: "\f107";
            font-family: 'FontAwesome';
        }

        .confirm {
            background-color: #f94211 !important;
        }

        .panel {
            margin: 0 !important;
            border: 0px !important;
        }

        .reactRadioButtonGroup .ant-radio-button-wrapper {
            /*    background: white !important;
        color: rgba(0,0,0,.65) !important;*/
        }

        .reactRadioButtonGroup .ant-radio-button-wrapper.checked {
            background-color: #f64c1e !important;
            border-color: #f64c1e !important;
            box-shadow: -1px 0 0 0 #f64c1e;
            color: white !important;
        }

        .minh-350 {
            min-height: 300px !important;
        }

        .pos-of-accc,
        .panel-white,
        .panel-body {
            background: transparent;
        }
        .disablefield{
            user-select: none;
            pointer-events: none;
            display: none;
        }
        .showaAllBtnMob {
            margin-top: 10px;
            margin-bottom: 10px;
            position: relative;
        }
        .showaAllBtnMob label:before {
            content: '';
            position: relative;
            width: 15px;
            height: 15px;
            border: 1px solid #858585;
            border-radius: 50%;
            display: inline-block;
            top: 3px;
            margin-right: 6px;
        }
        .showaAllBtnMob.active label:after {
            background: #858585;
            content: '';
            width: 15px;
            height: 15px;
            position: absolute;
            left: 0;
            top: 3px;
            -webkit-transform: scale(.6);
            -ms-transform: scale(.6);
            /* transform: scale(.6); */
            border-radius: 50%;
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
        <span>PERSONAL</span> <br>MEASUREMENTS
        <div class="backtopage">
            <a @if ($queryString == 'Yes') href="{{ url('calendar/daily-dairy?date=' . $eventDate) }}" @else href="{{ url('calendar/daily-dairy') }}" @endif><i class="fa fa-long-arrow-left"></i> Back</a>
        </div>
    </div>
    <input hidden class="body-measurement-id" value="{{ $measurementData['id'] }}">
    <input hidden class="body-measurement" data-new="">
    <div class="personal_mobile_details">
        <div class="personal_dairy_section personal-measurement-mobile " id="accordion">
            <h2><strong>BODY</strong><br>MEASUREMENTS</h2>
            <input hidden value="{{ date('d M Y', strtotime($eventDate)) }}" data-val="{{ $eventDate }}"
                class="currentDate">
            <div class="measurement-div panel" id="collapseOne-mainDiv">
                <h6 class="measurement-heading"><strong>CHEST</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapseOne"
                                data-mainName="chest" data-parent="#accordion" href="#collapseOne" aria-expanded="true">

                            </a></strong></span></h6>
                <h4 class="measure-value  m-0"><strong>{{ $measurementData['chest'] }}</strong> cm</h4>
                <a data-label="cm" data-name="CHEST" data-mainName="chest" data-val="{{ $measurementData['chest'] }}"
                    class="bodyEditBtn float-right"> <i class="fa fa-pencil"></i> <span class="c-gray">EDIT</span>
                </a>
                <a data-name="CHEST" data-mainName="chest" class="bodyAddBtn float-right" style="margin-right: 10px;">
                    <i class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span>
                </a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapseOne" class="panel-collapse collapse" aria-expanded="true" style="">      
                </div>


                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>
                <hr class="m-0">
              
            </div>
            <div class="measurement-div panel" id="collapsetwo-mainDiv">
                <h6 class="measurement-heading"><strong>NECK</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapsetwo"
                                data-mainName="neck" data-parent="#accordion" href="#collapsetwo" aria-expanded="true">

                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{ $measurementData['neck'] }}</strong> cm</h4>
                <a data-name="NECK" data-mainName="neck" data-label="cm" data-val="{{ $measurementData['neck'] }}"
                    class="bodyEditBtn float-right"> <i class="fa fa-pencil"></i> <span
                        class="c-gray">EDIT</span></a>
                <a data-name="NECK" data-mainName="neck" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapsetwo" class="panel-collapse collapse" aria-expanded="true" style="">
                </div>
                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>

                <hr class="m-0">
            </div>
            <div class="measurement-div panel" id="collapsethree-mainDiv">
                <h6 class="measurement-heading"><strong>BICEP R</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapsethree"
                                data-mainName="bicepR" data-parent="#accordion" href="#collapsethree" aria-expanded="true">

                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{ $measurementData['bicep_r'] }}</strong> cm</h4>
                <a data-name="BICEP R" data-label="cm" data-mainName="bicep_r" data-val="{{ $measurementData['bicep_r'] }}"
                    class="bodyEditBtn float-right"> <i class="fa fa-pencil"></i> <span
                        class="c-gray">EDIT</span></a>
                <a data-name="BICEP R" data-mainName="bicep_r" class="bodyAddBtn float-right" style="margin-right: 10px;">
                    <i class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapsethree" class="panel-collapse collapse" aria-expanded="true" style="">

                </div>
                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>

                <hr class="m-0">
            </div>
            <div class="measurement-div panel" id="collapsefour-mainDiv">
                <h6 class="measurement-heading"><strong>BICEP L</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapsefour"
                                data-mainName="bicepL" data-parent="#accordion" href="#collapsefour" aria-expanded="true">

                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{ $measurementData['bicep_l'] }}</strong> cm</h4>

                <a data-name="BICEP L" data-label="cm" data-mainName="bicep_l" data-val="{{ $measurementData['bicep_l'] }}"
                    class="bodyEditBtn float-right"> <i class="fa fa-pencil"></i> <span
                        class="c-gray">EDIT</span></a>
                <a data-name="BICEP L" data-mainName="bicep_l" class="bodyAddBtn float-right" style="margin-right: 10px;">
                    <i class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapsefour" class="panel-collapse collapse" aria-expanded="true" style="">

                </div>
                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>
                <hr class="m-0">
            </div>
            <div class="measurement-div panel" id="collapsefive-mainDiv">
                <h6 class="measurement-heading"><strong>FOREARM R</strong> MEASUREMENT <span
                        class="float-right"><strong><a class="accordion-toggle collapsed" data-toggle="collapse"
                                data-id="collapsefive" data-mainName="forearmR" data-parent="#accordion"
                                href="#collapsefive" aria-expanded="true">

                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{ $measurementData['forearm_r'] }}</strong> cm</h4>
                <a data-name="FOREARM R" data-label="cm" data-mainName="forearm_r"
                    data-val="{{ $measurementData['forearm_r'] }}" class="bodyEditBtn float-right disableInputMob disablefield"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                <a data-name="FOREARM R" data-mainName="forearm_r" class="bodyAddBtn float-right disableInputMob disablefield"
                    style="margin-right: 10px;"> <i class="fa fa-plus"></i> <span class="c-gray">ADD
                        NEW</span></a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapsefive" class="panel-collapse collapse" aria-expanded="true" style="">

                </div>
                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>
                <hr class="m-0">
            </div>
            <div class="measurement-div panel" id="collapsesix-mainDiv">
                <h6 class="measurement-heading"><strong>FOREARM L</strong> MEASUREMENT <span
                        class="float-right"><strong><a class="accordion-toggle collapsed" data-toggle="collapse"
                                data-id="collapsesix" data-mainName="forearmL" data-parent="#accordion" href="#collapsesix"
                                aria-expanded="true">

                            </a></strong></span></h6>
                <h4 class="m-0"><strong>{{ $measurementData['forearm_l'] }}</strong> cm</h4>
                <a data-name="FOREARM L" data-label="cm" data-mainName="forearm_l"
                    data-val="{{ $measurementData['forearm_l'] }}" class="bodyEditBtn float-right disableInputMob disablefield"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                <a data-name="FOREARM L" data-mainName="forearm_l" class="bodyAddBtn float-right disableInputMob disablefield"
                    style="margin-right: 10px;"> <i class="fa fa-plus"></i> <span class="c-gray">ADD
                        NEW</span></a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapsesix" class="panel-collapse collapse" aria-expanded="true" style="">

                </div>
                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>
                <hr class="m-0">
            </div>
            <div class="measurement-div panel" id="collapseseven-mainDiv">
                <h6 class="measurement-heading"><strong>ABDOMEN</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapseseven"
                                data-mainName="abdomen" data-parent="#accordion" href="#collapseseven" aria-expanded="true">

                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{ $measurementData['waist'] }}</strong> cm</h4>
                <a data-name="ABDOMEN" data-label="cm" data-mainName="waist" data-val="{{ $measurementData['waist'] }}"
                    class="bodyEditBtn float-right"> <i class="fa fa-pencil"></i> <span
                        class="c-gray">EDIT</span></a>
                <a data-name="ABDOMEN" data-mainName="waist" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapseseven" class="panel-collapse collapse" aria-expanded="true" style="">

                </div>
                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>
                <hr class="m-0">
            </div>
            <div class="measurement-div panel" id="collapseeight-mainDiv">
                <h6 class="measurement-heading"><strong>HIP</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapseeight"
                                data-mainName="hip" data-parent="#accordion" href="#collapseeight" aria-expanded="true">

                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{ $measurementData['hip'] }}</strong> cm</h4>
                <a data-name="HIP" data-label="cm" data-mainName="hip" data-val="{{ $measurementData['hip'] }}"
                    class="bodyEditBtn float-right"> <i class="fa fa-pencil"></i> <span
                        class="c-gray">EDIT</span></a>
                <a data-name="HIP" data-mainName="hip" class="bodyAddBtn float-right" class="float-right"
                    style="margin-right: 10px;"> <i class="fa fa-plus"></i> <span class="c-gray">ADD
                        NEW</span></a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapseeight" class="panel-collapse collapse" aria-expanded="true" style="">

                </div>
                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>
                <hr class="m-0">
            </div>
            <div class="measurement-div panel" id="collapsenine-mainDiv">
                <h6 class="measurement-heading"><strong>THIGH R</strong> MEASUREMENT <span
                        class="float-right"><strong><a class="accordion-toggle collapsed" data-toggle="collapse"
                                data-id="collapsenine" data-mainName="thighR" data-parent="#accordion" href="#collapsenine"
                                aria-expanded="true">

                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{ $measurementData['thigh_r'] }}</strong> cm</h4>
                <a data-name="THIGH R" data-label="cm" data-mainName="thigh_r" data-val="{{ $measurementData['thigh_r'] }}"
                    class="bodyEditBtn float-right"> <i class="fa fa-pencil"></i> <span
                        class="c-gray">EDIT</span></a>
                <a data-name="THIGH R" data-mainName="thigh_r" class="bodyAddBtn float-right" style="margin-right: 10px;">
                    <i class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapsenine" class="panel-collapse collapse" aria-expanded="true" style="">

                </div>
                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>
                <hr class="m-0">
            </div>
            <div class="measurement-div panel" id="collapseten-mainDiv">
                <h6 class="measurement-heading"><strong>THIGH L</strong> MEASUREMENT <span
                        class="float-right"><strong><a class="accordion-toggle collapsed" data-toggle="collapse"
                                data-id="collapseten" data-mainName="thighL" data-parent="#accordion" href="#collapseten"
                                aria-expanded="true">

                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{ $measurementData['thigh_l'] }}</strong> cm</h4>
                <a data-name="THIGH L" data-label="cm" data-mainName="thigh_l" data-val="{{ $measurementData['thigh_l'] }}"
                    class="bodyEditBtn float-right"> <i class="fa fa-pencil"></i> <span
                        class="c-gray">EDIT</span></a>
                <a data-name="THIGH L" data-mainName="thigh_l" class="bodyAddBtn float-right" style="margin-right: 10px;">
                    <i class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapseten" class="panel-collapse collapse" aria-expanded="true" style="">

                </div>
                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>
                <hr class="m-0">
            </div>
            <div class="measurement-div panel" id="collapseeleven-mainDiv">
                <h6 class="measurement-heading"><strong>CALF R</strong> MEASUREMENT <span
                        class="float-right"><strong><a class="accordion-toggle collapsed" data-toggle="collapse"
                                data-id="collapseeleven" data-mainName="calfR" data-parent="#accordion"
                                href="#collapseeleven" aria-expanded="true">

                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{ $measurementData['calf_r'] }}</strong> cm</h4>
                <a data-name="CALF R" data-label="cm" data-mainName="calf_r" data-val="{{ $measurementData['calf_r'] }}"
                    class="bodyEditBtn float-right disableInputMob disablefield"> <i class="fa fa-pencil"></i> <span
                        class="c-gray">EDIT</span></a>
                <a data-name="CALF R" data-mainName="calf_r" class="bodyAddBtn float-right disableInputMob disablefield" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapseeleven" class="panel-collapse collapse" aria-expanded="true" style="">

                </div>
                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>
                <hr class="m-0">
            </div>
            <div class="measurement-div panel" id="collapsetwelve-mainDiv">
                <h6 class="measurement-heading"><strong>CALF L</strong> MEASUREMENT <span
                        class="float-right"><strong><a class="accordion-toggle collapsed" data-toggle="collapse"
                                data-id="collapsetwelve" data-mainName="calfL" data-parent="#accordion"
                                href="#collapsetwelve" aria-expanded="true">

                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{ $measurementData['calf_l'] }}</strong> cm</h4>
                <a data-name="CALF L" data-label="cm" data-mainName="calf_l" data-val="{{ $measurementData['calf_l'] }}"
                    class="bodyEditBtn float-right disableInputMob disablefield"> <i class="fa fa-pencil"></i> <span
                        class="c-gray">EDIT</span></a>
                <a data-name="CALF L" data-mainName="calf_l" class="bodyAddBtn float-right disableInputMob disablefield" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapsetwelve" class="panel-collapse collapse" aria-expanded="true" style="">

                </div>
                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>
                <hr class="m-0">
            </div>
            <div class="measurement-div panel" id="collapsethirteen-mainDiv">




                <h6 class="measurement-heading"><strong>WEIGHT</strong> 
                   @if($measurementData['weight'])
                    <span class="kg_show" @if ($measurementData['weightUnit'] == 'Imperial') style="display: none;" @endif>(Kg)</span>
                    <span class="pound_show @if ($measurementData['weightUnit'] == 'Metric') hidden @endif ">(Pound)</span> 
                    <button type="button"class="btn btn-primary btn-o btn-sm p-y-0 bg-none mli-10 f-11" @if ($measurementData['weightUnit'] == 'Imperial') style="display: none;" @endif
                        id="mobconvertP">Show Imperial</button>
                    <button type="button" class="btn btn-primary btn-o btn-sm p-y-0 bg-none mli-10  f-11  @if ($measurementData['weightUnit'] == 'Metric') hidden @endif"
                        id="mobconKg">Show Metric</button>
                    @endif
                    <span class="float-right"><strong>
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapsethirteen"
                                data-mainName="weight" data-parent="#accordion" href="#collapsethirteen" aria-expanded="true">
                            </a></strong>
                    </span>
                   
                </h6>

                <h4 class="measure-value m-0"><strong class="weight_m" id="weight_m">{{ $measurementData['weight'] }} </strong>
                    @if ($measurementData['weightUnit'] == 'Imperial')<span class="measurementWeight_m">pound</span> @endif @if ($measurementData['weightUnit'] == 'Metric')<span class="measurementWeight_m">kg</span>@endif</h4>

                <input type="hidden" name="weight_m" value="{{ $measurementData['weight'] }}">
                <input type="hidden" name="weightUnit"
                    value="{{ isset($measurementData['weightUnit']) && $measurementData['weightUnit'] != null ? $measurementData['weightUnit'] : 'Metric' }}">
                <a data-name="WEIGHT" data-label="cm" data-mainName="weight" data-val="{{ $measurementData['weight'] }}"
                    class="bodyEditBtn float-right"> <i class="fa fa-pencil"></i> <span
                        class="c-gray">EDIT</span></a>
                <a data-name="WEIGHT" data-mainName="weight" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapsethirteen" class="panel-collapse collapse" aria-expanded="true" style="">

                </div>
                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>
                <hr class="m-0">
            </div>

            <div class="measurement-div panel" id="collapsefourteen-mainDiv">
                <h6 class="measurement-heading">
                    <strong>HEIGHT</strong> 
                    @if($measurementData['height'])
                    <span class="cm_show" @if ($measurementData['heightUnit'] == 'inches') style="display: none;" @endif>(cm)</span>
                    <span class="inches_show @if ($measurementData['heightUnit'] == 'cm') hidden @endif">(inches)</span> 
                    <button type="button" class="btn btn-primary btn-o btn-sm p-y-0 bg-none mli-10 f-11" id="mobconvert-inches"
                        @if ($measurementData['heightUnit'] == 'inches') style="display: none;" @endif>Show in inches</button>
                    <button type="button" class="btn btn-primary btn-o btn-sm p-y-0 bg-none mli-10  @if ($measurementData['heightUnit'] == 'cm') hidden @endif f-11" id="mobconvert-cm">Show in cm</button>
                    @endif
                    <span class="float-right"><strong>
                      <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-id="collapsefourteen" data-mainName="height"
                                href="#collapsefourteen" aria-expanded="false">
                       </a>
                        </strong>
                    </span>
                   
                </h6>


                <h4 class="measure-value  m-0"><strong class="height_m" id="height_m">{{ $measurementData['height'] }}</strong>
                    @if ($measurementData['heightUnit'] == 'inches') <span class="measurementHeight_m">inches</span> @endif @if ($measurementData['heightUnit'] == 'cm') <span class="measurementHeight_m">cm</span>@endif</h4>


                <input type="hidden" name="height_m" value="{{ $measurementData['height'] }}">
                <input type="hidden" name="heightUnit"
                    value="{{ isset($measurementData['heightUnit']) && $measurementData['heightUnit'] != null ? $measurementData['heightUnit'] : 'cm' }}">
                <a data-name="HEIGHT" data-label="cm" data-mainName="height" data-val="{{ $measurementData['height'] }}"
                    class="bodyEditBtn float-right"> <i class="fa fa-pencil"></i> <span
                        class="c-gray">EDIT</span></a>
                <a data-name="HEIGHT" data-mainName="height" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                {{-- <a href="#" class=" float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-trash"></i> </span>
                </a> --}}
                <div id="collapsefourteen" class="panel-collapse collapse" aria-expanded="true" style="">

                </div>
                <span class="currentDate-p">{{ date('d M Y', strtotime($eventDate)) }}</span>
                <hr class="m-0">

            </div>
            <div class="showaAllBtnMob">
                <label>Show All</label>
            </div>

        </div>
        <!-- Edit popup model start -->
        @include('Result.dailydiary.measurement-modal')
        <!-- Edit popup model end -->

    @stop
    @section('required-script')

        {!! Html::script('result/plugins/chartjs/dist/Chart.bundle.min.js') !!}
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>

        <script type="text/javascript">
            $(document).ready(function() {

                $('body').on('click', '.showaAllBtnMob', function(){
                    if ($(".showaAllBtnMob").hasClass("active")) {
                        $('.showaAllBtnMob').removeClass('active');
                        $('.disableInputMob').addClass('disablefield');
                    } else {
                        $('.showaAllBtnMob').addClass('active');
                        $('.float-right').removeClass('disablefield');
                    } 
                });

                if ($('#weight_m').html().trim() == "") {
                       $('#weight_m').parents().parents().children('.currentDate-p').css('width','auto');
                    }
                    else{
                        $('#weight_m').parents().parents().children('.currentDate-p').css('width','');
                    }
                    if ($('#height_m').html().trim() == "") {
                       $('#height_m').parents().parents().children('.currentDate-p').css('width','auto');
                    }
                    else{
                       $('#height_m').parents().parents().children('.currentDate-p').css('width','');
                    }
                $(".accordion-toggle").click(function() {
                    console.log('click');
                    // $(".accordion-toggle").parent().parent().parent().parent().removeClass("theme-orange");
                 
                    if (!$(this).hasClass("collapsed")){
                    $(".accordion-toggle").parent().parent().parent().parent().removeClass("theme-orange");
                    }
                    else{
                          $(this).parent().parent().parent().parent().addClass("theme-orange"); 
                    }
                    var oldDivId = $('.body-measurement').attr('data-new');
                    $("#" + oldDivId).html('');
                    var bodypart = $(this).attr('data-mainName');
                    var div_id = $(this).attr('data-id');
                    $('.body-measurement').attr('data-new', div_id);
                    $("#" + div_id).html('');
                    // console.log('gg',bodypart,div_id);
                    // console.log("#"+div_id,'..........',"#"+div_id+" .graph");
                    if ($(this).hasClass('collapsed')) {
                        $('#waitingShield').removeClass('hidden');
                        $.ajax({
                            url: public_url + 'calendar/body-measurement-graph/' + bodypart,
                            method: "get",
                            success: function(data) {
                                // console.log('data--',data);
                                if (data.status == 'ok') {
                                    $("#" + div_id).html(data.mob_html);
                                    var duration = '6';
                                    $.ajax({
                                        url: public_url + 'filter-body-measurement/' +
                                            bodypart + '/' + duration,
                                        method: "get",
                                        success: function(data) {
                                            $(".graph-" + bodypart).hide();
                                            $(".filter-div-" + bodypart).show();
                                            $(".filter-div-" + bodypart).html(data)
                                            // $("input[name='filterDate']").attr("checked", false);
                                            // $("input[name='filterDate'][value=" + duration + "]").attr("checked",
                                            //     true);
                                            // $("input[name='filterDate'] + label").removeClass("checked");
                                            // $("input[name='filterDate'][value=" + duration + "] + label").addClass(
                                            //     "checked");
                                        }
                                    });
                                }
                                $('#waitingShield').addClass('hidden');
                                $("#" + div_id + "-mainDiv")[0].scrollIntoView(true);
                            }
                        });
                    }
                });

                // $('body').on('click','input[name="filterDate"]', function(){

                $(document).on('click', '.ant-radio-button-wrapper', function() {
                    var duration = $(this).attr('data-value');
                    var bodypart = $(this).attr('bodypart');
                    // $("input[name='filterDate']").each(function() {
                    //     $("input[name='filterDate']").attr("checked", false); 
                    //  });

                    $.ajax({
                        url: public_url + 'filter-body-measurement/' + bodypart + '/' + duration,
                        method: "get",
                        success: function(data) {
                            $(".graph-" + bodypart).hide();
                            $(".filter-div-" + bodypart).show();
                            $(".filter-div-" + bodypart).html(data);
                            $("input[name='filterDate']").attr("checked", false);
                            $("input[name='filterDate'][value=" + duration + "]").attr("checked",
                                true);
                            $("input[name='filterDate'] + label").removeClass("checked");
                            $("input[name='filterDate'][value=" + duration + "] + label").addClass(
                                "checked");
                            // $(".graph").hide();
                            // $(".filter-div").show();
                            // $(".filter-div").html(data)
                        }
                    });
                })

                /* end graph */
                /* convert weight */
                $('#mobconvertP').click(function() {
                    // var weight = parseFloat($(".weight_m").val());
                    var weight = parseFloat($('input[name="weight_m"]').val());
                    weightInPounds = (weight * 2.2046226218);
                    result = weightInPounds.toFixed(2);
                    $(".weight_m").text(result);
                    $('input[name="weight_m"]').val(result)
                    $("#mobconvertP").hide();
                    $("#mobconKg").removeClass('hidden');
                    $('.kg_show').hide();
                    $('.pound_show').removeClass('hidden');
                    $('input[name="weightUnit"]').val('Imperial');
                    $('.measurementWeight_m').text(' pound');
                });

                $('#mobconKg').click(function() {
                    // var weight = parseFloat($(".weight_m").val());
                    var weight = parseFloat($('input[name="weight_m"]').val());
                    weightInPounds = (weight / 2.2046226218);
                    // result = weightInPounds.toFixed(0);
                    result = weightInPounds.toFixed(2);
                    $(".weight_m").text(result);
                    $('input[name="weight_m"]').val(result)
                    $("#mobconvertP").show();
                    $('.kg_show').show();
                    $('.pound_show').addClass('hidden');
                    $("#mobconKg").addClass('hidden');
                    $('input[name="weightUnit"]').val('Metric');
                    $('.measurementWeight_m').text(' kg');
                });

                $('#mobconvert-inches').click(function() {
                    // var height = parseFloat($("#height_m").val());
                    var height = parseFloat($('input[name="height_m"]').val());
                    heightInCm = (height * 0.393701);
                    result = heightInCm.toFixed(2);
                    $(".height_m").text(result);
                    $('input[name="height_m"]').val(result);
                    $("#mobconvert-inches").hide();
                    $("#mobconvert-cm").removeClass('hidden');
                    $('.cm_show').hide();
                    $('.inches_show').removeClass('hidden');
                    $('input[name="heightUnit"]').val('inches');
                    $('.measurementHeight_m').text(' inches');
                });

                $('#mobconvert-cm').click(function() {
                    // var height = parseFloat($("#height_m").val());
                    var height = parseFloat($('input[name="height_m"]').val());
                    heightInInches = (height / 0.393701);
                    // result = heightInInches.toFixed(0);
                    result = heightInInches.toFixed(2);
                    $(".height_m").text(result);
                    $('input[name="height_m"]').val(result);
                    // $("#height_m").val(result);
                    $("#mobconvert-inches").show();
                    $('.cm_show').show();
                    $('.inches_show').addClass('hidden');
                    $("#mobconvert-cm").addClass('hidden');
                    $('input[name="heightUnit"]').val('cm');
                    $('.measurementHeight_m').text(' cm');
                });

                /* modal data */
                $(document).on('click', '.bodyEditBtn', function() {
                    var name = $(this).attr('data-name');
                    var val = $(this).attr('data-val');
                    var mainName = $(this).attr('data-mainName');
                    var currentDate = $('.currentDate').val();
                    var label = 'cm';
                    if (mainName == 'weight' || mainName == 'height') {
                        if (mainName == 'weight') {
                            label = $('.measurementWeight_m').text();
                            val = $('input[name="weight_m"]').val();
                        }
                        if (mainName == 'height') {
                            label = $('.measurementHeight_m').text();
                            val = $('input[name="height_m"]').val();
                        }

                    }
                    console.log('currentDate=', val, label);
                    console.log('name', name, mainName);
                    $('.editSaveMeasurementBtn').attr('data-name', mainName);
                    $('.measurementValue').html(val);
                    $('.measurementLabel').html(label);
                    $('.measurementTitle').html(name);
                    $('.currentDate').html(currentDate);
                    $('.measurementInputValue').val(val);
                    $('#edit-measurement').modal('show');
                });



                $('body').on('click', '.editSaveMeasurementBtn', function() {
                    var editItemName = $(this).attr('data-name');
                    var formData = {};
                    formData['id'] = $('.body-measurement-id').val();
                    formData['eventDate'] = $('.currentDate').attr('data-val');
                    formData['updated_field'] = editItemName;
                    $('.bodyEditBtn').each(function() {
                        var item_name = $(this).attr('data-mainName');
                        if (item_name == editItemName) {
                            formData[item_name] = $('.measurementInputValue').val();
                        } else {
                            formData[item_name] = $(this).attr('data-val');
                        }
                    });
                    formData['weightUnit'] = $('input[name="weightUnit"]').val();
                    formData['heightUnit'] = $('input[name="heightUnit"]').val();
                    console.log('hi==', formData);
                    $.post(public_url + 'calendar/update-measurement-data-mob', formData, function(response) {
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

                /* add */
                $(document).on('click', '.bodyAddBtn', function() {
                    var name = $(this).attr('data-name');
                    var mainName = $(this).attr('data-mainName');
                    var currentDate = $('.currentDate').val();
                    console.log('currentDate==', currentDate, name, mainName);
                    var currentDateFormat = moment(currentDate).format('YYYY-MM-DD');
                    $('.saveMeasurementBtn').attr('data-name', mainName);
                    $('.measurement-date-calendar').val(currentDateFormat);
                    $('.addmeasurementTitle').text(name);
                    $('#add-measurement').modal('show');
                });

                $('body').on('click', '.saveMeasurementBtn', function() {
                    var addItemName = $(this).attr('data-name');
                    var formData = {};
                    formData['eventDate'] = $('.measurement-date-calendar').val();
                    formData['updated_field'] = addItemName;
                    $('.bodyEditBtn').each(function() {
                        var item_name = $(this).attr('data-mainName');
                        if (item_name == addItemName) {
                            formData[item_name] = $('.addInputMeasurement').val();
                        } else {
                            formData[item_name] = $(this).attr('data-val');
                        }
                    });
                    formData['weightUnit'] = $('input[name="weightUnit"]').val();
                    formData['heightUnit'] = $('input[name="heightUnit"]').val();
                    console.log('hii==', formData);
                    $.post(public_url + 'calendar/store-measurement-data-mob', formData, function(response) {
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
                                    //    $('#edit_current').modal('hide');
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

                /* modal data */

            });


// $(".on-click-measurement").click(function() {
  $('body').on('click', '.on-click-measurement', function() {
        $('.edit-div').hide();
        $(this).children('.edit-div').show();
    });

    $(document).on('click','.edit-popup-save',function(){
        var formData = {};
        formData['id'] = $(this).data('id');
        formData['field'] = $(this).data('field');
        formData['value'] = $('.edit-field-value-'+formData['id']).val();
    
        console.log('formData--', formData);
        $.post(public_url+'calendar/store-list-measurement-data',formData,function(response){
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
                      location.reload();
                    //    $('#edit_current').modal('hide');
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
                    $('#Edit-popupp-'+formData['id']).modal('hide');
                });
            }
        },'json');
        //   alert('edit-popup-click');
    });
    </script>
    @stop
