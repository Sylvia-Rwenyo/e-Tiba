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
    <title>Your dashboard</title>
</head>
<body class="dash-body" id="patient-log">
  <div class="header">
    <h1>Records</h1>
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
    <section style=' margin-top: 2.5%;'>
        <?php
            echo "
            <div class='welcome-msg' style='margin-left: 2.5%'>
                <h5>How're you feeling today, ".$_SESSION["username"]."?</h5>
                <p>Keep track of your progress.</p>
            </div>
            ";
            ?>
            <div class="prompts" id="prompts">
                <div class="prompt" id="rec-sleepPrompt">
                    <h6>Record how much you've slept today</h6>
                    <!-- sleep animation or sth similar 
                    along with the average hours of sleep in the last week
                  -->
                  
                  <?php
                    $totalSleep = 0;
                    $avgSleep = 0;
                    $id = $_SESSION['id'];
                    $week = date('Y-m-d H:i:s', strtotime('-1 week'));
                    $stmt = "SELECT * FROM patientSleepLog WHERE userID='$id' AND DATE(recordDate) >= DATE_SUB(DATE(NOW()), INTERVAL 1 WEEK)";
                    $sql = mysqli_query($conn, $stmt);

                    if (mysqli_num_rows($sql) > 0) {
                        while ($row = mysqli_fetch_array($sql)) {
                            $totalSleep += $row['sleepTime'];
                        }
                    }

                    $avgSleep = $totalSleep / 7;

                    // Output the average sleep time
                    echo "<p style='margin-top: 20%;'>Your average sleep this week is $avgSleep hours</p>";
                ?>      
                </div>
                <div class="prompt" id="rec-mealPrompt">
                    <h6>Keep track of your meals too</h6>
                     <!-- eating animation or sth similar 
                    along with a fun fact about recommended foods or sth similar
                  -->
                </div>
                <div class="prompt" id="rec-medPrompt">
                    <h6>Record the last time you took your medicine</h6>
                     <!-- medicine intake animation or sth similar 
                    along with sth idk
                  -->
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
                        <button type="submit" name="record-sleep" class="btn btn-primary">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>
                </div>
                <div class="input-div input-meals" id="input-meals">
                    <h6>What have you eaten today</h6>
                    <form id="meal-form" action="controls/processing.php" method="POST" >
                        <div>
                            <label>Meal name:</label>
                            <input type="text" name="meal-name" />
                        </div>
                        <div>
                            <label>Meal time:</label>
                            <input type="time" name="meal-time" />
                        </div>
                        <button type="submit" name="record-meal" class="btn btn-primary">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>
                </div>
                <div class="input-div input-medication" id="input-medication">
                    <h6>What time did you take you medicine</h6>
                    <form id="meds-form" action="controls/processing.php" method="POST" >
                        <div>
                            <label>Medicine name:</label>
                            <input type="text" name="med-name" />
                        </div>
                        <div>
                            <label>Intake time:</label>
                            <input type="time" name="med-time" />
                        </div>
                        <button type="submit" name="record-medTime" class="btn btn-primary">
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
// //   // Sleep Form submission
// $('#sleep-form').on('submit', function(event) {
//     event.preventDefault(); // Prevent the form from submitting normally
//     // Perform the AJAX request
//     $.ajax({
//       url: 'controls/controls/controls/processing.php',
//       type: 'POST',
//       data: $(this).serialize(),
//       success: function(response) {
//          alert("Sleep time: " + response); // Display the calculated sleep time as an alert
//       },
//       error: function(xhr, status, error) {
//         console.log(error); // Handle any errors
//       }
//     });
//   });

//   // Meal Form submission
//   $('#meal-form').on('submit', function(event) {
//     event.preventDefault(); // Prevent the form from submitting normally
//     // Perform the AJAX request
//     $.ajax({
//       url: 'controls/controls/controls/processing.php',
//       type: 'POST',
//       data: $(this).serialize(),
//       success: function(response) {
//          alert(response); 
//       },
//       error: function(xhr, status, error) {
//         console.log(error); // Handle any errors
//       }
//     });
//   });
//   // Medication Form submission
//   $('#meds-form').on('submit', function(event) {
//     event.preventDefault(); // Prevent the form from submitting normally
//     // Perform the AJAX request
//     $.ajax({
//       url: 'controls/controls/controls/processing.php',
//       type: 'POST',
//       data: $(this).serialize(),
//       success: function(response) {
//         alert(response); 
//       },
//       error: function(xhr, status, error) {
//         console.log(error); // Handle any errors
//       }
//     });
//   });
  document.getElementById('rec-sleepPrompt').onclick = () =>{
    document.getElementById('input-sleep').style.display ='flex';
    document.getElementById('prompts').style.display ='none';
  }
  document.getElementById('rec-mealPrompt').onclick = () =>{
    document.getElementById('input-meals').style.display ='flex';
    document.getElementById('prompts').style.display ='none';
  }
  document.getElementById('rec-medPrompt').onclick = () =>{
    document.getElementById('input-medication').style.display ='flex';
    document.getElementById('prompts').style.display ='none';
  }
</script>

</body>
</html>
