<style type="text/css">
    .pre-w{
white-space: pre-wrap;
    }
</style>

<div class="col-md-6">
    <fieldset class="padding-15">
        <legend>Goals & Priorities</legend>

            <div class="form-group">
                <label class="strong" for="referrer">Prioritise and drag the following fitness components relating to your specific needs: Number from 1 (most important) to 5 (least important)</label>
                <div class="dd" id="nestable">
                    <ol class="dd-list">
                        <?php
                        $cLabels = array('goalFitnessComponents0' => 'Body Fat %', 'goalFitnessComponents1' => 'Cardio Endurance', 'goalFitnessComponents2' => 'Flexibility & mobility', 'goalFitnessComponents3' => 'Muscular strength', 'goalFitnessComponents4' => 'Explosive power');
                        $comps = $parq->goalFitnessComponents ? json_decode($parq->goalFitnessComponents, true) : array(array('id' => 'goalFitnessComponents0'), array('id' => 'goalFitnessComponents1'), array('id' => 'goalFitnessComponents2'), array('id' => 'goalFitnessComponents3'), array('id' => 'goalFitnessComponents4'));

                        ?>
                        @foreach($comps as $carr)
                            <li class="dd-item" data-id="{{ $carr['id'] }}">
                                <div class="">{{ $cLabels[$carr['id']] }}</div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        
            <div class="form-group">
                <label for="goalHealthWellness" class="strong">Select your specific goals</label></br>
                <?php
                if(count($parq->goalHealthWellness)>0) {
                    $str = implode('</br>',$parq->goalHealthWellness);
                    $str = str_replace('["', '', $str);
                    $str = str_replace('"]', '', $str);
                    //echo str_replace('"', '', $str);
                     echo '<span data-realtime="goals">'.str_replace('"', '', $str).'</span>';
                } else { echo '--' ; } ?>
            </div>
        
        <div class="form-group">
            <label class="strong">Please indicate areas you would like to strengthen, tone, rehabilitate & increase flexibility and/or mobility</label>
              
                
               
                @if(count($parq->footImprove)>0)
                    <h5 style="margin-bottom: 0px;"><b>Ankle & Feet Improve</b></h5>
                    @if(count($parq->footImprove)>0)
                        {{  $footImprove = array_diff($parq->footImprove, ['L_All', 'R_All']) }}
                    {!! str_replace('_',' ',implode("</br>",$footImprove)) !!}
                    @if($parq->footImproveNotes != '')
                    </br><div class="pre-w">Notes-<?php echo $parq->footImproveNotes; ?></div>
                    @endif
                    @endif
                    </br>
                @endif

                @if(count($parq->legImprove)>0)
                    </br><h5 style="margin-bottom: 0px;"><b>Leg Improve</b></h5>
                    @if(count($parq->legImprove)>0)
                        {{  $legImprove = array_diff($parq->legImprove, ['L_All', 'R_All']) }}
                    {!! str_replace('_',' ',implode("</br>",$legImprove)) !!}
                    @if($parq->legImproveNotes != '')
                    </br><div class="pre-w">Notes-<?php echo $parq->legImproveNotes; ?>
                </div>
                    @endif
                    @endif
                    </br>
                @endif
                 
                @if(count($parq->hipInjury)>0)
                    </br><h5 style="margin-bottom: 0px;"><b>Hip Improve</b></h5>
                    @if(count($parq->hipInjury)>0)
                        {{  $hipInjury = array_diff($parq->hipInjury, ['L_All', 'R_All']) }}
                    {!! str_replace('_',' ',implode("</br>",$hipInjury)) !!}
                    @if($parq->hipInjuryNotes != '')
                    </br><div class="pre-w">Notes-<?php echo $parq->hipInjuryNotes; ?></div>
                    @endif
                    @endif
                    </br>
                @endif

                

                @if(count($parq->coreImprove)>0)
                    </br><h5 style="margin-bottom: 0px;"><b>Core Improve</b></h5>
                    @if(count($parq->coreImprove)>0)
                        {{  $coreImprove = array_diff($parq->coreImprove, ['All']) }}
                    {!! implode("</br>", $coreImprove) !!}
                    @if($parq->coreImproveNotes != '')
                    </br><div class="pre-w">Notes-<?php echo $parq->coreImproveNotes; ?></div>
                    @endif
                    @endif
                    </br>
                @endif

                @if(count($parq->backImprove)>0)
                    </br><h5 style="margin-bottom: 0px;"><b>Back Improve</b></h5>
                    @if(count($parq->backImprove)>0)
                        {{  $backImprove = array_diff($parq->backImprove, ['All']) }}
                    {!! implode("</br>", $backImprove) !!}
                    @if($parq->backImproveNotes != '')
                    </br><div class="pre-w">Notes-<?php echo $parq->backImproveNotes; ?></div>
                    @endif
                    @endif
                    </br>
                @endif


                @if(count($parq->chestImprove)>0)
                    </br><h5 style="margin-bottom: 0px;"><b>Chest Improve</b></h5>
                    @if(count($parq->chestImprove)>0)
                        {{  $chestImprove = array_diff($parq->chestImprove, ['All']) }}
                    {!! implode("</br>", $chestImprove) !!}
                    @if($parq->chestImproveNotes != '')
                    </br><div class="pre-w">Notes-<?php echo $parq->chestImproveNotes; ?></div>
                    @endif
                    @endif
                    </br>
                @endif

                @if(count($parq->shouldersImprove)>0)
                    </br><h5 style="margin-bottom: 0px;"><b>Shoulder  Improve</b></h5>
                    @if(count($parq->shouldersImprove)>0)
                        {{  $shouldersImprove = array_diff($parq->shouldersImprove, ['L_All', 'R_All']) }}
                    {!! str_replace('_',' ',implode("</br>",$shouldersImprove)) !!}
                    @if($parq->shouldersImproveNotes != '')
                    </br><div class="pre-w">Notes-<?php echo $parq->shouldersImproveNotes; ?></div>
                    @endif
                    @endif
                    </br>
                 @endif

                 
                    @if(count($parq->armsImprove)>0)
                        </br> <h5 style="margin-bottom: 0px;"><b>Arms Improve</b></h5>
                        @if(count($parq->armsImprove)>0)
                            {{  $armsImprove = array_diff($parq->armsImprove, ['L_All', 'R_All']) }}
                        {!! str_replace('_',' ',implode("</br>",$armsImprove)) !!}
                        @if($parq->armsImproveNotes != '')
                        </br><div class="pre-w">Notes-<?php echo $parq->armsImproveNotes; ?></div>
                        @endif
                        @endif
                        </br>
                    @endif

                @if(count($parq->handImprove)>0)
                    </br><h5 style="margin-bottom: 0px;"><b>Hand Improve</b></h5>
                    @if(count($parq->handImprove)>0)
                        {{  $handImprove = array_diff($parq->handImprove, ['L_All', 'R_All']) }}
                    {!! str_replace('_',' ',implode("</br>",$handImprove)) !!}
                    @if($parq->handImproveNotes != '')
                    </br><div class="pre-w">Notes-<?php echo $parq->handImproveNotes; ?></div>
                    @endif
                    @endif
                    </br>
                @endif
                
                 @if(count($parq->calvesImprove)>0)
                    </br> <h5 style="margin-bottom: 0px;"><b>Calves Improve</b></h5>
                    @if(count($parq->calvesImprove)>0)
                        {{ $calvesImprove = array_diff($parq->calvesImprove, ['All']) }}
                    {!! implode("</br>", $calvesImprove) !!}
                    @if($parq->calvesImproveNotes != '')
                    </br><div class="pre-w">Notes-<?php echo $parq->calvesImproveNotes; ?></div>
                    @endif
                    @endif
                    </br>
                @endif

                   @if(count($parq->quadsImprove)>0)
                    </br><h5 style="margin-bottom: 0px;"><b>Quads Improve</b></h5>
                    @if(count($parq->quadsImprove)>0)
                        {{ $quadsImprove = array_diff($parq->quadsImprove, ['All']) }}
                    {!! implode("</br>", $quadsImprove) !!}
                    @if($parq->quadsImproveNotes != '')
                    </br><div class="pre-w">Notes-<?php echo $parq->quadsImproveNotes; ?></div>
                    @endif
                    @endif
                    </br>
                @endif

                @if(count($parq->neckImprove)>0)
                    </br><h5 style="margin-bottom: 0px;"><b>Neck Improve</b></h5>
                    @if(count($parq->neckImprove)>0)
                        {{  $neckImprove = array_diff($parq->neckImprove, ['All']) }}
                    {!! implode("</br>",$neckImprove) !!}
                    @if($parq->neckImproveNotes != '')
                    </br><div class="pre-w">Notes-<?php echo $parq->neckImproveNotes; ?></div>
                    @endif
                    @endif
                    </br>
                @endif

                @if(count($parq->headImprove)>0)
                  </br><h5 style="margin-bottom: 0px;"><b>Head Improve</b></h5>
                    @if(count($parq->headImprove)>0)
                    {{  $headImprove = array_diff($parq->headImprove, ['All']) }}
                    {!! implode("</br>",$headImprove) !!}
                    @if($parq->headImproveNotes != '')
                    </br><div class="pre-w">Notes-<?php echo $parq->headImproveNotes; ?></div>
                    @endif
                    @endif
                    </br>
                 @endif

            
            
        </div>
        
      
        
        <div class="form-group">
            <label class="strong" for="lifestyleImprove">What areas of your lifestyle are you willing to improve to achieve your goal?</label></br>
            <?php
            if(count($parq->lifestyleImprove)>0){
                //print_r(implode(',', $parq->lifestyleImprove));
                $str = implode(', ',$parq->lifestyleImprove);
                $str = str_replace('["', '', $str);
                $str = str_replace('"]', '', $str);
                echo str_replace('"', '', $str);
            } else { echo '--' ; } ?>
        </div>
    </fieldset>
