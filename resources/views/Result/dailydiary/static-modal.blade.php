<div id="staticEdit" class="modal fade mobile_popup_fixed" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content animate-bottom static_edit_details">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><span class="staticName">BFP</span> Body Fat Percentage</h4>
            </div>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#Current" data-toggle="tab">Current</a>
                </li>
                |
                <li>
                    <a href="#Goal" data-toggle="tab">Goal</a>
                </li>
            </ul>
            <div class="tab-content clearfix">
                {{-- current --}}
                <div class="tab-pane active" id="Current">
                    <div class="modal-body current_tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="data"><strong class="staticValue">65</strong><strong class="bp-hg-value" hidden>/65</strong><span class="staticLabel">%</span></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <span class="edit_date"><i class="fa fa-calendar"></i> <span class="currentDate"> 01 Jan 2022</span></span>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <a data-toggle="modal" data-target="#edit_current" href="#"><i class="fa fa-pencil"></i> Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end current --}}
                {{-- goal --}}
                <div class="tab-pane" id="Goal">
                    <div class="modal-body goal_tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="data"><strong class="staticValue">65</strong><strong class="bp-hg-value" hidden>65</strong><span class="staticLabel">%</span></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p>This is my desired <strong class="staticName">BPF</strong><br>that I am aiming to achieve by<br><span class="goalDate">01 Jan 2022</span></p>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <a data-toggle="modal" data-target="#add_goal" href="#"><i class="fa fa-pencil"></i> Add Goal</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end goal --}}
            </div>
        </div>
    </div> 
</div>
<div id="edit_current" class="modal fade edit_current mobile_popup_fixed" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content animate-bottom">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><span class="staticName">BFP</span> Body Fat Percentage <span>Edit</span> Goal</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="data">
                            <input type="text" class="newStaticEditVal" value="0" name="">
                            <span class="blood_pressure hidden"><span>/</span> <input type="text" class="newStaticEditValForHb" value="0" name=""></span>
                            <!-- <span class="staticLabel">%</span> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <span class="edit_date"><i class="fa fa-calendar"></i> <span class="currentDate"> 01 Jan 2022</span></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <a class="savePersonalStats" data-name=""><i class="fa fa-check"></i> Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="add_goal" class="modal fade add_goal mobile_popup_fixed" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content animate-bottom">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><span class="staticName">BFP</span> Body Fat Percentage <span>Edit</span> Goal</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="data">
                            <input type="text" class="edit-value goalStaticEditVal" value="0" name="">
                            <span class="blood_pressure hidden"><span>/</span> <input type="text" class="newStaticEditValForHb goal-bp-hg" value="0" name=""></span>
                            <!-- <span class="staticLabel">%</span> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input type="date" class="current-date-calendar form-control"  value="2018-07-22">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <a class="saveGoalPersonalStats" data-name=""><i class="fa fa-check"></i> Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--edit modal popup-->
{{-- <div id="Edit-popupp" class="modal fade mobile_popup_fixed edit_current" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content animate-bottom static_edit_details">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><span class="Edit-popupp-name">BFP</span> Body Fat Percentage</h4>
            </div>
           <div class="modal-body">
                <div class="row" style="box-shadow: none;">
                    <div class="col-md-12">
                        <div class="data">
                            <input type="text" class="staticvalue" value="0" name="">
                          
                        </div>
                    </div>
                </div>
                <div class="row" style="box-shadow: none;">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                     
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <a class="" data-name="pulsed_kg"><i class="fa fa-check"></i> Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div> --}}

