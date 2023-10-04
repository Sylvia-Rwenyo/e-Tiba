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
    <!-- Include Chart.js library -->
    <!-- <script src="js/cdn.jsdelivr.net_npm_chart.js"></script> -->
<script src="js/cdnjs.cloudflare.com_ajax_libs_Chart.js_2.9.4_Chart.js"></script>

    <title>Your dashboard</title>
</head>
<body class="dash-body" id="dash-body">
  <div class="header">
    <?php
      include_once 'notif-menu.php';
    ?>
  </div>
  <div class="mainBody" style="height: 100vh">
<?php
if (!isset($_SESSION["loggedIN"])) {
    header('location:index.php');
} else {
    // Show dashboard menu
    include_once 'dash-menu.php';
    $userID = $_SESSION['id'];
    ?>
    <section class="main-section" style="height: 90%">
        <!-- 
            <div class="dash-intro">
            <div class="welcome-msg">
                <h3><?php
                // php echo $_SESSION["username"]
                ?>, thank you for choosing CERA</h3>
                <p>Your healthcare care companion.</p>
            </div>
        </div> -->
        <?php
        if (isset($_GET['dr'])) {
            if ($_GET['dr'] == 1) {
                include_once 'single-patient-records.php';
            }
        }
        if (isset($_GET['m'])) {
            if ($_GET['m'] == 1) {
                // include_once 'single-patient-records.php';
            }
        }
            ?>

<div class="progress-charts">
    <?php
    $today = new DateTime(); // Create a new DateTime object for today's date
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

    // Fetch and calculate data for each day here

    // Sleep data
    $sql2 = "SELECT * FROM patientsleeplog WHERE userID = '$userID' && DATE(recordDate)='$currentDayString'";
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_array($result2)) {
            $sleepTime = $row['sleepTime'];
            $totalSleep += $sleepTime;
        }

        $targetSleep = 12;
        $sleepPercentage = 100 * $sleepTime / $targetSleep;
    }

    // Meals data
    $stmt = "SELECT * FROM patientsmeallog WHERE userID='$userID' AND recordDate='$currentDayString' ";
    $sql3 = mysqli_query($conn, $stmt);

    if (mysqli_num_rows($sql3) > 0) {
        while ($row = mysqli_fetch_array($sql3)) {
            $mealNumbers += 1;
            $totalMeals += $mealNumbers;
        }

        $targetMeals = 3;
        $mealsPercentage = 100 * $mealNumbers / $targetMeals;
    }

    // Exercise data
    $stmt = "SELECT * FROM patientsexerciselog WHERE userID='$userID' AND DATE(recordDate)='$currentDayString' ";
    $sql3 = mysqli_query($conn, $stmt);

    if (mysqli_num_rows($sql3) > 0) {
        while ($row = mysqli_fetch_array($sql3)) {
            $exerciseTime = $row['exerciseDuration'];
            $totalExercise += $exerciseTime;
        }

        $targetExercise = 100;
        $exercisePercentage = 100 * $exerciseTime / $targetExercise;
    }

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
?>
    <!-- week indicator -->
    <span class="week-indicator" style="margin-left: 0;">
        <i class="fa fa-arrow-left" onclick="showLastWeek()"></i>
        <?php echo substr($firstDayOfWeekString, 5, 5) . ' - ' . substr($lastDayOfWeekString, 5, 5); ?>
        <i class="fa fa-arrow-right" onclick="showNextWeek()"></i>
    </span>
    <div class="single-progress-chart">
        <canvas class="day-graphs" id="dayCharts"></canvas>
    </div>
   
<div class="log-prompts" id="log-prompts">
            <div class="single-log-prompt sleepLog" id="rec-sleepPrompt">
                <span class="target-display">Daily sleep log<span style="width: <?php echo 60 -  $sleepPercentage; ?>%;"></span></span>
                <span class="prompt"><i class="fa-solid fa-circle-plus"></i></span>
            </div>
            <div class="single-log-prompt mealLog" id="rec-mealsPrompt">
                <span class="target-display">Daily meal log<span></span></span> 
                <span class="prompt"><i class="fa-solid fa-circle-plus"></i></span>
            </div>
            <div class="single-log-prompt exerciseLog" id="rec-exercisePrompt">
                <span class="target-display">Daily exercise log<span></span></span>
                <span class="prompt"><i class="fa-solid fa-circle-plus"></i></span>
            </div>
</div>
<div class="input" style="width:80%;">
                <div class="input-div input-sleep" id="input-sleep" >
                   
                    <form id="sleep-form" action="controls/processing.php" method="POST">
                        <div>
                            <label>Start time</label>
                            <input type="time" name="start-time" />
                        </div>
                        <div>
                            <label>End time</label>
                            <input type="time" name="end-time" />
                        </div>
                        <button type="submit" name="record-sleep" class="btn btn-primary" style="margin-top:12%;">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>
                </div>
                <div class="input-div input-meals" id="input-meals">
                    
                    <form id="meal-form" action="controls/processing.php" method="POST" >
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
                <div class="input-div input-exerciseRoutine" id="input-exerciseRoutine">
                    
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
                            <label>For how long? (in minutes)</label>
                            <input type="number" name="exerciseDuration" />
                        </div>
                        <div>
                            <label>At what time:</label>
                            <input type="time" name="exerciseTime" />
                        </div>
                        <button type="submit" name="record-physicalActivity" class="btn btn-primary" style="margin-top:13.5%;">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>
                </div>
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
            </div>
    </section>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/code.jquery.com_jquery-latest.js"></script>
    <!-- ... Your HTML and PHP code ... -->

<!-- ... Your HTML and PHP code ... -->

<!-- Include Chart.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>

<!-- Include Chart.js Datalabels plugin -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>


<script type="text/javascript">
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
        return (exercise / 45) * 100; // Calculate exercise percentage
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
let sleepPrompt = document.getElementById("rec-sleepPrompt");
let mealPrompt = document.getElementById("rec-mealsPrompt");
let exercisePrompt = document.getElementById("rec-exercisePrompt");

let inputSleep = document.getElementById('input-sleep');
let inputMeals = document.getElementById('input-meals');
let inputExercise = document.getElementById('input-exerciseRoutine');

let logPrompts = document.getElementById('log-prompts');


   sleepPrompt.onclick = () =>{
        inputSleep.style.display ='flex';

        sleepPrompt.style.display ='grid';
        sleepPrompt.style.height ='100%';
        mealPrompt.style.display ='none';
        exercisePrompt.style.display ='none';
        logPrompts.style.height = '4.5%';
        logPrompts.style.display = 'block';
    }
    mealPrompt.onclick = () =>{
        inputMeals.style.display ='flex';

        sleepPrompt.style.display ='none';
        mealPrompt.style.display ='grid';
        mealPrompt.style.height ='100%';
        exercisePrompt.style.display ='none';
        logPrompts.style.height = '4.5%';
        logPrompts.style.display = 'block';
        }

    exercisePrompt.onclick = () =>{
        inputExercise.style.display ='flex';

        sleepPrompt.style.display ='none';
        mealPrompt.style.display ='none';
        exercisePrompt.style.display ='grid';
        exercisePrompt.style.height ='100%';
        logPrompts.style.height = '4.5%';
        logPrompts.style.display = 'block';
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
