<?php
include_once "../conn.php";
session_start();
$current_user_email = $_SESSION['email'];
$current_user_category = $_SESSION['category'];
$fname_chatting_with = 0;

if(isset($_GET['p_id'])){
        $requested_patient = $_GET['p_id'];
}
$data_points_meals = array();
$sql = "SELECT recordDate, COUNT(mealTime) num_of_meals FROM patientsmeallog WHERE userID = '$requested_patient' GROUP BY recordDate";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while($rows = mysqli_fetch_array($result)){
    $point = array("label"=>$rows['recordDate'], "y"=>$rows["num_of_meals"]);
    array_push($data_points_meals, $point);
}

$sql2 = "SELECT firstName, lastName FROM regpatients WHERE id = '$requested_patient'";
$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
while($row = mysqli_fetch_array($result2)){
    $patient_meal_chart_title = $row['firstName'].' '.$row['lastName'].'\'s Eating Progress';
}

?>
<div class="meals_chart_container" id="meals_chart_container"></div>
<script src="js/canvasjs.min.js"></script>
<script type="text/JavaScript">
    var chart2 = new CanvasJS.Chart("meals_chart_container", {
        animationEnabled: true,
        title:{text: <?php echo json_encode($patient_meal_chart_title);?>},
        axisY: {
            title:"Number of Meals",
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
            itemclick: toggleDataSeries2
        },
        data:[{
            type:"line",
            name:"Number of meals",
            legendText:"Number of Meals",
            showInLegend:true,
            dataPoints:<?php echo json_encode($data_points_meals,JSON_NUMERIC_CHECK);?>
        }]
    });

    function toggleDataSeries2(e){
        if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible){
            e.dataSeries.visible = false;
        }
        else {
            e.dataSeries.visible = true;
        }
        chart2.render();
    }

    chart2.render();
</script>