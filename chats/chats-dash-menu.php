<ul>
    <?php
    // Function to check if the current page name matches the given link name
    function isActive($linkName)
    {
        $currentPage = basename($_SERVER['PHP_SELF']);
        return ($currentPage === $linkName) ? 'active' : '';
    }?>
    <!-- back to dashboard -->
    <a href="../dashboard.php"><li><i class="fa fa-angle-left"></i></li></a>
    <!-- chat home page -->
    <a href="chats-home.php" class="<?php echo isActive('chats-home.php'); ?>">
        <li>
            <?php 
            $current_user_email = $_SESSION['email'];
            $resultPost = mysqli_query($conn,"SELECT readStatus FROM chat WHERE sent_to = '$current_user_email'");
            $count = 0;
            while($row = mysqli_fetch_array($resultPost)) 
            {
                if($row['readStatus'] == 'unread')
                {
                    $count = $count + 1;
                }
            }?>
            <i class="fa fa-comments"><span class="badge"><?php if($count == 0){echo "";}else{echo $count;}?></span></i>
        </li>
    </a>
    <!-- send report to hospital -->
    <a href="send-reports-home.php" class="<?php echo isActive('send-reports-home.php'); ?>">
        <li>
            <?php 
            $current_user_email = $_SESSION['email'];
            $resultPost = mysqli_query($conn,"SELECT readStatus FROM reports WHERE sent_to = '$current_user_email'");
            $count = 0;
            while($row = mysqli_fetch_array($resultPost)) 
            {
                if($row['readStatus'] == 'unread')
                {
                    $count = $count + 1;
                }
            }?>
            <i class="fa fa-comment"><span class="badge"><?php if($count == 0){echo "";}else{echo $count;}?></span></i>
        </li>
    </a>
</ul>

