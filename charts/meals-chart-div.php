<?php
$current_user_email = $_SESSION['email'];
$current_user_category = $_SESSION['category'];
$fname_chatting_with = 0;

if (isset($_GET['p_id'])) {
    $requested_patient = $_GET['p_id'];
}else{
    $requested_patient = $_SESSION['id'];
}
$data_points_meals = array();
$sql = "SELECT recordDate, COUNT(mealTime) num_of_meals FROM patientsmeallog WHERE userID = '$requested_patient' GROUP BY recordDate";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while ($rows = mysqli_fetch_array($result)) {
    $point = array("label" =>substr($rows['recordDate'], 8, 2), "y" => $rows["num_of_meals"]);
    array_push($data_points_meals, $point);
}

$sql2 = "SELECT firstName, lastName FROM regpatients WHERE id = '$requested_patient'";
$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($result2)) {
    $patient_meal_chart_title = $row['firstName'] . ' ' . $row['lastName'] . '\'s Eating Progress';
}
?>

<canvas id="mealsChart" class="canvas-chart" ></canvas>
<!-- <script src="../js/cdnjs.cloudflare.com_ajax_libs_Chart.js_2.9.4_Chart.js"></script> -->
<script type="text/JavaScript">
    var data_points_meals = <?php echo json_encode($data_points_meals); ?>;

    var mealsChart = new Chart("mealsChart", {
        type: "bar",
        data: {
            labels: data_points_meals.map(point => point.label),
            datasets: [{
                label: "Number of Meals",
                data: data_points_meals.map(point => point.y),
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
                    max: 10,         // Maximum value on the y-axis
                    stepSize: 1,                    title: {
                        display: true,
                        text: 'Number of Meals'
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
                    text: "<?php echo $patient_meal_chart_title; ?>",
                    fontSize: 16
                }
            }
        }
    });
</script>
