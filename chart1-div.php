<?php
$sql = "SELECT attending_doctor_name, times_a_day FROM dosage WHERE patient_id LIKE '$requested_patient'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$rows = mysqli_fetch_array($result);
?>
<div class="chart_container" id="chart_container"></div>
<script src="js/canvasjs.min.js"></script>
<script type="text/JavaScript">
    var chart = new CanvasJS.Chart("chart_container", {
        animationEnabled: true,
        title:{text: "Progress Chart 1"},
        axisY: {
            title:"title 1",
            titleFontColor:"#4F81BC",
            lineColor: "#4F81BC",
            labelFontColor: "#4F81BC",
            tickColor:"#4F81BC"
        },
        toolTip:{shared: true},
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeriesFunction
        },
        data:[{
            type:"column",
            name:"title 1",
            legendText:"title 1",
            showInLegend:true,
            dataPoints:<?php echo json_encode($rows,JSON_NUMERIC_CHECK);?>
        }]
    });
    chart.render();

    function toggleDataSeriesFunction(e){
        if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible){
            e.dataSeries.visible = false;
        }
        else {
            e.dataSeries.visible = true;
        }
        chart.render();
    }
</script>