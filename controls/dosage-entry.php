<?php
extract($_POST);
include("..conn.php");
$sql=mysqli_query($conn,"SELECT * FROM dosage where dosage-name='$dosage-name'");
if(mysqli_num_rows($sql)>0)
{
    echo "Medicine Dosage Already Exists For This Patient"; 
	exit;
}
else
{
    $query="INSERT INTO dosage(dosage-name, tablets, times-a-day, number-of-days) VALUES ('$dosage-name', '$tablets', '$times-a-day', '$number-days')";
    $sql=mysqli_query($conn,$query)or die("Could Not Perform the Query");
    header ("Location: ..dosage-registration.php?status=success");
}

?>