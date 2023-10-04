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
<body class="profileBody">
<div class="header">
    <?php
    include_once 'notif-menu.php';
    ?>
</div>
<div class="mainBody" id="patient-records-section">
    <?php
    include_once 'dash-menu.php';
    ?>
    <section style="margin-top: 0; margin-left: 10%;" id="singlePatientRecords">
        <?php
        $i = 0;
        $pID = isset($_GET['p']) ? $_GET['p'] : $_SESSION['id'];
        $stmt = mysqli_query($conn, "SELECT * FROM regPatients where id='$pID'");
        if ($stmt) {
            if (mysqli_num_rows($stmt) > 0) {
                $i = 0;
                while ($result = mysqli_fetch_array($stmt)) {
                    ?>
                    <h2 style="width: 30%; margin-left: 0;"><?php echo $result["firstName"] . ' ' . $result["lastName"] ?></h2>
                    <h4 style="margin-left: 0;"><strong>Contact number:</strong> <?php echo $result["phoneNumber"] ?></h4>
                    <table style="margin-left: 0;">
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
            include 'risk-prediction.php';

            if (isset($riskLevel)) {

                $status = $riskLevel;

                switch ($status) {
                    case 0:
                        echo "<span style='width: 100%; padding:0.25em; border-radius: 5px; background-color: rgb(255, 255, 10);'>low</span>";
                        break;
                    case 1:
                        echo "<span  style='width: 100%; padding:0.25em; border-radius: 5px; background-color: rgb(136, 33, 0);'>moderate</span>";
                        break;
                    case 2:
                        echo "<span  style='width: 100%; padding:0.25em; border-radius: 5px; background-color:  #59BF7E;'>high</span>";
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
                // get dosage info
            } else {
                echo "Not under any treatment";
            }
            ?></td>
    </tr>
    <tr>
        <th>Progress</th>
        <td>
            <?php
            if (isset($riskLevel)) {

                $status = $riskLevel;

                switch ($status) {
                    case 0:
                        echo "<span style='width: 100%; padding:0.25em; border-radius: 5px;'>Improving</span>";
                        break;
                    case 1:
                        echo "<span  style='width: 100%; padding:0.25em; border-radius: 5px;'>Even</span>";
                        break;
                    case 2:
                        echo "<span  style='width: 100%; padding:0.25em; border-radius: 5px;'>Regressing</span>";
                        break;
                    default:
                        echo "Determining progress trend";
                }
            } else {
                echo "Progress trend undetermined.";
            }
            ?>
        </td>
    </tr>
</table>

                    <?php
                }
            } else {
                echo "No records found for the specified ID.";
            }
        } else {
            echo "Error executing the SQL query: " . mysqli_error($conn);
        }
        ?>
    </section>
</div>
</body>
</html>
<style>
    .menuBar, .menu {
        display: none;
    }
</style>
        <script>
window.onload(window.print());
if(window.print()){
    window.location.href = 'dashboard.php?r=1';
}

function toPatientCalendar(patientID){
window.location.href = 'calendar.php?p='+patientID;
}

function fetchData() {
$.ajax({
url: 'single-patient-records.php', // Replace with your server-side script URL
method: 'GET',
success: function(response) {
// Handle the response and update the HTML content
$('#singlePatientRecords').html(response);
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
window.location.href = 'single-patient-records.php?print=1&p=' + <?php echo $_GET['p']?>;
}
// </script>
