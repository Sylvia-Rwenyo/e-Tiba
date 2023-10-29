<?php 
    include_once '../conn.php';
    @session_start();
    if($_SESSION["loggedIN"] == false)
    {
        echo ' <script> 
        window.location.href = "../index.php";
        </script>';       
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>nafuu</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css"></link>
    <link rel="icon" href="../favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Join nafuu</title>
    <script src="https://use.fontawesome.com/1d95bf24b3.js"></script>
</head>
<body class="reg-body" id="chat-body">
    <?php 
        $current_user_category = $_SESSION['category'];
        $current_user_email = $_SESSION['email'];
    ?>
    <div class="menu-bar">
        <div class="welcome-msg">
            <h2>Patient Doctor Chat</h2>
            <h3><?php if($current_user_category == 'hospital')
            {
                echo "Reports from users to you";
            }
            else
            {
                echo "Send Report to Hospital";
            }?></h3>
        </div>
        <div class="chat_with_title">
            <?php
            $sent_to = 0;
            $fname_chatting_with = 0;
            $query = 0;

            if(isset($_GET['id'])){
                $requested_report_id = $_GET['id'];
                $query_chat_opener = "SELECT * FROM reports WHERE id ='$requested_report_id'";
                $result_chat_opener = mysqli_query($conn, $query_chat_opener) or die(mysqli_error($conn));
                while($row = mysqli_fetch_array($result_chat_opener))
                {
                    if($row['sender_class'] == 'hospital'){
                        $chat_identity = $row['emailAddress'].'_'.$row['sent_to'];
                        if($current_user_category == 'hospital'){
                            $sent_to = $row["sent_to"];
                        }
                        else{
                            $sent_to = $current_user_email;
                        }
                    }
                    elseif($row['sender_class'] != 'hospital'){
                        $chat_identity = $row['sent_to'].'_'.$row['emailAddress'];
                        if($current_user_category == 'hospital'){
                            $sent_to = $row["emailAddress"];
                        }
                        else{
                            $sent_to = $row['sent_to'];
                        }
                    }	
                }
            }
            elseif(isset($_GET['hosp-id'])){
                $requested_hospital = $_GET['hosp-id'];
                $query_chat_opener = "SELECT * FROM reginstitutions WHERE id ='$requested_hospital'";
                $result_chat_opener = mysqli_query($conn, $query_chat_opener) or die(mysqli_error($conn));
                while($row = mysqli_fetch_array($result_chat_opener))
                {
                    $chat_identity = $row['emailAddress'].'_'.$current_user_email;	
                    $sent_to = $row['emailAddress'];
                }
            }?>
            <h4>Report Exchange with <?php echo $sent_to;?></h4>
        </div>
    </div>
    <div class="chat_content">

    <div class = "all_messages" id="all_messages"></div>
    
    <div class = "message-input-box">
        <form method="POST" action="../controls/processing.php">
            <input type="hidden"  name="sent_to" value="<?php echo $sent_to;?>"/>
            <input type="hidden"  name="sender_class" value="<?php echo $_SESSION['category'];?>"/>
            <input type="hidden"  name="readStatus" value="<?php echo 'unread';?>"/>
            <textarea rows='2' cols ='50' id="message" name="message" placeholder="Enter Message" required></textarea>
            <button type="submit" name="submit-report-or-suggestion" class="pos-btn">Send</button>
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
                    url:"all-report-bubbles-div.php",
                    data: {
                        chat_id:`<?php echo $chat_identity;?>`,
                        sent_to:`<?php echo $sent_to;?>`,
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
        var div_height = 0;

        const element = document.getElementById("all_messages");
        window.onload = function(){
            element.scrollTop = element.scrollHeight;
        }
        function check_message(){
            var scrollable = element.scrollHeight - element.clientHeight;
            if(div_height < scrollable){
                div_height = scrollable;
                element.scrollTop = element.scrollHeight;
            }
        }
        setInterval(check_message, 1000);
    </script>
</body>
</html>