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
<body class="reg-body" id="patient-doc-home-chat">
<div class="menu-bar">
<div class="welcome-msg">
        <h3>Patient Doctor Chat</h3>
        <p>Get to know your patient</p>
    </div>
    <div class="search-bar-top">
        <div class="search-bar">
            <div data-parallax = "scroll">
                <form action = "" method = "GET" class = "form-inline">
                    <input name = "keyword" type = "text" placeholder = "Search Doctor here..." class = "form-control" value = "<?php echo isset($_POST['keyword'])?$_POST['keyword']:''?>"/>
                    <span class = "input-group-button"><button class="search-btn" type="submit" name = "search">SEARCH</button></span>
                </form>
                <div class = "dropdown">
                    <div style="position:absolute;">
                        <div class = "dropdown-content">
                            <div style="word-wrap:break-word;">
                                <?php
                                include_once 'conn.php';
                                session_start();
                                if(isset($_GET['search']))
                                {
                                    $keyword = $_GET['keyword'];
                                    $sql = "SELECT * FROM regdoctors WHERE emailAddress LIKE '$keyword' or firstName LIKE '$keyword'";
                                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                    while($rows = mysqli_fetch_array($result))
                                    {?>
                                        <a href = "individual-patient-chats.php?id=<?php echo $rows['id']; ?>"><h3><?php echo $rows['firstName'];?></h3></a>
                                        <a href = "individual-patient-chats.php?id=<?php echo $rows['id']; ?>" ><h4><?php echo $rows['emailAddress'];?></h4></a>
                                        <?php
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="chat_list_table">
    <?php
    $_id = 0;
    $current_user = $_SESSION['id'];
    $current_user_email = $_SESSION['email'];
    $resultPost = mysqli_query($conn,"SELECT * FROM chat WHERE id IN (SELECT MAX(id) FROM chat WHERE (sent_to = '$current_user_email' OR emailAddress = '$current_user_email') GROUP BY chat_identity ORDER BY id DESC) GROUP BY chat_identity ORDER BY id DESC");
    if($resultPost == null){
        echo "You Have No Chats Yet";
    }
    else
    {
        while($row = mysqli_fetch_array($resultPost)) 
        {
            ?>
            <div class="table-row">
                <span>
                <?php if($row["sender_class"] == 'patient'){$_id = $row["sent_to_id"];}else{$_id = $row["sent_from_id"];}?>
                <a href="individual-patient-chats.php?id=<?php echo $_id; ?>">
                    <p class="conversation_name">From <?php if($current_user_email == $row["emailAddress"]){echo "You";}else{echo $row["emailAddress"];} ?> To <?php if($current_user_email == $row["sent_to"]){echo "You";}else{echo $row["sent_to"];} ?></p>
                    <span class="home-chat-briefs"><?php echo $row["message"]; ?></span>
                    <img class = "read_ticks" src="<?php 
                        if(($row["readStatus"] == 'unread') AND ($row["sent_to"] == $current_user_email))
                        {
                            echo "images/unread.PNG";
                        }
                        elseif(($row["readStatus"] == 'unread') AND ($row["sent_to"] != $current_user_email))
                        {
                            echo "images/grey_tick.PNG";
                        }
                        elseif(($row["readStatus"] != 'unread') AND ($row["sent_to"] != $current_user_email))
                        {
                            echo "images/blue_tick.PNG";
                        }
                        else
                        {
                            echo "images/read.PNG";
                        }?>"
                    />
                    </a>
                </span>                        
            </div>
            <?php 
        }
    }?> 
</div>
    
</body>
</html>