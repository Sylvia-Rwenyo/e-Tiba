<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"></link>
    <link rel="icon" href="favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Join CERA</title>
    <script src="https://use.fontawesome.com/1d95bf24b3.js"></script>
</head>
<body class="reg-body" id="chat-body">
<div class="welcome-msg">
        <h2>Patient Doctor Chat</h2>
        <h3>Ask your doctor anything</h3>
    </div>
    <div>
    <?php
    include_once "conn.php";
    session_start();
    $current_user_email = $_SESSION['email'];
    if(isset($_GET['id'])){
        $requested_doctor = $_GET['id'];
    }
    $sent_to = 0;
    $query = "SELECT emailAddress, id FROM regdoctors WHERE id ='$requested_doctor'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    while($row = mysqli_fetch_array($result))
    {
        $sent_to = $row["emailAddress"];	
    }

    $resultPost = mysqli_query($conn,"SELECT id, readStatus, sent_to, emailAddress, sent_to_id, sent_from_id, message FROM chat WHERE (sent_to = '$current_user_email' AND emailAddress = '$sent_to') OR (sent_to = '$sent_to' AND emailAddress = '$current_user_email')");
    if($resultPost == null){
        echo "You Have No Chats Yet";
    }
    else
    {
        while($row = mysqli_fetch_array($resultPost)) {
            if($current_user_email == $row["sent_to"])
            {
                if ($row['readStatus'] == 'read')
                {
                    ?>
                    <div class="message-box" style="<?php if($current_user_email == $row["emailAddress"]){echo 'text-align:right;margin-left:40%;margin-right:20%;';}else{echo  'text-align:left;margin-right:40%;margin-left:20%;';$sent_to = $row["emailAddress"];}?>">
                        <p><?php echo $row["message"]; ?></p> 
                        <form id="message-form"  action="controls/processing.php?id=<?php echo $row["id"]; ?>" method="POST" style="<?php if($current_user_email == $row["emailAddress"]){echo 'display:block;';}else{echo  'display:none;';}?>">
                            <input type="hidden"  name="sent_to" value="<?php echo $sent_to;?>"/>
                            <input id = "message-delete" type="submit" name="message-delete" class="neg-btn"value="Delete"/>
                        </form>
                    </div><?php
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
        }
    }?>
    </div>
    <div class = "message-input-box">
        <form method="POST" action="controls/processing.php">
            <input type="hidden"  name="sent_to" value="<?php echo $sent_to;?>"/>
            <input type="hidden"  name="readStatus" value="<?php echo 'unread';?>"/>
            <input type="hidden"  name="sender_class" value="<?php echo $_SESSION['category'];?>"/>
            <input type="text" name="message" placeholder="Enter Message" required/>
            <button type="submit" name="enter-message-as-patient" class="pos-btn">Send</button>
        </form>
    </div>
</body>
</html>