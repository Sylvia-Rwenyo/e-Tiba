<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css"></link>
    <link rel="icon" href="favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Join CERA</title>
    <script src="https://use.fontawesome.com/1d95bf24b3.js"></script>
</head>
<body class="reg-body" id="chat-body">
    <div class="menu-bar">
        <div class="welcome-msg">
            <h2>Patient Doctor Chat</h2>
            <h3>Ask your doctor anything</h3>
        </div>
        <div class="chat_with_title">
            <?php
            include_once "../conn.php";
            session_start();
            if(isset($_GET['id'])){
                $requested_patient = $_GET['id'];
            }
            $current_user_email = $_SESSION['email'];
            $sent_to = 0;
            $fname_chatting_with = 0;
            $query = "SELECT * FROM regpatients WHERE id ='$requested_patient'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            
            while($row = mysqli_fetch_array($result))
            {
                $sent_to = $row["emailAddress"];	
                $fname_chatting_with = $row["firstName"];
            }?>
            <h4><?php echo $fname_chatting_with;?></h4>
        </div>
    </div>
    <div class = "all_messages">
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
                        <div class="message-box" style="<?php if($current_user_email == $row["emailAddress"]){echo 'text-align:right;margin-left:40%;margin-right:20%;';}else{echo  'text-align:left;margin-right:40%;margin-left:20%;';}?>">
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
                        <div class="message-box" style="<?php if($current_user_email == $row["emailAddress"]){echo 'text-align:right;margin-left:40%;margin-right:20%;';}else{echo  'text-align:left;margin-right:40%;margin-left:20%;';}?>">
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
    </div>
    <div class = "message-input-box">
        <form method="POST" action="../controls/processing.php">
            <input type="hidden"  name="sent_to" value="<?php echo $sent_to;?>"/>
            <input type="hidden"  name="sender_class" value="<?php echo $_SESSION['category'];?>"/>
            <input type="hidden"  name="readStatus" value="<?php echo 'unread';?>"/>
            <input type="text" name="message" placeholder="Enter Message" required/>
            <button type="submit" name="enter-message-as-doc" class="pos-btn">Send</button>
        </form>
    </div> 
</body>
</html>