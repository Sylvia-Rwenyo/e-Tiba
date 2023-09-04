<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="style.css">
    <title>Records of Patients</title>
</head>
<body class="profileBody" id="profileBody" >
    <div class="header">
        <?php include_once 'notif-menu.php';?>
    </div>
    <div class="mainBody" id="patient-records-section">
    <?php 
        include_once 'dash-menu.php';
    ?>
    <section class="main-section">
        <div class="records-header" style="flex-direction:column;justify-content: unset;">
            <?php
            $i=0;
            $pID = isset($_GET['p']) ? $_GET['p'] : null;
            $stmt = mysqli_query($conn,"SELECT * FROM regPatients where id='$pID'");
            if (mysqli_num_rows($stmt) > 0) {
                $i=0;
                while($result = mysqli_fetch_array($stmt)) {
            ?>
            <h2 style="width: 30%;"><?php echo $result["firstName"] .' '.$result["lastName"]?></h2>
            <h4><strong>Contact number:</strong>  <?php echo $result["phoneNumber"] ?></h4>
            <?php
         
            ?>
            <!-- search functionality to be added. Get from dosage-registration.php-->
            <?php 
            // include_once "doctors/dosage-reg-search-div.php";
            ?>
        </div>
        <table>
        <tr>
            <th>Registration Date</th>
            <td><?php
            if (isset($result["registrationDate"]) && $result["registrationDate"] !== null) {
                $regDate = new DateTime($result["registrationDate"]);
                echo $regDate->format('m/d/Y');
            } else {
                echo "Registration date not available.";
            }            
             ?></td>
        </tr>
        <?php
        // Fetch all appointment dates for the patient from the database
        $sql = mysqli_query($conn, "SELECT appointmentDate FROM appointments WHERE patientID='$pID' ORDER BY appointmentDate");

        // Initialize variables to store the recent and next checkup dates
        $recentCheckupDate = null;
        $nextCheckupDate = null;

        if (mysqli_num_rows($sql) > 0) {
            // Get the current date
            $currentDate = new DateTime();

            // Loop through the appointment dates to find the recent and next checkup dates
            while ($result = mysqli_fetch_array($sql)) {
                $appointmentDate = new DateTime($result["appointmentDate"]);

                // Check if the appointment date is in the past (recent checkup)
                if ($appointmentDate < $currentDate) {
                    $recentCheckupDate = $appointmentDate;
                }
                // Check if the appointment date is in the future (next checkup)
                elseif ($appointmentDate > $currentDate) {
                    $nextCheckupDate = $appointmentDate;
                    break; // Break the loop as we found the next checkup date
                }
            }
        }

        // Output the Recent Checkup and Next Checkup dates
        echo '<tr>';
        echo '<th>Recent Checkup</th>';
        echo '<td>';
        if ($recentCheckupDate) {
            echo $recentCheckupDate->format('m/d/Y');
        } else {
            echo 'No recent checkup';
        }
        echo '</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<th>Next Checkup</th>';
        echo '<td>';
        if ($nextCheckupDate) {
            echo $nextCheckupDate->format('m/d/Y');
        } else {
            echo 'No next checkup';
        }
        echo '</td>';
        echo '</tr>';
        ?>

<tr>
    <th>Risk level</th>
    <td><?php
        if (isset($result['status'])) {
            $status = $result['status'];

            switch ($status) {
                case 0:
                    echo "<p style='color: rgb(200, 200, 10);'>low</p>";
                    break;
                case 1:
                    echo "<p  style='color: rgb(136, 33, 0);>moderate</p>";
                    break;
                case 2:
                    echo "<p  style='color:  #59BF7E;>high</p>";
                    break;
                default:
                    echo "Determining risk level";
            }
        } else {
            echo "Risk level undetermined.";
        }
    ?></td>
</tr>

        <tr>
            <th>Current Treatment plan</th>
            
            <td style="display:flex;flex-direction:row;padding:10px;">
                <!-- register new dosage -->
                <a style="text-decoration:none;margin-right:20px;" href="doctors/dosage-registration-form.php?id=<?php echo $pID; ?>"><i class="fa fa-plus"></i><br/>New Dose</a>
            
                <!-- dosages for this patient patients -->
                <a style="text-decoration:none;margin-right:20px;" href="doctors/dosage-registration.php?id=<?php echo $pID; ?>"><i class="fa-solid fa-folder"></i><br/>Doses</a>
            
                <!-- dosages for all patients -->
                <a style="text-decoration:none;margin-right:20px;" href="doctors/view-all-dosages.php"><i class="fa-solid fa-folder-tree"></i><br/>All Doses</a>
            </td>
        </tr>
        <tr>
            <th>Progress</th>
            <td>
                <?php
                //  summary of progress and link to progress charts
                ?>
            </td>
        </tr>
        </table>
                        </section>
                    </div>
                </body>
                </html>
              
                <?php
            }
            $i++;
        }else{ 
                include_once 'conn.php';
            $i=0;
            $pID = isset($_GET['p']) ? $_GET['p'] : $_SESSION['id'];
            $stmt = mysqli_query($conn,"SELECT * FROM regPatients where id='$pID'");
            if (mysqli_num_rows($stmt) > 0) {
                $i=0;
                while($result = mysqli_fetch_array($stmt)) {
            ?>
        <table>
        <tr>
            <th>Registration Date</th>
            <td><?php
            if (isset($result["registrationDate"]) && $result["registrationDate"] !== null) {
                $regDate = new DateTime($result["registrationDate"]);
                echo $regDate->format('m/d/Y');
            } else {
                echo "Registration date not available.";
            }            
             ?></td>
        </tr>
        <?php
        // Fetch all appointment dates for the patient from the database
        $sql = mysqli_query($conn, "SELECT appointmentDate FROM appointments WHERE patientID='$pID' ORDER BY appointmentDate");

        // Initialize variables to store the recent and next checkup dates
        $recentCheckupDate = null;
        $nextCheckupDate = null;

        if (mysqli_num_rows($sql) > 0) {
            // Get the current date
            $currentDate = new DateTime();

            // Loop through the appointment dates to find the recent and next checkup dates
            while ($result = mysqli_fetch_array($sql)) {
                $appointmentDate = new DateTime($result["appointmentDate"]);

                // Check if the appointment date is in the past (recent checkup)
                if ($appointmentDate < $currentDate) {
                    $recentCheckupDate = $appointmentDate;
                }
                // Check if the appointment date is in the future (next checkup)
                elseif ($appointmentDate > $currentDate) {
                    $nextCheckupDate = $appointmentDate;
                    break; // Break the loop as we found the next checkup date
                }
            }
        }

        // Output the Recent Checkup and Next Checkup dates
        echo '<tr>';
        echo '<th>Recent Checkup</th>';
        echo '<td>';
        if ($recentCheckupDate) {
            echo $recentCheckupDate->format('m/d/Y');
        } else {
            echo 'No recent checkup';
        }
        echo '</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<th>Next Checkup</th>';
        echo '<td>';
        if ($nextCheckupDate) {
            echo $nextCheckupDate->format('m/d/Y');
        } else {
            echo 'No next checkup';
        }
        echo '</td>';
        echo '</tr>';
        ?>

<tr>
    <th>Risk level</th>
    <td><?php
        if (isset($result['status'])) {
            $status = $result['status'];

            switch ($status) {
                case 0:
                  echo "<span style='width: 100%; padding:0.25em; border-radius: 5px; background-color: rgb(255, 255, 10);'>low</span>";
                  break;
              case 1:
                  echo "<span  style='width: 100%; padding:0.25em; border-radius: 5px; background-color: rgb(136, 33, 0);>moderate</span>";
                  break;
              case 2:
                      echo "<span  style='width: 100%; padding:0.25em; border-radius: 5px; background-color:  #59BF7E;>high</span>";
                      break;
                default:
                  echo "Determining risk level";
              }
        } else {
            echo "Risk level undetermined.";
        }
    ?></td>
</tr>

        <tr>
            <th>Current Treatment plan</th>
            
            <td><?php
        if (isset($result['dosage'])) {
            echo $result['dosage'];
        } else {
            echo "Not under any treatment";
            ?>
            &nbsp;  &nbsp;  &nbsp;  &nbsp;
            <!-- link to this patient's treatment records -->
            <a href="">See history</a>
            <?php

        }
    ?></td>
        </tr>
        <tr>
            <th>Progress</th>
            <td>
                <?php
                //  summary of progress and link to progress charts
                ?>
            </td>
        </tr>
        <?php
        }}
        $i++;
        ?>
        </table>
        <?php
            if(isset($_GET['print'])){
                ?>
                <script>
        window.onload(window.print());
        if(window.print()){
            window.location.href = 'dashboard.php?r=1';
        }
        </script>
                        <?php
                  
                }else{

        ?>
        <button class="records-print-btn" onclick="print1patientRecord()">Print</button>
        <?php
         }}
         ?>
        <script>
    function toPatientCalendar(patientID){
        window.location.href = 'calendar.php?p='+patientID;
    }

function fetchData() {
$.ajax({
    url: 'single-patient-records.php', // Replace with your server-side script URL
    method: 'GET',
    success: function(response) {
    // Handle the response and update the HTML content
    $('#profile-body').html(response);
    console.log("all good");
    },
    error: function(xhr, status, error) {
    // Handle errors
    console.error(error);
    }
});
}

// Call the getNewData function periodically to fetch new data
setInterval(fetchData, 60000);

function print1patientRecord(){
    window.location.href = 'single-patient-records.php?print=1';
}
// </script>
     