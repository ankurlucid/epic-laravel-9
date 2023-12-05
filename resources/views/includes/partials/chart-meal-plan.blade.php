
<h2>Nutritional Information</h2>
<div id="calories-per-serve1" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
<div class="daily">
    <div class="barWrapper">
        <div class="progressText">
            <span class="daily-text">Daily:</span> <span class="daily-cal">2000</span>cal
        </div>
        @php
            $nutrient_kcal = json_decode($client_nutrient_kcal, true);
            $total_cal = (( $nutrient_kcal['total_energ_kcal'])*100)/2000;
            $total_energ_kcal =  (int)($nutrient_kcal['total_energ_kcal']);
            $carbs = (int)($nutrient_kcal['cal_from_protein']);
            $protein = (int)($nutrient_kcal['cal_from_carbs']);
            $fat = (int)($nutrient_kcal['cal_from_fat']);

        @endphp
        <div class="progress @if($total_cal > 100) daily-red @endif">
            <div class="progress-bar" role="progressbar" style="@if($total_cal > 100) width: 98%; @else width: {{$total_cal}}%; @endif">
                <span class="popOver" data-toggle="tooltip" data-placement="bottom" >                                                   
                </span>
                <div class="tooltip fade bottom in" role="tooltip" style="top: 0px; left: 21.0243px; display: block;">
                    <div class="tooltip-arrow" style="left: 50%;">                                                   
                    </div>
                    <div class="tooltip-inner">{{ $total_cal }}%</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="nutrient-info">
    <div class="circles">
        <div class="circle protein">

            <div class="value">{{ round($nutrient_kcal['cal_from_protein'] , 2)??0 }}</div>
            <div class="cal">cal</div>
        </div>
        <div class="subcal">Protein</div>
    </div>
    <div class="circles">
        <div class="circle carbs">
            <div class="value"> {{ round($nutrient_kcal['cal_from_carbs'], 2)??0 }}</div>
            <div class="cal">cal</div>
        </div>
        <div class="subcal">Carbs</div>
    </div>
    <div class="circles">
        <div class="circle fat">
            <div class="value">{{ round($nutrient_kcal['cal_from_fat'], 2)??0 }}</div>
            <div class="cal">cal</div>
        </div>
        <div class="subcal">Fat</div>
    </div>
</div>

<script type="text/javascript">
      var nutrient_kcal = {{ isset($nutrient_kcal) ? true : false }}
    if(nutrient_kcal){
        var total_energ_kcal = {{ isset($total_energ_kcal) ? $total_energ_kcal : 0 }}; 
        var carbs = <?php echo ($carbs ? $carbs :0); ?>; 
        var protein = <?php echo ($protein ? $protein :0); ?>;
        var fat = <?php echo ($fat ? $fat :0); ?>; 
       
    } else{
        var total_energ_kcal =  0;
        var carbs = 0;
        var protein = 0;
        var fat = 0; 
    }
chart = new Highcharts.Chart({
       credits: { enabled: false },
       chart: {
        renderTo: 'calories-per-serve1',
        type: 'pie'
    },
    title: {
     text: '<strong>'+total_energ_kcal+'</strong><br>CALORIES',
     align: 'center',
     verticalAlign: 'middle',
     y: 20
 },
 plotOptions: {
    pie: {
        shadow: false
    },
    series: {
        enableMouseTracking: false
    }
},
series: [{
    name: 'Browsers',
    data: [
    {
        name: 'Protien',
        y: protein,
        color:'#6acc00',
        dataLabels: {
            enabled: false,
        }
    },{
        name: 'Carbs',
        y: carbs,
        color:'#ffbe61',
        dataLabels: {
            enabled: false,
        }
    },    
    {
        name: 'Fat',
        y: fat,
        color:'#f14647',
        dataLabels: {
            enabled: false,
        }
    },
    ],

    size: '100%',
    innerSize: '80%',
    showInLegend:false,
    dataLabels: {
        enabled: false
    }
}]
});
</script>

