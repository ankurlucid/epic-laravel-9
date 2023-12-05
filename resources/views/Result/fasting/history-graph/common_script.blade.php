<script>
        
    // START FASTING TIME DATES AND TIME
    var mDate = new Date();
    mDate.setDate(mDate.getDate()-30);

    var endDate = new Date();
    endDate.setDate(endDate.getDate());

    $('#fasting_start_fast_date').bootstrapMaterialDatePicker({
        time:false,
        format : 'YYYY-MM-DD',
        lang : 'en',
        weekStart: 1,
        minDate:mDate,
        maxDate:endDate

    });
    $('#fasting_start_fast_time').bootstrapMaterialDatePicker({
         date: false,
        format: 'HH:mm'
    });

    var mDate = new Date();
    mDate.setDate(mDate.getDate()-30);

    $('#fasting_end_fast_date').bootstrapMaterialDatePicker({
        time:false,
        format : 'YYYY-MM-DD',
        lang : 'en',
        weekStart: 1,
        minDate:mDate,
        maxDate:endDate

    });
    $('#fasting_end_fast_time').bootstrapMaterialDatePicker({
         date: false,
        format: 'HH:mm'
    });

    // Cross update

    $(document).on("change","#fasting_end_fast_date",function(){

        // if($("#fasting_type").val() == 'Fasting') {

            // Date
            
            var fastingEndDate = $("#fasting_end_fast_date").val();
            $("#eating_start_fast_date").val(fastingEndDate);
        // }
    });

    $(document).on("change","#fasting_end_fast_time",function(){

        // if($("#fasting_type").val() == 'Fasting') {
            
            // Time
            
            var fastingEndTime = $("#fasting_end_fast_time").val();
            $("#eating_start_fast_time").val(fastingEndTime);
        // }
    });

    // END FASTING TIME DATES AND TIME

    // START EATING TIME DATES AND TIME
    var mDate = new Date();
    mDate.setDate(mDate.getDate()-30);

    $('#eating_end_fast_date').bootstrapMaterialDatePicker({
        time:false,
        format : 'YYYY-MM-DD',
        lang : 'en',
        weekStart: 1,
        minDate:mDate,
        maxDate:endDate

    });
    $('#eating_end_fast_time').bootstrapMaterialDatePicker({
         date: false,
        format: 'HH:mm'
    });
    // END EATING TIME DATES AND TIME

    $("#saveChunkData").unbind().click(function(e) {

        $(this).removeAttr('id');

        var fasting_start_date = $("input[name='fasting_start_date']").val();
        var fasting_start_time = $("input[name='fasting_start_time']").val();

        var fasting_end_date = $("input[name='fasting_end_date']").val();
        var fasting_end_time = $("input[name='fasting_end_time']").val();

        var eating_start_date = $("input[name='eating_start_date']").val();
        var eating_start_time = $("input[name='eating_start_time']").val();

        var eating_end_date = $("input[name='eating_end_date']").val();
        var eating_end_time = $("input[name='eating_end_time']").val();


        // Fasting 
        if(fasting_start_date == ''){
            toastr.error("Please fill fasting start date");
            $(this).attr('id','saveChunkData'); 
            return false;
         } 

        if(fasting_start_time == ''){
            toastr.error("Please fill fasting start time"); 
            $(this).attr('id','saveChunkData');
            return false;
         } 

        if(fasting_end_date == ''){
            toastr.error("Please fill fasting end date"); 
            $(this).attr('id','saveChunkData');
            return false;
         } 

        if(fasting_end_time == ''){
            toastr.error("Please fill fasting end time"); 
            $(this).attr('id','saveChunkData');
            return false;
        } 

        // Eating 
        if(eating_start_date == ''){
            toastr.error("Please fill eating start date"); 
            $(this).attr('id','saveChunkData');
            return false;
         } 

        if(eating_start_time == ''){
            toastr.error("Please fill eating start time"); 
            $(this).attr('id','saveChunkData');
            return false;
         } 

        if(eating_end_date == ''){
            toastr.error("Please fill eating end date"); 
            $(this).attr('id','saveChunkData');
            return false;
         } 

        if(eating_end_time == ''){
            toastr.error("Please fill eating end time"); 
            $(this).attr('id','saveChunkData');
            return false;
        } 

        $.ajax({
            url: public_url + 'save-chunk-fast-graph',
            type: 'POST',
            data: $("#chunkForm input").serialize(),
            success: function(data) {
                
                if (data.status == 422) {

                    $('.validation-message').html(data.message);
                    $('.addClass').attr('id','saveChunkData');
                    return false;

                }else if(data.status == 200){
                    $('#chunkPopup').modal('hide');
                    setTimeout(function() {

                       $(".refreshGraph").trigger('click');
                       
                    }, 1000);
                    
                }
            }
        });                 
    });

</script>