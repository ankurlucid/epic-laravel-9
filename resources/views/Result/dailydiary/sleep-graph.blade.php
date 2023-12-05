<h6 class="measurement-heading" style="font-size: 13px;display: flex;"><strong>DAILY&nbsp;</strong>  JOURNAL 
    <a href="#" class="right-left-arrow arrow-btn-click" data-date="{{$date1}}" data-btn="pre-btn"><</a> {{ date('d', strtotime($date1))}} - {{ date('d M Y', strtotime($date2))}} <a href="#" class="right-left-arrow arrow-btn-click" data-date="{{$date2}}" data-btn="next-btn">></a>
 </h6>

 <div class="flex sleep-graph">    
     @foreach($sleepArray as $key => $sleep)
     <div><div class="weeks"><div class="progres-bar" @if($sleep['progresBar'] > 100 ) style="height: 100%;" @else style="height: {{$sleep['progresBar']}}%;" @endif><span>{{$sleep['hour']}} <br>hr <br><br>{{$sleep['minute']}}<br>min</span></div></div>{{$sleep['day']}}</div>
     @endforeach           
</div>
{{--  --}}
<div class="measurement-div">
    <h6 class="measurement-heading"><strong>AVERAGE AMOUNT  </strong> OF SLEEP?</h6>
    <h4 class="measure-value float-left m-0 f-40"><strong>{{$avgAmoutSleep}}</strong></h4>     
    <hr class="m-0">
</div>

<div class="measurement-div">
    <h6 class="measurement-heading"><strong>AVERAGE TIME </strong> GO TO BED?</h6>
    <h4 class="measure-value float-left m-0"><strong>@if($avgAmoutGoToBed){{date('h:i A', strtotime($avgAmoutGoToBed))}} @endif</strong></h4>
    {{-- <h4 class="measure-value float-left m-0"><strong>10:15 </strong>PM</h4>      --}}
    <hr class="m-0">
</div>
<div class="measurement-div">
    <h6 class="measurement-heading"><strong>AVERAGE TIME </strong> GO TO SLEEP?</h6>
    <h4 class="measure-value float-left m-0"><strong>@if($avgAmoutGoToSleep){{date('h:i A', strtotime($avgAmoutGoToSleep))}}@endif </strong></h4>     
    <hr class="m-0">
</div>
<div class="measurement-div">
    <h6 class="measurement-heading"><strong>AVERAGE TIME </strong> WAKE UP?</h6>
    <h4 class="measure-value float-left m-0"><strong>@if($avgAmoutWakeUp){{date('h:i A', strtotime($avgAmoutWakeUp))}}@endif </strong></h4>  
    {{-- <h4 class="measure-value float-left m-0"><strong>{{date('H:i A', strtotime($sleepData['wake_up']))}} </strong></h4>      --}}
    <hr class="m-0">
</div>