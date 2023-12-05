<div class="row graph_top_details">
    <div class="col-md-6 col-xs-6">
        <a href="javascript:void(0)" class="refreshGraph" style="display:none;">Click me</a>
    </div>
    <div class="col-md-6 col-xs-6 text-right">
        <a href="#" class="right-left-arrow arrow-btn-click current-start-date previousDate" data-date="{{$date1}}" data-btn="pre-btn" data-graph="fasting"><</a> 
           <span>{{ date('d', strtotime($date1))}}</span> {{ date('M', strtotime($date1))}}<span>-{{ date('d', strtotime($date2))}}</span> {{ date('M', strtotime($date2))}}
       <a href="#" class="right-left-arrow arrow-btn-click nextDate" data-date="{{$date2}}" data-btn="next-btn" data-graph="fasting">></a>
    </div>
</div>
<div class="fasting_history_graph">
    <?php 
        $j = 0;
    for($i = 24 ; $i >= 0; $i--){ ?>

        <div class="bottom_line" style="position: absolute;left: 5%;right:auto !important;width:88%;height: 1px;border-bottom: 1px solid #8f8f8f;top:{{$j}}%">
            <span style="position: relative;float: left;margin-left: -48px;top: -11px;color: #FF571B;font-size: 16px;font-weight: 500;">{{$i}}
            </span>
        </div>

        <?php $j = $j + 4.166; ?>

    <?php } ?>

    <div class="flex">
        
        @foreach($fastArray as $key => $fast)
            <div class="graph_tab">
                <div class="m_date">
                    @if(!empty($fast['fastAndEatData']))
                            <?php 

                                $totalArraySize = count($fast['fastAndEatData']);
                            ?>
                            @foreach($fast['fastAndEatData'] as $key2=>$v2)

                                    <?php 

                                        $hasGap = false;
                                        if ($key2 == 0) {
                                                
                                            if ($v2['fast_start_time'] != 0) {

                                                $hasGap = true;
                                                $gapInPercentage = round(($v2['fast_start_time']/86400)*100,3);
                                            }

                                        }else{

                                            $lastkey = $key2-1;

                                            if (isset($fast['fastAndEatData'][$lastkey]['fast_end_time'])  && $fast['fastAndEatData'][$lastkey]['fast_end_time'] != $v2['fast_start_time']) {
                                                
                                                $hasGap = true;
                                                $gappingSecond = $v2['fast_start_time'] - $fast['fastAndEatData'][$lastkey]['fast_end_time'];

                                                $gapInPercentage = round(($gappingSecond/86400)*100,3);

                                            }
                                        }
                                    ?>

                                    @if($hasGap == true && isset($gapInPercentage))

                                        <div class="progres-bar-yello" style="height:{{$gapInPercentage}}%"></div>

                                    @endif

                                    <?php 

                                        $chunkClass = 'custom-method';
                                        
                                        if (isset($v2['chunk']) && $v2['chunk'] == true) {
                                            
                                            $chunkClass = 'chunk-class';
                                        }

                                    ?>
                                    @if($v2['type'] == 'fasting')

                                        @if($chunkClass == 'chunk-class')
                                            <div class="fasting-start"></div>
                                        @endif
                                        <div data-type="Fasting" data-id="{{$v2['fastingId']}}" class="progres-bar-orange {{$chunkClass}}" style="height:{{$v2['percentage']}}%"></div>
                                        

                                    @elseif($v2['type'] == 'eating')    

                                        <div data-type="Eating" data-id="{{$v2['fastingId']}}" class="progres-bar-gray {{$chunkClass}}" style="height:{{$v2['percentage']}}%"></div>
                                        @if($chunkClass == 'chunk-class')
                                            <div class="eating-end"></div>
                                        @endif
                                    @endif

                                    <?php 

                                        $hasLastGap = false;
                                        if ($totalArraySize-1 == $key2) {
                                                
                                            if ($v2['fast_end_time'] < 86400) {

                                                $hasLastGap = true;
                                                
                                                $totalSeconds = 86400 - $v2['fast_end_time'];

                                                $gapInPercentageLast = round(($totalSeconds/86400)*100,3);
                                            }
                                        
                                        }
                                    ?>

                                    @if($hasLastGap == true && isset($gapInPercentageLast))

                                        <div class="progres-bar-yello" style="height:{{$gapInPercentageLast}}%"></div>

                                    @endif

                            @endforeach

                    @else

                        <div class="progres-bar-yello" style="height:100%"></div>

                    @endif

                </div>
                
                <div class="bottom_date" style="line-height: 14px"> <span>

                {{$fast['short_date']}}</span><br>{{$fast['month']}}</div>
            </div>
        @endforeach
        
    </div>
</div>