<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="favicon.ico" />
    <title>Your daily records</title>
</head>
<body class="dash-body" id="patient-log">
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
        //show dashboard menu
        include_once 'dash-menu.php';
    ?>
    <section style=' margin-top: 2.5%;' class ="main-section">
        <?php
            echo "
            <div class='welcome-msg' style='margin-left: 2.5%'>
                <h3>How're you feeling today, ".$_SESSION["username"]."?</h3>
                <p>Keep track of your progress.</p>
            </div>
            ";
            ?>
            <div class="prompts" id="prompts">
                <div class="prompt" id="rec-sleepPrompt">
                    <h4>Record how much you've slept today</h4>
                    <!-- sleep animation or sth similar 
                    along with the average hours of sleep in the last week
                  -->
                  
                  <?php
$totalSleep = 0;
$avgSleep = 0;
$numDaysWithRecord = 0; // Initialize the variable to count the number of days with records
$id = $_SESSION['id'];
$week = date('Y-m-d H:i:s', strtotime('-1 week'));
$stmt = "SELECT DISTINCT DATE(recordDate) AS logDate FROM patientSleepLog WHERE userID='$id' AND DATE(recordDate) >= DATE_SUB(DATE(NOW()), INTERVAL 1 WEEK)";
$sql = mysqli_query($conn, $stmt);

if (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_array($sql)) {
        $logDate = $row['logDate'];
        $daySleepQuery = "SELECT SUM(sleepTime) AS daySleep FROM patientSleepLog WHERE userID='$id' AND DATE(recordDate) = '$logDate'";
        $daySleepResult = mysqli_query($conn, $daySleepQuery);
        
        if ($daySleepResult) {
            $daySleepRow = mysqli_fetch_assoc($daySleepResult);
            $daySleep = $daySleepRow['daySleep'];
            if ($daySleep > 0) {
                $numDaysWithRecord++; // Increment the count for each day with a non-zero sleep record
                $totalSleep += $daySleep;
            }
        }
    }

    // Calculate average sleep based on the number of days with non-zero records
    $avgSleep = ($numDaysWithRecord > 0) ? floor($totalSleep / $numDaysWithRecord) : 0;

    // Output the average sleep time
    echo "<p style='margin-top: 20%;'>Average recorded sleep time this week is $avgSleep hours</p>";
} else {
    echo "<p style='margin-top: 20%;'>Add a record here</p>";
}
?>


  
                </div>
                <div class="prompt" id="rec-mealPrompt">
                    <h4>Keep track of your meals too</h4>
                     <!-- eating animation or sth similar liked a picture of food
                    along with a fun fact about recommended foods or sth similar
                  -->
                    <?php
                    $id = $_SESSION['id'];
                    $meal = '';
                    $mealTime = '';

                    // Calculate the timestamp 24 hours ago
                    $twentyFourHoursAgo = date('Y-m-d H:i:s', strtotime('-24 hours'));

                    $stmt = "SELECT * FROM patientsmeallog WHERE userID='$id' AND mealTime >= '$twentyFourHoursAgo' ORDER BY mealTime DESC LIMIT 1";
                    $sql = mysqli_query($conn, $stmt);

                    if (mysqli_num_rows($sql) > 0) {
                        while ($row = mysqli_fetch_array($sql)) {
                            $meal .= $row['mealName'];
                            $mealTime .= $row['mealTime'];
                        }
                        // Output the most recent meal intake's details
                        echo "<p style='margin-top: 20%;'>Your most recent meal was $meal taken at $mealTime</p>";
                        echo "<p style='margin-top: 20%;'>Add a record here</p>";
                    } else {
                        echo "<p style='margin-top: 20%;'>Add a record here</p>";
                    }
                    ?>


                </div>
                <!-- <div class="prompt" id="rec-medPrompt"> -->
                    <!-- <h4>Record the last time you took your medicine</h4> -->
                     <!-- medicine intake animation or sth similar 
                    along with sth idk
                  -->
                <!-- </div> -->
                <div class="prompt" id="rec-exercisePrompt">
                    <h4>Track your physical activity</h4>
                     <!-- eating animation or sth similar liked a picture of food
                    along with a fun fact about recommended foods or sth similar
                  -->
                  <?php
                  $id = $_SESSION['id'];
                  $exerciseTypeString ='';
                  $exerciseTime ='';
                  $exerciseDuration ='';
                  $week = date('Y-m-d H:i:s', strtotime('-1 week'));
                  $stmt = "SELECT * FROM patientsexerciselog WHERE userID='$id' order by exerciseTime DESC limit 1";
                  $sql = mysqli_query($conn, $stmt);

                  if (mysqli_num_rows($sql) > 0) {
                      while ($row = mysqli_fetch_array($sql)) {
                          $exerciseType = explode( '*', $row['exerciseType']);
                          for($i = 0; $i < count($exerciseType); $i++){
                            $exerciseTypeString .= $exerciseType[$i] . ' ';
                          }
                          $exerciseTime .= $row['exerciseTime'];
                          $exerciseDuration .= $row['exerciseDuration'];
                      }
                // Output the details of the user's most recent exercise duration
                  echo "<p style='margin-top: 20%;'>You had a $exerciseTypeString exercise session for $exerciseDuration at $exerciseTime</p>";
                  echo "<p style='margin-top: 20%;'>Add a record here</span></p>";
                  }else{
                    // show no recorded exercise lately
                  echo "<p style='margin-top: 20%;'>Add a record here</span></p>";
                  }


                  ?>
                </div>
            </div>
            <div class="input">
                <div class="input-div input-sleep" id="input-sleep" >
                    <h6>Sleep Tracker</h6>
                    <form id="sleep-form" action="controls/processing.php" method="POST">
                        <div>
                            <label>Start time</label>
                            <input type="time" name="start-time" />
                        </div>
                        <div>
                            <label>End time</label>
                            <input type="time" name="end-time" />
                        </div>
                        <button type="submit" name="record-sleep" class="btn btn-primary" style="margin-top:13.5%;">
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
                        <button type="submit" name="record-meal" class="btn btn-primary" style="margin-top:13.5%;">
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
    <?php
    }
    ?>
  </div>
  <script>
    function recordsSleep(){
        document.getElementById('input-sleep').style.display ='flex';
        document.getElementById('prompts').style.display ='none';   
    }
   document.getElementById('rec-sleepPrompt').onclick = () =>{
        recordsSleep();
    }

    function recordMeals(){
        document.getElementById('input-meals').style.display ='flex';
        document.getElementById('prompts').style.display ='none';
    }

  document.getElementById('rec-mealPrompt').onclick = () =>{
    recordMeals();
  }

  function recordPhysicalActvity(){
    document.getElementById('input-exerciseRoutine').style.display ='flex';
    document.getElementById('prompts').style.display ='none';
  }
  document.getElementById('rec-exercisePrompt').onclick = () =>{
    recordPhysicalActvity();
  }

  function recordMedIntake(){
    document.getElementById('input-medication').style.display ='flex';
    document.getElementById('prompts').style.display ='none';
  }
  document.getElementById('rec-medPrompt').onclick = () =>{
    recordMedIntake();
  }
</script>

</body>
</html>
