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
        <span>Personal</span> <br>Statistics
        <div class="backtopage">
            <a @if ($queryString == 'Yes') href="{{ url('calendar/daily-dairy?date=' . $eventDate) }}" @else href="{{ url('calendar/daily-dairy') }}" @endif><i class="fa fa-long-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="personal_mobile_details" id="accordion">
        <div class="personal_dairy_section personal-measurement-mobile">
            <h2><strong>BODY</strong><br>MEASUREMENTS</h2>
            <input hidden value="{{date('d M Y', strtotime($eventDate))}}" data-val="{{$eventDate}}" class="currentDate">      
            <div class="measurement-div">
                <h6 class="measurement-heading"><strong>CHEST</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapseOne" data-mainName="chest" data-parent="#accordion" href="#collapseOne"
                                aria-expanded="true"> 
                               
                            </a></strong></span></h6>
                <h4 class="measure-value  m-0"><strong>{{$measurementData['chest']}}</strong> cm</h4>
                <a data-label="cm" data-name="CHEST" data-mainName="chest" data-val="{{$measurementData['chest']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span>
                </a>
                <a data-name="CHEST" data-mainName="chest" class="bodyAddBtn float-right" style="margin-right: 10px;"> 
                     <i class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span>
                </a>
                {{-- <a data-toggle="modal" data-target="#add-new-measurement" class="float-right"> <i
                    class="fa fa-pencil"></i> <span class="c-gray">EDIT</span>
                </a> --}}
                {{-- <a data-toggle="modal"data-target="#add-new-measurement" class="float-right" style="margin-right: 10px;"> 
                    <i class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span>
                </a> --}}


                <div id="collapseOne" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding: 15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                       <div class="row" style="    margin-bottom: 20px">
                        <div class="col-xs-12">
                             <h2 class="max-min"><strong>MAXIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                          <div class="col-xs-12">
                             <h2 class="max-min"><strong>MINIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                        
                    </div>
                    </div>
                     
                </div>


                <span class="currentDate-p">1 Jan 2021</span>
                <hr class="m-0">
            </div>
            <div class="measurement-div">
                <h6 class="measurement-heading"><strong>NECK</strong> MEASUREMENT <span
                        class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapsetwo" data-mainName="neck" data-parent="#accordion" href="#collapsetwo"
                                aria-expanded="true"> 
                               
                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{$measurementData['neck']}}</strong> cm</h4>
                 <a data-name="NECK" data-mainName="neck" data-label="cm" data-val="{{$measurementData['neck']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                 <a data-name="NECK" data-mainName="neck" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                          <div id="collapsetwo" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding: 15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                                <div class="row" style="    margin-bottom: 20px">
                        <div class="col-xs-12">
                             <h2 class="max-min"><strong>MAXIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                          <div class="col-xs-12">
                             <h2 class="max-min"><strong>MINIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                        
                    </div>
                       
                    </div>
                </div>
                <span class="currentDate-p">1 Jan 2021</span>
                
                <hr class="m-0">
            </div>
            <div class="measurement-div">
                <h6 class="measurement-heading"><strong>BICEP R</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapsethree" data-mainName="bicepR" data-parent="#accordion" href="#collapsethree"
                                aria-expanded="true"> 
                               
                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{$measurementData['bicep_r']}}</strong> cm</h4>
                 <a data-name="BICEP R" data-label="cm" data-mainName="bicep_r" data-val="{{$measurementData['bicep_r']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                 <a data-name="BICEP R" data-mainName="bicep_r" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                        <div id="collapsethree" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding:15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                                <div class="row" style="    margin-bottom: 20px">
                        <div class="col-xs-12">
                             <h2 class="max-min"><strong>MAXIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                          <div class="col-xs-12">
                             <h2 class="max-min"><strong>MINIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                        
                    </div>
                       
                    </div>
                </div>
                <span class="currentDate-p">1 Jan 2021</span>
                
                <hr class="m-0">
            </div>
             <div class="measurement-div">
                <h6 class="measurement-heading"><strong>BICEP L</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapsefour" data-mainName="bicepL" data-parent="#accordion" href="#collapsefour"
                                aria-expanded="true"> 
                               
                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{$measurementData['bicep_l']}}</strong> cm</h4>
         
                 <a data-name="BICEP L" data-label="cm" data-mainName="bicep_l" data-val="{{$measurementData['bicep_l']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                 <a data-name="BICEP L" data-mainName="bicep_l" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                        <div id="collapsefour" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding: 15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                                <div class="row" style="    margin-bottom: 20px">
                        <div class="col-xs-12">
                             <h2 class="max-min"><strong>MAXIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                          <div class="col-xs-12">
                             <h2 class="max-min"><strong>MINIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                        
                    </div>
                       
                    </div>
                </div>
                       <span class="currentDate-p">1 Jan 2021</span>
                <hr class="m-0">
            </div>
            <div class="measurement-div">
                <h6 class="measurement-heading"><strong>FOREARM R</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapsefive" data-mainName="forearmR" data-parent="#accordion" href="#collapsefive"
                                aria-expanded="true"> 
                               
                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{$measurementData['forearm_r']}}</strong> cm</h4>
                 <a data-name="FOREARM R" data-label="cm" data-mainName="forearm_r" data-val="{{$measurementData['forearm_r']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                 <a data-name="FOREARM R" data-mainName="forearm_r" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                        <div id="collapsefive" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding:15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                                <div class="row" style="    margin-bottom: 20px">
                        <div class="col-xs-12">
                             <h2 class="max-min"><strong>MAXIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                          <div class="col-xs-12">
                             <h2 class="max-min"><strong>MINIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                        
                    </div>
                       
                    </div>
                </div>
                       <span class="currentDate-p">1 Jan 2021</span>
                <hr class="m-0">
            </div>
             <div class="measurement-div">
                <h6 class="measurement-heading"><strong>FOREARM L</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapsesix" data-mainName="forearmL" data-parent="#accordion" href="#collapsesix"
                                aria-expanded="true"> 
                               
                            </a></strong></span></h6>
                <h4 class="m-0"><strong>{{$measurementData['forearm_l']}}</strong> cm</h4>
                <a data-name="FOREARM L" data-label="cm" data-mainName="forearm_l" data-val="{{$measurementData['forearm_l']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                <a data-name="FOREARM L" data-mainName="forearm_l" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                        <div id="collapsesix" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding: 15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                                <div class="row" style="    margin-bottom: 20px">
                        <div class="col-xs-12">
                             <h2 class="max-min"><strong>MAXIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                          <div class="col-xs-12">
                             <h2 class="max-min"><strong>MINIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                        
                    </div>
                       
                    </div>
                </div>
                       <span class="currentDate-p">1 Jan 2021</span>
                <hr class="m-0">
            </div>
             <div class="measurement-div">
                <h6 class="measurement-heading"><strong>ABDOMEN</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapseseven" data-mainName="abdomen" data-parent="#accordion" href="#collapseseven"
                                aria-expanded="true"> 
                               
                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{$measurementData['waist']}}</strong> cm</h4>
                <a data-name="ABDOMEN" data-label="cm" data-mainName="waist" data-val="{{$measurementData['waist']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                <a data-name="ABDOMEN" data-mainName="waist" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                        <div id="collapseseven" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding: 15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                                <div class="row" style="    margin-bottom: 20px">
                        <div class="col-xs-12">
                             <h2 class="max-min"><strong>MAXIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                          <div class="col-xs-12">
                             <h2 class="max-min"><strong>MINIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                        
                    </div>
                       
                    </div>
                </div>
                       <span class="currentDate-p">1 Jan 2021</span>
                <hr class="m-0">
            </div>
             <div class="measurement-div">
                <h6 class="measurement-heading"><strong>HIP</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapseeight" data-mainName="hip" data-parent="#accordion" href="#collapseeight"
                                aria-expanded="true"> 
                               
                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{$measurementData['hip']}}</strong> cm</h4>
                <a data-name="HIP" data-label="cm" data-mainName="hip" data-val="{{$measurementData['hip']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                <a data-name="HIP" data-mainName="hip" class="bodyAddBtn float-right" class="float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                        <div id="collapseeight" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding: 15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                                <div class="row" style="    margin-bottom: 20px">
                        <div class="col-xs-12">
                             <h2 class="max-min"><strong>MAXIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                          <div class="col-xs-12">
                             <h2 class="max-min"><strong>MINIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                        
                    </div>
                       
                    </div>
                </div>
                       <span class="currentDate-p">1 Jan 2021</span>
                <hr class="m-0">
            </div>
             <div class="measurement-div">
                <h6 class="measurement-heading"><strong>THIGH R</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapsenine" data-mainName="thighR" data-parent="#accordion" href="#collapsenine"
                                aria-expanded="true"> 
                               
                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{$measurementData['thigh_r']}}</strong> cm</h4>
                <a data-name="THIGH R" data-label="cm" data-mainName="thigh_r" data-val="{{$measurementData['thigh_r']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                <a data-name="THIGH R" data-mainName="thigh_r" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                        <div id="collapsenine" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding: 15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                                <div class="row" style="    margin-bottom: 20px">
                        <div class="col-xs-12">
                             <h2 class="max-min"><strong>MAXIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                          <div class="col-xs-12">
                             <h2 class="max-min"><strong>MINIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                        
                    </div>
                       
                    </div>
                </div>
                       <span class="currentDate-p">1 Jan 2021</span>
                <hr class="m-0">
            </div>
             <div class="measurement-div">
                <h6 class="measurement-heading"><strong>THIGH L</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapseten" data-mainName="thighL" data-parent="#accordion" href="#collapseten"
                                aria-expanded="true"> 
                               
                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{$measurementData['thigh_l']}}</strong> cm</h4>
                 <a data-name="THIGH L" data-label="cm" data-mainName="thigh_l" data-val="{{$measurementData['thigh_l']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                 <a data-name="THIGH L" data-mainName="thigh_l" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                        <div id="collapseten" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding: 15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                                <div class="row" style="    margin-bottom: 20px">
                        <div class="col-xs-12">
                             <h2 class="max-min"><strong>MAXIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                          <div class="col-xs-12">
                             <h2 class="max-min"><strong>MINIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                        
                    </div>
                       
                    </div>
                </div>
                       <span class="currentDate-p">1 Jan 2021</span>
                <hr class="m-0">
            </div>
             <div class="measurement-div">
                <h6 class="measurement-heading"><strong>CALF R</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapseeleven" data-mainName="calfR" data-parent="#accordion" href="#collapseeleven"
                                aria-expanded="true"> 
                               
                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{$measurementData['calf_r']}}</strong> cm</h4>
                <a data-name="CALF R" data-label="cm" data-mainName="calf_r" data-val="{{$measurementData['calf_r']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                <a data-name="CALF R" data-mainName="calf_r" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                        <div id="collapseeleven" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding: 15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                                <div class="row" style="    margin-bottom: 20px">
                        <div class="col-xs-12">
                             <h2 class="max-min"><strong>MAXIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                          <div class="col-xs-12">
                             <h2 class="max-min"><strong>MINIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                        
                    </div>
                       
                    </div>
                </div>
                       <span class="currentDate-p">1 Jan 2021</span>
                <hr class="m-0">
            </div>
            <div class="measurement-div">
                <h6 class="measurement-heading"><strong>CALF L</strong> MEASUREMENT <span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapsetwelve" data-mainName="calfL" data-parent="#accordion" href="#collapsetwelve"
                                aria-expanded="true"> 
                               
                            </a></strong></span></h6>
                <h4 class="measure-value m-0"><strong>{{$measurementData['calf_l']}}</strong> cm</h4>
                <a data-name="CALF L" data-label="cm" data-mainName="calf_l" data-val="{{$measurementData['calf_l']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                <a data-name="CALF L" data-mainName="calf_l" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                        <div id="collapsetwelve" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding: 15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                                <div class="row" style="    margin-bottom: 20px">
                        <div class="col-xs-12">
                             <h2 class="max-min"><strong>MAXIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                          <div class="col-xs-12">
                             <h2 class="max-min"><strong>MINIMUM</strong></h2>
                             <span class="currentDate-p c-gray">1 Jan 2021</span>
                             <h4 class="measure-value m-0 c-gray"><strong>40</strong> cm</h4>
                        </div>
                        
                    </div>
                       
                    </div>
                </div>
                       <span class="currentDate-p">1 Jan 2021</span>
                <hr class="m-0">
            </div>
             <div class="measurement-div">
              

