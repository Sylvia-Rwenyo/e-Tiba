<?php
    include_once "../conn.php";
    session_start();
    $SECRETKEY = "";
    include_once "../controls/key.php";
    $current_user = $_SESSION['id'];
    $current_user_email = $_SESSION['email'];
    $current_user_category = $_SESSION['category'];
    $resultPost = mysqli_query($conn,"SELECT * FROM chat WHERE id IN (SELECT MAX(id) FROM chat WHERE (sent_to = '$current_user_email' OR emailAddress = '$current_user_email') GROUP BY chat_identity ORDER BY id DESC) GROUP BY chat_identity ORDER BY id DESC");
    if($resultPost == null){
        echo "You Have No Chats Yet";
    }
    else
    {
        while($row = mysqli_fetch_array($resultPost)) {
        ?>
        <div class="table-row">
            <span>
                <a href="messages-page.php?id=<?php if($row["sender_class"] == $current_user_category){echo $row["sent_to_id"];}else{echo $row["sent_from_id"];} ?>">
                <p class="conversation_name">From <?php if($current_user_email == $row["emailAddress"]){echo "You";}else{echo $row["emailAddress"];} ?> To <?php if($current_user_email == $row["sent_to"]){echo "You";}else{echo $row["sent_to"];} ?></p>
                <span class="home-chat-briefs">
                    <?php 
                    $encryd = $row["message"];
                    $decryd = openssl_decrypt($encryd, "AES-128-ECB", $SECRETKEY);
                    echo $decryd; ?>
                </span>
                <img class = "read_ticks" size = "5px" src="<?php 
                        if(($row["readStatus"] == 'unread') AND ($row["sent_to"] == $current_user_email))
                        {
                            echo "../images/unread.PNG";
                        }
                        elseif(($row["readStatus"] == 'unread') AND ($row["sent_to"] != $current_user_email))
                        {
                            echo "../images/grey_tick.PNG";
                        }
                        elseif(($row["readStatus"] != 'unread') AND ($row["sent_to"] != $current_user_email))
                        {
                            echo "../images/blue_tick.PNG";
                        }
                        else
                        {
                            echo "../images/read.PNG";
                        }?>"/>
                </a>
            </span>                        
        </div>
        <?php }}?>