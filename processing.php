<?php
include_once "conn.php";
if(isset($_POST['register']))
{	
    //create session
    session_start();
    
    //store values submitted in the signup form in variables
	 $firstName = $_POST['firstName'];
     $lastName = $_POST['lastName'];
	 $emailAddress = $_POST['emailAddress'];
     $institution = $_POST['institution'];
     $condition = $_POST['condition'];
	 $password = $_POST['password'];
    
     
     //statement to enter values into the registration table in the database
	 $sql = "INSERT INTO registration (firstName, lastName, emailAddress, institution,  password, illness)
	 VALUES ('$firstName','$lastName', '$emailAddress','$institution',   '$password', '$condition')";

     //if sql query is executed...
	 if (mysqli_query($conn, $sql)) {
        $_SESSION["loggedIN"] = true;
        $_SESSION["username"] = $firstName;
            header('location:');

			 } else {	
                //show error
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
     //close connection
	 mysqli_close($conn);

}
?>