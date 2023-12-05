@extends('Result.masters.app')
@section('required-styles')
{!! Html::style('result/css/custom.css?v='.time()) !!}
<style type="text/css">
    @media (max-width: 767px) {
        section#page-title {
            display: none;
        }

        #app>footer {
            display: none;
        }

        .modal,
        .modal-dialog {
            z-index: 99999999 !important;
        }
    }
</style>

@stop
@section('content')
<div class="fasting_mobile_top">
    <h1><span>EPIC </span> Nutrition</h1>
    <h2><span>Intermittent </span> Fasting</h2>
</div>
<div class="panel panel-white">
    <!-- Start mobile view -->
    <div class="fasting_mobile_details">
        <!-- Fasting History Start -->
        <div class="moodpage fasting_history">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <h2 class="mobile-page-heading"><strong>Mood</strong> <br>History! </h2>
                </div>
    
                <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                    <div class="fasting_back text-right" style="padding-top: 15px;">
                        <a href="{{ url($preUrl) }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>You recent mood history for the past 7 days.</label>
                    </div>
                </div>
            </div>
            <div class="row graph_top_details">
                <div class="col-md-6 col-xs-6"></div>
                <div class="col-md-6 col-xs-6 text-right">
                    <a href="#" class="right-left-arrow arrow-btn-click" data-date="{{$date1}}" data-btn="pre-btn" data-graph="fasting" id='pre-btn'>
                        < </a>
                            <span id='date1'>{{ date('d', strtotime($date1))}} {{ date('M', strtotime($date1))}} </span>
                            <span id='date2'>- {{ date('d', strtotime($date2))}} {{ date('M', strtotime($date2))}} </span>
                            <a href="#" class="right-left-arrow arrow-btn-click" data-date="{{$date2}}" data-btn="next-btn" data-graph="fasting" id='next-btn'>></a>                            
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mood_history_graph">
                        <div class="bottom_line1"><span>10</span></div>
                        <div class="bottom_line2"><span>8</span></div>
                        <div class="bottom_line3"><span>5</span></div>
                        <div class="bottom_line4"><span>3</span></div>
                        

                        <div class="flex">
                            <div class="graph_tab">
                                <div class="m_date">
                                    <div class="progres-bar" id='md1' style="height:1%;"><span id='m1'>0</span></div>
                                </div>
                                <div class="bottom_date" id='d1'> <span>15</span><br>Jan</div>
                            </div>
                            <div class="graph_tab">
                                <div class="m_date">
                                    <div class="progres-bar" id='md2' style="height:1%;"><span id='m2'>0</span></div>
                                </div>
                                <div class="bottom_date" id='d2'> <span>16</span><br>Jan</div>
                            </div>
                            <div class="graph_tab">
                                <div class="m_date">
                                    <div class="progres-bar" id='md3' style="height:1%;"><span id='m3'>0</span></div>
                                </div>
                                <div class="bottom_date" id='d3'> <span>17</span><br>Jan</div>
                            </div>
                            <div class="graph_tab">
                                <div class="m_date">
                                    <div class="progres-bar" id='md4' style="height:1%;"><span id='m4'>0</span></div>
                                </div>
                                <div class="bottom_date" id='d4'> <span>18</span><br>Jan</div>
                            </div>
                            <div class="graph_tab">
                                <div class="m_date">
                                    <div class="progres-bar" id='md5' style="height:1%;"><span id='m5'>0</span></div>
                                </div>
                                <div class="bottom_date" id='d5'> <span>19</span><br>Jan</div>
                            </div>
                            <div class="graph_tab">
                                <div class="m_date">
                                    <div class="progres-bar" id='md6' style="height:1%;"><span id='m6'>0</span></div>
                                </div>
                                <div class="bottom_date" id='d6'> <span>20</span><br>Jan</div>
                            </div>
                            <div class="graph_tab">
                                <div class="m_date">
                                    <div class="progres-bar" id='md7' style="height:1%;"><span id='m7'>0</span></div>
                                </div>
                                <div class="bottom_date" id='d7'> <span>21</span><br>Jan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Fasting History  End -->

    </div>
</div>
@stop
@section('required-script')
<script>
    var preWeek = 0;
    $(document).ready(function (){

        var gdata =  @json($gdata);
        console.log(gdata);

        var forDates = @json($forDates);
        console.log(forDates);
        console.log(typeof(forDates));

        for(var i=0;i<7;i++){
            if(forDates[i] != null) document.getElementById('d'+(i+1).toString()).innerHTML='<span>'+forDates[i].split(" ")[0]+'</span><br>'+forDates[i].split(" ")[1];
            if(gdata[i]!=null) document.getElementById('m'+(i+1).toString()).innerHTML = gdata[i];
            if(gdata[i]!=null) document.getElementById('md'+(i+1).toString()).style.height = (parseInt(gdata[i])*10).toString()+'%';
        }

        
        
       

        
        
    })
    $(document).on('click', '#pre-btn', function() {
        console.log("pre-btn");
        preWeek+=1;
        console.log('preWeek: '+preWeek);
        $.ajax({
            url: public_url + 'get-mood-data-prev',
            method: "get",
            data: {
                'preweek':preWeek
            },
            success: function(data) {
                
                console.log(data.gdata);
                console.log(data.forDates);

                for(var i=0;i<7;i++){
                    if(data.forDates[i] != null) document.getElementById('d'+(i+1).toString()).innerHTML='<span>'+data.forDates[i].split(" ")[0]+'</span><br>'+data.forDates[i].split(" ")[1];
                    if(data.gdata[i]!=null && data.gdata[i]!=0) document.getElementById('m'+(i+1).toString()).innerHTML = data.gdata[i];
                    else document.getElementById('m'+(i+1).toString()).innerHTML = 'N/A';
                    if(data.gdata[i]!=null && data.gdata[i]!=0) document.getElementById('md'+(i+1).toString()).style.height = (parseInt(data.gdata[i])*10).toString()+'%';
                    else document.getElementById('md'+(i+1).toString()).style.height = '1%';
                }

                
                document.getElementById('date1').innerHTML = data.date1;
                document.getElementById('date2').innerHTML = '- '+data.date2;
                
            }
        });
    });
    $(document).on('click', '#next-btn', function() {

        console.log("next-btn");
        preWeek-=1;
        console.log('preWeek: '+preWeek);
        $.ajax({
            url: public_url + 'get-mood-data-prev',
            method: "get",
            data: {
                'preweek':preWeek
            },
            success: function(data) {
                
                console.log(data.gdata);
                console.log(data.forDates);
                for(var i=0;i<7;i++){
                    if(data.forDates[i] != null) document.getElementById('d'+(i+1).toString()).innerHTML='<span>'+data.forDates[i].split(" ")[0]+'</span><br>'+data.forDates[i].split(" ")[1];
                    if(data.gdata[i]!=null && data.gdata[i]!=0) document.getElementById('m'+(i+1).toString()).innerHTML = data.gdata[i];
                    else document.getElementById('m'+(i+1).toString()).innerHTML = 'N/A';
                    if(data.gdata[i]!=null && data.gdata[i]!=0) document.getElementById('md'+(i+1).toString()).style.height = (parseInt(data.gdata[i])*10).toString()+'%';
                    else document.getElementById('md'+(i+1).toString()).style.height = '1%';
                }

                console.log("data.date1"+data.date1);
                document.getElementById('date1').innerHTML = data.date1;
                document.getElementById('date2').innerHTML = '- '+data.date2;
                
            }
        });
    });
</script>
@stop