<?php
    include_once 'conn.php';
    if(isset($_POST['search']))
    {
        $keyword = $_POST['search'];
        $sql = "SELECT * FROM regPatients WHERE emailAddress LIKE '%{$keyword}%' or firstName LIKE '%{$keyword}%'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));?>
        <ul class='list-group' style='margin-top:-15px;'>
        <?php 
        while($rows = mysqli_fetch_array($result))
        {?>
            <li class="list-group-item">
                <a href = "single-patient-records.php?p=<?php echo $rows['id']; ?>"><h3><?php echo $rows['firstName']?></h3></a>
                <a style="text-decoration:none; color:black;" href = "single-patient-records.php?p=<?php echo $rows['id']; ?>" ><h4><?php echo $rows['emailAddress']?></h4></a>
            </li>
            <?php
        }?>
        </ul>
    <?php }
    else{
        $bool_value = 0;
    } 
?>