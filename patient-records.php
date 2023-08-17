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
        <div class="records-header">
            <h2>Patients</h2>
            <!-- search functionality to be added -->
            <!-- filter/sort functionality -->
            <div>
                <span id="all-indicator" onclick="sort('all')">All</span>
                <span id="attended-indicator" onclick="sort('my-dosage')">Attended</span>
                <span id="atRisk-indicator" onclick="sort('at-risk')">At risk</span>
            </div>
        </div>
        <table>
        <tr>
            <th>Full Name</th>
            <th>Email Address</th>
            <th>Phone No.</th>
            <th>Address</th>
            <th>Condition</th>
            <th>Risk</th>
            <th>Records</th>
            <th>calendar</th>
        </tr>
        <?php
            $username = $_SESSION['username'];
            $id = $_SESSION['id'];
            $doct_id = 0;
            if(isset($_GET['d'])){
                $doct_id = $_GET['d'];
            }
            $institution = '';
            $institutionName = '';
            $records = '';
            if($_SESSION['category'] == 'doctor'){
                $institutionName = mysqli_query($conn,"SELECT institution FROM regDoctors where id='$id'");
                if (mysqli_num_rows($institutionName) > 0) {
                    $i=0;
                    while($result = mysqli_fetch_array($institutionName)) {
                        $institution .= $result['institution'];
                    }
                    $i++;
                }
                $records = "SELECT * FROM regPatients where institution='$institution'";
            }
            else{
            $records = "SELECT * FROM regPatients where institution='$username'";
            }
             // show filter/sort criteria
        if(isset($_GET['a'])){
            if($_GET['a'] == 'l'){
                echo '
                <style>
                    #all-indicator{
                        background-color:#408DCE;
                        border: none;
                    }
                </style>
                ';
            }else if($_GET['a'] == 'd'){
                $records = "SELECT * FROM regpatients where id in (SELECT patientID FROM appointments WHERE doctorID = '$id')";
                echo '
                <style>
                    #attended-indicator{
                        background-color:#408DCE;
                        border: none;
                    }
                </style>
                ';
            }
            else if(isset($_GET['d'])){
                $records = "SELECT * FROM regpatients where id in (SELECT patientID FROM appointments WHERE doctorID = '$doct_id')";
                echo '
                <style>
                    #attended-indicator{
                        background-color:#408DCE;
                        border: none;
                    }
                </style>
                ';
            }
            else if($_GET['a'] == 'r'){
                $records .= " ORDER BY status DESC ";
                echo '
                <style>
                    #atRisk-indicator{
                        background-color:#408DCE;
                        border: none;
                    }
                </style>
                ';
            }
        }else{
            echo '
                <style>
                    #all-indicator{
                        background-color:#408DCE;
                        border: none;
                    }
                </style>
                ';
        }
        $stmt = mysqli_query($conn, $records);
        if (mysqli_num_rows($stmt) > 0) {
        $i=0;
        while($result = mysqli_fetch_array($stmt)) {
        ?>
        <tr>
            <td><?php echo $result['firstName'].' '.$result['lastName']?></td>
            <td><?php echo $result['emailAddress']?></td>
            <td><?php echo $result['phoneNumber']?></td>
            <td><?php echo $result['address']?></td>
            <td><?php $illness =  explode('*',$result['illness']); for($i=0; $i<count($illness); $i++){echo $illness[$i]. ' ';}?></td>
            <td><?php 
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
             
             ?></td>
            <td onclick="toSinglePatientRecords(<?php echo $result['id']?>)"><i class="fa-solid fa-folder"></i></td>
            <td onclick="toPatientCalendar(<?php echo $result['id']?>)"><i class="fa fa-calendar"></i></td>
        </tr>
        <?php
        }
        $i++;
    }
        ?>
        </table>
        <br/><br/>
        <table>
        <tr>
            <th>Full Name</th>
            <th>Email Address</th>
            <th>Phone No.</th>
            <th>Address</th>
            <th>Condition</th>
            <th>Doctor Attending</th>
        </tr>
        <?php
        $current_user_id = $_SESSION['id'];
        if($_SESSION['category'] == 'doctor'){
            $doct_name = $_SESSION['username'];
            $resultPost = mysqli_query($conn,"SELECT * FROM regpatients WHERE id IN (SELECT patientID FROM appointments  WHERE doctorID = '$current_user_id')");
        }
        else{
            $institution = $_SESSION['username'];
            $resultPost = mysqli_query($conn,"SELECT * FROM regpatients WHERE id IN (SELECT patientID FROM appointments  WHERE doctorID IN (SELECT id FROM regdoctors WHERE institution = '$institution' and id = '$doct_id'))");
            $mini_query = mysqli_query($conn,"SELECT * FROM regdoctors WHERE id = '$doct_id'");
            while($row = mysqli_fetch_array($mini_query)) {
                $doct_name = $row['firstName'];
            }
        }
        while($row = mysqli_fetch_array($resultPost)) {
        ?>
        <tr>
            <td><?php echo $row["firstName"]; ?></td>
            <td><?php echo $row["emailAddress"]; ?></td>
            <td><?php echo $row["phoneNumber"]; ?></td>
            <td><?php echo $row["address"]; ?></td>
            <td><?php echo $row["illness"]; ?></td>
            <td><?php echo $doct_name ?></td>
        </tr><?php 
        }?>
        </section>
    </div>
</body>
</html>
<script>
    function toSinglePatientRecords(patientID){
        window.location.href = 'single-patient-records.php?p='+patientID;
    }
    function toPatientCalendar(patientID){
        window.location.href = 'calendar.php?p='+patientID;
    }
    // sort patient records display
function sort(criteria){
    if(criteria == 'all'){
        window.location.href = 'patient-records.php?a=l';
    }else  if(criteria == 'at-risk'){
        window.location.href = 'patient-records.php?a=r';
    }
    else  if(criteria == 'my-dosage'){
        window.location.href = 'patient-records.php?a=d';
    }
}
function fetchData() {
$.ajax({
    url: 'patient-records.php', // Replace with your server-side script URL
    method: 'GET',
    success: function(response) {
    // Handle the response and update the HTML content
    $('#patient-records-section').html(response);
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

// </script>
    