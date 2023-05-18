<?php
extract($_POST);
include("../conn.php");
$sql=mysqli_query($conn,"SELECT * FROM patient-info where name='$name' AND national-id='$nationalId'");
if(mysqli_num_rows($sql)>0)
{
    echo "User Already Registered"; 
	exit;
}
else
{
    $query="INSERT INTO patient-info(name, illness, date_diagnosed, national-id) VALUES ('$name', '$illness','$dateDiagnosed', '$nationalId')";
    $sql=mysqli_query($conn,$query)or die("Could Not Perform the Query");
    header ("Location: ../index.php?status=success");
}

?>