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
    ?>
    <div class="menu-bar">
        <div class="welcome-msg">
            <h2>Patient Doctor Chat</h2>
            <h3>Ask your <?php if($current_user_category == 'doctor')
            {
                echo "patient";
            }elseif($current_user_category == 'patient')
            {
                echo "doctor";
            }?> anything</h3>
        </div>
        <div class="chat_with_title">
            <?php
            $sent_to = 0;
            $fname_chatting_with = 0;
            $query = 0;
            if($current_user_category == 'doctor'){
                if(isset($_GET['id'])){
                    $requested_patient = $_GET['id'];
                }
                $query = "SELECT * FROM regPatients WHERE id ='$requested_patient'";
            }
            elseif($current_user_category == 'patient'){
                if(isset($_GET['id'])){
                    $requested_doctor = $_GET['id'];
                }
                $query = "SELECT * FROM regDoctors WHERE id ='$requested_doctor'";
            }
            
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            
            while($row = mysqli_fetch_array($result))
            {
                $sent_to = $row["emailAddress"];	
                $fname_chatting_with = $row["firstName"];
            }?>
            <h4>Chatting with <?php echo $fname_chatting_with;?></h4>
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
            <button type="submit" name="input-message" class="pos-btn">Send</button>
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