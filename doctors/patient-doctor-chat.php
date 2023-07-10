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
<body class="reg-body">
    <div class="welcome-msg">
        <h3></h3>
        <p></p>
    </div>
    <div>
    <?php
    include_once "../conn.php";
    $current_user = $_SESSION['id'];
    $resultPost = mysqli_query($conn,"SELECT LAST userId, emailAddress, readStatus FROM chat WHERE userId != '$current_user' GROUP BY userId");
    while($row = mysqli_fetch_array($resultPost)) {
    ?>
    <tr>
        <td>
            <a href="individual-chats.php?id=<?php echo $row["userId"]; ?>" method="POST">
                <span style="display:inline-block; overflow:hidden; max-width:20ch;"><?php echo $row["message"]; ?></span>
                <p style="font-size:5px;">from <?php echo $row["message"]; ?></p>
            </a>
        </td>                        
    </tr>
    <?php }?> 
    </div>
    
</body>
</html>