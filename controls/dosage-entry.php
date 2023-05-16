<?php
extract($_POST);
include("../conn.php");
$sql=mysqli_query($conn,"SELECT * FROM dosage where dosageName='$dosageName'");
if(mysqli_num_rows($sql)>0)
{
    echo "Medicine Dosage Already Exists For This Patient"; 
	exit;
}
else
{
    $query="INSERT INTO dosage(dosageName, tablets, times_a_day, number_of_days) VALUES ('$dosageName', '$tablets', '$timesADay', '$numberOfDays')";
    $sql=mysqli_query($conn,$query)or die("Could Not Perform the Query");
    header ("Location: ../dosage-registration.php?status=success");
}

?>