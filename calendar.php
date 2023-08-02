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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="style.css">
    <title>Appointments</title></head>
<body class="dash-body">
    <div class="header">
        <?php include_once 'notif-menu.php'; ?>
    </div>
    <div class="mainBody" id="calendarBody">
        <?php
            //show dashboard menu
            include_once 'dash-menu.php';
            $id = $_SESSION['id'];
            $pID = 0;
            $dID = 0;
            $today = new DateTime(); // Get the current date and time
            $today->setTime(0, 0, 0); // Set the time to the beginning of the day (midnight)
            
            $firstDayOfWeek = clone $today; // Clone the current date object
            $firstDayOfWeek->modify('monday this week'); // Get the date of the first day (Monday) of the current week
            $firstDayName = $firstDayOfWeek->format('l'); // Get the day name of the first day of the week
            
            $firstDayOfWeekString = $firstDayOfWeek->format('Y-m-d'); // Convert the DateTime object to a string
            $lastDayOfWeek = clone $firstDayOfWeek; // Clone the first day of the week object
            $lastDayOfWeek->modify('+6 days'); // Get the last day of the week as 6 days after the first day
            $lastDayOfWeekString = $lastDayOfWeek->format('Y-m-d'); // Convert the DateTime object to a string
        ?>
        <section class="main-section">
            <span class="week-indicator"><i class="fa fa-arrow-left"></i> <?php echo substr($firstDayOfWeekString, 5, 5) . ' - ' . substr($lastDayOfWeekString, 5, 5); ?> <i class="fa fa-arrow-right"></i></span>
            <div class="calendar">
                <?php
                $currentDay = clone $firstDayOfWeek;
                $currentDayString = $currentDay->format('Y-m-d');

                while ($currentDayString <= $lastDayOfWeekString) {
                    // Output the day and date
                    $dayName = $currentDay->format('l');
                    $dateString = $currentDay->format('m/d/Y');
                    echo '<div class="day">';
                    echo '<div class="day-name">' . substr($dayName, 0, 3) . ' (' . $dateString . ')</div>';
                    
                    for ($hour = 9; $hour <= 16; $hour++) {
                        for ($minute = 0; $minute < 60; $minute += 30) {
                            $timeString = sprintf('%02d:%02d', $hour, $minute);
                            
                            // Check if the appointment exists for this date and time
                            $appointmentExists = false;
                            
                            // Fetch the appointments for the current date from the database
                            $stmt = '';
                            if ($_SESSION['category'] == "patient" ) {
                                $stmt .= "SELECT * FROM appointments WHERE patientID='$id' AND appointmentDate='$currentDayString'";
                            } else if (isset($_GET["p"])) {
                                $pID = $_GET['p'];
                                if($_SESSION['category'] == "doctor" ){
                                    $dID =$id;
                                    // possibly show only that particular patient's appointments to the doctor
                                    // if(isset($_GET["s"])){
                                    //     $stmt .= "SELECT * FROM appointments WHERE patientID='$id' && AND appointmentDate='$currentDayString'";
                                    // }
                                }
                                $stmt .= "SELECT * FROM appointments WHERE patientID='$pID' AND appointmentDate='$currentDayString'";
                            } else if (isset($_GET["d"])) {
                                $dID = $_GET['d'];
                                if (isset($_GET["p"])) {
                                    $pID = $_GET['p'];
                                }
                                $stmt .= "SELECT * FROM appointments WHERE doctorID='$dID' AND appointmentDate='$currentDayString'";
                            } else if ($_SESSION['category'] == "doctor" && !isset($_GET["p"]) ){
                                $stmt .= "SELECT * FROM appointments WHERE doctorID='$id' AND appointmentDate='$currentDayString'";
                            }
                            $sql = mysqli_query($conn, $stmt);
                            
                            if (mysqli_num_rows($sql) > 0) {
                                while ($row = mysqli_fetch_array($sql)) {
                                    // Check if the appointment exists for this time slot
                                    if ($row['appointmentTime'] === $timeString) {
                                        $appointmentExists = true;
                                        break;
                                    }
                                }
                            }
                            
                            if ($appointmentExists) {
                                // Output the booked time slot
                                echo '<div class="booked" onclick="startMeeting(\''.$timeString.'\')">' . $timeString . '</div>';
                            } else {
                                $reqID = $_SESSION['category'] == "patient" ? $pID : $dID;
                                // Output the available time slot
                                echo '<div class="available" onclick="makeAppointment(\'' . $currentDay->format('Y-m-d') 
                                    . '\', \'' . $timeString . '\', \'' . $reqID . '\', \'' . $id . '\')">' . $timeString . '
                                    <i class="fa-solid fa-circle-check"></i></div>';
                            }
                        }
                    }
                    echo '</div>'; // Close the day div
                    $currentDay->modify('+1 day');
                    $currentDayString = $currentDay->format('Y-m-d');
                }
                ?>
            </div>
        </section>
    </div>
</body>
<script>
    function makeAppointment(date, time, pID, dID) {
        window.location.href = "controls/processing.php?a=p&d=" + date + 
        "&t=" + time + "&pID=" + pID + "&dID=" + dID;
    }
    function startMeeting(time){
        //join video call if its 15 min to time or within 30 minutes of indicated time
    }
</script>
</html>
