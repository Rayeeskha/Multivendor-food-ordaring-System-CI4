<div style="display: none;">
    <audio controls id="audioBox">
        <source src="<?= base_url('public/ordersound/food.mp3') ?>" type="audio/mpeg" />
    </audio>
</div>
<script type="text/javascript">
    var audioBox = document.getElementById("audioBox"); 
    setInterval(function(){
        order_ringtone();
    },3000)
    function order_ringtone(){
        $.ajax({
            type:'ajax',
            method:'GET',
            url:'<?= base_url('Restaurent/order_ringtone_open/'); ?>',
            success:function(result){
                var data = JSON.parse(result);
                if (data.sound=='yes') {
                    // alert(data.sound);
                    audioBox.play();
                }else{
                    audioBox.pause();
                }
               
            },
            error:function(){
                // alert('Error! Technical Issue Contact with Administrator');
            }
        });
    }

//Order Dashboard Script Start 






	//Dashboard Chart Section Script Start 
  var chartdata1 = new CanvasJS.Chart("Restaurent_order_chart",{
    animationEnabled: true,
    exportEnabled: true,
    theme: "light2", 
    title :{
        text: "Last 30days  Orders",
    },
    data: [{
    // type: "column", //change type to bar, line, area, pie, etc
        type: "line",
        //indexLabel: "{y}", //Shows y value on all Data Points
        indexLabelFontColor: "#5A5757",
        indexLabelFontSize: 16,
        indexLabelPlacement: "outside",
      dataPoints: [
            { label : 'Today',     y: <?= $chart_data['ch_today_order']; ?> },
            { label : 'Yesterday', y: <?= $chart_data['ch_yesterday_order']; ?> },
            { label : '3rd Days',  y: <?= $chart_data['ch_last_3_days_order']; ?> },
            { label : '4rd Days',  y: <?= $chart_data['ch_last_4_days_order']; ?> },
            { label : '5rd Days',  y: <?= $chart_data['ch_last_5_days_order']; ?> },
            { label : '6rd Days',  y: <?= $chart_data['ch_last_6_days_order']; ?> },
            { label : '7rd Days',  y: <?= $chart_data['ch_last_7_days_order']; ?> },
            { label : '8rd Days',  y: <?= $chart_data['ch_last_8_days_order']; ?> },
            { label : '10rd Days',  y: <?= $chart_data['ch_last_10_days_order']; ?> },
            { label : '11rd Days',  y: <?= $chart_data['ch_last_11_days_order']; ?> },
            { label : '12rd Days',  y: <?= $chart_data['ch_last_12_days_order']; ?> },
            { label : '13rd Days',  y: <?= $chart_data['ch_last_13_days_order']; ?> },
            { label : '14rd Days',  y: <?= $chart_data['ch_last_14_days_order']; ?> },
            { label : '15rd Days',  y: <?= $chart_data['ch_last_15_days_order']; ?> },
            { label : '16rd Days',  y: <?= $chart_data['ch_last_16_days_order']; ?> },
            { label : '17rd Days',  y: <?= $chart_data['ch_last_17_days_order']; ?> },
            { label : '18rd Days',  y: <?= $chart_data['ch_last_18_days_order']; ?> },
            { label : '19rd Days',  y: <?= $chart_data['ch_last_19_days_order']; ?> },
            { label : '20rd Days',  y: <?= $chart_data['ch_last_20_days_order']; ?> },
            { label : '21rd Days',  y: <?= $chart_data['ch_last_21_days_order']; ?> },
            { label : '22rd Days',  y: <?= $chart_data['ch_last_22_days_order']; ?> },
            { label : '23rd Days',  y: <?= $chart_data['ch_last_23_days_order']; ?> },
            { label : '24rd Days',  y: <?= $chart_data['ch_last_24_days_order']; ?> },
            { label : '25rd Days',  y: <?= $chart_data['ch_last_25_days_order']; ?> },
            { label : '26rd Days',  y: <?= $chart_data['ch_last_26_days_order']; ?> },
            { label : '27rd Days',  y: <?= $chart_data['ch_last_27_days_order']; ?> },
            { label : '28rd Days',  y: <?= $chart_data['ch_last_28_days_order']; ?> },
            { label : '29rd Days',  y: <?= $chart_data['ch_last_29_days_order']; ?> },
            { label : '30rd Days',  y: <?= $chart_data['ch_last_30_days_order']; ?> },
            
        ]   
    }]
});

chartdata1.render();
//Dashboard Chart Section Script End
</script>