<?php
include_once 'database.php';
{
	$id = $_GET['id'];
     $sql = "DELETE FROM item WHERE i_id=$id";
	 if (mysqli_query($conn, $sql))
	  {echo "<script>
		alert(\"Item deleted\");
		window.location.href=\"ItemView.php\";
		</script>";	
     } 
	 else 
     {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}


?>