<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../favicon.ico" />
    <link rel="stylesheet" href="../style.css"></link>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/1d95bf24b3.js"></script>
    <title>nafuu</title>
</head>

<body class="reg-body" id="dosage-reg">
    <div class="menu-bar">
        <div class="welcome-msg" style="display:inline-block">
            <h1>Prescription Entry, by Doctor</h1>
            <div class="dosage_for_title">
                <?php
                include_once "../conn.php";
                @session_start();
                if(isset($_GET['id'])){
                    $requested_patient = $_GET['id'];
                }
                $current_user_email = $_SESSION['email'];
                $patient_email = 0;
                $fname_patient = 0;
                $query = "SELECT * FROM regPatients WHERE id ='$requested_patient'";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                
                while($row = mysqli_fetch_array($result))
                {
                    $patient_email = $row["emailAddress"];	
                    $fname_patient = $row["firstName"];
                }?>
                <h4>Prescription For <?php echo $fname_patient;?></h4>
            </div>
        </div>
    </div>
    <section>
        <form id="dosage-form"  action="../controls/processing.php" method="POST">
            <input type="hidden"  name="patientName" value="<?php echo $fname_patient;?>"/>
            <input type="hidden"  name="patientEmail" value="<?php echo $patient_email;?>"/>
            <input type="hidden"  name="patient_id" value="<?php echo $requested_patient;?>"/>
            <input type="hidden"  name="attending_doctor_name" value="<?php echo $_SESSION["username"];?>"/>
            <input type="hidden"  name="attending_doctor_email" value="<?php echo $current_user_email;?>"/>
            <input type="hidden"  name="attending_doctor_id" value="<?php echo $_SESSION["id"];?>"/>
            <input type="text" id="dosageName" name="dosageName"  size="30" placeholder="Enter Medicine Name">
            <input type="number" id="tablets" name="tablets"  size="10"  placeholder="Tablets">
            <input type="number" id="timesADay" name="timesADay"  size="10"  placeholder="Times in a day">
            <input type="number" id="numberOfDays" name="numberOfDays"  size="10"  placeholder="Prescribed Duration in Days">
            <br/>
            <input id = "itemsubmit" type="submit" value="Submit" name="dosage-registration" class="pos-btn">
        </form>
    </section>
</body>
</html>