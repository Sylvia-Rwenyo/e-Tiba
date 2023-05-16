<?php
include_once '../conn.php';
{
	$id = $_GET['id'];
     $sql = "DELETE FROM dosage WHERE dosageId=$id";
	 if (mysqli_query($conn, $sql))
	  {echo "<script>
		alert(\"Item deleted\");
		window.location.href=\"../dosage-registration.php\";
		</script>";	
     } 
	 else 
     {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}


?>