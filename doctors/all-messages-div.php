<div class="all_message_mini">
    <?php
    $chat_identity = $current_user_email."_".$sent_to;
    $resultPost = mysqli_query($conn,"SELECT * FROM chat WHERE chat_identity = '$chat_identity' ");
    while($row = mysqli_fetch_array($resultPost)) 
    {  
        if($current_user_email == $row["sent_to"])
        {
            if ($row['readStatus'] == 'read')
            { ?>
                <div class="message-box receiving" style="<?php if($current_user_email == $row["emailAddress"]){echo 'text-align:right;margin-left:40%;margin-right:20%;';}else{echo  'text-align:left;margin-right:40%;margin-left:20%;';}?>">
                    <p><?php echo $row["message"]; ?></p>
                    <form id="message-form"  action="../controls/processing.php?id=<?php echo $row["id"]; ?>" method="POST" style="<?php if($current_user_email == $row["emailAddress"]){echo 'display:block;';}else{echo  'display:none;';}?>">
                        <input type="hidden"  name="sent_to" value="<?php echo $sent_to;?>"/>    
                        <input id = "message-delete-doc" type="submit" name="message-delete-doc" class="chat-btn" value="Delete"/>
                    </form>
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
                <div class="message-box sent" style="<?php if($current_user_email == $row["emailAddress"]){echo 'text-align:right;margin-left:40%;margin-right:20%;';}else{echo  'text-align:left;margin-right:40%;margin-left:20%;';}?>">
                    <p><?php echo $row["message"]; ?></p>
                    <div style="display:flex;flex-direction:row;">
                        <form id="message-form"  action="../controls/processing.php?id=<?php echo $row["id"]; ?>" method="POST" style="<?php if($current_user_email == $row["emailAddress"]){echo 'display:block;';}else{echo  'display:none;';}?>">
                            <input type="hidden"  name="sent_to" value="<?php echo $sent_to;?>"/>    
                            <input id = "message-delete-doc" type="submit" name="message-delete-doc" class="chat-btn" value="Delete"/>
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