{{-- <div class="personal_mob_graph"> --}}
{{-- @php

        $dataPoints = [];
        $dataPoints1 = [];
        $xaxis = [];
                
        foreach ($data as $key => $value) {
            
            if($bodypart == 'bp'){
                $xaxis[] = $value['date'];
                $dataPoints[] = $value['bp_mm'];
                $dataPoints1[] = $value['bp_hg'];
            }else{
                $xaxis[] = $value['date'];
                $dataPoints[] = $value['value'];
            }
            

        }
        if($duration == 1){
            $unit = 'day';
        }else{
            $unit = 'month';
        }

        if($bodypart == 'smm' || $bodypart == 'bfm' || $bodypart == 'vis_fat'){
            $yaxis_label_suffix = $label_suffix;
        }
        if($bodypart == 'bfp'){
            $yaxis_label_suffix = $label_suffix;
        }
        if($bodypart == 'bmr'){
            $yaxis_label_suffix = $label_suffix;
        }
        if($bodypart == 'bmi'){
            $yaxis_label_suffix = $label_suffix;
        }
        if($bodypart == 'hw'){
            $yaxis_label_suffix = $label_suffix;
        }
        if($bodypart == 'pulse'){
            $yaxis_label_suffix = $label_suffix;
        }
        if($bodypart == 'bp'){
            $yaxis_label_suffix = $label_suffix;
        }

    @endphp --}}

<div class="modal-header">
    <h4><span>{{ $body_part }}</span> Body Fat Percentage</h4>
