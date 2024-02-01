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
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="style.css">
    <title>Records of Patients</title>
</head>
<body class="profileBody" id="patient-records" >
    <div class="header">
        <?php include_once 'notif-menu.php';?>
    </div>
    <div class="mainBody" id="patient-records-section">
    <?php 
        include_once 'dash-menu.php';
    ?>
        <section class="main-section" id="patient-records-main-section">
        <div class="records-header">
            <h2>Patients</h2>
            <!-- search functionality to be added -->
            <div class="search-bar" style="width:100%;display:flex;flex-direction:column;">
                <form action = "" method = "GET" class = "form-inline" style="width:100%">
                    <input id="search" name = "keyword" type = "text" placeholder = "Search Patient..." class = "form-control" value = "<?php echo isset($_POST['keyword'])?$_POST['keyword']:''?>"/>
                    <button class="search-btn" type="submit" name = "search"><i class="fa fa-search"></i></button>
                </form>
                <div id="suggestion" class="suggestion"></div>
        `   </div>
            <!-- filter/sort functionality -->
            <div class="search-indicators">
                <span id="all-indicator" onclick="sort('all')">All</span>
                <span id="attended-indicator" onclick="sort('my-dosage')">Attended</span>
                <span id="atRisk-indicator" onclick="sort('at-risk')">At risk</span>
            </div>
        </div>
        <table>
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
                $records = "SELECT * FROM regPatients where institution='$username'";
            }else if($_GET['a'] == 'd'){
                $records = "SELECT * FROM regPatients where id in (SELECT patientID FROM appointments WHERE doctorID = '$id')";
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
                $records = "SELECT * FROM regPatients where id in (SELECT patientID FROM appointments WHERE doctorID = '$doct_id')";
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
        }
        else if(isset($_GET['d'])){
            $records = "SELECT * FROM regPatients where id in (SELECT patientID FROM appointments WHERE doctorID = '$doct_id')";
            echo '
            <style>
                #attended-indicator{
                    background-color:#408DCE;
                    border: none;
                }
                #attended_to_table{
                    display:none;
                }
            </style>
            ';
        }
        else if(isset($_GET['id'])){
            $requested_patient = $_GET['id'];
            $records = "SELECT * FROM regPatients where id = '$requested_patient'";
        }else if(isset($_GET['search'])){

            $keyword = $_GET['keyword'];
            $records = "SELECT * FROM regPatients WHERE emailAddress LIKE '$keyword' OR firstName LIKE '$keyword' OR lastName LIKE '$keyword'";
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
        $stmt3 = mysqli_query($conn, $records);
        if (mysqli_num_rows($stmt3) > 0) {
        $i=0;
        ?>
        <tr >
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
        include 'risk-prediction.php';            
        while($result = mysqli_fetch_array($stmt3)) {
        ?>
        <tr id="<?php echo $result['id']?>">
            <td><?php echo $result['firstName'].' '.$result['lastName']?></td>
            <td><?php echo $result['emailAddress']?></td>
            <td><?php echo $result['phoneNumber']?></td>
            <td><?php echo $result['address']?></td>
            <td><?php $illness =  explode('*',$result['illness']); for($i=0; $i<count($illness); $i++){echo $illness[$i]. ' ';}?></td>
            <td><?php 
                $status =$predictedRiskLevel;

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
                case 3:
                    echo "Insufficient Data for Prediction";
            }
             
             ?></td>
            <td onclick="toSinglePatientRecords(<?php echo $result['id']?>)"><i class="fa-solid fa-folder"></i></td>
            <td onclick="toPatientCalendar(<?php echo $result['id']?>)"><i class="fa fa-calendar"></i></td>
        </tr>
        <?php
        }
        $i++;
    }else{
        '<tr>There are no records of patients matching your selected criteria</tr>';
    }
        ?>
        </table>    
        </section>
    </div>
</body>
</html>
<script>
    function toSinglePatientRecords(patientID){
        window.location.href = 'doctors/single-patient-records.php?p='+patientID;
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
// function fetchData() {
// $.ajax({
//     url: 'patient-records.php', // Replace with your server-side script URL
//     method: 'GET',
//     success: function(response) {
//     // Handle the response and update the HTML content
//     $('#patient-records').html(response);
//     console.log("all good");
//     },
//     error: function(xhr, status, error) {
//     // Handle errors
//     console.error(error);
//     }
// });
// }

// // Call the getNewData function periodically to fetch new data
// setInterval(fetchData, 60000);

// </script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/code.jquery.com_jquery-latest.js"></script>
<script src="js/jquery.timers-1.0.0.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //autocomplete 1
        $("#search").keyup(function(e){
            var search_query = $(this).val();
            if(search_query != ""){
                $.ajax({
                    url:"suggest-patient-srch.php",
                    type: "POST",
                    data: {search: search_query},
                    success: function($data){
                        $("#suggestion").fadeIn('fast').html($data);
                    }
                });
            }
            else{
                $("#suggestion").fadeOut();
            }
        })
    });
</script>