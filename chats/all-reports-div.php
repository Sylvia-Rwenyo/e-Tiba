<?php
    include_once "../conn.php";
    session_start();
    $current_user = $_SESSION['id'];
    $current_user_email = $_SESSION['email'];
    $current_user_category = $_SESSION['category'];
    $resultPost = mysqli_query($conn,"SELECT * FROM reports WHERE id IN (SELECT MAX(id) FROM reports WHERE (sent_to = '$current_user_email' OR emailAddress = '$current_user_email') GROUP BY chat_identity ORDER BY id DESC) GROUP BY chat_identity ORDER BY id DESC");
    if(mysqli_num_rows($resultPost) == 0){
        echo "You Have No Reports Yet";
    }
    else
    {
        while($row = mysqli_fetch_array($resultPost)) {
        ?>
        <div class="table-row">
            <span>
                <a href="reports-messages.php?id=<?php echo $row["id"]; ?>">
                <p class="conversation_name">From <?php if($current_user_email == $row["emailAddress"]){echo "You";}else{echo $row["emailAddress"];} ?> To <?php if($current_user_email == $row["sent_to"]){echo "You";}else{echo $row["sent_to"];} ?></p>
                <span class="home-chat-briefs"><?php echo $row["message"]; ?></span>
                </a>
            </span>                        
        </div>
        <?php }}?>