<?php
$current_user_email = $_SESSION['email'];
$current_user_category = $_SESSION['category'];
$fname_chatting_with = 0;

if (isset($_GET['p_id'])) {
    $requested_patient = $_GET['p_id'];
}else{
    $requested_patient = $_SESSION['id'];
}
$data_points_exercise = array();
$sql = "SELECT * FROM patientsexerciselog WHERE userID = '$requested_patient'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while ($rows = mysqli_fetch_array($result)) {
    $point = array("label" => $rows['recordDate'], "y" => $rows["exerciseDuration"]);
    array_push($data_points_exercise, $point);
}

$sql2 = "SELECT firstName, lastName FROM regpatients WHERE id = '$requested_patient'";
$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($result2)) {
    $patient_exercise_chart_title = $row['firstName'] . ' ' . $row['lastName'] . '\'s Exercise Progress';
}
?>

<canvas id="exerciseChart" style="width:200px;" class="canvas-chart"></canvas>
<!-- <script src="../js/cdnjs.cloudflare.com_ajax_libs_Chart.js_2.9.4_Chart.js"></script> -->
<script type="text/JavaScript">
    var data_points_exercise = <?php echo json_encode($data_points_exercise); ?>;

    var exercise_chart = new Chart("exerciseChart", {
        type: "bar",
        data: {
            labels: data_points_exercise.map(point => point.label),
            datasets: [{
                label: "Exercise Time",
                data: data_points_exercise.map(point => point.y),
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Customize the chart color
                borderColor: 'rgba(75, 192, 192, 1)', // Customize the border color
                borderWidth: 1 // Customize the border width
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true, // Start the scale from zero
                    min: 0,           // Minimum value on the y-axis
                    max: 300,         // Maximum value on the y-axis
                    stepSize: 10,     // Interval between ticks
                    title: {
                        display: true,
                        text: 'Exercise Time'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Record Date'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: "<?php echo $patient_exercise_chart_title; ?>",
                    fontSize: 16
                }
            }
        }
    });
</script>