<!--                 <h6 class="measurement-heading"><strong>WEIGHT</strong><span class="kg_show">(Kg)</span><span
                        class="pound_show hidden">(Pound)</span><span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsethirteen"
                                aria-expanded="true"> 
                               
                            </a></strong></span></h6>
                <button type="button" class="btn btn-primary btn-o btn-sm p-y-0 bg-none mli-10 pull-right f-11 "
                    id="mobconvertP">Show Imperial</button>
                <button type="button" class="btn btn-primary btn-o btn-sm p-y-0 bg-none mli-10 pull-right f-11 hidden"
                    id="mobconKg">Show Metric</button>
                <h4 class="measure-value m-0"><strong class="weight_m">{{$measurementData['weight']}} </strong><span class="measurementWeight_m">kg</span></h4> -->

                <h6 class="measurement-heading"><strong>WEIGHT</strong><span class="kg_show" @if($measurementData['weightUnit']=='Imperial') style="display: none;" @endif>(Kg)</span>
                    <span class="pound_show @if($measurementData['weightUnit']=='Metric') hidden @endif ">(Pound)</span> <button type="button" class="btn btn-primary btn-o btn-sm p-y-0 bg-none mli-10 f-11"
                    @if($measurementData['weightUnit']=='Imperial') style="display: none;" @endif id="mobconvertP">Show Imperial</button> 
                <button type="button" class="btn btn-primary btn-o btn-sm p-y-0 bg-none mli-10  f-11  @if($measurementData['weightUnit']=='Metric') hidden @endif"
                    id="mobconKg">Show Metric</button><span class="float-right"><strong><a
                                class="accordion-toggle collapsed" data-toggle="collapse" data-id="collapsethirteen" data-mainName="weight" data-parent="#accordion" href="#collapsethirteen"
                                aria-expanded="true"> 
                               
                            </a></strong></span>
                </h6>
                
                <h4 class="measure-value m-0"><strong class="weight_m">{{$measurementData['weight']}} </strong> @if($measurementData['weightUnit']=='Imperial')<span class="measurementWeight_m">pound</span> @endif @if($measurementData['weightUnit']=='Metric')<span class="measurementWeight_m">kg</span>@endif</h4>

                 <input type="hidden" name="weight_m" value="{{$measurementData['weight']}}">
                 <input type="hidden" name="weightUnit" value="{{ isset($measurementData['weightUnit']) && $measurementData['weightUnit'] !=null? $measurementData['weightUnit']:'Metric' }}">
                 <a data-name="WEIGHT" data-label="cm" data-mainName="weight" data-val="{{$measurementData['weight']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                 <a data-name="WEIGHT" data-mainName="weight" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                        <div id="collapsethirteen" class="panel-collapse collapse" aria-expanded="true" style="">
                           <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding: 15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                       
                    </div>
                </div>
                       <span class="currentDate-p">1 Jan 2021</span>
                <hr class="m-0">
            </div>

            <div class="measurement-div">
                <h6 class="measurement-heading">
                    <strong>HEIGHT</strong><span class="cm_show" @if($measurementData['heightUnit']=='inches') style="display: none;" @endif>(cm)</span>
                    <span class="inches_show @if($measurementData['heightUnit']=='cm') hidden @endif">(inches)</span> <button type="button" class="btn btn-primary btn-o btn-sm p-y-0 bg-none mli-10 f-11"
                    id="mobconvert-inches" @if($measurementData['heightUnit']=='inches') style="display: none;" @endif>Show in inches</button><button type="button" class="btn btn-primary btn-o btn-sm p-y-0 bg-none mli-10  @if($measurementData['heightUnit']=='cm') hidden @endif f-11"
                    id="mobconvert-cm">Show in cm</button><span class="float-right"><strong><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-id="collapsefourteen" data-mainName="height" href="#collapsefourteen" aria-expanded="false"> 
                               
                            </a></strong></span>
                </h6>
                
                
                <h4 class="measure-value  m-0"><strong class="height_m">{{$measurementData['height']}}</strong> @if($measurementData['heightUnit']=='inches')<span class="measurementHeight_m">inches</span> @endif @if($measurementData['heightUnit']=='cm')<span class="measurementHeight_m">cm</span>@endif</h4>
                
                {{-- <input type="number" name="height" value="" id="height_m"> --}}                                    
                {{-- <input type="hidden" name="heightUnit" value="{{ isset($measurementData->heightUnit) && $measurementData->heightUnit !=null?$measurementData->heightUnit:'cm' }}"> --}}
                <input type="hidden" name="height_m" value="{{$measurementData['height']}}">
                <input type="hidden" name="heightUnit" value="{{ isset($measurementData['heightUnit']) && $measurementData['heightUnit'] !=null? $measurementData['heightUnit']:'cm' }}">
                 <a data-name="HEIGHT" data-label="cm" data-mainName="height" data-val="{{$measurementData['height']}}" class="bodyEditBtn float-right"> <i
                        class="fa fa-pencil"></i> <span class="c-gray">EDIT</span></a>
                 <a data-name="HEIGHT" data-mainName="height" class="bodyAddBtn float-right" style="margin-right: 10px;"> <i
                        class="fa fa-plus"></i> <span class="c-gray">ADD NEW</span></a>
                        <div id="collapsefourteen" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="panel-body">
                   
                                <div class="row my-div graph" style="padding: 15px">
                                    <canvas id="myChart" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                       
                    </div>
                </div>
               <span class="currentDate-p">1 Jan 2021</span>
                <hr class="m-0">

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
                /* graph */
                

                /* end graph */
                $(".accordion-toggle").click(function() {
                    $(this).parent().parent().parent().parent().toggleClass("theme-orange");
                    var bodypart =  $(this).attr('data-mainName');
                    var div_id =  $(this).attr('data-id');
                    console.log('gg',name,div_id);
                    if($(this).hasClass('collapsed')){
                         $('#waitingShield').removeClass('hidden');
                    $.ajax({
                        url: public_url + 'calendar/body-measurement-graph/' + bodypart,
                        method: "get",
                        success: function (data) {
                            $('#waitingShield').addClass('hidden');
                            console.log('data--',data);
                            if(data.status == 'ok'){
                                $("#"+div_id).html(data.mob_html);
                            }
                            // $(".graph").hide();
                            // $(".filter-div").show();
                            // $(".filter-div").html(data)
                        }
                     });
                   }                  
                });
            /* convert weight */
           $('#mobconvertP').click(function(){
                // var weight = parseFloat($(".weight_m").val());
                var weight = parseFloat($('input[name="weight_m"]').val());
                weightInPounds = (weight*2.2046226218); 
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
                weightInPounds = (weight/2.2046226218);
                result = weightInPounds.toFixed(0);
                $(".weight_m").text(result);
                $('input[name="weight_m"]').val(result)
                $("#mobconvertP").show();
                $('.kg_show').show();
                $('.pound_show').addClass('hidden');
                $("#mobconKg").addClass('hidden');
                $('input[name="weightUnit"]').val('Metric');
                $('.measurementWeight_m').text(' kg');
               });

               $('#mobconvert-inches').click(function(){
                    // var height = parseFloat($("#height_m").val());
                    var height = parseFloat($('input[name="height_m"]').val());
                    heightInCm = (height*0.393701); 
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

                $('#mobconvert-cm').click(function(){
                    // var height = parseFloat($("#height_m").val());
                    var height = parseFloat($('input[name="height_m"]').val());
                    heightInInches = (height/0.393701);
                    result = heightInInches.toFixed(0);
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
                $(document).on('click','.bodyEditBtn',function(){
                    var name = $(this).attr('data-name');
                    var val = $(this).attr('data-val');
                    var mainName = $(this).attr('data-mainName');
                    var currentDate = $('.currentDate').val();
                    // var label = 'cm';
                    // if(mainName =='weight' || mainName =='height'){
                    //     if(mainName =='weight'){
                    //         var label = $('.measurementWeight_m').text();
                    //     }
                    //    if(mainName =='height'){
                    //         var label = $('.measurementHeight_m').text();
                    //     }
                   
                    // } 
                    // console.log('currentDate=', currentDate, label);
                    console.log('name', name,mainName);
                    $('.editSaveMeasurementBtn').attr('data-name',mainName);
                    $('.measurementValue').html(val);
                    // $('.measurementLabel').html(label);
                    $('.measurementTitle').html(name);
                    $('.currentDate').html(currentDate);
                    $('.measurementInputValue').val(val); 
                    $('#edit-measurement').modal('show');
                });


                
              $('body').on('click','.editSaveMeasurementBtn',function(){
                    var editItemName = $(this).attr('data-name');
                    var formData = {};
                    formData['eventDate'] = $('.currentDate').attr('data-val');
                    formData['updated_field'] = editItemName;
                    $('.bodyEditBtn').each(function(){
                        var item_name = $(this).attr('data-mainName');
                        if(item_name == editItemName ){
                            formData[item_name] = $('.measurementInputValue').val();
                        } else {
                            formData[item_name] = $(this).attr('data-val');
                        }
                    });
                     formData['weightUnit']= $('input[name="weightUnit"]').val();
                     formData['heightUnit']= $('input[name="heightUnit"]').val();
                     console.log('hi==',formData);
                    $.post(public_url+'calendar/update-measurement-data-mob',formData,function(response){
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
                                  location.reload();
                                // $('#edit_current').modal('hide');
                            });
                         }
                      },'json');
                 });

              /* add */
              $(document).on('click','.bodyAddBtn',function(){
                    var name = $(this).attr('data-name');
                    var mainName = $(this).attr('data-mainName');
                    var currentDate = $('.currentDate').val();
                    console.log('currentDate==', currentDate);
                    var currentDateFormat = moment(currentDate).format('YYYY-MM-DD');  
                    $('.saveMeasurementBtn').attr('data-name',mainName);
                    $('.measurement-date-calendar').val(currentDateFormat); 
                    $('#add-measurement').modal('show');
                });

             $('body').on('click','.saveMeasurementBtn',function(){
                    var addItemName = $(this).attr('data-name');
                    var formData = {};
                    formData['eventDate'] = $('.measurement-date-calendar').val();
                    formData['updated_field'] = addItemName;
                    $('.bodyEditBtn').each(function(){
                        var item_name = $(this).attr('data-mainName');
                        if(item_name == addItemName ){
                            formData[item_name] = $('.addInputMeasurement').val();
                        } else {
                            formData[item_name] = $(this).attr('data-val');
                        }
                    });
                     formData['weightUnit']= $('input[name="weightUnit"]').val();
                     formData['heightUnit']= $('input[name="heightUnit"]').val();
                     console.log('hii==',formData);
                    $.post(public_url+'calendar/store-measurement-data-mob',formData,function(response){
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
                                location.reload();
                            });
                        }
                    },'json');
                });

                /* modal data */

            });
        </script>
    @stop
