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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="style.css">
    <title>Appointments</title></head>
<body class="dash-body">
    <div class="header">
        <?php include_once 'notif-menu.php'; ?>
    </div>
    <!-- <button id="showDialog"></button> -->
    <div class="mainBody" id="calendarBody">
        <?php
            //show dashboard menu
            include_once 'dash-menu.php';
            $pID = 0;
            $dID = 0;
            $apID = 0;
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
            
        ?>
        <section class="main-section">
            <span class="week-indicator">
                <i class="fa fa-arrow-left" onclick="showLastWeek()"></i>
                    <?php echo substr($firstDayOfWeekString, 5, 5) . ' - ' . substr($lastDayOfWeekString, 5, 5); ?>
                <i class="fa fa-arrow-right" onclick="showNextWeek()"></i>
            </span>
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
                            $stmt = ''; // Initialize the query string
                            if ($_SESSION['category'] == "patient") {
                                $pID = $id;
                                $dID = 0;
                                $stmt .= "SELECT * FROM appointments WHERE patientID='$pID' AND appointmentDate='$currentDayString' AND cancelled=0";
                            } else {
                                if (isset($_GET["p"])) {
                                    $pID = $_GET['p'];
                                    if ($_SESSION['category'] == "doctor") {
                                        $dID = $id;
                                        $stmt .= "SELECT * FROM appointments WHERE patientID='$pID' AND appointmentDate='$currentDayString' AND cancelled=0";
                                    }
                                } else if (isset($_GET["d"])) {
                                    $dID = $_GET['d'];
                                    if (isset($_GET["p"])) {
                                        $pID = $_GET['p'];
                                        $stmt .= "SELECT * FROM appointments WHERE doctorID='$dID' AND patientID='$pID' AND appointmentDate='$currentDayString' AND cancelled=0";
                                    } else {
                                        $stmt .= "SELECT * FROM appointments WHERE doctorID='$dID' AND appointmentDate='$currentDayString' AND cancelled=0";
                                    }
                                } else if ($_SESSION['category'] == "doctor" && !isset($_GET["p"])) {
                                    $dID = $id;
                                    $stmt .= "SELECT * FROM appointments WHERE doctorID='$dID' AND appointmentDate='$currentDayString' AND cancelled=0";
                                }
                            }
                            
                            $sql = mysqli_query($conn, $stmt);
                            
                            if (mysqli_num_rows($sql) > 0) {
                                while ($row = mysqli_fetch_array($sql)) {
                                    // Check if the appointment exists for this time slot
                                    if ($row['appointmentTime'] === $timeString) {
                                        $appointmentExists = true;
                                        $dID = $row['doctorID'];
                                        $pID = $row['patientID'];
                                        $apID = $row['appointmentID'];
                                        break;
                                    }
                                }
                            }
                            
                            if ($appointmentExists) {
                                // Output the booked time slot
                                echo '<div class="booked" onclick="startMeeting(\'' . $currentDay->format('Y-m-d') 
                                . '\', \'' . $timeString . '\', \'' . $pID . '\', \'' . $dID . '\', \'' . $apID . '\')">' . $timeString . '</div>';
                            } else {
                                // $reqID = $_SESSION['category'] == "patient" ? $pID : $dID;
                                // Output the available time slot
                                echo '<div class="available" onclick="makeAppointment(\'' . $currentDay->format('Y-m-d') 
                                    . '\', \'' . $timeString . '\', \'' . $pID . '\', \'' . $dID . '\')">' . $timeString . '
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
        <?php
        if(isset($_GET['a'])){
            if(isset($_GET['s'])){
                if($_GET['s'] == 1){
                    $appointment = $_GET['apID'];
                    $sql = "UPDATE appointments SET  pConfirmed=1 WHERE appointmentID='$appointment'";
 
                // if sql query is executed and database connection is established
                if (!mysqli_query($conn, $sql)) {	
                    echo "Error: " . $sql . "
                " . mysqli_error($conn);
                    }
                }else if($_GET['s'] == 0){
                    $appointment = $_GET['apID'];
                    $sql = "UPDATE appointments SET  pConfirmed=0 WHERE appointmentID='$appointment'";
                    if (!mysqli_query($conn, $sql)) {	
                        echo "Error: " . $sql . "
                    " . mysqli_error($conn);
                        }
            }
            echo ' <script> 
            window.location.href = "calendar.php";
            </script>
            ';
        }
            if($_GET['a'] == 'p'){
                echo '<style>
                    .overlay 
                        {
                            display: block;
                        }
                        .calendar{
                            opacity: 0.5;
                        }
                    </style>';
                if(!isset($_GET['c'])){

                    if(isset($_GET['dID']) && $_SESSION['category'] == 'patient'){
                        if($_GET['dID'] == 0){
                            ?>
                            <div id="noAppointmentAlert" class="overlay">
                                 <p>Please contact your doctor via our messaging service to set an appoinment</p> 
                                <div class="overlay-btns">
                                    <button  class="btn btn-lg btn-success confirm" onclick="toChat()">Okay</button>
                                    <button  class="btn btn-lg btn-danger dialog-box-btn" onclick="cancelDialogBox()">Back</button>
                                </div>
                            </div>
                                <?php

                        }
                    }   
                    else  if(isset($_GET['pID'])&& $_SESSION['category'] == 'doctor'){
                         if($_GET['pID'] == 0){
                        ?>
                        <div id="noAppointmentAlert" class="overlay">
                             <p>Please select patient to book into a time slot under patient records
                                <!-- add chat link -->
                             <a href="patient-records.php">here <i class="fa fa-arrow-right"></i></p> 
                            <div>
                                <button  class="btn btn-lg btn-success confirm" onclick="toPatientRecords()">Okay</button>
                                <button  class="btn btn-lg btn-danger dialog-box-btn" onclick="cancelDialogBox()">Back</button>                            </div>
                        </div>
            <?php
                }}}else{
            $dateString = $_GET['d'];
            $dateObject = DateTime::createFromFormat('Y-m-d', $dateString);
            if($_SESSION['category'] !== 'doctor'){
                $doctorID = $_GET['dID'];
                $sql = mysqli_query($conn,  "SELECT * FROM regDoctors WHERE id='$doctorID'");     
                if (mysqli_num_rows($sql) > 0) {
                    while ($row = mysqli_fetch_array($sql)) {
                   
        ?>

        <div id="confirmAppointment" class="overlay">
            <p>You have an appoinment on <?php echo $dateObject->format('m/d/Y')?> at <?php echo $_GET['t']?> with Dr.
            <?php echo ucfirst($row['lastName'])?> of <?php echo ucfirst($row['institution'])?>
            </p>
            <div class="overlay-btns">
                <button id="confirmButton" class="btn btn-lg btn-success confirm">Confirm</button>
                <button  class="btn btn-lg btn-danger dialog-box-btn" onclick="cancelDialogBox()">Back</button>
            </div>

        </div>
        <?php
         if(isset($_GET['w'])){
            if(stristr('-', $_GET['w']) == true){
                echo '<style>
                .overlay 
                    {
                        display: none;
                    }
                    .calendar{
                        opacity: 1;
                    }
                </style>'; 
                }
            }   
                    }}}else{
                        $patientID = $_GET['pID'];
                        $sql = mysqli_query($conn,  "SELECT * FROM regpatients WHERE id='$patientID'");     
                        if (mysqli_num_rows($sql) > 0) {
                            while ($row = mysqli_fetch_array($sql)) {
                        ?>
                     <div id="confirmAppointment" class="overlay">
            <p>You have an appoinment on <?php echo $dateObject->format('m/d/Y')?> at <?php echo $_GET['t']?> with
            <?php echo ucfirst($row['firstName'].' '.$row['lastName'])?> at <?php echo ucfirst($row['institution'])?>
            </p>
            <div class="overlay-btns">
                <button id="confirmButton" class="btn btn-lg btn-success confirm">Confirm</button>
                <button  class="btn btn-lg btn-danger dialog-box-btn" onclick="cancelAppointment()">Cancel</button>
            </div>

        </div>
                    <?php
            }}}}}}
        ?>
    </div>
</body>
<script>
      
    var patientID;
    var doctorID;
    var appointmentID;
    function makeAppointment(date, time, pID, dID) {
        if(pID == 0){
            window.location.href = "calendar.php?a=p&d=" + date + 
             "&t=" + time + "&pID=" + pID + "&dID=" + dID;
        }else if(dID == 0){
            window.location.href = "calendar.php?a=p&d=" + date + 
             "&t=" + time + "&pID=" + pID + "&dID=" + dID;
        }else{
            window.location.href = "controls/processing.php?a=p&d=" + date + 
             "&t=" + time + "&pID=" + pID + "&dID=" + dID;
        }
    }
  
    function startMeeting(date, appointmentTime, pID, dID, apID) {
    let currentTime = new Date();
    patientID = pID;
    doctorID = dID;
    appointmentID = apID;
    console.log(appointmentID)
    // Convert appointmentTime to a Date object
    let appointmentTimeString = date + ' ' + appointmentTime;
    let appointmentDateTime = new Date(appointmentTimeString);

    // Calculate 15 minutes before and after the appointment time
    let nearTime = new Date(appointmentDateTime.getTime() - 15 * 60 * 1000);
    let afterTime = new Date(appointmentDateTime.getTime() + 15 * 60 * 1000);

    if (currentTime >= nearTime && currentTime <= afterTime) {
        window.location.href = 'meet.php';
    } else {
        window.location.href = "calendar.php?a=p&c=1&d=" + date + 
             "&t=" + appointmentTime + "&pID=" + pID + "&dID=" + dID + "&apID=" + apID;
    }
}

document.getElementById('confirmButton').onclick = () =>{
    window.location.href = "calendar.php?a=p&s=1"<?php if(isset( $_GET['apID'])){?>+"&apID=" + <?php echo $_GET['apID'];}?>;
}
document.getElementById('cancelButton').onclick = () =>{
    window.location.href = "calendar.php?a=p&s=0"<?php if(isset( $_GET['apID'])){?>+"&apID=" + <?php echo $_GET['apID'];}?>;

}
function cancelDialogBox(){
    window.location.href = "calendar.php";
}
function cancelAppointment(){
    window.location.href = 'controls/processing.php?a=pc&apID=' <?php if(isset( $_GET['apID'])){ echo '+'.$_GET['apID'];}?> +'&pID=' <?php if(isset($_GET['pID'])){ echo '+'.$_GET['pID'];}else if(isset( $_GET['p'])){ echo '+'.$_GET['p'];}?>;
}
function toChat(){
    // add link to patient-doctor chat
    window.location.href = 'chats/chats-home.php';
}
function toPatientRecords(){
    window.location.href = 'patient-records.php';
}
function showLastWeek(){
    window.location.href = 'calendar.php?w=' <?php  if(isset($_GET['w'])){ echo '+'. (int)$_GET['w'] - 1; }else { echo '+'. -1;} ?>;
}
function showNextWeek(){
    window.location.href = 'calendar.php?w=' <?php if(isset($_GET['w'])){ echo '+'.  (int)$_GET['w'] + 1; }else { echo '+'. +1;} ?> ;
}
</script>
</html>
