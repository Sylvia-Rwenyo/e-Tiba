    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="icon" href="favicon.ico" />
        <link rel="stylesheet" href="style.css">
        <title>Edit Your profile</title>
    </head>
    <body class="profileBody" id="profileBody" >
        <div class="header">
            <?php 
             include_once 'notif-menu.php';
             $user = $_SESSION["username"];
            ?>
        </div>
        <div id="editProfileSection">
        <?php 
            // get user info
                include_once 'dash-menu.php';
                $id = $_SESSION['id'];
                $stmt ='';
                if( $_SESSION['category'] == 'patient'){
                $stmt .="SELECT * FROM  regPatients where id='$id'";
                }else if ( $_SESSION['category'] == 'doctor') {
                $stmt .="SELECT * FROM regDoctors where id='$id'";
            }else if( $_SESSION['category'] == 'hospital') {
                $stmt .="SELECT * FROM regInstitutions where id='$id'";
            }
            $records = mysqli_query($conn, $stmt);
             if(mysqli_num_rows($records) > 0){
            $i=0;
            while($result = mysqli_fetch_array($records)) {
        ?>
        <section class="main-section">
            <div class="profile">
                <div class="intro">
                    <img src="<?php if($result['profilePhoto'] == ''){
                        echo 'Images/user.png';} else{
                            echo 'Uploads/'.$result['profilePhoto'];} 
                           ?>"
                        alt="profile photo"/>
                    <div class="name">
                    <h4><?php 
                    if(isset($result['institutionName'])){
                        echo $result['institutionName'];
                    }else if(isset($result['firstName']) && isset($result['lastName'])){
                    echo $result['firstName'] . ' ' . $result['lastName'];
                    }
                    ?></h4>
                    </div>
                </div>
                <div class="contactInfo">
                <p><a href='mailto:<?php echo $result['emailAddress']?>'><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;<?php echo $result['emailAddress']?></a></p>
                <p><a <?php if($result['phoneNumber'] == 0){
                    echo 'onclick="editProfile()"';} else{ echo 'href="tel:'. $result['phoneNumber'].'"';}?>>
                    <i class="fa-solid fa-phone"></i>&nbsp;&nbsp;&nbsp;
                    <?php if($result['phoneNumber'] == 0){
                     echo 'Add phone number';} else{ echo $result['phoneNumber'];}
                     $i++;
                     }}?></a></p>
                <p onclick="editProfile()"><i class="fa-solid fa-pencil"></i></p>
            </div>
            </div>
            <?php 
            $records;
            if( $_SESSION['category'] == 'patient'){
                $records = mysqli_query($conn,"SELECT * FROM  regPatients where id='$id'");
                }else if ( $_SESSION['category'] == 'doctor') {
                $records = mysqli_query($conn,"SELECT * FROM regDoctors where id='$id'");
                }else if( $_SESSION['category'] == 'hospital') {
                $records = mysqli_query($conn,"SELECT * FROM regInstitutions where id='$id'");
                }  
                if (mysqli_num_rows($records) > 0) {
                $i=0;
                while($result = mysqli_fetch_array($records)) {
                    if(isset($_GET['e'])){
                        echo '<style>
                        .alertDiv 
                            {
                                display: block;
                            }
                        </style>';
                            if($_GET['e'] == 2){                
                                ?>
                                 <div class="alertDiv">
                                    <button  class="btn btn-lg btn-danger dialog-box-btn" onclick="register2()">x</button>
                                    <p>Phone number already registered</p>  
                                </div>
                                   <?php
                            }
                            if($_GET['e'] == 3){   
                            ?>
                                 <div class="alertDiv">
                                    <button  class="btn btn-lg btn-danger dialog-box-btn" onclick="register2()">x</button>
                                    <p>Email address already registered</p> 
                                </div>
                                <?php
                            }
                            if($_GET['e'] == 4){   
                            ?>
                             <div class="alertDiv">
                                <button  class="btn btn-lg btn-danger dialog-box-btn" onclick="register2()">x</button>
                                <p>Password must be 8 - 20 characters long and include an uppercase letter, a number, and a symbol. Password must not include spaces.</p>  
                            </div>
                            <?php
                            }
                        }
        ?>
        <!-- show form for editing user info -->
                <form action="controls/processing.php" method="POST" enctype="multipart/form-data" id="editingProfile">
                    <!-- exit editing form -->
                    <span>
                        <h4>Edit profile</h4>
                        <i class="fa fa-arrow-left" onclick="exitForm()"></i>
                    </span>
                    <!-- edit photo -->
                    <div class="intro" id="editPhoto">
                        <label>Your profile picture: </label>
                    <img src="<?php if($result['profilePhoto'] == ''){
                            echo 'Images/user.png';} else{
                                echo 'Uploads/'. $result['profilePhoto'];} ?>"
                            alt="profile photo" id="pfp"/>  
                            <label for="fileInput" id="pfpInput">
                                Change<i class="fa-solid fa-cloud-arrow-up"></i>
                                <input type="file" id="fileInput"  name="profilePhoto" id="profilePhoto" />
                            </label>
                    </div>
                <!-- edit name and password -->
                <div class="name">
                    <label>Your name: </label>
                    <input  name="name" value="<?php
                        if(isset($result['institutionName'])){
                            echo $result['institutionName'];
                        }else if(isset($result['firstName']) && isset($result['lastName'])){
                        echo $result['firstName'] . ' ' . $result['lastName'];
                        };
                        ?>"
                       />
                    </div>
                <div class="pw">
                    <label>Your current password: </label>
                    <span><input  name="password" value="<?php echo $result['password']?>" placeholder="password" id="password" type="password"/>
                    <p onclick="pswdDisplay()" id="showPswd" >                    
                        <i class="fa fa-eye-slash"></i>
                    </p></span>
                    <input  name="id" value="<?php echo $result['id']?>" type="hidden" />
                </div>
                <!-- edit email address -->
                <div>
                    <label>Your email address: </label>
                    <input type="text" name="emailAddress" value="<?php echo $result['emailAddress']?>" />
                </div>
                <!-- edit phone number -->
                <div>
                    <label>Your phone number: </label>
                    <?php 
                    if($result['phoneNumber'] == 0){
                        echo '<input type="text" placeholder="for example(07********" name="phoneNumber" id="phoneNumber" />';
                    }else{
                        ?>
                    <input type="number" name="phoneNumber" value="<?php echo $result['phoneNumber'];   ?>" />
                    <?php
                    }$i++ ;}}
                ?>
                </div>
                <!-- submit form -->
                <input type="submit" value="Update" name="update" class="pos-btn"/>
            </form>

            <!-- 'log out' section -->
            <div class="profile logOut">
            <a href="controls/processing.php?action=logOut"><h5 class="intro">Log Out</h5></a>
             </div>

             <!-- delete account section -->
             <div class="profile deleteAccount">
             <h5 class="intro" id="deletePrompt">Delete Account</h5>
                <p class="intro" id="deleteQ">Are you sure that you want to delete your account?</p>
                <div  id="confirmDelete">
                    <a href="controls/processing.php?action=deleteAccount&id=<?php echo $id; ?>" class="btn pos-btn"><p>Yes</p></a>
                    <a class="btn neg-btn" onclick="cancelDelete()"><p>Cancel</p></a>
                </div>
             </div>
         </section>
        </div>
    </body>
    </html>
    <script>
        // show delete confirmation message
        var deleteQ = document.getElementById('deleteQ');
        var confirmDelete = document.getElementById('confirmDelete');
        deleteQ.style.display = "none";
        confirmDelete.style.display = "none";

        document.getElementById('deletePrompt').onclick = () =>{
            deleteQ.style.display = "block";
            confirmDelete.style.display = "flex";
        }

        // remove delete confirmation msg
        function cancelDelete(){
            deleteQ.style.display = "none";
        confirmDelete.style.display = "none";
        }

        //remove dialog box
        function register2(){
        window.location.href = "settings.php";
    }
    if(sessionStorage.getItem("editFormState") == true){
            editProfile();
        }

        // remove all profile divs in the page except the editing form
        function editProfile(){
            let profileDivs = document.getElementsByClassName('profile');
            for(let i= 0; i < profileDivs.length; i++){
                profileDivs[i].style.display = 'none';
            }
            document.getElementById('editingProfile').style.display = "block";
        }
        console.log(sessionStorage.getItem("editFormState"));
        // display all profile divs in the page except the editing form
        function exitForm(){
            let profileDivs = document.getElementsByClassName('profile');
            for(let i= 0; i < profileDivs.length; i++){
                profileDivs[i].style.display = 'block';
            }
            document.getElementById('editingProfile').style.display = "none";
            sessionStorage.setItem("editFormState", false);
        }
        if(sessionStorage.getItem("editFormState") == false){
            exitForm();
        }

        // show pfp file input element
        let profilePhoto = document.getElementById('profilePhoto');
    let pfp = document.getElementById('pfp');
    pfp.onclick = () =>{
        profilePhoto.style.display = "block"
    }
    profilePhoto.oninput = () =>{
       pfp.style.display = 'none';
    }
    let phoneNo = document.getElementById('phoneNumber');
        phoneNo.onclick = () =>{
        phoneNo.type = "number";
    }
    function pswdDisplay(){
        let showPswd = document.getElementById('showPswd');
        let pswd = document.getElementById("password");
        if(pswd.type == "text"){
            pswd.type = "password";
            showPswd.innerHTML = '<i class="fa fa-eye-slash"></i>';
        }else{
            pswd.type = "text";
            showPswd.innerHTML = '<i class="fa fa-eye"></i>';
            pswd.style.border = "none";
        }
    }
//     var formSubmitted = false;
//     $('#editingProfile').on('submit', function(event) {
//     event.preventDefault(); // Prevent the form from submitting normally
//     // Perform the AJAX request
//     $.ajax({
//       url: 'controls/processing.php',
//       type: 'POST',
//       data: $(this).serialize(),
//       success: function(response) {
//         // Update the   page with the received response
//         fetchData();
//       },
//       error: function(xhr, status, error) {
//         console.log(error); // Handle any errors
//       }
//     });
//   });
  function fetchData() {
    $.ajax({
      url: 'settings.php', // Replace with your server-side script URL
      method: 'GET',
      success: function(response) {
        // Handle the response and update the HTML content
        $('#profileBody').html(response);
        console.log("all good");
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.error(error);
      }
    });
}

// Call the getNewData function periodically to fetch new data
setInterval(fetchData, 60000);

    </script>
   