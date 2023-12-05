
<div class="row graph_top_details">
  <div class="col-md-6 col-xs-6">
      <span>Average</span> {{round($avgAmoutEating, 2)}} h
  </div>
  <div class="col-md-6 col-xs-6 text-right">
      <a href="#" class="right-left-arrow arrow-btn-click" data-date="{{$date1}}" data-btn="pre-btn" data-graph="eating"><</a> 
         <span>{{ date('d', strtotime($date1))}}</span> {{ date('M', strtotime($date1))}}<span>-{{ date('d', strtotime($date2))}}</span> {{ date('M', strtotime($date2))}}
     <a href="#" class="right-left-arrow arrow-btn-click" data-date="{{$date2}}" data-btn="next-btn" data-graph="eating">></a>
  </div>
</div>
<div class="fasting_history_graph">
  <div class="bottom_line1"><span>24</span></div>
  <div class="bottom_line2"><span>16</span></div>
  <div class="bottom_line3"><span>8</span></div>

  <div class="flex">
  {{--  --}}
  @foreach($fastArray as $key => $fast)
    <div class="graph_tab">
        <div class="m_date">
          @if($fast['eatingProgresBar'] != "0")
          {{-- @if($fast['eatingHour'] != 0 && $fast['eatingMinute'] != 0) --}}
               <div class="progres-bar" @if($fast['eatingProgresBar'] > 100 ) style="height: 100%;" @else style="height: {{$fast['eatingProgresBar']}}%;" @endif><span>{{$fast['eatingHour']}}<br>h</span><br><span>{{$fast['eatingMinute']}} min</span></div>
          @else
               <span class="data_na">N/A</span>
          @endif
        </div>
       <div class="bottom_date"><span>{{$fast['short_date']}}</span><br>{{$fast['month']}}</div>
     </div>
  @endforeach   
  {{--  --}}
  </div>
</div>