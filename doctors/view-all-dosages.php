<?php 
    include_once '../conn.php';
    @session_start();
    if($_SESSION["loggedIN"] == false)
    {
        echo ' <script> 
        window.location.href = "../index.php";
        </script>';       
    }
?>
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

<body class="dash-body" id="patient_records">
    <?php
        $current_user_name = $_SESSION['username'];
    ?>
    <div class = "records-container">
    <section>
        <div class="menu-bar">
            <div class="welcome-msg" style="display:inline-block">
                <h1>Dosage Details</h1>
                <h3>All Prescriptions Administered To Patients</h3>
            </div>
        </div>
        <div class="dosage_records">
            <table>
                <tr class="table_field_names">
                    <th>Patient name</th>
                    <th>Medicine name</th>
                    <th>Administered By</th>
                    <th>Number of Tablets</th>
                    <th>Number of Days</th>
                    <th>Number of Times a Day</th>
                </tr>
                
                <?php
                $current_user_id = $_SESSION['id'];
                $resultPost = mysqli_query($conn,"SELECT * FROM dosage");
                while($row = mysqli_fetch_array($resultPost)) {
                ?>
                <tr class="table_field_items">
                    <td>
                    <?php echo $row["patientName"]; ?>
                    </td> 
                    <td>
                    <?php echo $row["dosageName"]; ?>
                    </td> 
                    <td>
                    <?php echo $row["attending_doctor_name"]; ?>
                    </td>
                    <td>
                    <?php echo $row["tablets"]; ?>
                    </td>
                    <td>
                    <?php echo $row["times_a_day"]; ?>
                    </td> 
                    <td>
                    <?php echo $row["number_of_days"]; ?>
                    </td>
                    <td>
                    <a  href="dosage-update-form.php?id=<?php echo $row["dosageId"]; ?>" method="POST">
                        <button id = "dosage-update" type="button" name="dosage-update" class="pos-btn"><i class="fa fa-edit"></i>Update</button>
                    </a>
                    </td>                        
                </tr>   
                 
                <?php }?>  
                   
            </table>
        </div>
    </section>
    </div>
</body>
</html>