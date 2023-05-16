<?php
include_once '../conn.php';

if(isset($_POST['save']))
{
	$id = $_GET['id'];
	$dosageName = $_POST['dosageName'];
	$tablets = $_POST['tablets'];
	$numberOfDays = $_POST['numberOfDays'];
	$timesADay = $_POST['timesADay'];

     $sql = "UPDATE dosage SET dosageName = '$dosageName', tablets = '$tablets', number_of_days = '$numberOfDays', times_a_day = '$timesADay' WHERE dosageId=$id";
    
	 if (mysqli_query($conn, $sql)) 
     {
		echo "<script> alert(\"Item updated\");window.location.href=\"../dosage-registration.php\"; </script>";	 
    } 
    else 
    {
        echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}

?>