<?php
include_once "conn.php";
// define global variables

// register patients 
if(isset($_POST['register']))
{	
    //create session
    session_start();
    
    //store values submitted in the signup form in variables
	 $firstName = $_POST['firstName'];
     $lastName = $_POST['lastName'];
	 $emailAddress = $_POST['emailAddress'];
     $phoneNumber = $_POST['phoneNumber'];
     $institution = $_POST['institution'];
     $conditionsArr= array();
     for($i=0; $i < count($_POST['condition']); $i++){
        $conditionsArr[] = $_POST['condition'][$i];
         }
    $conditions = implode('*', $conditionsArr);	 $password = $_POST['password'];
     $age = $_POST['age'];
     $address = $_POST['address'];
	 $gender = $_POST['gender'];
    
     
     //statement to enter values into the registration table in the database
	 $sql = "INSERT INTO regPatients (firstName, lastName, emailAddress, institution,  password, illness, address, age, gender,phoneNumber )
	 VALUES ('$firstName','$lastName', '$emailAddress','$institution', '$password', '$conditions', '$address', '$age', '$gender', '$phoneNumber')";

     //if sql query is executed...
	 if (mysqli_query($conn, $sql)) {
        if(!isset($_SESSION['category'])){
        login($conn);
        }else{
            header('location:dashboard.php');
        }
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
        header('location:dashboard.php');
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
            $_SESSION["username"] = $row['institutionName'];
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

// handle data submitted by user
if (isset($_POST["record-sleep"])) {
    // Start a session
    session_start();

    // Get the form values
    $start = $_POST['start-time'];
    $end = $_POST['end-time'];
    $id = $_SESSION['id'];

    // Calculate sleep time based on the difference between start time and end time
    $startTime = strtotime($start);
    $endTime = strtotime($end);
    $sleepTime = ($endTime - $startTime)/3600 ; // Convert to hours

    // Insert the sleep log into the database
    $sql = "INSERT INTO patientSleepLog (userID, sleepTime) VALUES ('$id', '$sleepTime')";

    // Connect to your database and execute the SQL query
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (mysqli_query($conn, $sql)) {
        echo ' 
        <script> 
            window.location.href = "patient-log.php"
        </script>';
    }else{
        // Show error if the SQL query is not executed
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    // Close the database connection
    mysqli_close($conn);
}

if(isset($_POST["record-meal"]))
{	
    //create session
    session_start();
    
    //store values submitted in the signup form in variables
	 $mealName = $_POST['meal-name'];
     $mealTime = $_POST['meal-time'];
     $id = $_SESSION['id'];
     //statement to enter values into the registration table in the database
	 $sql = "INSERT INTO patientsMealLog (userID, mealName, mealTime)
	 VALUES ('$id','$mealName','$mealTime')";

     //if sql query is not executed...
	 if (mysqli_query($conn, $sql)) {
        echo ' 
        <script> 
            window.location.href = "patient-log.php"
        </script>';
      }else{
                //show error
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	     }
     //close connection
	 mysqli_close($conn);

}
if(isset($_POST["record-medTime"]))
{	
    //create session
    session_start();
    
    //store values submitted in the  form in variables
	 $medName = $_POST['med-name'];
     $medTime = $_POST['med-time'];
     $id = $_SESSION['id'];
     //statement to enter values into a table in the database
	 $sql = "INSERT INTO patientMedLog (userID, medName, medTime)
	 VALUES ('$id','$medName','$medTime')";

     //if sql query is not executed...
	 if (mysqli_query($conn, $sql)) {
        echo ' 
        <script> 
            window.location.href = "patient-log.php"
        </script>';
    }else{
                //show error
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	
     }
     //close connection
	 mysqli_close($conn);

}

// video chat back end

if (isset($_POST['action']) && $_POST['action'] === 'offer') {
    session_start();
    // Retrieve the offer SDP from the client
    $offerSdp = $_POST['offerSdp'];

    // Store the offer SDP in the session
    $_SESSION['offerSdp'] = $offerSdp;

    // Send the offer SDP to the other peer or save it for later use

    // Prepare the response
    $response = array('status' => 'success');

    // Send the response back to the client
    echo json_encode($response);
    exit();
}

if (isset($_POST['action']) && $_POST['action'] === 'answer') {
    session_start();
    // Retrieve the answer SDP from the client
    $answerSdp = $_POST['answerSdp'];

    // Send the answer SDP to the other peer or save it for later use

    // Prepare the response
    $response = array('status' => 'success');

    // Send the response back to the client
    echo json_encode($response);
    exit();
}

if (isset($_POST['action']) && $_POST['action'] === 'candidate') {
    session_start();
    // Retrieve the ICE candidate from the client
    $candidate = json_decode($_POST['candidate']);

    // Send the ICE candidate to the other peer or save it for later use

    // Prepare the response
    $response = array('status' => 'success');

    // Send the response back to the client
    echo json_encode($response);
    exit();
}
?>