<style type="text/css">
    .validation-message {
        text-align: left;
        color: red;
        font-weight: 600;
        margin-left: 20px;
        padding: 20px;
    }
</style>
 <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h4 class="modal-title">Edit <span class="theme_color ftype"> EATING TIME </span></h4>
</div>
<div class="modal-body">
    <div class="row">
        <form action="{{route('save-chunk-fast-graph')}}" method="post" id="chunkForm">
            <input type="hidden" name="fasting_id" value="{{$fastingData->id}}">
            <input type="hidden" name="fasting_type" id="fasting_type" value="{{$type}}">
           
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="form-group">
                    <label>Fasting Start Date</label>
                    <input type="text" name="fasting_start_date" value="{{ date('Y-m-d',strtotime($fastingData->start_fast))}}" id="fasting_start_fast_date" class="date form-control" placeholder="Date">
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="form-group">
                    <label>Start Time</label>
                    <input type="text" name="fasting_start_time" value="{{ date('H:i',strtotime($fastingData->start_fast))}}" id="fasting_start_fast_time" class="date form-control" placeholder="Time">
                </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="form-group">
                    <label>Fasting End Date</label>
                    <input type="text" name="fasting_end_date" value="{{ date('Y-m-d',strtotime($fastingData->end_fast))}}" id="fasting_end_fast_date" class="date form-control" placeholder="Date">
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="form-group">
                    <label>End Time</label>
                    <input type="text" name="fasting_end_time" value="{{ date('H:i',strtotime($fastingData->end_fast))}}" id="fasting_end_fast_time" class="date form-control" placeholder="Time">
                </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="form-group">
                    <label>Eating Start Date</label>
                    <input readonly type="text" name="eating_start_date" value="{{ date('Y-m-d',strtotime($fastingData->start_eat))}}" id="eating_start_fast_date" class="date form-control" placeholder="Date">
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="form-group">
                    <label>Start Time</label>
                    <input readonly type="text" name="eating_start_time" value="{{ date('H:i',strtotime($fastingData->start_eat))}}" id="eating_start_fast_time" class="date form-control" placeholder="Time">
                </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="form-group">
                    <label>Eating End Date</label>
                    <input type="text" name="eating_end_date" value="{{ date('Y-m-d',strtotime($fastingData->end_eat))}}" id="eating_end_fast_date" class="date form-control" placeholder="Date">
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
                <div class="form-group">
                    <label>End Time</label>
                    <input type="text" name="eating_end_time" value="{{ date('H:i',strtotime($fastingData->end_eat))}}" id="eating_end_fast_time" class="date form-control" placeholder="Time">
                </div>
            </div>

        </form>    

        <div class="validation-message">
                        
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <a class="addClass btn btn-primary" id='saveChunkData'>Update</a>
        </div>
    </div>
</div>
@include('Result.fasting.history-graph.common_script')