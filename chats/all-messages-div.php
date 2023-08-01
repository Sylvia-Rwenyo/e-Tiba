<div class="all_message_mini">
    <?php
    include_once "../conn.php";
    session_start();
    $current_user_email = $_SESSION['email'];
    $current_user_category = $_SESSION['category'];
    $sent_to = 0;
    $fname_chatting_with = 0;

    $query = 0;
    if($current_user_category == 'doctor'){
        if(isset($_GET['id'])){
            $requested_patient = $_GET['id'];
        }
        $query = "SELECT * FROM regpatients WHERE id ='$requested_patient'";
    }
    elseif($current_user_category == 'patient'){
        if(isset($_GET['id'])){
            $requested_doctor = $_GET['id'];
        }
        $query = "SELECT * FROM regdoctors WHERE id ='$requested_doctor'";
    }
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    while($row = mysqli_fetch_array($result))
    {
        $sent_to = $row["emailAddress"];	
        $fname_chatting_with = $row["firstName"];
    }

    if($current_user_category == 'doctor'){
        $chat_identity = $current_user_email."_".$sent_to;
    }
    elseif($current_user_category == 'patient'){
        $chat_identity = $sent_to."_".$current_user_email;
    }

    $resultPost = mysqli_query($conn,"SELECT * FROM chat WHERE chat_identity = '$chat_identity' ");
    while($row = mysqli_fetch_array($resultPost)) 
    {  
        if($current_user_email == $row["sent_to"])
        {
            if ($row['readStatus'] == 'read')
            { ?>
                <div class="message-box receiving">
                    <p><?php echo $row["message"]; ?></p>
                </div> 
                <?php
            }
            else
            {
                $id = $row['id'];
                $sql = "UPDATE chat SET readStatus = 'read' WHERE id='$id'";
                if (mysqli_query($conn, $sql)) 
                {
                    header('Location: '.$_SERVER['PHP_SELF']);
                    die;
                } 
                else 
                {
                    echo "Error: " . $sql . "" . mysqli_error($conn);
                }
            }
        } 
        else
        {
            ?>
                <div class="message-box sent">
                    <p><?php echo $row["message"]; ?></p>
                    <div style="display:flex;flex-direction:row;">
                        <form id="message-form"  action="../controls/processing.php?id=<?php echo $row["id"]; ?>" method="POST" style="
                        <?php 
                            if($current_user_email == $row["emailAddress"]){
                                echo 'display:block;';
                            }
                            else{
                                echo  'display:none;';
                            }
                            if($row['readStatus'] == 'unread')
                            {
                                echo 'display:block;';
                            }else{
                                echo  'display:none;';
                        }?>">
                            <input type="hidden"  name="sent_to" value="<?php echo $sent_to;?>"/>    
                            <input id = "message-delete" type="submit" name="message-delete" class="chat-btn" value="Delete"/>
                        </form>
                        <img class = "read_ticks_in_chat" size = "5px" src="<?php 
                        if($row["readStatus"] == 'unread')
                        {
                            echo "../images/grey_tick.PNG";
                        }
                        else
                        {
                            echo "../images/blue_tick.PNG";
                        }?>"/>
                    </div>
                </div> 
                <?php
        }
    }?>
</div>