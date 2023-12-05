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
                <h4 class="modal-title"><span class="measurementTitle">2 Slices  </span> wholewheat toast</h4>
            </div>
            <div class="modal-body current_tab">
                <div class="row">
                    <div class="col-md-12">
                        <div class="data"><strong class="measurementValue">toast</strong><span
                                class="measurementLabel"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <span class="edit_date"><i class="fa fa-calendar"></i> <span class="currentDate"> 01 Jan
                                2022</span></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <a data-toggle="modal" data-toggle="modal" data-target="#edit_current-measurement" href="#"><i
                                class="fa fa-pencil"></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end add popup for personal-measurement-->

<!-- edit popup for personal-measurement-->
<div id="edit_current-measurement" class="modal fade edit_current mobile_popup_fixed" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content animate-bottom">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                  <h4 class="modal-title"><span class="measurementTitle">2 Slices  </span> wholewheat toast</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="data">
                            <input type="text" class="" value="toast" name="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <span class="edit_date"><i class="fa fa-calendar"></i> <span class="currentDate"> 01 Jan
                                2022</span></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <a class="editSaveMeasurementBtn" data-name=""><i class="fa fa-check"></i> Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end edit popup for personal-measurement-->


