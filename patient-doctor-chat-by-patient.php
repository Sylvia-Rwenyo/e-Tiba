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
<body class="reg-body" id="patient-doc-home-chat">
<div class="welcome-msg">
    <h3>Patient Doctor Chat</h3>
    <p>Get to know your patient</p>
</div>
<div class="search-bar-top">
    <div class="search-bar">
        <form action = "" method = "GET" class = "form-inline">
            <input name = "keyword" type = "text" placeholder = "Search Doctor here..." class = "form-control" value = "<?php echo isset($_POST['keyword'])?$_POST['keyword']:''?>"/>
            <span class = "input-group-button"><button class="pos-btn type="submit" name = "search">SEARCH</button></span>
        </form>
        <div class = "dropdown">
        <div class = "dropdown-content">
            <div style="word-wrap:break-word;">
            <?php
            include_once '../conn.php';
            session_start();
            if(isset($_GET['search']))
            {
                $keyword = $_GET['keyword'];
                $sql = "SELECT * FROM regdoctors WHERE emailAddress LIKE '$keyword' or firstName LIKE '$keyword'";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                while($rows = mysqli_fetch_array($result))
                {?>
                    <a href = "individual-patient-chats.php?id=<?php echo $rows['id'] ?>"><h3><?php echo $rows['firstName']?></h3></a>
                    <a href = "individual-patient-chats.php?id=<?php echo $rows['id'] ?>" ><h4><?php echo $rows['emailAddress']?></h4></a>
                    <?php
                }
            } ?>
            </div>
        </div>
    </div>
    </div>
</div>
    <div>
        <table>
            <?php
            include_once "../conn.php";
            $current_user = $_SESSION['id'];
            $current_user_email = $_SESSION['email'];
            $resultPost = mysqli_query($conn,"SELECT id, sender_class, sent_to, message, sent_from_id, emailAddress, readStatus FROM chat WHERE sent_to = '$current_user_email' OR emailAddress = '$current_user_email' ORDER BY id DESC LIMIT 1");
            if($resultPost == null){
                echo "You Have No Chats Yet";
            }
            else
            {
                while($row = mysqli_fetch_array($resultPost)) {
                ?>
                <tr class="table-row">
                    <td>
                        <a href="individual-patient-chats.php?id=<?php if($row["sender_class"] == 'patient'){echo $row["sent_to_id"];}else{echo $row["sent_from_id"];} ?>" method="POST">
                        <p>From <?php if($current_user_email == $row["emailAddress"]){echo "You";}else{echo $row["emailAddress"];} ?></p>
                        <span style="display:inline-block; font-size:25px; overflow:hidden; max-width:20ch;word-wrap:break-word;"><?php echo $row["message"]; ?></span>
                        </a>
                    </td>                        
                </tr>
                <?php }}?> 
        </table>
    </div>
    
</body>
</html>