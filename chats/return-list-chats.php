<?php
    include_once '../conn.php';
    @session_start();
    $current_user_category = $_SESSION['category'];
    $current_user_email = $_SESSION['email'];
    if(isset($_POST['search']))
    {
        $keyword = $_POST['search'];

        if($current_user_category == 'doctor'){
            $sql = "SELECT id, firstName, emailAddress FROM regpatients WHERE emailAddress LIKE '%{$keyword}%' or firstName LIKE '%{$keyword}%'";
        }
        elseif($current_user_category == 'patient'){
            $sql = "SELECT id, firstName, emailAddress FROM regDoctors WHERE emailAddress LIKE '%{$keyword}%' or firstName LIKE '%{$keyword}%'";
        }
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));?>
        <ul class='list-group' style='margin-top:-15px;'>
        <?php 
        while($rows = mysqli_fetch_array($result))
        {?>
            <li class="list-group-item">
                <a href = "messages-page.php?id=<?php echo $rows['id']; ?>"><h3><?php echo $rows['firstName']?></h3></a>
                <a style="text-decoration:none; color:black;" href = "messages-page.php?id=<?php echo $rows['id']; ?>" ><h4><?php echo $rows['emailAddress']?></h4></a>
            </li>
            <?php
        }?>
        </ul>
        <?php 
    }
?>