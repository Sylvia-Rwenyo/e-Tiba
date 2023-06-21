<?php
include_once "conn.php";

// register patients 
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
	 $sql = "INSERT INTO regPatients (firstName, lastName, emailAddress, institution,  password, illness, address, age, gender)
	 VALUES ('$firstName','$lastName', '$emailAddress','$institution', '$password', '$condition', '$address', '$age', '$gender')";

     //if sql query is executed...
	 if (mysqli_query($conn, $sql)) {
        login($conn);
			 } else {	
                //show error
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
     //close connection
	 mysqli_close($conn);

}

// register hospitals 
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
	 $sql = "INSERT INTO regInstitutions (institutionName, location, emailAddress, phoneNumber,  password, illnesses, postalAddress)
	 VALUES ('$institutionName','$location', '$emailAddress','$phoneNumber', '$password', '$conditions', '$postalAddress')";

     //if sql query is executed...
	 if (mysqli_query($conn, $sql)) {
        login($conn);
			 } else {	
                //show error
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
     //close connection
	 mysqli_close($conn);

}

// register private practice doctors 
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
	 $sql = "INSERT INTO regDoctors (firstName, lastName, emailAddress, institution,  password, specialty, address, age, gender)
	 VALUES ('$firstName','$lastName', '$emailAddress','$institution', '$password', '$condition', '$address', '$age', '$gender')";

     //if sql query is executed...
	 if (mysqli_query($conn, $sql)) {
        login($conn);
			 } else {	
                //show error
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
     //close connection
	 mysqli_close($conn);

}

if(isset($_POST['logIn']))
{
    //create session
    session_start();
    login($conn);
}

function login($conn){
    //import variables
    session_start();
    extract($_POST);
    $emailAddress = $_POST ["emailAddress"];
    $password = $_POST ["password"];
    $stmt;
     //statement to select values from the registration table in the database
    $stmt = "SELECT * FROM regPatients where emailAddress='$emailAddress' and password='$password'";
    $sql=mysqli_query($conn, $stmt);
    $row  = mysqli_fetch_array($sql);
    if(is_array($row)){
        $_SESSION['category'] = 'patient';
        $_SESSION["email"]=$row['emailAddress'];
        $_SESSION["username"] = $row['firstName'];
        $_SESSION["id"]=$row['id'];
        $_SESSION["loggedIN"] = true;
        header('location:dashboard.php');
    }else{
        $stmt = "SELECT * FROM regDoctors where emailAddress='$emailAddress' and password='$password'"; 
        $sql=mysqli_query($conn, $stmt);
        $row  = mysqli_fetch_array($sql);
        if(is_array($row)){
            $_SESSION['category'] = 'doctor';
            $_SESSION["email"]=$row['emailAddress'];
            $_SESSION["username"] = $row['firstName'];
            $_SESSION["id"]=$row['id'];
            $_SESSION["loggedIN"] = true;
            header('location:dashboard.php');
        }else{
        $stmt = "SELECT * FROM regInstitutions where emailAddress='$emailAddress' and password='$password'"; 
        $sql=mysqli_query($conn, $stmt);
        $row  = mysqli_fetch_array($sql);
        if(is_array($row)){
            $_SESSION['category'] = 'hospital';
            $_SESSION["email"]=$row['emailAddress'];
            $_SESSION["username"] = $row['institution'];
            $_SESSION["id"]=$row['id'];
            $_SESSION["loggedIN"] = true;
            header('location:dashboard.php');
        }else{
            echo "Invalid email address /Password";
         }
}
    }
}

if(isset($_GET['action'])){
    // log out if the user selects "Log Out" on the menu bar
        if($_GET['action']== "logOut"){
            session_start();
            session_unset();
            echo ' <script> 
                        window.location.href = "index.php"
                    </script>
        '; 
        }
    
        if($_GET['action'] == "deleteAccount"){
            session_start();
            $id = $_GET['id'];
            $stmt;
            // check the user's category
            if($_SESSION['category'] == 'patient'){
             //statements to select values from the registration tables in the database
            $stmt = "DELETE FROM regPatients where id='$id'";
            }else if($_SESSION['category'] == 'doctor'){
                $stmt = "DELETE FROM regDoctors where id='$id'";
            }else if($_SESSION['category'] == 'hospital'){
                $stmt = "DELETE FROM regInstitutions where id='$id'";
            }
            $sql=mysqli_query($conn, $stmt);
             if ($sql)
              {     
                session_unset();      
                echo ' <script> 
                         window.location.href = "index.php";
                       </script>';
             } 
        
             else {
                echo "Error: " . $stmt . "
        " . mysqli_error($conn);
             }
             mysqli_close($conn);
        }
    }
    if(isset($_POST['update']))
{	 
     // specify directory for uploading the file
     $target_dir3 = "Uploads/";
     $fileName3 = basename($_FILES["profilePhoto"]["name"]);
     $targetFilePath3 = $target_dir3 . $fileName3;
     $imageFileType3 = strtolower(pathinfo($targetFilePath3,PATHINFO_EXTENSION));

    //if file input is not empty
     if(!empty($_FILES["profilePhoto"]["name"])){
     //move uploaded file
     move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $targetFilePath3);
     } 
    session_start();
   //store values submitted in the edit profile form in variables
    $id = $_POST['id'];
    $emailAddress = $_POST['emailAddress'];
    $password = $_POST['password'];
    $profilePhoto = $fileName3;
    $phoneNumber = $_POST['phoneNumber'];
    //statement to update values
    $sql = "UPDATE regPatients SET  emailAddress='$emailAddress', password='$password', 
                   profilePhoto='$profilePhoto', phoneNumber='$phoneNumber' WHERE id='$id'";

    // if sql query is executed and database connection is established
    if (mysqli_query($conn, $sql)) {
        // $_SESSION["username"]=$name;
        $_SESSION["email"]=$emailAddress;
        echo ' <script> 
        window.location.href = "settings.php";
        </script>
        ';
    } else {	
    echo "Error: " . $sql . "
" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>