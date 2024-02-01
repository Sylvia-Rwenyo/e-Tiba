<div style="display:block;block-direction:column;">
    <!--change profile picture-->
    
        <form method="POST" action="controls/processing.php" class="profile-mini-form">
            <label>Your profile picture: </label>
            <img src="<?php if($result['profilePhoto'] == ''){
                echo 'images/user.png';} else{
                    echo 'Uploads/'. $result['profilePhoto'];} ?>"
                alt="profile photo" id="pfp"/>
            <div class="profile-form-input">
                <label for="fileInput" id="pfpInput">
                    Change<i class="fa-solid fa-cloud-arrow-up"></i>
                    <input type="file" id="fileInput"  name="profilePhoto" id="profilePhoto" />
                </label>
                <input name="image-profile" type = "submit" class="pos-btn" value="Update"/>
            </div>
        </form>
    
    <!--change username-->
    <?php 
    if( $_SESSION['category'] == 'hospital'){?>
        
            <form method="POST" action="controls/processing.php" class="profile-mini-form">
                <label><?php echo $result["institutionName"];?></label>
                <div class="profile-form-input">
                    <input type="text" name="institutionName" id="institutionName" placeholder="Enter New Institution Name"><br/>
                    <input name="institution_name" type = "submit" class="pos-btn" value="Update"/>
                </div>
                
            </form>
        
    <?php
    }
    else {?>
        
            <form method="POST" action="controls/processing.php" class="profile-mini-form">
                <label><?php echo $result["firstName"];?></label>
                <div class="profile-form-input">
                    <input type="text" name="firstName" id="firstName" placeholder="Enter New First Name"><br/>
                    <input name="first_name" type = "submit" class="pos-btn" value="Update"/>
                </div>    
            </form>
        
        
            <form method="POST" action="controls/processing.php" class="profile-mini-form">
                <label><?php echo $result["lastName"];?></label>
                <div class="profile-form-input">
                    <input type="text" name="lastName" id="lastName" placeholder="Enter New Last Name"><br/>
                    <input name="last_name" type = "submit" class="pos-btn" value="Update"/>
                </div>
                
            </form>
        
    <?php 
    }?>
    
    <!--change email address-->
    
        <form method="POST" action="controls/processing.php" class="profile-mini-form">
            <label>Email: <?php echo $result["emailAddress"];?></label>
            <div class="profile-form-input">
                <input type="text" name="emailAddress" id="emailAddress"  placeholder="Enter Email"><br/>
                <input name="email-address" type = "submit" class="pos-btn" value="Update"/>
            </div>
            
        </form>
    
    <!--change phone number-->
    
        <form method="POST" action="controls/processing.php"  class="profile-mini-form">
            <label>Phone: <?php echo $result["phoneNumber"];?></label>
            <div class="profile-form-input">
                <input type="text" name="phoneNumber" id="phoneNumber"  placeholder="2547********"><br/>
                <input name="phone-number" type = "submit" class="pos-btn" value="Update"/>
            </div>
            
        </form>
    
    <!--change institution-->
    
    <?php 
    if( $_SESSION['category'] != 'hospital'){?>
        <form method="POST" action="controls/processing.php" class="profile-mini-form">
            <label>Current Hospital: <?php echo $result["institution"];?></label>
            <div style="display:flex;flex-direction:column;">
            <select name="institution" id="institution" required>
                <option selected disabled> Select your hospital</option>
                <?php
                include_once 'conn.php';
                $stmt = "SELECT * FROM regInstitutions ";
                $sql = mysqli_query($conn, $stmt);
                $specialties = array();
                if (mysqli_num_rows($sql) > 0) {
                    while ($result = mysqli_fetch_array($sql)) {
                    ?>
                    <option><?php echo $result['institutionName'];?></option>
                <?php
                }}
                ?>
            </select>
                <input name="user_institution" type = "submit" class="pos-btn" value="Update"/>
            </div>
        </form>
    <?php
    }
    ?>
    
    <!--change password-->
    
        <form method="POST" action="controls/processing.php" class="profile-mini-form">
            <div class="profile-form-input" style="flex-direction:column;">
                <label>Your current password: </label>
                <input type="password" name="oldpassword" id="oldpassword"  placeholder="Enter Current Password"><br/>
                <label>Your new password: </label>
                <input type="password" name="newpassword" id="newpassword"  placeholder="Enter New Password"><br/>
                <input name="new_password" type = "submit" class="pos-btn" value="Update"/>
            </div>
            
        </form>
    
</div>
    