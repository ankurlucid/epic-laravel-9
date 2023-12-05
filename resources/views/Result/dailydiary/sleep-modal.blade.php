<!--add popup for personal-measurement-->
<style type="text/css">
    .edit_current .data input {
        font-size: 50px;
    }
</style>
 <div id="edit-measurement" class="modal fade mobile_popup_fixed" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content animate-bottom static_edit_details">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">WHAT TIME DID YOU GO <span class="sleepTitle">TO BED</span>?</h4>
            </div>
            <div class="modal-body current_tab">
                <div class="row">
                    <div class="col-md-12">
                        <div class="data"><strong class="sleepValue">10.15</strong>
                            <span class="sleepLabel">PM</span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <span class="edit_date"><i class="fa fa-calendar"></i> <span class="currentDate"> 01 Jan
                                2022</span></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <a data-toggle="modal" data-toggle="modal" data-target="#edit_current-sleep" href="#"><i
                                class="fa fa-pencil"></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end add popup for personal-measurement-->

<!-- edit popup for personal-measurement-->
<div id="edit_current-sleep" class="modal fade edit_current mobile_popup_fixed" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content animate-bottom">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                 <h4 class="modal-title">WHAT TIME DID YOU GO <span class="sleepTitle">TO BED</span>?</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="data">
                            <input type="text" class="go_to_sleep event-date-timepicker" value="10.15 PM" name="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <span class="edit_date"><i class="fa fa-calendar"></i> <span class="currentDate"> 01 Jan
                                2022</span></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <a class="editSaveSleepBtn" data-name=""><i class="fa fa-check"></i> Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end edit popup for personal-measurement-->


