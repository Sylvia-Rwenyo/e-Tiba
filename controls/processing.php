<?php
include_once "../conn.php";
// define global variables

// register patients 
if(isset($_POST['register']))
{	
    //create session
    @session_start();
    
    //store values submitted in the signup form in variables
	 $firstName = htmlspecialchars($_POST['firstName']);
     $lastName = htmlspecialchars($_POST['lastName']);
	 $emailAddress = filter_var($_POST['emailAddress'], FILTER_SANITIZE_EMAIL);
     $password = htmlspecialchars($_POST['password']);
    
    //encrypt the password to insert
    $password = openssl_encrypt($password, "AES-128-ECB", $SECRETKEY);
    
    //  check for duplicate entries first
     $sql_e=mysqli_query($conn,"SELECT * FROM regpatients where emailAddress='$emailAddress'");
        if(mysqli_num_rows($sql_e)>0)
        {
            echo '<script> 
            window.location.href = "../register.php?e=3"
            </script>';
        }
     //statement to enter values into the registration table in the database
	 $sql = "INSERT INTO regpatients (firstName, lastName, emailAddress,  password)
	 VALUES ('$firstName','$lastName', '$emailAddress', '$password')";

     //if sql query is executed...
	 if (mysqli_query($conn, $sql)) {
        if(!isset($_SESSION['category'])){
        login($conn, $SECRETKEY);
        }else{
            echo ' <script> 
                    window.location.href = "../dashboard.php"
                </script>';
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
    @session_start();
    
    //store values submitted in the signup form in variables
	 $institutionName = htmlspecialchars($_POST['institutionName']);
     $location = htmlspecialchars($_POST['location']);
	 $emailAddress = filter_var($_POST['emailAddress'], FILTER_SANITIZE_EMAIL);
     $phoneNumber = htmlspecialchars($_POST['phoneNumber']);

     $conditionsArr= array();
     for($i=0; $i < count($_POST['conditions']); $i++){
        $conditionsArr[] = $_POST['conditions'][$i];
         }
    $conditions = implode('*', $conditionsArr);
	$password = $_POST['password'];
    
    //encrypt the password to insert
    $password = openssl_encrypt($password, "AES-128-ECB", $SECRETKEY);

    $postalAddress = htmlspecialchars($_POST['postalAddress']);
    
     
     //statement to enter values into the registration table in the database
	 $sql = "INSERT INTO reginstitutions (institutionName, location, emailAddress, phoneNumber,  password, illnesses, postalAddress)
	 VALUES ('$institutionName','$location', '$emailAddress','$phoneNumber', '$password', '$conditions', '$postalAddress')";

     //if sql query is executed...
	 if (mysqli_query($conn, $sql)) {
        login($conn,$SECRETKEY);
			 } else {	
                //show error
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
     //close connection
	 mysqli_close($conn);

}

if(isset($_POST['add-patient'])){
    //create session
    session_start();

    $firstName = htmlspecialchars($_POST['firstName']);
     $lastName = htmlspecialchars($_POST['lastName']);
     $age = $_POST['age'];
     $gender = htmlspecialchars($_POST['gender']);
	 $emailAddress = filter_var($_POST['emailAddress'], FILTER_SANITIZE_EMAIL);
     $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
     $address = htmlspecialchars($_POST['address']);
     $institution = htmlspecialchars($_POST['institution']);
     $conditionsArr= array();
     for($i=0; $i < count($_POST['condition']); $i++){
        $conditionsArr[] = $_POST['condition'][$i];
         }
    $conditions = implode('*', $conditionsArr);   
    $password = substr($emailAddress, 0, strpos($emailAddress, "@"));
    //encrypt the password to insert
    $password = openssl_encrypt($password, "AES-128-ECB", $SECRETKEY); 
	 
    $sql=mysqli_query($conn,"SELECT * FROM regpatients where emailAddress='$emailAddress' || phoneNumber='$phoneNumber'");
    if(mysqli_num_rows($sql)>0)
    {
        echo "Patient Already Registered"; 
        exit;
    }
    else
    {
        $query="INSERT INTO regpatients(firstName, password, lastName, age, gender, emailAddress, phoneNumber, address, institution, illness) VALUES ('$firstName', '$password' ,'$lastName' ,'$age' ,'$gender' ,'$emailAddress' ,'$phoneNumber' ,'$address' ,'$institution' ,'$conditions')";
    }
    //if sql query is executed...
    if (mysqli_query($conn, $query)) {
        header('location:../patient-records.php?status=success');
    }
	else {	
        //show error
		echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    //close connection
    mysqli_close($conn);
}

if(isset($_POST['register-doc'])){
    //create session
    @session_start();

    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $gender = htmlspecialchars($_POST['gender']);
    $emailAddress = filter_var($_POST['emailAddress'], FILTER_SANITIZE_EMAIL);
    $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
    $institution = htmlspecialchars($_POST['institution']);
    $conditionsArr= array();
     for($i=0; $i < count($_POST['conditions']); $i++){
        $conditionsArr[] = $_POST['conditions'][$i];
         }
    $conditions = implode('*', $conditionsArr);	 
    $password = $_POST['password'];
    $address = htmlspecialchars($_POST['address']);
    $years = filter_var($_POST['years'], FILTER_SANITIZE_NUMBER_INT);//years experience

    
    //encrypt the password to insert
    $password = openssl_encrypt($password, "AES-128-ECB", $SECRETKEY);
	 
    $sqlp=mysqli_query($conn,"SELECT * FROM regdoctors where emailAddress='$emailAddress' AND phoneNumber='$phoneNumber'");
    if(mysqli_num_rows($sqlp)>0)
    {
        echo "Doctor Already Registered"; 
        exit;
    }
    else
    {
        $query="INSERT INTO regdoctors(firstName, lastName, gender, emailAddress, institution, specialty, phoneNumber, address, password) VALUES ('$firstName' ,'$lastName' ,'$gender' ,'$emailAddress', '$institution', '$conditions' ,'$phoneNumber' ,'$address' ,'$password')";
    }
    //if sql query is executed...
	 if (mysqli_query($conn, $query)) {
        if(!isset($_SESSION['category'])){
        login($conn,$SECRETKEY);
        }else{
            echo ' <script> 
            window.location.href = "../dashboard.php?status=success"
        </script>';
           
        }
			 } else {	
                //show error
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
     //close connection
	 mysqli_close($conn);
}

if(isset($_POST['register-doc-by-partner'])){
    //create session
    @session_start();

    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $gender = htmlspecialchars($_POST['gender']);
    $emailAddress = filter_var($_POST['emailAddress'], FILTER_SANITIZE_EMAIL);
    $institution = $_SESSION['username'];
    $conditionsArr= array();
     for($i=0; $i < count($_POST['condition']); $i++){
        $conditionsArr[] = $_POST['condition'][$i];
         }
    $conditions = implode('*', $conditionsArr);
    $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
    $address = htmlspecialchars($_POST['address']);
    $years = filter_var($_POST['years'], FILTER_SANITIZE_NUMBER_INT);
    $password = substr($emailAddress, 0, strpos($emailAddress, "@"));
    //encrypt the password to insert
    $password = openssl_encrypt($password, "AES-128-ECB", $SECRETKEY);

	 
    $sql=mysqli_query($conn,"SELECT * FROM regdoctors where emailAddress='$emailAddress' AND phoneNumber='$phoneNumber'");
    if(mysqli_num_rows($sql)>0)
    {
        echo "Doctor Already Registered"; 
        exit;
    }
    else
    {
        $query="INSERT INTO regdoctors(firstName, lastName, gender, institution, emailAddress, specialty, phoneNumber, address, password) VALUES
         ('$firstName' ,'$lastName' ,'$gender' , '$institution' ,'$emailAddress', '$conditions', '$phoneNumber' ,'$address' ,'$password')";
    }
    //if sql query is executed...
    if (mysqli_query($conn, $query)) {
        header('location:../doctor-records.php?status=success');
    } else 
    {	
        //show error
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
     //close connection
	 mysqli_close($conn);
}


if(isset($_POST['dosage-registration'])){
    $fname_patient = $_POST["patientName"];
    $patient_email = filter_var($_POST['patientEmail'], FILTER_SANITIZE_EMAIL);
    $patient_id = $_POST["patient_id"];
    $attending_doctor_name = $_POST["attending_doctor_name"];
    $attending_doctor_email = filter_var($_POST['attending_doctor_email'], FILTER_SANITIZE_EMAIL);
    $attending_doctor_id = $_POST["attending_doctor_id"];
	$dosageName = htmlspecialchars($_POST['dosageName']);
	$tablets = filter_var($_POST['tablets'], FILTER_SANITIZE_NUMBER_INT);
	$numberOfDays = filter_var($_POST['numberOfDays'], FILTER_SANITIZE_NUMBER_INT);
	$timesADay = filter_var($_POST['timesADay'], FILTER_SANITIZE_NUMBER_INT);
    $sql=mysqli_query($conn,"SELECT * FROM dosage where dosageName='$dosageName'");
    if(mysqli_num_rows($sql)>0)
    {
        echo "Medicine Dosage Already Exists For This Patient"; 
        exit;
    }
    else
    {
        $query="INSERT INTO dosage(attending_doctor_id, attending_doctor_email, attending_doctor_name, patient_id, patientEmail, patientName, dosageName, tablets, times_a_day, number_of_days) VALUES ('$attending_doctor_id', '$attending_doctor_email', '$attending_doctor_name', '$patient_id','$patient_email', '$fname_patient', '$dosageName', '$tablets', '$timesADay', '$numberOfDays')";
        $sql=mysqli_query($conn,$query)or die("Could Not Perform the Query");
        echo ' <script> 
            window.location.href = "../single-patient-records.php?p=$patient_id"
        </script>';
    }
}

if(isset($_POST['dosage-update']))
{
	$id = $_GET['id'];
    $original_dosageName = 0;
    $original_tablets = 0;
    $original_numberOfDays = 0;
    $original_timesADay = 0;
    $query3 = "SELECT * FROM dosage WHERE dosageId ='$id'";
    $result3 = mysqli_query($conn, $query3) or die(mysqli_error($conn));
    while($row = mysqli_fetch_array($result3))
    {
        $original_dosageName = $row['dosageName'];
        $original_tablets = $row['tablets'];
        $original_numberOfDays = $row['number_of_days'];
        $original_timesADay = $row['times_a_day'];
    }
	$id = $_GET['id'];
    if(!empty($_POST['dosageName'])){
        $dosageName = htmlspecialchars($_POST['dosageName']);
    }
    else{
        $dosageName = $original_dosageName;
    }
    if(!empty($_POST['tablets'])){
        $tablets = filter_var($_POST['tablets'], FILTER_SANITIZE_NUMBER_INT);
    }
    else{
        $tablets = $original_tablets;
    }
    if(!empty($_POST['numberOfDays'])){
        $numberOfDays = filter_var($_POST['numberOfDays'], FILTER_SANITIZE_NUMBER_INT);
    }
    else{
        $numberOfDays = $original_numberOfDays;
    }
    if(!empty($_POST['timesADay'])){
        $timesADay = filter_var($_POST['timesADay'], FILTER_SANITIZE_NUMBER_INT);
    }
    else{
        $timesADay = $original_timesADay;
    }

     $sql = "UPDATE dosage SET dosageName = '$dosageName', tablets = '$tablets', number_of_days = '$numberOfDays', times_a_day = '$timesADay' WHERE dosageId=$id";
    
    if (mysqli_query($conn, $sql)) 
    {
        $query2 = "SELECT * FROM dosage WHERE dosageId ='$id'";
        $result = mysqli_query($conn, $query2) or die(mysqli_error($conn));
        while($row = mysqli_fetch_array($result))
        {
            $pId = $row['patient_id'];	
        }
        echo "<script> alert(\"Item updated\");window.location.href='../dosage-registration.php?id=$pId'; </script>";	 
    } 
    else 
    {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
	 mysqli_close($conn);
}
if(isset($_POST['dosage-delete'])){
	$id = $_GET['id'];
    $query2 = "SELECT * FROM dosage WHERE dosageId ='$id'";
    $result = mysqli_query($conn, $query2) or die(mysqli_error($conn));
    while($row = mysqli_fetch_array($result))
    {
        $pId = $row['patient_id'];	
    }
     $sql = "DELETE FROM dosage WHERE dosageId=$id";
	 if (mysqli_query($conn, $sql))
	  {echo "<script>
		alert(\"Item deleted\");
		window.location.href='../dosage-registration.php?id=$pId';
		</script>";	
     } 
	 else 
     {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}


if(isset($_POST['logIn']))
{
    login($conn,$SECRETKEY);
}

function login($conn,$SECRETKEY){
    //import variables
    @session_start();
    
    extract($_POST);
    $emailAddress = filter_var($_POST['emailAddress'], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $stmt;
    //encrypt the password to compare
    $password = openssl_encrypt($password, "AES-128-ECB", $SECRETKEY);
     //statement to select values from the registration table in the database
    $stmt = "SELECT * FROM regpatients where emailAddress='$emailAddress' and password='$password'";
    $sql=mysqli_query($conn, $stmt);
    $row  = mysqli_fetch_array($sql);
    if(is_array($row)){
echo ' <script> 
            window.location.href = "../dashboard.php";
        </script>';       
            $_SESSION['category'] = 'patient';
            $_SESSION["email"]=$row['emailAddress'];
            $_SESSION["username"] = $row['firstName'];
            $_SESSION["id"]=$row['id'];
            $_SESSION["loggedIN"] = true;
            $_SESSION["menuState"] = false;
            
            echo ' <script> 
            window.location.href = "../dashboard.php";
        </script>';
    }else{
        $stmt = "SELECT * FROM regdoctors where emailAddress='$emailAddress' and password='$password'"; 
        $sql=mysqli_query($conn, $stmt);
        $row  = mysqli_fetch_array($sql);
        if(is_array($row)){
            $_SESSION['category'] = 'doctor';
            $_SESSION["email"]=$row['emailAddress'];
            $_SESSION["username"] = $row['firstName'];
            $_SESSION["id"]=$row['id'];
            $_SESSION["loggedIN"] = true;
            $_SESSION["menuState"] = false;
             
            echo ' <script> 
            window.location.href = "../patient-records.php";
        </script>';
        }else{
        $stmt = "SELECT * FROM reginstitutions where emailAddress='$emailAddress' and password='$password'"; 
        $sql=mysqli_query($conn, $stmt);
        $row  = mysqli_fetch_array($sql);
        if(is_array($row)){
            $_SESSION['category'] = 'hospital';
            $_SESSION["email"]=$row['emailAddress'];
            $_SESSION["username"] = $row['institutionName'];
            $_SESSION["id"]=$row['id'];
            $_SESSION["loggedIN"] = true;
            $_SESSION["menuState"] = false;
            echo ' <script> 
            window.location.href = "../doctor-records.php";
        </script>';
        }else{
            echo '<script> 
            window.location.href = "../register.php?login=1&e=1"
        </script>';
         }
    }
    }
}

if(isset($_GET['action'])){
    // log out if the user selects "Log Out" on the menu bar
    if($_GET['action']== "logOut"){
        @session_start();
        session_unset();
        echo ' <script> 
                    window.location.href = "../index.php"
                </script>
    '; 
    }

    if($_GET['action'] == "deleteAccount"){
        @session_start();
        $id = $_GET['id'];
        $stmt;
        // check the user's category
        if($_SESSION['category'] == 'patient'){
            //statements to select values from the registration tables in the database
        $stmt = "DELETE FROM regpatients where id='$id'";
        }else if($_SESSION['category'] == 'doctor'){
            $stmt = "DELETE FROM regdoctors where id='$id'";
        }else if($_SESSION['category'] == 'hospital'){
            $stmt = "DELETE FROM reginstitutions where id='$id'";
        }
        $sql=mysqli_query($conn, $stmt);
            if ($sql)
            {     
            session_unset();      
            echo ' <script> 
                        window.location.href = "../index.php";
                    </script>';
            } 
    
            else {
            echo "Error: " . $stmt . "
    " . mysqli_error($conn);
            }
            mysqli_close($conn);
    }
}
// handle data submitted by user
if (isset($_POST["record-sleep"])) {
    // Start a session
    @session_start();

    // Get the form values
    $start = $_POST['start-time'];
    $end = $_POST['end-time'];
    $id = $_SESSION['id'];

    // Calculate sleep time based on the difference between start time and end time
    $startTime = strtotime($start);
    $endTime = strtotime($end);
    $sleepTime = ($endTime - $startTime)/3600 ; // Convert to hours

    // Insert the sleep log into the database
    $sql = "INSERT INTO patientsleeplog (userID, sleepTime) VALUES ('$id', '$sleepTime')";

    // Connect to your database and execute the SQL query
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (mysqli_query($conn, $sql)) {
        echo '
        <script> window.location.href="../dashboard.php"</script>
        ';
    }else{
        // Show error if the SQL query is not executed
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    // Close the database connection
    mysqli_close($conn);
}
if(isset($_POST["record-physicalActivity"]))
{	
    //create session
    @session_start();
    
    //store values submitted in the signup form in variables
     $exerciseType = '';
     $exerciseTypeArr = $_POST['exerciseType'];
     $exerciseType .= implode('*', $exerciseTypeArr);	
	 $exerciseDuration = $_POST['exerciseDuration'];
     $exerciseTime = $_POST['exerciseTime'];
     $id = $_SESSION['id'];
     //statement to enter values into the registration table in the database
	 $sql = "INSERT INTO patientsexerciselog (userID, exerciseType, exerciseTime, exerciseDuration)
	 VALUES ('$id','$exerciseType','$exerciseTime', '$exerciseDuration')";

     //if sql query is not executed...
	 if (mysqli_query($conn, $sql)) {
        echo '
        <script> window.location.href="../dashboard.php"</script>
        ';	
         }else{
                //show error
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	     }
     //close connection
	 mysqli_close($conn);

}
if(isset($_POST["record-meal"]))
{	
    //create session
    @session_start();
    
    //store values submitted in the signup form in variables
	 $mealName = htmlspecialchars($_POST['meal-name']);
     $mealTime = $_POST['meal-time'];
     $current_date = date('Y-m-d');
     $id = $_SESSION['id'];
     //statement to enter values into the registration table in the database
	 $sql = "INSERT INTO patientsmeallog (userID, mealName, mealTime, recordDate)
	 VALUES ('$id','$mealName','$mealTime', '$current_date')";

     //if sql query is not executed...
	 if (mysqli_query($conn, $sql)) {
        echo '
        <script> window.location.href="../dashboard.php"</script>
        ';	
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
    @session_start();
    
    //store values submitted in the  form in variables
	 $medName = htmlspecialchars($_POST['med-name']);
     $medTime = $_POST['med-time'];
     $id = $_SESSION['id'];
     //statement to enter values into a table in the database
	 $sql = "INSERT INTO patientmedlog (userID, medName, medTime)
	 VALUES ('$id','$medName','$medTime')";

     //if sql query is not executed...
	 if (mysqli_query($conn, $sql)) {
        echo 'Medicine intake recorded';	

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
    @session_start();
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
    @session_start();
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
    @session_start();
    // Retrieve the ICE candidate from the client
    $candidate = json_decode($_POST['candidate']);

    // Send the ICE candidate to the other peer or save it for later use

    // Prepare the response
    $response = array('status' => 'success');

    // Send the response back to the client
    echo json_encode($response);
    exit();
}

if(isset($_POST['input-message']))
{	
    //create session
    @session_start();
    //store values submitted in the chat form in variables 
    $message = $conn->real_escape_string($_POST['message']);
    //encrypt messages
    
    $message = openssl_encrypt($message, "AES-128-ECB", $SECRETKEY);

    $userId = $_SESSION['id'];
    $emailAddress = $_SESSION['email'];
    $readStatus = $_POST['readStatus'];
    $sent_to = $_POST['sent_to'];
    $sender_class = $_POST['sender_class'];
    $sent_to_id = 0;
    $query = 0;
     
    if(($_SESSION['category']) == 'patient'){
        $query2 = "SELECT id FROM regdoctors WHERE emailAddress ='$sent_to'";
        $result = mysqli_query($conn, $query2) or die(mysqli_error($conn));
        while($row = mysqli_fetch_array($result))
        {
            $sent_to_id = $row['id'];	
        }
        $chat_identity = $sent_to."_".$emailAddress;
        //statement to messages and userId in the database
        $query = "INSERT INTO chat (chat_identity, message, sender_class, sent_from_id, emailAddress, sent_to_id, sent_to, readStatus) VALUES ('$chat_identity','$message', '$sender_class','$userId', '$emailAddress', '$sent_to_id', '$sent_to', '$readStatus')";
    }
    elseif(($_SESSION['category']) == 'doctor'){
        $query2 = "SELECT id FROM regpatients WHERE emailAddress ='$sent_to'";
        $result = mysqli_query($conn, $query2) or die(mysqli_error($conn));
        while($row = mysqli_fetch_array($result))
        {
            $sent_to_id = $row['id'];	
        }
        $chat_identity = $emailAddress."_".$sent_to;
        //statement to messages and userId in the database
        $query = "INSERT INTO chat (chat_identity, message, sender_class, sent_from_id, emailAddress, sent_to_id, sent_to, readStatus) VALUES ('$chat_identity', '$message','$sender_class','$userId', '$emailAddress', '$sent_to_id', '$sent_to', '$readStatus')";
    }
    
    if (mysqli_query($conn,$query)) 
    {
        echo "<script> window.location.href= '../chats/messages-page.php?id=$sent_to_id'; </script>";	
        //add notifications here 
    } 
    else 
    {
        echo "Error: " . $query . "" . mysqli_error($conn) . "Could Not Send Message";
    }
	 mysqli_close($conn);

}

if(isset($_POST['message-delete'])){
    //create session
    @session_start();
    //store values submitted in the chat form in variables
	$id = $_GET['id'];
    $sent_to = $_POST['sent_to'];
    $sql = "DELETE FROM chat WHERE id=$id";
    $query2 = 0;
    if (mysqli_query($conn, $sql))
    {
        if(($_SESSION['category']) == 'doctor'){
            $query2 = "SELECT id FROM regpatients WHERE emailAddress ='$sent_to'";
        }
        elseif(($_SESSION['category']) == 'patient'){
            $query2 = "SELECT id FROM regdoctors WHERE emailAddress ='$sent_to'";
        }
        $result = mysqli_query($conn, $query2) or die(mysqli_error($conn));
        while($row = mysqli_fetch_array($result))
        {
            $sent_to_id = $row['id'];
            echo "<script> window.location.href= '../chats/messages-page.php?id=$sent_to_id'; </script>";	
        }
     } 
	 else 
     {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}

if(isset($_POST['submit-report-or-suggestion']))
{	
    //create session
    @session_start();
    //store values submitted in the chat form in variables 
    $message = $conn->real_escape_string($_POST['message']);
    //encrypt messages
    
    $message = openssl_encrypt($message, "AES-128-ECB", $SECRETKEY);

    $userId = $_SESSION['id'];
    $emailAddress = $_SESSION['email'];
    $readStatus = $_POST['readStatus'];
    $sent_to = $_POST['sent_to'];
    $sender_class = $_POST['sender_class'];
    $sent_to_id = 0;
    $query = 0;
     
    if(($_SESSION['category']) == 'patient' || ($_SESSION['category']) == 'doctor'){
        $query2 = "SELECT id FROM reginstitutions WHERE emailAddress ='$sent_to'";
        $result = mysqli_query($conn, $query2) or die(mysqli_error($conn));
        while($row = mysqli_fetch_array($result))
        {
            $sent_to_id = $row['id'];	
        }
        $chat_identity = $sent_to."_".$emailAddress;
        $query = "INSERT INTO reports (chat_identity, message, sender_class, sent_from_id, emailAddress, sent_to_id, sent_to, readStatus) VALUES ('$chat_identity', '$message','$sender_class','$userId', '$emailAddress', '$sent_to_id', '$sent_to', '$readStatus')";
        if (mysqli_query($conn,$query)) 
        {
            echo "<script> window.location.href= '../chats/reports-messages.php?hosp-id=$sent_to_id'; </script>";	
            //add notifications here 
        } 
        else 
        {
            echo "Error: " . $query . "" . mysqli_error($conn) . "Could Not Send Message";
        }
        mysqli_close($conn);
    }
    elseif(($_SESSION['category']) == 'hospital'){
        $query2 = "SELECT id FROM regpatients WHERE emailAddress ='$sent_to'";
        $result = mysqli_query($conn, $query2) or die(mysqli_error($conn));
        if(mysqli_num_rows($result) == 0){
            $query2 = "SELECT id FROM regdoctors WHERE emailAddress ='$sent_to'";
            $result = mysqli_query($conn, $query2) or die(mysqli_error($conn));
            if(mysqli_num_rows($result) == 0){
                echo "Error, Does not Exist from both patients and doctors records";
            }
        }
        while($row = mysqli_fetch_array($result))
        {
            $sent_to_id = $row['id'];	
        }
        $chat_identity = $emailAddress."_".$sent_to;
        $query = "INSERT INTO reports (chat_identity, message, sender_class, sent_from_id, emailAddress, sent_to_id, sent_to, readStatus) VALUES ('$chat_identity', '$message','$sender_class','$userId', '$emailAddress', '$sent_to_id', '$sent_to', '$readStatus')";
        if (mysqli_query($conn,$query)) 
        {
            $query3 = "SELECT MAX(id) FROM reports WHERE emailAddress ='$emailAddress'";
            $result = mysqli_query($conn, $query3) or die(mysqli_error($conn));
            while($row = mysqli_fetch_array($result))
            {
                $message_id = $row['id'];	
            }
            echo "<script> window.location.href= '../chats/reports-messages.php?id=$message_id'; </script>";	
            //add notifications here 
        } 
        else 
        {
            echo "Error: " . $query . "" . mysqli_error($conn) . "Could Not Send Message";
        }
        mysqli_close($conn);
    }
}
// book appointment date 
if(isset($_GET["a"])){
    if($_GET["a"] == "p"){
        //create session
        @session_start();
        
        //store values submitted in the  form in variables
         $doctorID = $_GET['dID'];
         $patientID = $_GET['pID'];
         $appointmentDate = $_GET['d'];
         $appointmentTime = $_GET['t'];
         //statement to enter values into a table in the database
         $sql = "INSERT INTO appointments (doctorID, patientID, appointmentDate, appointmentTime)
         VALUES ('$doctorID','$patientID','$appointmentDate', '$appointmentTime')";
    
         //if sql query is not executed...
         if (mysqli_query($conn, $sql)) {
            echo '
            <script>window.location.href = "../calendar.php?p='.$patientID.'"</script>
            ';	
        }else{
                    //show error
            echo "Error: " . $sql . "
    " . mysqli_error($conn);
        
         }
         //close connection
         mysqli_close($conn);
    
    }
    if($_GET["a"] == "pc"){
        $patientID = $_GET['pID'];
        $appointmentID = $_GET['apID'];
        $sql = "UPDATE appointments SET  cancelled=1 WHERE appointmentID='$appointmentID'";
         //if sql query is not executed...
         if (mysqli_query($conn, $sql)) {
            echo '
            <script>window.location.href = "../calendar.php?p='.$patientID.'"</script>
            ';	
        }else{
                    //show error
            echo "Error: " . $sql . "
    " . mysqli_error($conn);
        
         }
         //close connection
         mysqli_close($conn);
    }}


    if(isset($_POST["delete-med-record"])){
        //import variables
        session_start();
        $medId = $_GET['id'];
        $query = "DELETE * FROM medicine WHERE medId='$medId'";
        if (mysqli_query($conn, $query))
        {echo "<script>
            alert(\"Item deleted\");
            window.location.href='../add-medicine.php';
            </script>";	
         } 
         else 
         {
            echo "Error: " . $query . "" . mysqli_error($conn);
         }
         mysqli_close($conn);
    }

    if(isset($_POST['add-med'])){
        //import variables
        session_start();
        $medName = htmlspecialchars($_POST['medName']);
        $medManufacturer = htmlspecialchars($_POST['manufacturer']);
        $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
        $hospId = $_SESSION["id"];
        $medAdmin = htmlspecialchars($_POST['administration']);
    
        $sql=mysqli_query($conn,"SELECT * FROM medicine WHERE medName='$medName' AND medManufacturer ='$medManufacturer' AND hospId = '$hospId'");
        if(mysqli_num_rows($sql)>0)
        {
            echo "Item Already Exists For This Hospital"; 
            exit;
        }
        else
        {
            $query="INSERT INTO medicine (medName, price, hospId, medManufacturer, medAdmin) VALUES ('$medName', '$price', '$hospId', '$medManufacturer', '$medAdmin')";
            $sql=mysqli_query($conn,$query)or die("Could Not Perform the Query");
            header ("Location: ../add-medicine.php");
        }
    }
    if(isset($_POST["first_name"])){
        //import variables
        session_start();
        $userId = $_SESSION["id"];
        $firstName = htmlspecialchars($_POST['firstName']);
        if( $_SESSION['category'] == 'patient'){
            $query="UPDATE regpatients SET firstName = '$firstName' WHERE id= '$userId'";
        }else if ( $_SESSION['category'] == 'doctor') {
            $query="UPDATE regdoctors SET firstName = '$firstName' WHERE id= '$userId'";
        }
        
        //if sql query is executed...
        if (mysqli_query($conn, $query)) {
            header('location:../user-account.php?status=success');
        }
        else {	
            //show error
            echo "Error: updating user details " . mysqli_error($conn);
        }
        //close connection
        mysqli_close($conn);
    }
    if(isset($_POST["last_name"])){
        //import variables
        session_start();
        $userId = $_SESSION["id"];
        $lastName = htmlspecialchars($_POST['lastName']);
        if( $_SESSION['category'] == 'patient'){
            $query="UPDATE regpatients SET lastName = '$lastName' WHERE id= '$userId'";
        }else if ( $_SESSION['category'] == 'doctor') {
            $query="UPDATE regdoctors SET lastName = '$lastName' WHERE id= '$userId'";
        }
        //if sql query is executed...
        if (mysqli_query($conn, $query)) {
            header('location:../user-account.php?status=success');
        }
        else {	
            //show error
            echo "Error: updating user details " . mysqli_error($conn);
        }
        //close connection
        mysqli_close($conn);
    }
    if(isset($_POST["user_institution"])){
        //import variables
        session_start();
        $userId = $_SESSION["id"];
        $institution = htmlspecialchars($_POST['institution']);
        if( $_SESSION['category'] == 'patient'){
            $query="UPDATE regpatients SET institution = '$institution' WHERE id= '$userId'";
        }else if ( $_SESSION['category'] == 'doctor') {
            $query="UPDATE regdoctors SET institution = '$institution' WHERE id= '$userId'";
        }
        //if sql query is executed...
        if (mysqli_query($conn, $query)) {
            header('location:../user-account.php?status=success');
        }
        else {	
            //show error
            echo "Error: updating user details " . mysqli_error($conn);
        }
        //close connection
        mysqli_close($conn);
    }
    if(isset($_POST["institution_name"])){
        //import variables
        session_start();
        $userId = $_SESSION["id"];
        $institutionName = htmlspecialchars($_POST['institutionName']);
    
        //check for company in db
        $query="UPDATE reginstitutions SET institutionName = '$institutionName' WHERE Id = '$userId'";
        //if sql query is executed...
        if (mysqli_query($conn, $query)) {
            header('location:../user-account.php?status=success');
        }
        else {	
            //show error
            echo "Error: updating user details " . mysqli_error($conn);
        }
        //close connection
        mysqli_close($conn);
    }
    if(isset($_POST["email-address"])){
        //import variables
        session_start();
        $userId = $_SESSION["id"];
        $emailAddress = filter_var($_POST['emailAddress'], FILTER_SANITIZE_EMAIL);
        if( $_SESSION['category'] == 'patient'){
            $sql_e=mysqli_query($conn,"SELECT * FROM regpatients where emailAddress='$emailAddress'");       
            if(mysqli_num_rows($sql_e)>0)
            {
                echo '<script> 
                window.location.href = "../user-account.php?e=3"
                </script>';
            }
            $query="UPDATE regpatients SET emailAddress = '$emailAddress' WHERE id= '$userId'";
        }else if ( $_SESSION['category'] == 'doctor') {
            $sql_e=mysqli_query($conn,"SELECT * FROM regdoctors where emailAddress='$emailAddress'");       
            if(mysqli_num_rows($sql_e)>0)
            {
                echo '<script> 
                window.location.href = "../user-account.php?e=3"
                </script>';
            }
            $query="UPDATE regdoctors SET emailAddress = '$emailAddress' WHERE id= '$userId'";
        }else if( $_SESSION['category'] == 'hospital') {
            $sql_e=mysqli_query($conn,"SELECT * FROM reginstitutions where emailAddress='$emailAddress'");       
            if(mysqli_num_rows($sql_e)>0)
            {
                echo '<script> 
                window.location.href = "../user-account.php?e=3"
                </script>';
            }
            $query="UPDATE reginstitutions SET emailAddress = '$emailAddress' WHERE id= '$userId'";
        }
        //if sql query is executed...
        if (mysqli_query($conn, $query)) {
            header('location:../user-account.php?status=success');
        }
        else {	
            //show error
            echo "Error: updating user details " . mysqli_error($conn);
        }
        //close connection
        mysqli_close($conn);
    }
    if(isset($_POST["phone-number"])){
        //import variables
        session_start();
        $userId = $_SESSION["id"];
        $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
        
        
        if( $_SESSION['category'] == 'patient'){
            //check for duplicate entries
            $sql_f=mysqli_query($conn,"SELECT * FROM regpatients where phoneNumber='$phoneNumber'");
            if(mysqli_num_rows($sql_f)>0)
            {
                echo '<script> 
                window.location.href = "../user-account.php?e=2"
                </script>';
            }
            $query="UPDATE regpatients SET phoneNumber = '$phoneNumber' WHERE id= '$userId'";
        }else if ( $_SESSION['category'] == 'doctor') {
            $sql_f=mysqli_query($conn,"SELECT * FROM regdoctors where phoneNumber='$phoneNumber'");
            if(mysqli_num_rows($sql_f)>0)
            {
                echo '<script> 
                window.location.href = "../user-account.php?e=2"
                </script>';
            }
            $query="UPDATE regdoctors SET phoneNumber = '$phoneNumber' WHERE id= '$userId'";
        }else if( $_SESSION['category'] == 'hospital') {
            $sql_f=mysqli_query($conn,"SELECT * FROM reginstitutions where phoneNumber='$phoneNumber'");
            if(mysqli_num_rows($sql_f)>0)
            {
                echo '<script> 
                window.location.href = "../user-account.php?e=2"
                </script>';
            }
            $query="UPDATE reginstitutions SET phoneNumber = '$phoneNumber' WHERE id= '$userId'";
        }
        
        //if sql query is executed...
        if (mysqli_query($conn, $query)) {
            header('location:../user-account.php?status=success');
        }
        else {	
            //show error
            echo "Error: updating user details " . mysqli_error($conn);
        }
        //close connection
        mysqli_close($conn);
    }
    //change password
    if(isset($_POST["new_password"])){
        //import variables
        session_start();
        $userId = $_SESSION["id"];
        $new_password = $_POST["newpassword"];
        $old_password = $_POST["oldpassword"];
        //encrypt the password to compare
        $password = openssl_encrypt($old_password, "AES-128-ECB", $SECRETKEY);
        if( $_SESSION['category'] == 'patient'){
            $sql = "SELECT emailAddress FROM regpatients WHERE id = ? AND password = ?'";
        }else if ( $_SESSION['category'] == 'doctor') {
            $sql = "SELECT emailAddress FROM regdoctors WHERE id = ? AND password = ?'";
        }else if( $_SESSION['category'] == 'hospital') {
            $sql = "SELECT emailAddress FROM reginstitutions WHERE id = ? AND password = ?'";
        }
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId,$password]);
        $result = $stmt->get_result();
        if(!empty($result))
        {
            $stmt;
            //encrypt the password to update
            $password = openssl_encrypt($new_password, "AES-128-ECB", $SECRETKEY);
            if( $_SESSION['category'] == 'patient'){
                $sql = "UPDATE regpatients SET password = '$password' WHERE id = '$userId'";
            }else if ( $_SESSION['category'] == 'doctor') {
                $sql = "UPDATE regdoctors SET password = '$password' WHERE id = '$userId'";
            }else if( $_SESSION['category'] == 'hospital') {
                $sql = "UPDATE reginstitutions SET password = '$password' WHERE id = '$userId'";
            }
            
            if (mysqli_query($conn, $sql)) {
                header('location:../user-account.php?status=success');
            }
            else {	
                //show error
                echo "Error: updating password ".$sql."". mysqli_error($conn);
            }
        }
        else{
            echo '<script> 
                window.location.href = "../user-account.php?e=5"
                </script>';
        }
        //close connection
        mysqli_close($conn);
    }
    
    if(isset($_POST["image-profile"])){
        //import variables
        session_start();
        $id = $_SESSION["id"];
        $filename = $_FILES['profile_picture']["name"];
        $temp_filename = $_FILES['profile_picture']["tmp_name"];
        $folder = "uploads/". $filename;
        if( $_SESSION['category'] == 'patient'){
            $query ="UPDATE regpatients SET profilePhoto = '$filename' WHERE id= '$id'";
        }else if ( $_SESSION['category'] == 'doctor') {
            $query ="UPDATE regdoctors SET profilePhoto = '$filename' WHERE id= '$id'";
        }else if( $_SESSION['category'] == 'hospital') {
            $query ="UPDATE reginstitutions SET profilePhoto = '$filename' WHERE id= '$id'";
        }
        //if sql query is executed...
        if (mysqli_query($conn, $query)) {
            if(move_uploaded_file($temp_filename, $folder)){
                header('location:../user-account.php');
            }
            else {	
                //show error
                echo "Error: uploading image " . mysqli_error($conn);
            }
        }
        else {	
            //show error
            echo "Error: updating user details " . mysqli_error($conn);
        }
        //close connection
        mysqli_close($conn);
    }
?>