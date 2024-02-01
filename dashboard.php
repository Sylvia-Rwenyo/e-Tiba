<?php
    @session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
        <link rel="icon" href="favicon.ico" />
        <link rel="stylesheet" href="style.css">
        <script src="js/cdnjs.cloudflare.com_ajax_libs_Chart.js_2.9.4_Chart.js"></script>
        <title>Your dashboard</title>
    </head>
    <body class="dash-body" id="dash-body">
        <!-- page header -->
        <div class="header">
            <!-- menu with call or chat notifications -->
            <?php
                include_once 'notif-menu.php';
            ?>
        </div>
        <div class="mainBody" style="height: 100vh">
            <?php
                if (!isset($_SESSION["loggedIN"])) {
                    echo '<script> 
            window.location.href = "index.php"</script>';
                } else {
                    // Show dashboard menu
                    include_once 'dash-menu.php';
                    $userID = $_SESSION['id'];
                    // Get the current date
                    $today = new DateTime(); // Create a new DateTime object for today's date
                    $firstDayOfWeek = clone $today;
                    $firstDayOfWeek->modify('monday this week');
                ?>
                    <section class="main-section" style="height: 90%">
                        <?php
                        if (isset($_GET['dr'])) {
                            if ($_GET['dr'] == 1) {
                                include_once 'single-patient-records.php';
                            }
                        }
            ?>

            <div class="progress-charts">
                <?php
                if (isset($_GET['w'])) {
                    $viewWeek = intval($_GET['w']);
                    $week = 'weeks';
                    if ($viewWeek == -1 || $viewWeek == +1) {
                        $week = 'week';
                    }
                    // Clone the current date object and modify it to a week before or a week after appropriately
                    $firstDayOfWeek = clone $today;
                    $firstDayOfWeek->modify('monday this week');
                    $weekOperation = $viewWeek . ' ' . $week;
                    $firstDayOfWeek->modify($weekOperation); // Go back or ahead by a week

                    if ($viewWeek == 0) {
                        $firstDayOfWeek = clone $today;
                        $firstDayOfWeek->modify('monday this week');
                    }
                } else {
                    // Default behavior: show the current week
                    $firstDayOfWeek = clone $today;
                    $firstDayOfWeek->modify('monday this week');
                }

                $firstDayOfWeekString = $firstDayOfWeek->format('Y-m-d'); // Convert the DateTime object to a string
                $lastDayOfWeek = clone $firstDayOfWeek; // Clone the first day of the week object
                $lastDayOfWeek->modify('+6 days'); // Get the last day of the week as 6 days after the first day
                $lastDayOfWeekString = $lastDayOfWeek->format('Y-m-d'); // Convert the DateTime object to a string

                $currentDay = clone $firstDayOfWeek;
                $currentDayString = $currentDay->format('Y-m-d');
                $sleepPercentage = 0;
                $mealsPercentage = 0;
                $exercisePercentage = 0;
                $totalSleep = 0;
                $totalMeals = 0;
                $totalExercise = 0;
            // Initialize empty arrays to store data for each day
                $dayData = array();
                $sleepData = array();
                $mealsData = array();
                $exerciseData = array();

                while ($currentDayString <= $lastDayOfWeekString) {
                    $dayName = $currentDay->format('l');
                    $dateString = $currentDay->format('m/d/Y');
                    $currentDay->modify('+1 day');
                    $currentDayString = $currentDay->format('Y-m-d');

                    // Initialize data variables for the current day
                    $sleepTime = 0;
                    $mealNumbers = 0;
                    $exerciseTime = 0;

                    $avgSleep = 0;
                    $avgMeals = 0;
                    $avgExercise = 0;
                    

                    // Store data for the current day in arrays
                    $dayData[] = $dateString;
                    $sleepData[] = $sleepTime;
                    $mealsData[] = $mealNumbers;
                    $exerciseData[] = $exerciseTime;
                }

                // Convert PHP arrays to JavaScript arrays
                $dayDataJSON = json_encode($dayData);
                $sleepDataJSON = json_encode($sleepData);
                $mealsDataJSON = json_encode($mealsData);
                $exerciseDataJSON = json_encode($exerciseData);
                

            // Calculate the date 7 days ago
            $firstDayOfWeekFormatted = $firstDayOfWeek -> format('Y-m-d');
            $sevenDaysAgo = clone $firstDayOfWeek;
            $sevenDaysAgo->modify('-7 days');
            $sevenDaysAgoFormatted = $sevenDaysAgo->format('Y-m-d');

            // SQL query to retrieve sleep data from the last 7 days
            $sql = "SELECT * FROM patientsleeplog WHERE userID = '$userID' AND DATE(recordDate) BETWEEN '$sevenDaysAgoFormatted' AND '$firstDayOfWeekFormatted'";
            $result = mysqli_query($conn, $sql);

                // Initialize total sleep time
                $totalSleep = 0;
                $daysInLog = 0;

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $sleepTime = $row['sleepTime'];
                        $totalSleep += $sleepTime;
                        $daysInLog += 1;
                    }

                    $avgSleep = $totalSleep / $daysInLog; // Calculate average sleep time
                    $sleepPercentage = $avgSleep/8 * 10;
                }

                
                    // Meals data
                    $stmt = "SELECT DISTINCT DATE(recordDate) as uniqueDate FROM patientsmeallog WHERE userID='$userID' AND DATE(recordDate) BETWEEN '$sevenDaysAgoFormatted' AND '$firstDayOfWeekFormatted' ";
                    $sql3 = mysqli_query($conn, $stmt);

                    // Initialize counters
                    $totalDaysLogged = mysqli_num_rows($sql3);
                    $totalMeals = 0;


                    while ($row = mysqli_fetch_array($sql3)) {
                        $date = $row['uniqueDate'];

                        // Count meals for each day
                        $stmtMealsPerDay = "SELECT COUNT(*) as mealsCount FROM patientsmeallog WHERE userID='$userID' AND DATE(recordDate) = '$date'";
                        $resultMealsPerDay = mysqli_query($conn, $stmtMealsPerDay);
                        $rowMealsPerDay = mysqli_fetch_assoc($resultMealsPerDay);

                        $mealsCount = $rowMealsPerDay['mealsCount'];

                        $totalMeals += $mealsCount;
                    }
                        $targetMeals = 3;
                        $avgMeals = 0; // Default value if $totalDaysLogged is zero

                        if ($totalDaysLogged > 0) {
                            $avgMeals = ($totalMeals / $targetMeals) / $totalDaysLogged;
                        }
                        
                        $mealsPercentage = 100 * $avgMeals;
                        
                    // Exercise data
                    $stmt = "SELECT * FROM patientsexerciselog WHERE userID='$userID' AND DATE(recordDate) BETWEEN '$sevenDaysAgoFormatted' AND '$firstDayOfWeekFormatted' ";
                    $sql4 = mysqli_query($conn, $stmt);

                    if (mysqli_num_rows($sql4) > 0) {
                        while ($row = mysqli_fetch_array($sql4)) {
                            $exerciseTime = $row['exerciseDuration'];
                            $totalExercise += $exerciseTime;
                        }

                        $targetExercise = 90;
                        $avgExercise = ($exerciseTime / $targetExercise)/mysqli_num_rows($sql4);
                        $exercisePercentage = (100 * $avgExercise);
                    }

                ?>
                <!-- show which week it is -->
                <span class="week-indicator" style="margin-left: 0;">
                    <i class="fa fa-arrow-left" onclick="showLastWeek()"></i>
                    <?php
                        echo date('j M', strtotime($firstDayOfWeekString)) . ' - ' . date('j M', strtotime($lastDayOfWeekString));
                    ?>
                    <i class="fa fa-arrow-right" onclick="showNextWeek()"></i>
                </span>
                

                <!-- data input areas -->
                <div class="input">
                    <!-- sleep data input area -->
                    <div class="input-div input-sleep">
                        <div class="data-bars">
                            <span>Average daily sleep</span>
                            <span class="single-data-bar"><span style="width:<?php echo round($sleepPercentage, 0)?>%;background-color: rgba(75, 192, 192, 0.6);">
                                <span class="data-txt"  ><?php echo round($avgSleep, 1);?> hours</span>
                            </span></span>
                        </div>
                    <div class="log-prompts" id="log-prompts1"> 
                        <!-- prompt to log sleep data -->
                        <div class="single-log-prompt sleepLog" id="rec-sleepPrompt">
                            <span class="target-display">sleep log</span>
                            <span class="prompt"><i class="fa-solid fa-circle-plus"></i></span>
                        </div>
                    </div>
                        <form id="sleep-form" action="controls/processing.php" method="POST">
                            <div>
                                <label>Start time</label>
                                <input type="time" name="start-time" />
                            </div>
                            <div>
                                <label>End time</label>
                                <input type="time" name="end-time" />
                            </div>
                            <button type="submit" name="record-sleep" class="btn btn-primary" style="margin-top:10%;">
                                <i class="fas fa-check-circle"></i>
                            </button>
                        </form>
                    </div>
                    <!-- end sleep data input area -->

                    <!-- meals data input area -->
                    <div class="input-div input-meals">
                    <div class="data-bars">
                            <span>Average daily meals</span>
                            <span class="single-data-bar"><span style="width:<?php echo $mealsPercentage ?>%; background-color: rgba(255, 99, 132, 0.6);">
                            <span class="data-txt"><?php echo $avgMeals*3 ;?> meal<?php if( $avgMeals*3 > 1){ echo 's';}?></span>
                            </span></span>
                        </div>
                        <div class="log-prompts" id="log-prompts2">
                        <!-- prompt to log meals data -->
                            <div class="single-log-prompt mealLog" id="rec-mealsPrompt">
                                <span class="target-display">meal log<span></span></span> 
                                <span class="prompt"><i class="fa-solid fa-circle-plus"></i></span>
                            </div>
                        </div>
                        <form id="meal-form" action="controls/processing.php" method="POST">
                            <div>
                                <label>Meal name:</label>
                                <input type="text" name="meal-name" />
                            </div>
                            <div>
                                <label>Meal time:</label>
                                <input type="time" name="meal-time" />
                            </div>
                            <button type="submit" name="record-meal" class="btn btn-primary" style="margin-top:10%;">
                                <i class="fas fa-check-circle"></i>
                            </button>
                        </form>
                    </div>
                    <!-- end meals data input area -->

                    <!-- exercise data input area -->
                        <div class="input-div input-exerciseRoutine" > 
                        <div class="data-bars">
                            <span>Average daily exercise</span>
                            <span class="single-data-bar"><span style="width:<?php echo $exercisePercentage ?>%;  background-color: rgba(54, 162, 235, 0.6);">
                                <span class="data-txt" ><?php echo $avgExercise*90;?> minutes</span>
                            </span></span>
                        </div>
                            <div class="log-prompts" id="log-prompts">
                            <!-- prompt to log exercise data -->
                            <div class="single-log-prompt exerciseLog" id="rec-exercisePrompt">
                                <span class="target-display">exercise log<span></span></span>
                                <span class="prompt"><i class="fa-solid fa-circle-plus"></i></span>
                            </div>
                        </div>   
                                <form id="exercise-form" action="controls/processing.php" method="POST" >
                                <div>
                                    <label>Exercise type:</label>
                                    <select multiple name="exerciseType[]" style="color: black;">
                                        <option>Aerobics</option>
                                        <option>Weight Training</option>
                                        <option>Body Weight Exercises</option>
                                        <option>Dancing</option>
                                        <option>Walking</option>
                                        <option>Swimming</option>
                                    </select>
                                </div>
                                <div>
                                    <label>Duration (in minutes)</label>
                                    <input type="number" name="exerciseDuration" />
                                </div>
                                <div>
                                    <label>Time</label>
                                    <input type="time" name="exerciseTime" />
                                </div>
                                <button type="submit" name="record-physicalActivity" class="btn btn-primary" style="margin-top:4%;">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </form>
                        </div>
                        <!-- end exercise data input area -->

                        <!-- medication data input area
                        <div class="input-div input-medication" id="input-medication">
                            <form id="meds-form" action="controls/processing.php" method="POST" >
                                <div>
                                    <label>Medicine name:</label>
                                    <input type="text" name="med-name" />
                                </div>
                                <div>
                                    <label>Intake time:</label>
                                    <input type="time" name="med-time" />
                                </div>
                                <button type="submit" name="record-medTime" class="btn btn-primary" style="margin-top:13.5%;">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </form>
                        </div>
                        end medication input area -->
                    </div>
                </section>
            </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/code.jquery.com_jquery-latest.js"></script>
    <!-- Include Chart.js library -->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script> -->

    <!-- Include Chart.js Datalabels plugin -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script> -->


    <script type="text/javascript">
         let sleepPrompt = document.getElementById("rec-sleepPrompt");
        let mealPrompt = document.getElementById("rec-mealsPrompt");
        let exercisePrompt = document.getElementById("rec-exercisePrompt");

        let inputSleep = document.getElementById('sleep-form');
        let inputMeals = document.getElementById('meal-form');
        let inputExercise = document.getElementById('exercise-form');

        let logPrompts = document.getElementById('log-prompts');


        sleepPrompt.onclick = () =>{
            inputSleep.style.display ='flex';
        }
        mealPrompt.onclick = () =>{
            inputMeals.style.display ='flex';
            }

        exercisePrompt.onclick = () =>{
            inputExercise.style.display ='flex';

            }

        // Get references to the canvas element and its context
        var ctx = document.getElementById('dayCharts').getContext('2d');
        // Create a function to format the date labels
        function formatDayLabels(dayLabels) {
        return dayLabels.map(function(dateLabel) {
            const dayOfMonth = new Date(dateLabel).toLocaleDateString('en-US', { day: 'numeric' });
            return dayOfMonth;
        });
        }

        // Define the data for the chart
        var data = {
        labels: formatDayLabels(<?php echo $dayDataJSON; ?>), // Format date labels
        datasets: [
            {
            label: 'Sleep Percentage',
            data: <?php echo $sleepDataJSON; ?>.map(function(sleep) {
                return (sleep / 8) * 100; // Calculate sleep percentage
            }),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            },
            {
            label: 'Meals Percentage',
            data: <?php echo $mealsDataJSON; ?>.map(function(meals) {
                return (meals / 3) * 100; // Calculate meals percentage
            }),
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            },
            {
            label: 'Exercise Percentage',
            data: <?php echo $exerciseDataJSON; ?>.map(function(exercise) {
                return (exercise / 60) * 100; // Calculate exercise percentage
            }),
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            }
        ]
        };

        // Create the chart
        var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            scales: {
            y: {
                beginAtZero: true, // Ensure the y-axis starts from 0
                max: 100, // Set the maximum value of the y-axis to 100
                min: 0
            },
            x:{
                beginAtZero: true, // Ensure the x-axis starts from 0
                min: 0
            }
            },
            tooltips: {
            mode: 'index',
            intersect: false,
            callbacks: {
                title: function (tooltipItems) {
                // Display the formatted date as the tooltip title
                return formatDayLabels([labels[tooltipItems[0].index]])[0];
                },
                label: function (tooltipItem, data) {
                var datasetLabel = data.datasets[tooltipItem.datasetIndex].label;
                var dataType = datasetLabel.split(' ')[0]; // Extract the data type (Sleep, Meals, Exercise)
                var actualValue = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

                if (dataType === 'Sleep') {
                    return dataType + ': ' + Math.round(actualValue * 8 / 100) + ' hours'; // Display sleep time in hours
                } else if (dataType === 'Exercise') {
                    return dataType + ': ' + Math.round(actualValue * 45 / 100) + ' minutes'; // Display exercise time in minutes
                } else {
                    return dataType + ': ' + Math.round(actualValue * 3 / 100); // Display meal numbers without percentage
                }
                }
            }
            }
        }
        });


        function print1patientRecord() {
            window.location.href = 'single-patient-records.php?print=1';
        }
        function showLastWeek(){
            window.location.href = 'dashboard.php?charts=1&w=' <?php  if(isset($_GET['w'])){ echo '+'. (int)$_GET['w'] - 1; }else { echo '+'. -1;} ?>;
        }
        function showNextWeek(){
            window.location.href = 'dashboard.php?charts=1&w=' <?php if(isset($_GET['w'])){ echo '+'.  (int)$_GET['w'] + 1; }else { echo '+'. +1;} ?> ;
        }
       
        //   function recordMedIntake(){
        //     document.getElementById('input-medication').style.display ='flex';
        //     document.getElementById('prompts').style.display ='none';
        //   }
        //   document.getElementById('rec-medPrompt').onclick = () =>{
        //     recordMedIntake();
        //   }
    </script>
</body>
</html>
<?php
    }
?>
