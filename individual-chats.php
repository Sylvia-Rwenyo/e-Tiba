<!DOCTYPE html>
<html lang="en">
<head>
    <title>CERA</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css"></link>
    <link rel="icon" href="../favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Join CERA</title>
    <script src="https://use.fontawesome.com/1d95bf24b3.js"></script>
</head>
<body class="reg-body" id="chat-body" onload="show_func()">
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
    <div class="chat_content">
    <div class = "all_messages" id="all_messages">
        
    </div>
    <div class = "message-input-box">
        <form method="POST" action="controls/processing.php">
            <input type="hidden"  name="sent_to" value="<?php echo $sent_to;?>"/>
            <input type="hidden"  name="sender_class" value="<?php echo $_SESSION['category'];?>"/>
            <input type="hidden"  name="readStatus" value="<?php echo 'unread';?>"/>
            <textarea rows='2' cols ='50' id="message" name="message" placeholder="Enter Message" required></textarea>
            <button type="submit" name="enter-message-as-doc" class="pos-btn">Send</button>
        </form>
    </div> 
    </div>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/code.jquery.com_jquery-latest.js"></script>
    <script src="../js/jquery.timers-1.0.0.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".all_messages").everyTime(1000, function(i){
                $.ajax({
                    url:"all-messages-div.php",
                    data: {
                        id:<?php echo $_GET["id"];?>,
                    },
                    cache: false,
                    success: function(html){
                        $(".all_messages").html(html)
                    }
                })
            })
        });
    </script>
    <script>
        function show_func() {
            var element = document.getElementById("all_messages");
            element.scrollTop = element.scrollHeight;
        }
        setInterval (show_func, 10000);
    </script>
</body>
</html>