<div class="panel-body">
        
    {{--  --}}
  
        @if (count($dataPoints) > 0)
            <div class="minh-350 my-div graph graph-{{$bodypart}}">
                <div class="health-section-area">
                    <canvas id="myChart" height="200"></canvas>
                </div>
            </div>
        @else
            <div class="row my-div graph graph-{{$bodypart}}" style="padding: 10%">
                <canvas id="myChart" height="200" class="hidden"></canvas>
                <center><img src="{{ asset('no-graph.png') }}" alt="no-graph" height="100" width="100" srcset="">
                </center>
                <center>
                    <h4>There are no stats to graph right now.</h4>
                </center>
                <center>
                    <h6>Try changing the timeframe, or adding new stats.</h6>
                </center>
            </div>
        @endif

        <div class="minh-350 my-div filter-div filter-div-{{$bodypart}}" style="display: none">
            <div class="health-section-area">
                {{-- <canvas id="filterChart" height="100"></canvas> --}}
            </div>
        </div>
    {{--  --}}
        {{-- filter --}}
        <div class="row">
            <div class="col-md-12 text-right">
                <div class="reactRadioButtonGroup">
                    <div class="ant-radio-group">
                        <input type="radio" id="radio1" name="filterDate" value="1"
                            class="ant-radio-button-input filterDateFirstTime" @if ($duration == 1) checked @endif>
                        <label for="radio1" class="ant-radio-button-wrapper" bodypart="{{ $bodypart }}" data-value="1">1M</label>
                        <input type="radio" id="radio2" bodypart="{{ $bodypart }}" name="filterDate" 
                            class="ant-radio-button-input" @if ($duration == 3) checked @endif value="3">
                        <label for="radio2" class="ant-radio-button-wrapper" bodypart="{{ $bodypart }}" data-value="3">3M</label>
                        <input type="radio" id="radio3" checked bodypart="{{ $bodypart }}" name="filterDate" 
                            class="ant-radio-button-input" @if ($duration == 6) checked @endif value="6">
                        <label for="radio3" class="ant-radio-button-wrapper" bodypart="{{ $bodypart }}" data-value="6">6M</label>
                        <input type="radio" id="radio4" bodypart="{{ $bodypart }}" name="filterDate" 
                            class="ant-radio-button-input" @if ($duration == 12) checked @endif value="12">
                        <label for="radio4" class="ant-radio-button-wrapper" bodypart="{{ $bodypart }}" data-value="12">1Y</label>
                        <input type="radio" id="radio5" bodypart="{{ $bodypart }}" name="filterDate" 
                            class="ant-radio-button-input" @if ($duration == 24) checked @endif value="24">
                        <label for="radio5" class="ant-radio-button-wrapper" bodypart="{{ $bodypart }}" data-value="24">2Y</label>
                        <input type="radio" id="radio6" bodypart="{{ $bodypart }}" name="filterDate" 
                            class="ant-radio-button-input" @if ($duration == 36) checked @endif value="36">
                        <label for="radio6" class="ant-radio-button-wrapper" bodypart="{{ $bodypart }}" data-value="36">3Y</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- filter --}}

    <div class="row text-center" style="    margin-bottom: 20px">
        <div class="col-xs-12">
            <h2 class="max-min"><strong>MAXIMUM</strong></h2>
            <span class="currentDate-p c-gray">@if($max->event_date){{date("d M Y", strtotime($max->event_date))}} @endif</span>
            <h4 class="measure-value m-0 c-gray"><strong>{{$max->$columnName}}</strong> 
                @if($columnName == 'weight')
                @if($max->event_date) {{ $max->unit == 'Imperial'? 'pound' : 'kg' }} @endif
                @elseif($columnName == 'height')
                  {{ $max->unit }}
                @else
                 cm 
                @endif
            </h4>
        </div>
        <div class="col-xs-12">
            <h2 class="max-min"><strong>MINIMUM</strong></h2>
            <span class="currentDate-p c-gray">@if($min->event_date){{date("d M Y", strtotime($min->event_date))}} @endif</span>
            <h4 class="measure-value m-0 c-gray"><strong>{{$min->$columnName}}</strong> 
              @if($columnName == 'weight')
              @if($max->event_date)  {{ $mix->unit == 'Imperial'? 'pound' : 'kg' }} @endif
              @elseif($columnName == 'height')
                {{ $mix->unit }}
              @else
               cm 
              @endif
            </h4>
        </div>

    </div>

     <!-- Histroy table start -->
 <div class="graph_data measurement_graph">
    <div class="min_width">
      @if (count($personal_measurement_field) >= 2)
        @foreach ($personal_measurement_field as $key => $item)
          @if ($loop->index < $loop->count - 1)
          <div class="row on-click-measurement">
            <div class="list col-md-4 col-sm-4 col-xs-4">{{ date('d M', strtotime($item['updated_date'])) }}
            </div>
             @php
              if($columnName == 'weight'){
                 if($item->weightUnit == 'Metric'){
                    $label_suffix= 'kg';
                 } else {
                    $label_suffix= 'pound';
                 }
             } elseif($columnName == 'height'){
                if($item->heightUnit == 'inches'){
                    $label_suffix= 'inches';
                 } else {
                    $label_suffix= 'cm';
                 }
             } else{
                $label_suffix= 'cm';
             }

             $diff = $item[$columnName] - $personal_measurement_field[$key + 1][$columnName];
             @endphp
            <div class="list col-md-4 col-sm-4 col-xs-4 text-center">
                {{ $item[$columnName] }} {{$label_suffix}}
            </div>
            <div class="list col-md-4 col-sm-4 col-xs-4 text-right">
                @if ($diff > 0)
                    <span class="red">+{{ round($diff, 2) }}</span>
                @elseif($diff < 0)
                    <span class="green">{{ round($diff, 2) }}</span>
                @else
                    <span class="">{{ round($diff, 2) }}</span>
                @endif
                {{-- <span class="red">+90</span>% --}}
            </div>
            <div class="edit-div">
                <a data-toggle="modal" data-target="#Edit-popupp-{{ $item['id'] }}" href="#"><i class="fa fa-edit"></i> </a>
            </div>
         </div>
        @endif
        <div id="Edit-popupp-{{ $item['id'] }}" class="modal fade mobile_popup_fixed edit_current" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content animate-bottom static_edit_details">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title"><span>{{ $body_part }}</span> MEASUREMENT</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="box-shadow: none;">
                            <div class="col-md-12">
                                <div class="data">
                                    {{-- <input class="edit-field-value-239" type="text" value="90" name=""> --}}
                                    <input class="edit-field-value-{{ $item['id'] }}" type="text"
                                    value="{{ $item[$columnName] }}" name="">

                                </div>
                            </div>
                        </div>
                        <div class="row" style="box-shadow: none;">
                            <div class="col-md-6 col-sm-6 col-xs-6">

                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <a class="edit-popup-save" data-name="{{ $body_part }}"
                                            data-field="{{ $columnName }}" data-id="{{ $item['id'] }}"><i class="fa fa-check"></i> Save</a>
                                {{-- <a class="edit-popup-save" data-name="BFP" data-field="bfp_kg" data-id="239"><i class="fa fa-check"></i> Save</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
            <p style=" text-align: center; color: red;">No Record Found</p>
        @endif
    </div>
   
</div>
<!-- Histroy table end -->
  
</div>