</div>

<div class="col-md-6">
    <fieldset class="padding-15">
        <legend>Needs & Support</legend>
        <div class="form-group">
            <label class="strong" for="goalWantTobe">I want to be</label></br>
            <?php 
            if(count($parq->goalWantTobe)>0){
               // print_r(implode(',',$parq->goalWantTobe));
                $str = implode(',',$parq->goalWantTobe);
                $str = str_replace('["', '', $str);
                $str = str_replace('"]', '', $str);
                echo str_replace('"', '', $str);
            } else { echo '--' ; } ?>
        </div>
        
        <div class="form-group">
            <label class="strong" for="goalWantfeel">I want to feel</label></br>
            <?php
            if(count($parq->goalWantfeel)>0){ 
                // print_r(implode(',',$parq->goalWantfeel));
                 $str = implode(',',$parq->goalWantfeel);
                 $str = str_replace('["', '', $str);
                 $str = str_replace('"]', '', $str);
                 echo str_replace('"', '', $str);
            } else { echo '--' ; } ?>
        </div>
        
        <div class="form-group">
            <label class="strong" for="goalWantHave">I want to have</label></br>
            <?php
            if(count($parq->goalWantHave)>0){
                //print_r(implode(',',$parq->goalWantHave));
                $str = implode(',',$parq->goalWantHave);
                 $str = str_replace('["', '', $str);
                 $str = str_replace('"]', '', $str);
                 echo str_replace('"', '', $str);
            } else { echo '--' ; } ?>
        </div>
        <div class="form-group">
            <label class="strong" for="supportFamily">How supportive is your family?</label></br>
             <div class="pre-w">{{ $parq->supportFamily ? $parq->supportFamily : '--'}} </div>
        </div>
        
        <div class="form-group">
            <label class="strong" for="supportFriends">How supportive are your friends?</label></br>
           <div class="pre-w"> {{ $parq->supportFriends ? $parq->supportFriends : '--'}} </div>
