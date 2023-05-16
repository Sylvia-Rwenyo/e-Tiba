<?php
include_once 'database.php';

if(isset($_POST['save']))
{
	$id = $_GET['id'];
	$i_name = $_POST['name'];
	 $s_price = $_POST['s_price'];

     $sql = "UPDATE item SET i_name = '$i_name', s_price = '$s_price' WHERE i_id=$id";
    
	 if (mysqli_query($conn, $sql)) 
     {
		echo "<script> alert(\"Item updated\");window.location.href=\"ItemView.php\"; </script>";	 
    } 
    else 
    {
        echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}

?>