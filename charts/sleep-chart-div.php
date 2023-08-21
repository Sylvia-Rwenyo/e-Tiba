<?php
include_once "../conn.php";
session_start();
$current_user_email = $_SESSION['email'];
$current_user_category = $_SESSION['category'];
$fname_chatting_with = 0;

if(isset($_GET['p_id'])){
        $requested_patient = $_GET['p_id'];
}
$data_points_sleep = array();
$sql = "SELECT recordDate, sleepTime FROM patientsleeplog WHERE userID = '$requested_patient'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while($rows = mysqli_fetch_array($result)){
    $point = array("label"=>$rows['recordDate'], "y"=>$rows["sleepTime"]);
    array_push($data_points_sleep, $point);
}

$sql2 = "SELECT firstName, lastName FROM regpatients WHERE id = '$requested_patient'";
$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
while($row = mysqli_fetch_array($result2)){
    $patient_sleep_chart_title = $row['firstName'].' '.$row['lastName'].'\'s Sleep Progress';
}

?>
<div class="sleep_chart_container" id="sleep_chart_container"></div>
<script src="js/canvasjs.min.js"></script>
<script type="text/JavaScript">
    var chart1 = new CanvasJS.Chart("sleep_chart_container", {
        animationEnabled: true,
        title:{text: <?php echo json_encode($patient_sleep_chart_title);?>},
        axisY: {
            title:"Hours Slept",
            titleFontColor:"#4F81BC",
            lineColor: "#4F81BC",
            labelFontColor: "#4F81BC",
            tickColor:"#4F81BC"
        },
        axisX: {
            title:"Date n Time",
            titleFontColor:"red",
            lineColor: "red",
            labelFontColor: "red",
            tickColor:"red"
        },
        toolTip:{shared: true},
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
        },
        data:[{
            type:"line",
            name:"Hours Slept",
            legendText:"Hours Slept",
            showInLegend:true,
            dataPoints:<?php echo json_encode($data_points_sleep,JSON_NUMERIC_CHECK);?>
        }]
    });

    function toggleDataSeries(e){
        if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible){
            e.dataSeries.visible = false;
        }
        else {
            e.dataSeries.visible = true;
        }
        chart1.render();
    }

    chart1.render();
</script>