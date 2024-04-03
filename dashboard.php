<?php
    @session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <link rel="icon" href="favicon.ico" />
        <link rel="stylesheet" href="style.css">    
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
            // Check if 'w' is set in the URL parameters
            if (isset($_GET['w'])) {
                $viewWeek = intval($_GET['w']);
                
                // Determine the week operation based on the value of 'w'
                if ($viewWeek < 0) {
                    $weekOperation = abs($viewWeek) == 1 ? 'last week' : abs($viewWeek) . ' weeks ago';
                } elseif ($viewWeek > 0) {
                    $weekOperation = $viewWeek == 1 ? 'next week' : $viewWeek . ' weeks later';
                } else {
                    $weekOperation = 'this week';
                }

                // Clone the current date object and modify it accordingly
                $firstDayOfWeek = clone $today;
                $firstDayOfWeek->modify("monday $weekOperation");

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
                    $dateString = $currentDay->format('d');
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
                    $dayData[$dateString] = array(
                        'date' => $dateString,
                        'sleepTime' => $sleepTime,
                        'mealNumbers' => $mealNumbers,
                        'exerciseTime' => $exerciseTime
                    );
                }

            // Calculate the date 7 days ago
            $firstDayOfWeek = clone $today;
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
                $sleepTime = 0;

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $sleepTime = $row['sleepTime'];
                        $totalSleep += $sleepTime;
                        $daysInLog += 1;
                        $recordDate = new DateTime($row['recordDate']);
                        $dateString = $recordDate->format('d');
                        // Update sleep data for the current day
                        $dayData[$dateString]['sleepTime'] = intval($sleepTime);
                    }

                    $avgSleep = $totalSleep / $daysInLog;
                    $sleepPercentage = $avgSleep / 8 * 10; // Calculate sleep percentage
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
                        $stmtMealsPerDay = "SELECT DATE(recordDate) as recordDate, COUNT(*) as mealsCount FROM patientsmeallog WHERE userID='$userID' AND DATE(recordDate) = '$date' GROUP BY DATE(recordDate)";
                        $resultMealsPerDay = mysqli_query($conn, $stmtMealsPerDay);
                        $rowMealsPerDay = mysqli_fetch_assoc($resultMealsPerDay);

                        $mealsCount = $rowMealsPerDay['mealsCount'];

                        $totalMeals += $mealsCount;
                        $recordDate = new DateTime($rowMealsPerDay['recordDate']);
                        $dateString = $recordDate->format('d');
                        // Update meals data for the current day
                        $dayData[$dateString]['mealNumbers'] = intval($totalMeals);
                    }
                        $targetMeals = 3;
                        $avgMeals = 0; // Default value if $totalDaysLogged is zero

                        if ($totalDaysLogged > 0) {
                            $avgMeals = $totalMeals / $targetMeals / $totalDaysLogged;
                        }

                        $mealsData[] = $totalMeals;
                        
                        $mealsPercentage = 100 * $avgMeals; // Calculate meals percentage
                        
                    // Exercise data
                    $stmt = "SELECT * FROM patientsexerciselog WHERE userID='$userID' AND DATE(recordDate) BETWEEN '$sevenDaysAgoFormatted' AND '$firstDayOfWeekFormatted' ";
                    $sql4 = mysqli_query($conn, $stmt);

                    $exerciseTime = 0;

                    if (mysqli_num_rows($sql4) > 0) {
                        while ($row = mysqli_fetch_array($sql4)) {
                            $exerciseTime = $row['exerciseDuration'];
                            $totalExercise += $exerciseTime;
                            $exerciseData[] = $exerciseTime;
                            $recordDate = new DateTime($row['recordDate']);
                            $dateString = $recordDate->format('d');
                            // Update exercise data for the current day
                            $dayData[$dateString]['exerciseTime'] = intval($exerciseTime);
                        }

                        $targetExercise = 90;
                        $avgExercise = $totalExercise / $targetExercise / mysqli_num_rows($sql4);
                        $exercisePercentage = 100 * $avgExercise; // Calculate exercise percentage
                    }

                    //convert data to JSON
                    $dayDataJSON = json_encode(array_values($dayData));
                ?>
                <!-- show which week it is -->
                <span class="week-indicator" style="margin-left: 2.5%;">
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
                            <span class="single-data-bar"><span style="width:<?php echo round($avgSleep/8 * 100, 0)?>%;background-color: rgba(75, 192, 192, 0.6);">
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
                    <div style="margin-top: 3em">
                        <h5 style="margin-bottom: 1em; text-align: center">Your Progress towards Lifestyle Targets</h5>
                        <canvas id="dayCharts"></canvas>
                    </div>
                </section>
            </div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/code.jquery.com_jquery-latest.js"></script>
<script src="js/cdnjs.cloudflare.com_ajax_libs_Chart.js_2.9.4_Chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script type="text/javascript">
    // Get references to the canvas element and its context
    var ctx = document.getElementById('dayCharts').getContext('2d');

    <?php
        $data = array_values($dayData); // Get the values of $dayData array
        $sleepDataJSON = json_encode(array_map(function($day) {
            return isset($day['sleepTime']) ? intval($day['sleepTime']) : null; // Convert to integer or null
        }, $data));

        $mealsDataJSON = json_encode(array_map(function($day) {
            return isset($day['mealNumbers']) ? intval($day['mealNumbers']) : null; // Convert to integer or null
        }, $data));

        $exerciseDataJSON = json_encode(array_map(function($day) {
            return isset($day['exerciseTime']) ? intval($day['exerciseTime']) : null; // Convert to integer or null
        }, $data));
    ?>



  // Define the data for the chart
  var data = {
    labels: <?php echo json_encode(array_keys($dayData)); ?>, // X-axis labels from PHP array
    datasets: [{
      label: 'Sleep',
      data: <?php echo $sleepDataJSON; ?>.map(function(sleep) {
        return (sleep / 8) * 100; // Calculate sleep percentage
      }),
      backgroundColor: 'rgba(75, 192, 192, 0.2)',
      borderColor: 'rgba(75, 192, 192, 1)',
      borderWidth: 1,
    }, {
      label: 'Meals',
      data: <?php echo $mealsDataJSON; ?>.map(function(meals) {
        return (meals / 3) * 100; // Calculate meals percentage
      }),
      backgroundColor: 'rgba(255, 99, 132, 0.2)',
      borderColor: 'rgba(255, 99, 132, 1)',
      borderWidth: 1,
    }, {
      label: 'Exercise',
      data: <?php echo $exerciseDataJSON; ?>.map(function(exercise) {
        return (exercise / 45) * 100; // Calculate exercise percentage
      }),
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1,
    }]
  };

  // Define the labels you want to display in the tooltips
  var labels = <?php echo json_encode(array_keys($dayData)); ?>;

  // Create the chart
var myChart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: {
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          callback: function(value, index, values) {
            if (value === 100) {
              return 'Target'; // Show value at 100
            } else {
              return ''; // Hide other values
            }
          }
        }
      }
    },
    tooltips: {
      mode: 'index',
      intersect: false,
      callbacks: {
        title: function (tooltipItems) {
          // Display the date as the tooltip title
          return labels[tooltipItems[0].index];
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