</div>
<div class="modal-body">
    <!-- Start: First row -->
    <div class="row pos-of-acc pos-of-acc1 pos-of-accc b-measurement" style="">
        <!-- Start: Helath section -->
        <div class="col-md-12 col-sm-12" id="health-section-row">
            <div class="panel panel-white no-radius load1 panel-white-me" id="visits">
                <div collapse="visits" class="panel-wrapper">
                    <div class="panel-body">
                        @if ($bodypart == 'bp')
                            @if (count($dataPoints) > 0)
                                <div class="my-div graph">
                                    <div class="health-section-area">
                                        <canvas id="myChart1" height="100"></canvas>
                                    </div>
                                </div>
                            @else
                                <div class="row my-div graph" style="padding: 10%">
                                    <canvas id="myChart1" height="100" class="hidden"></canvas>
                                    <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100"
                                            width="100" srcset=""></center>
                                    <center>
                                        <h4>There are no stats to graph right now.</h4>
                                    </center>
                                    <center>
                                        <h6>Try changing the timeframe, or adding new stats.</h6>
                                    </center>
                                </div>
                            @endif
                        @endif
                        @if ($bodypart != 'bp')
                            @if (count($dataPoints) > 0)
                                <div class="my-div graph">
                                    <div class="health-section-area">
                                        <canvas id="myChart" height="100"></canvas>
                                    </div>
                                </div>
                            @else
                                <div class="row my-div graph" style="padding: 10%">
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
                            @endif
                        @endif

                        <div class="my-div filter-div" style="display: none">
                            <div class="health-section-area">
                                {{-- <canvas id="filterChart" height="100"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End: Helath section -->
    <div class="row">
        {{-- <div class="col-md-12">                
                <div class="currentDate flex">
                    <div class="pr16 view-calendar">
                        <script type="text/javascript">
                            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                            ];

                            const d = new Date();
                            document.write("" + monthNames[d.getMonth()]);
                        </script>  
                        <script>
                            now = new Date
                            theYear=now.getYear()
                            if (theYear < 1900)
                                theYear=theYear+1900
                            document.write(theYear)
                        </script>
                    </div>
                    <div>
                        <a href="javascript:void(0)" class="filterGraph" bodypart="{{ $bodypart }}" month="{{ date("Y-m-d") }}" duration="{{ $duration }}" status="previous"><i class="fa fa-angle-left"></i></a>
                    </div>
                    <div>
                        <img src="{{asset('assets/images/calendar1.png')}}">
                    </div>
                    <div>
                        <a href="javascript:void(0)" class="filterGraph" bodypart="{{ $bodypart }}" month="{{ date("Y-m-d") }}" duration="{{ $duration }}" status="next"><i class="fa fa-angle-right"></i></a>
                    </div>

                </div>
            </div> --}}
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <div class="reactRadioButtonGroup">
                <div class="ant-radio-group">
                    <input type="radio" id="radio1" bodypart="{{ $bodypart }}" name="filterDate" value="1"
                        class="ant-radio-button-input filterDateFirstTime" @if ($duration == 1) checked @endif>
                    <label for="radio1" class="ant-radio-button-wrapper">1M</label>
                    <input type="radio" id="radio2" bodypart="{{ $bodypart }}" name="filterDate" value="3"
                        class="ant-radio-button-input" @if ($duration == 3) checked @endif>
                    <label for="radio2" class="ant-radio-button-wrapper">3M</label>
                    <input type="radio" id="radio3" checked bodypart="{{ $bodypart }}" name="filterDate" value="6"
                        class="ant-radio-button-input" @if ($duration == 6) checked @endif>
                    <label for="radio3" class="ant-radio-button-wrapper">6M</label>
                    <input type="radio" id="radio4" bodypart="{{ $bodypart }}" name="filterDate" value="12"
                        class="ant-radio-button-input" @if ($duration == 12) checked @endif>
                    <label for="radio4" class="ant-radio-button-wrapper">1Y</label>
                    <input type="radio" id="radio5" bodypart="{{ $bodypart }}" name="filterDate" value="24"
                        class="ant-radio-button-input" @if ($duration == 24) checked @endif>
                    <label for="radio5" class="ant-radio-button-wrapper">2Y</label>
                    <input type="radio" id="radio6" bodypart="{{ $bodypart }}" name="filterDate" value="36"
                        class="ant-radio-button-input" @if ($duration == 36) checked @endif>
                    <label for="radio6" class="ant-radio-button-wrapper">3Y</label>
                </div>
            </div>

        </div>
    </div>
</div>
{{--  --}}

    <div class="row text-center" style="    margin-bottom: 20px">
        <div class="col-xs-12">
            <h2 class="max-min"><strong>MAXIMUM</strong></h2>
            <span class="currentDate-p c-gray">@if($max->event_date){{date("d M Y", strtotime($max->event_date))}} @endif @if($bodypart == 'bp')/ {{date("d M Y", strtotime($max_bp_hg['event_date']))}} @endif</span>
            <h4 class="measure-value m-0 c-gray"><strong>{{$max->$column_name}} @if($bodypart == 'bp')/{{$max_bp_hg['bp_hg']}} @endif</strong> 
                {{$label_suffix}}
                {{-- @if($columnName == 'weight')
                @if($max->event_date) {{ $max->unit == 'Imperial'? 'pound' : 'kg' }} @endif
                @elseif($columnName == 'height')
                {{ $max->unit }}
                @else
                cm 
                @endif --}}
            </h4>
        </div>
        <div class="col-xs-12">
            <h2 class="max-min"><strong>MINIMUM</strong></h2>
            <span class="currentDate-p c-gray">@if($min->event_date){{date("d M Y", strtotime($min->event_date))}} @endif @if($bodypart == 'bp')/ {{date("d M Y", strtotime($min_bp_hg['event_date']))}} @endif </span>
            <h4 class="measure-value m-0 c-gray"><strong>{{$min->$column_name}}@if($bodypart == 'bp')/{{$min_bp_hg['bp_hg']}} @endif</strong> 
                {{$label_suffix}}
            {{-- @if($columnName == 'weight')
            @if($max->event_date)  {{ $mix->unit == 'Imperial'? 'pound' : 'kg' }} @endif
            @elseif($columnName == 'height')
                {{ $mix->unit }}
            @else
            cm 
            @endif --}}
            </h4>
        </div>
    </div>
{{--  --}}
<div class="graph_data">
    <div class="min_width">
        @if (count($personal_statistic_field) >= 2)
            @foreach ($personal_statistic_field as $key => $item)

                @php
                    if ($updated_field == 'bp_mm') {
                        $diff = $item[$column_name] - $personal_statistic_field[$key + 1][$column_name];
                        //    $diff = $item[$updated_field]-$personal_statistic_field[$key+1][$updated_field];
                        $diff_bp_hg = $item['bp_hg'] - $personal_statistic_field[$key + 1]['bp_hg'];
                        if ($diff_bp_hg > 0) {
                            $bp_hg_class = 'red';
                            $diff_bp_hg_val = '+' . $diff_bp_hg;
                        } elseif ($diff_bp_hg < 0) {
                            $bp_hg_class = 'green';
                            $diff_bp_hg_val = $diff_bp_hg;
                        } else {
                            $bp_hg_class = '';
                            $diff_bp_hg_val = $diff_bp_hg;
                        }
                    } else {
                        $diff = $item[$column_name] - $personal_statistic_field[$key + 1][$column_name];
                        //   $diff = $item[$updated_field]-$personal_statistic_field[$key+1][$updated_field];
                    }
                    
                @endphp
                @if ($loop->index < $loop->count - 1)
                    <div class="row on-clickk">
                        <div class="list col-md-4 col-sm-4 col-xs-4">{{ date('d M', strtotime($item['updated_at'])) }}
                        </div>
                        <div class="list col-md-4 col-sm-4 col-xs-4 text-center">
                            {{ $item[$column_name] }} @if ($column_name == 'bp_mm')/{{ $item['bp_hg'] }} @endif{{ $label_suffix }}
                            {{-- {{$item[$updated_field]}} @if ($updated_field == 'bp_mm')/{{$item['bp_hg']}} @endif{{$label_suffix}} --}}
                        </div>
                        <div class="list col-md-4 col-sm-4 col-xs-4 text-right">
                            @if ($diff > 0)
                                <span class="red">+{{ round($diff, 2) }}</span>@if ($column_name == 'bp_mm')/ <span class="{{ $bp_hg_class }}">{{ $diff_bp_hg_val }}</span> @endif
                                {{ $label_suffix }}
                                {{-- <span class="red">+{{round($diff, 2)}}</span>@if ($updated_field == 'bp_mm')/ <span class="{{$bp_hg_class}}">{{round($diff_bp_hg_val, 2)}}</span> @endif {{$label_suffix}} --}}
                            @elseif($diff < 0) <span class="green">
                                    {{ round($diff, 2) }}</span>@if ($column_name == 'bp_mm')/ <span class="{{ $bp_hg_class }}">{{ $diff_bp_hg_val }}</span> @endif {{ $label_suffix }}
                                    {{-- <span class="green">{{round($diff, 2)}}</span>@if ($updated_field == 'bp_mm')/ <span class="{{$bp_hg_class}}">{{round($diff_bp_hg_val, 2)}}</span> @endif {{$label_suffix}} --}}
                                @else
                                    <span class="">{{ round($diff, 2) }}</span>@if ($column_name == 'bp_mm')/ <span class="{{ $bp_hg_class }}">{{ $diff_bp_hg_val }}</span> @endif
                                    {{ $label_suffix }}
                                    {{-- <span class="">{{round($diff, 2)}}</span>@if ($updated_field == 'bp_mm')/ <span class="{{$bp_hg_class}}">{{round($diff_bp_hg_val, 2)}}</span> @endif {{$label_suffix}} --}}
                            @endif
                        </div>
                        <div class="edit-div">
                            <a data-toggle="modal" data-target="#Edit-popupp-{{ $item['id'] }}" href="#"><i
                                    class="fa fa-edit"></i> </a>
                        </div>
                    </div>
                @endif
                {{-- edit popup --}}
                <div id="Edit-popupp-{{ $item['id'] }}" class="modal fade mobile_popup_fixed edit_current"
                    role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content animate-bottom static_edit_details">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                                <h4 class="modal-title"><span>{{ $body_part }}</span> Body Fat Percentage</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row" style="box-shadow: none;">
                                    <div class="col-md-12">
                                        <div class="data">
                                            <input class="edit-field-value-{{ $item['id'] }}" type="text"
                                                value="{{ $item[$column_name] }}" name="">
                                        @if($column_name == 'bp_mm')
                                              <span class="blood_pressure_edit_list"><span>/</span> 
                                              <input type="text" class="edit-field-bp-hg-{{ $item['id'] }}" value="{{$item['bp_hg']}}" name=""></span>
                                         @endif  
                                        </div>
                                    </div>
                                </div>
                                <div class="row"  style="box-shadow: none;">
                                    <div class="col-md-6 col-sm-6 col-xs-6">

                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                        <a class="edit-popup-save" data-name="{{ $body_part }}"
                                            data-field="{{ $column_name }}" data-id="{{ $item['id'] }}"><i class="fa fa-check"></i> Save</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end edit popup --}}
            @endforeach
        @else
            <p style=" text-align: center; color: red;">No Record Found</p>
        @endif

    </div>
</div>


<script type="text/javascript">
    $(".on-clickk").click(function() {
        $('.edit-div').hide();
        $(this).children('.edit-div').show();
    });
</script>
