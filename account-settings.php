<?php 
include_once "db.php";
session_start();
if (!isset($_SESSION["loggedIN"])) {
    header('location:index.php');
}
if (!isset($_SESSION["iNcompany"])) {
    header('location:company-reg.php');
}
$user_company_id = $_SESSION["companyId"];
$userId = $_SESSION["id"];
?>
<html>
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
    <body>
        <div class="main-body" id="personal-profile">
            <section class="main-section">
                <?php
                $query = "SELECT * FROM user_details WHERE userId ='$userId'";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                while($row = mysqli_fetch_array($result))
                {?>
                    <!--change profile picture, for later though-->
                    <!--change username-->
                    <div id="firstName-upload" class="upload-field">
                        <form method="POST" action="php-2-sql.php" class="profile-mini-form">
                            <h4><?php echo $row["firstName"];?></h4>
                            <div class="profile-form-input">
                                <input type="text" name="firstName" id="firstName" placeholder="Enter New First Name"><br/>
                                <input name="first_name" type = "submit" class="neg-button" value="Update"/>
                            </div>
                            
                        </form>
                    </div>
                    <div id="lastName-upload" class="upload-field" >
                        <form method="POST" action="php-2-sql.php" class="profile-mini-form">
                            <h4><?php echo $row["lastName"];?></h4>
                            <div class="profile-form-input">
                                <input type="text" name="lastName" id="lastName" placeholder="Enter Company New Name"><br/>
                                <input name="last_name" type = "submit" class="neg-button" value="Update"/>
                            </div>
                            
                        </form>
                    </div>
                    <!--change email address-->
                    <div id="companyEmail-upload" class="upload-field">
                        <form method="POST" action="php-2-sql.php" class="profile-mini-form">
                            <h4>Email: <?php  if(($row["emailAddress"]) == ''){echo "Unregistered!";}else{echo $row["emailAddress"];}?></h4>
                            <div class="profile-form-input">
                                <input type="text" name="emailAddress" id="emailAddress"  placeholder="Enter Company Email"><br/>
                                <input name="email-address" type = "submit" class="neg-button" value="Update"/>
                            </div>
                            
                        </form>
                    </div>
                    <!--change phone number-->
                    <div id="phone1-upload" class="upload-field">
                        <form method="POST" action="php-2-sql.php"  class="profile-mini-form">
                            <h4>Primary Phone: <?php echo $row["phoneNumber"];?></h4>
                            <div class="profile-form-input">
                                <input type="text" name="phoneNumber" id="phoneNumber"  placeholder="07********"><br/>
                                <input name="phone-number" type = "submit" class="neg-button" value="Update"/>
                            </div>
                            
                        </form>
                    </div>
                    <!--change company-->
                    <div id="company-upload-user" class="upload-field">
                        <form method="POST" action="php-2-sql.php" id="companyNameChange" class="profile-mini-form">
                            <h4>Current Company: <?php echo $_SESSION["companyName"];?></h4>
                            <div style="display:flex;flex-direction:column;">
                                <input type="text" id="userCompanyName" name="userCompanyName"  placeholder="Enter Company Name">
                                <div class="suggestion" id="suggestion"></div>
                                <input name="user_CompanyName" type = "submit" class="neg-button" value="Update"/>
                            </div>
                        </form>
                    </div>
                    <!--change password-->
                    <div id="password-upload" class="upload-field">
                        <form method="POST" action="password-change.php" class="profile-mini-form">
                            <div class="profile-form-input">
                                <input type="password" name="oldpassword" id="oldpassword"  placeholder="Enter Current Password"><br/>
                                <input name="old_password" type = "submit" class="neg-button" value="Next"/>
                            </div>
                            
                        </form>
                    </div>
                <?php
                }
                ?>
            </section>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                //autocomplete 1
                $("#userCompanyName").keyup(function(e){
                    var search_query = $(this).val();
                    if(search_query != ""){
                        $.ajax({
                            url:"suggest-companies.php",
                            type: "POST",
                            data: {search: search_query},
                            success: function($data){
                                $("#suggestion").fadeIn('fast').html($data);
                            }
                        });
                    }
                    else{
                        $("#suggestion").fadeOut();
                    }
                })
            });
            $(document).on("click", "li", function(){
                $("#userCompanyName").val($(this).text());
                $("#suggestion").fadeOut();
            });
        </script>
    </body>
</html>