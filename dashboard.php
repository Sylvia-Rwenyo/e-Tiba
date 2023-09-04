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
  <div class="mainBody">
<?php
if (!isset($_SESSION["loggedIN"])) {
    header('location:index.php');
} else {
    // Show dashboard menu
    include_once 'dash-menu.php';
    $userID = $_SESSION['id'];
    ?>
    <section class="main-section">
        <div class="dash-intro">
            <?php include_once 'dash-nav.php'; ?>
        </div>

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
        if ($_SESSION["category"] != "patient") {
            include_once 'patient-progress-search-div.php';
        }

        if (isset($_GET['charts'])) {
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
                    $weekOperation = $viewWeek . ' '.$week;
                    $firstDayOfWeek->modify($weekOperation); // Go back or ahead by a week
                    
                    if($viewWeek == 0){
                        $firstDayOfWeek = clone $today;
                        $firstDayOfWeek->modify('monday this week');
                    }
                }else {
                    // Default behavior: show the current week
                    $firstDayOfWeek = clone $today;
                    $firstDayOfWeek->modify('monday this week');
                }
                
                $firstDayName = $firstDayOfWeek->format('l'); // Get the day name of the first day of the week
                $firstDayOfWeekString = $firstDayOfWeek->format('Y-m-d'); // Convert the DateTime object to a string
                
                $lastDayOfWeek = clone $firstDayOfWeek; // Clone the first day of the week object
                $lastDayOfWeek->modify('+6 days'); // Get the last day of the week as 6 days after the first day
                $lastDayOfWeekString = $lastDayOfWeek->format('Y-m-d'); // Convert the DateTime object to a string

                $currentDay = clone $firstDayOfWeek;
                $currentDayString = $currentDay->format('Y-m-d');
                ?>
                <!-- week indicator -->
                <span class="week-indicator">
                    <i class="fa fa-arrow-left" onclick="showLastWeek()"></i>
                        <?php echo substr($firstDayOfWeekString, 5, 5) . ' - ' . substr($lastDayOfWeekString, 5, 5); ?>
                    <i class="fa fa-arrow-right" onclick="showNextWeek()"></i>
                </span>
                <div class="single-progress-chart">
                    <?php
                        while ($currentDayString <= $lastDayOfWeekString) {
                    ?>
                    <div class="single-chart">
                            <?php
                            $sleepTime = 0;
                            $sql2 = "SELECT * FROM patientsleeplog WHERE userID = '$userID' && recordDate='$currentDayString'";
                            $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                            while($row = mysqli_fetch_array($result2)){
                                $sleepTime = $row['sleepTime'];
                            }
                             $targetSleep = 12;
                             $sleepPercentage = 100 * $sleepTime/$targetSleep;
                             echo '
                                <style>
                                    .sleep span{
                                        height:'.$sleepPercentage.'%;
                                    }
                                </style>
                             ';
                            $mealNumbers = 0;
                            $sql3 = "SELECT * FROM patientsmeallog WHERE userID = '$userID' && recordDate='$currentDayString'";
                            $result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                            while($row = mysqli_fetch_array($result3)){
                                $mealNumbers += 1;
                            }
                            $targetMeals = 3;
                            $mealsPercentage = 100 * $mealNumbers/$targetMeals;
                            echo '
                               <style>
                                   .meals span{
                                       height:'.$mealsPercentage.'%;
                                   }
                               </style>
                            ';
                    
                            $exerciseTime = 0;
                            $sql4 = "SELECT * FROM patientsexerciselog WHERE userID = '$userID' && recordDate='$currentDayString'";
                            $result4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                            while($row = mysqli_fetch_array($result4)){
                                $exerciseTime = $row['exerciseDuration'];
                            }
                            $targetExercise = 100;
                            $exercisePercentage = 100 * $exerciseTime/$targetExercise;
                            echo '
                               <style>
                                   .exercise span{
                                       height:'.$exercisePercentage.'%;
                                   }
                               </style>
                            ';
                           ?>
                        <div class="day-graphs">
                            <span class="single-graph sleep"><span></span></span>
                            <span class="single-graph meals"><span></span></span>
                            <span class="single-graph exercise"><span></span></span>
                        </div>
                        <span class="date-label">
                            <?php
                                $dayName = $currentDay->format('l');
                                $dateString = $currentDay->format('m/d/Y');
                                echo substr($dayName, 0, 1);
                             ?>
                         </span>
                    </div>
                    <?php
                    $currentDay->modify('+1 day');
                    $currentDayString = $currentDay->format('Y-m-d');
                    }
                    ?>
                </div>
                <!-- Chart containers -->
                <?php
                //   include_once 'charts/sleep-chart-div.php';
                //   include_once 'charts/meals-chart-div.php';
                //   include_once 'charts/exercise-chart-div.php';
                ?>
            </div>
            <?php
        }
        ?>
    </section>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/code.jquery.com_jquery-latest.js"></script>
    <script type="text/javascript">
        function print1patientRecord() {
            window.location.href = 'single-patient-records.php?print=1';
        }
        function showLastWeek(){
    window.location.href = 'dashboard.php?charts=1&w=' <?php  if(isset($_GET['w'])){ echo '+'. (int)$_GET['w'] - 1; }else { echo '+'. -1;} ?>;
}
function showNextWeek(){
    window.location.href = 'dashboard.php?charts=1&w=' <?php if(isset($_GET['w'])){ echo '+'.  (int)$_GET['w'] + 1; }else { echo '+'. +1;} ?> ;
}
    </script>
</body>
</html>
<?php
}
?>