</div>
        
        <div class="form-group">
            <label class="strong" for="supportWork">How supportive are your work colleagues?</label></br>
          <div class="pre-w"> {{ $parq->supportWork ? $parq->supportWork : '--'}} </div>
</div>
        
        <div class="form-group">
            <label class="strong">Which best describes your motivation levels</label></br>
            <?php
            if(count($parq->motivationImprove)>0) { 
              // print_r(implode(',',$parq->motivationImprove));
               $str = implode(',',$parq->motivationImprove);
                $str = str_replace('["', '', $str);
                $str = str_replace('"]', '', $str);
                echo str_replace('"', '', $str);
            } else { echo '--' ; } ?>
        </div>
        
       @if($parq->smartGoalSpecific)
          <div class="form-group">
            <label class="strong" for="smartGoalNotes">SMARTER Specific Goal notes</label></br>

            <div>
           <div class="pre-w"> {{ $parq->smartGoalSpecific ? ucfirst($parq->smartGoalSpecific)  : '--'}}</div>
           </div>
        </div>
        @endif
        @if($parq->smartGoalMeasurable)
           <div class="form-group">
            <label class="strong" for="smartGoalNotes">SMARTER Measurable Goal notes</label></br>

            <div>
            <div class="pre-w">{{ $parq->smartGoalMeasurable ? ucfirst($parq->smartGoalMeasurable) : '--'}}</div>
           </div>
        </div>
        @endif
        @if($parq->smartGoalAchievable)
           <div class="form-group">
            <label class="strong" for="smartGoalNotes">SMARTER Achievable Goal notes</label></br>

            <div>
            <div class="pre-w">{{ $parq->smartGoalAchievable ? ucfirst($parq->smartGoalAchievable) : '--'}}</div>
           </div>
        </div>
        @endif
        @if($parq->smartGoalRelevent)
             <div class="form-group">
            <label class="strong" for="smartGoalNotes">SMARTER Relevent Goal notes</label></br>

            <div>
            <div class="pre-w">{{ $parq->smartGoalRelevent ? ucfirst($parq->smartGoalRelevent) : '--'}}</div>
           </div>
        </div>
        @endif
        @if($parq->smartGoalTime)
           <div class="form-group">
            <label class="strong" for="smartGoalNotes">SMARTER Time Goal notes</label></br>

            <div>
           <div class="pre-w"> {{ $parq->smartGoalTime ? ucfirst($parq->smartGoalTime) : '--'}}</div>
           </div>
        </div>
        @endif
        @if($parq->smartGoalNotes)
         <div class="form-group">
            <label class="strong" for="smartGoalNotes">SMARTER Goal notes</label></br>

            <div>
            <div class="pre-w">{{ $parq->smartGoalNotes ? ucfirst($parq->smartGoalNotes) : '--'}}</div>
           </div>
        </div>
        @endif
          <div class="form-group">
            <label class="strong" for="achieveGoal">How important is it to achieve your goal?</label></br>
          <div class="pre-w">  {{ $parq->achieveGoal ? $parq->achieveGoal : '--'}} </div>
        </div>
        <div class="form-group">
                <label class="strong" for="goalNotes">Please provide any additional notes you think are relevant</label></br>

          <div class="pre-w"> {{ $parq->goalNotes ? $parq->goalNotes : '--'}} </div>
        </div>
    </fieldset>
</div>
