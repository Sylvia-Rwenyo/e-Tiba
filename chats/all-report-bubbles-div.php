<div class="all_message_mini">
    <?php
    include_once "../conn.php";
    session_start();
    $current_user_email = $_SESSION['email'];
    $current_user_category = $_SESSION['category'];
    $fname_chatting_with = 0;

    if(isset($_GET['chat_id'])){
            $requested_reports = $_GET['chat_id'];
    }
    $query = "SELECT * FROM reports WHERE chat_identity ='$requested_reports'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $first_message = 0;
    while($row = mysqli_fetch_array($result))
    {
        if(isset($_GET['sent_to'])){
            $sent_to = $_GET['sent_to'];
        }
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
                $sql = "UPDATE reports SET readStatus = 'read' WHERE id='$id'";
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
                    <!--<div style="display:flex;flex-direction:row;">
                        <form id="message-form"  action="../controls/processing.php?id=<?php //echo $row["id"]; ?>" method="POST" style="<?php // if($row['readStatus'] == 'unread'){echo 'display:block;';}else{echo  'display:none;';}?>">
                            <input type="hidden"  name="sent_to" value="<?php //echo $sent_to;?>"/>    
                            <input id = "report-update" type="submit" name="report-update" class="chat-btn" value="Edit"/>
                        </form>
                    </div>-->
                </div> 
                <?php
        }
    }?>
</div>