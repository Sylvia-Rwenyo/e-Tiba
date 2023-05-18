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
     $age = $_POST['age'];
     $address = $_POST['address'];
	 $gender = $_POST['gender'];
    
     
     //statement to enter values into the registration table in the database
	 $sql = "INSERT INTO registration (firstName, lastName, emailAddress, institution,  password, illness, address, age, gender)
	 VALUES ('$firstName','$lastName', '$emailAddress','$institution', '$password', '$condition', '$address', '$age', '$gender')";

     //if sql query is executed...
	 if (mysqli_query($conn, $sql)) {
        $_SESSION["signedIn"] = true;
        $_SESSION["username"] = $firstName;
        header('location:dashboard.php');
			 } else {	
                //show error
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
     //close connection
	 mysqli_close($conn);

}
if(isset($_POST['reg-partner']))
{	
    //create session
    session_start();
    
    //store values submitted in the signup form in variables
	 $institutionName = $_POST['institutionName'];
     $location = $_POST['location'];
	 $emailAddress = $_POST['emailAddress'];
     $phoneNumber = $_POST['phoneNumber'];

     $conditionsArr= array();
     for($i=0; $i < count($_POST['conditions']); $i++){
        $conditionsArr[] = $_POST['conditions'][$i];
         }
    $conditions = implode('*', $conditionsArr);
	$password = $_POST['password'];
    $postalAddress = $_POST['postalAddress'];
    
     
     //statement to enter values into the registration table in the database
	 $sql = "INSERT INTO regPartners (institutionName, location, emailAddress, phoneNumber,  password, illnesses, postalAddress)
	 VALUES ('$institutionName','$location', '$emailAddress','$phoneNumber', '$password', '$conditions', '$postalAddress')";

     //if sql query is executed...
	 if (mysqli_query($conn, $sql)) {
        $_SESSION["signedIn"] = true;
        $_SESSION["username"] = $institutionName;
            header('location:dashboard.php');

			 } else {	
                //show error
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
     //close connection
	 mysqli_close($conn);

}
if(isset($_POST['reg-partners']))
{	
    //create session
    session_start();
    
    //store values submitted in the signup form in variables
	 $firstName = $_POST['firstName'];
     $lastName = $_POST['lastName'];
	 $emailAddress = $_POST['emailAddress'];
     $institution = $_POST['institution'];
     $conditionsArr= array();
     for($i=0; $i < count($_POST['conditions']); $i++){
        $conditionsArr[] = $_POST['conditions'][$i];
         }
    $conditions = implode('*', $conditionsArr);	 $password = $_POST['password'];
     $age = $_POST['age'];
     $address = $_POST['address'];
	 $gender = $_POST['gender'];
    
     
     //statement to enter values into the registration table in the database
	 $sql = "INSERT INTO regPartners2 (firstName, lastName, emailAddress, institution,  password, specialty, address, age, gender)
	 VALUES ('$firstName','$lastName', '$emailAddress','$institution', '$password', '$condition', '$address', '$age', '$gender')";

     //if sql query is executed...
	 if (mysqli_query($conn, $sql)) {
        $_SESSION["signedIn"] = true;
        $_SESSION["username"] = $firstName;
        header('location:dashboard.php');
			 } else {	
                //show error
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
     //close connection
	 mysqli_close($conn);

}
?>