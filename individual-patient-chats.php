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
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script>
        $(document).ready(function(){
            $("#all-messages").load("all-messages-div-patients.php");
            setInterval(function(){
                $("#all-messages").load("all-messages-div-patients.php");
            }, 1000);
        });
    </script>
    <script>
        function show_func() {
            var element = document.getElementById("all_messages");
            element.scrollTop = element.scrollHeight;
        }
        setInterval (show_func, 10000);
    </script>
</head>
<body class="reg-body" id="chat-body" onload="show_func()">
<div class="menu-bar">
    <div class="welcome-msg">
        <h2>Patient Doctor Chat</h2>
        <h3>Ask your doctor anything</h3>
    </div>
    <div class="chat_with_title">
        <?php
        include_once "conn.php";
        session_start();
        $current_user_email = $_SESSION['email'];
        if(isset($_GET['id'])){
            $requested_doctor = $_GET['id'];
        }
        $sent_to = 0;
        $fname_chatting_with = 0;
        $query = "SELECT * FROM regdoctors WHERE id ='$requested_doctor'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
        while($row = mysqli_fetch_array($result))
        {
            $sent_to = $row["emailAddress"];	
            $fname_chatting_with = $row["firstName"];
        }?>
        <h4><?php echo $fname_chatting_with;?></h4>
    </div>
</div>
<div class="chat_content">
    <div class = "all_messages" id="all_messages">
        
    </div>
    <div class = "message-input-box">
        <form method="POST" action="controls/processing.php">
            <input type="hidden"  name="sent_to" value="<?php echo $sent_to;?>"/>
            <input type="hidden"  name="readStatus" value="<?php echo 'unread';?>"/>
            <input type="hidden"  name="sender_class" value="<?php echo $_SESSION['category'];?>"/>
            <textarea rows='2' cols ='50' id="message" name="message" placeholder="Enter Message" required></textarea>
            <button type="submit" name="enter-message-as-patient" class="pos-btn">Send</button>
        </form>
    </div>
</div>
</body>
</html>