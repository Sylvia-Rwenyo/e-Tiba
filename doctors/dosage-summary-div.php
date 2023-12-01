<div class="dosage_records">
    <?php
        if(isset($_GET['id']))
        {
            $pID = $_GET['id'];
        }
        else{
            echo "<style>.dosage_records {display:none}</style>";
        }
        $resultPost = mysqli_query($conn,"SELECT * FROM regPatients  WHERE id = '$pID'");
        while($row = mysqli_fetch_array($resultPost)) {
            $firstName = $row['firstName'];
        }
    ?>
    <h5>Summary of Prescriptions For <?php  echo $firstName;?></h5>
    <table>
        <tr class="table_field_names">
            
            <th>Dosage Name</th>
            <th>Number of Days</th>
            <th>Tablets Per Time</th>
            <th>Number Of Times A Day</th>
        </tr>
        
        <?php
        $current_user_id = $_SESSION['id'];
        $resultPost = mysqli_query($conn,"SELECT * FROM dosage  WHERE patient_id = '$pID'");
        while($row = mysqli_fetch_array($resultPost)) {
        ?>
        <tr class="table_field_items">
            <td>
            <?php echo $row["dosageName"]; ?>
            </td>
            <td>
            <?php echo $row["number_of_days"]; ?>
            </td>
            <td>
            <?php echo $row["tablets"]; ?>
            </td>
            <td>
            <?php echo $row["times_a_day"]; ?>
            </td> 
            <td>
            <a  href="dosage-update-form.php?id=<?php echo $row["dosageId"]; ?>" method="POST">
                <button id = "dosage-update" type="button" name="dosage-update" class="pos-btn"><i class="fa fa-edit"></i>Update</button>
            </a>
            </td>   
            <td>
            <form id="form"  action="../controls/processing.php?id=<?php echo $row["dosageId"]; ?>" method="POST">
                <button id = "dosage-delete" type="submit" name="dosage-delete" class="pos-btn"><i class="fa fa-trash-o"></i>Delete</button>
            </form>
            </td>                        
        </tr>    
        <?php }?>  
    </table>
</div>