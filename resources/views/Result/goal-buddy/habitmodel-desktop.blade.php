<style type="text/css">
    .p-2 td,.p-2 th{
     padding: 23px;
    }
  </style>
  <div id="habit-modal-desktop" class="modal fade " role="dialog">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"></h4>
                                          </div>
                                          <div class="modal-body">
                                          <div class="row">
                                          <div class="col-md-9">
                                            <div class="pull-left"><h2 class="habit-name"></h2></div>
  
                                           
                                          </div>
                                          <div class="col-md-3">
                                            <div class="pull-right">
                                                  {{-- <a class="btn btn-xs btn-default tooltips edit-habit" data-edithabit=""  data-placement="top" data-original-title="Edit" href="#">
                                                      <i class="fa fa-pencil " style="color:#ff4401;" ></i>
                                                  </a>
                                                  <a class="btn btn-xs btn-default tooltips delete-habit-list" data-entity="habit"  data-placement="top" data-original-title="delete" data-deletehabitid = "">
                                                      <i class="fa fa-times" style="color:#ff4401;"></i>
                                                  </a> --}}
                                              </div>
                                          
                                          </div>
                                          </div>
                                          <div class="row">
                                           <div  class="col-md-6">
                                           <div class="form-group">
                                                <label class="strong">Frequency:</label>
                                                <span class="frequency"></span> 
                                            </div>
                                            <div class="form-group">
                                              <label class="strong">Supported Milestones:</label><br />
                                              <span class="goal-with-milestone"></span></div>
                                           </div>
                                           <div  class="col-md-6">
                                             <div class="form-group"><label class="strong">Shared:</label>
                                              <span class="shared"></span> </div>
                                             <div class="form-group">
                                              <label class="strong">Why is this habit important to me?:</label><br />
                                              <span class="goal-with-habit"></span>
                                            </div>
                                           </div>
                                           </div>
                                           {{--task  --}}
                                            <div class="row task-list">
           
                                            </div>
                                            {{-- task end --}}                  
                                          <!--div style="color:green;">1 occurence has been completed on time. (Success Ratio: 100%)</div-->
                                          
                                      <div class="unchecked-days"></div>
  
                                    
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                      </div>
                                    </div> 
                                  </div>