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
    <script src="js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="style.css">
    <title>Records of Doctors</title>
</head>
<body class="profileBody" id="doctor-records-main" >
    <div class="header">
        <?php include_once 'notif-menu.php';?>
    </div>
    <div class="mainBody" id="doctor-records-section">
    <?php 
        include_once 'dash-menu.php';
        $id = $_SESSION['id'];
    ?>
    <section id="doctor-records-main" class="main-section">
        <a data-toggle="modal" data-target="#quotation-form" class="btn">Get quotation</a>
        <div id="quotation-form" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Get a Quota</h5>
                        <span>Tell us more about your institution so that we can tailor our service's price to you</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Fill all the fields as required</p>
                        <form id="quotation-form" method="POST" action="create_order.php">
                            <p>Contact Information</p>
                            <div class="input-group mb-3">
                                <div class="input-group-append" style="background: transparent; margin-left: 20px;border-left-radius: 5px;">
                                    <span class="input-group-text" id="basic-addon2">Chief Medical Officer:</span>
                                </div>
                                <input type="number" class="custom-select" name="CMO_Name" placeholder="full name">
                                <input type="number" class="custom-select" name="phoneNumber" placeholder="phone number">
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" style="width: 48%; color: 35b6be; border: 1px solid 35b6be; background: transparent" data-dismiss="modal">Cancel</button>
                        <button type="button" id="confirm-payment-form" class="btn" style="width: 48%; color: white; background-color: 35b6be;">Finish</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="records-header">
            <!-- search/sort functionality -->
            <?php
                include_once 'doctor-records-search-div.php';
            ?>
        </div>
        <table>
        <tr>
            <th>Full Name</th>
            <th>Email Address</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Specialty</th>
            <th>Records</th>
            <th>calendar</th>
        </tr>
        <?php
        if(isset($_GET['id'])){
            $requested_patient = $_GET['id'];
            $records = "SELECT * FROM regDoctors where id = '$requested_patient'";
        }
        else{
            $username = $_SESSION['username'];
            $records = mysqli_query($conn,"SELECT * FROM regDoctors where institution='$username'");
        }
        if (mysqli_num_rows($records) > 0) {
        $i=0;
        while($result = mysqli_fetch_array($records)) {
        ?>
        <tr>
            <td><?php echo $result['firstName'].' '.$result['lastName']?></td>
            <td><?php echo $result['emailAddress']?></td>
            <td><?php echo $result['phoneNumber']?></td>
            <td><?php echo $result['address']?></td>
            <td><?php echo $result['specialty']?></td>
            <td onclick="toPatientRecords('<?php echo $result['id']?>')"><i class="fa-solid fa-folder"></i></td>
            <td onclick="toDoctorCalendar('<?php echo $result['id']?>')"><i class="fa fa-calendar"></i></td>
        </tr>
        <?php
        }
        $i++;
    }
        ?>
        </table>
        </section>
    </div>
</body>
</html>
<script src="js/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="js/fontawesome.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script>
    function toPatientRecords(doctorID){
        window.location.href = 'patient-records.php?d=' + doctorID ;
    }
    function toDoctorCalendar(doctorID){
        window.location.href = 'calendar.php?d=' + doctorID ;
    }
function fetchData() {
$.ajax({
    url: 'doctor-records.php', // Replace with your server-side script URL
    method: 'GET',
    success: function(response) {
    // Handle the response and update the HTML content
    $('#doctor-records-main').html(response);
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
    
