<div class="dosage_records">
    <table>
        <tr class="table_field_names">
            <th>Medicine name</th>
            <th>Number of Tablets</th>
            <th>Number of Days</th>
            <th>Number of Times a Day</th>
        </tr>
        
        <?php
        $current_user_id = $_SESSION['id'];
        $resultPost = mysqli_query($conn,"SELECT * FROM dosage  WHERE attending_doctor_id = '$current_user_id'");
        while($row = mysqli_fetch_array($resultPost)) {
        ?>
        <tr class="table_field_items">
            <td>
            <?php echo $row["dosageName"]; ?>
            </td> 
            <td>
            <?php echo $row["tablets"]; ?>
            </td>
            <td>
            <?php echo $row["times_a_day"]; ?>
            </td> 
            <td>
            <?php echo $row["number_of_days"]; ?>
            </td>
            <td>
            <a  href="dosage-update-form.php?id=<?php echo $row["dosageId"]; ?>" method="POST">
                <button id = "dosage-update" type="button" name="dosage-update" class="pos-btn">Update</button>
            </a>
            </td>   
            <td>
            <form id="form"  action="../controls/processing.php?id=<?php echo $row["dosageId"]; ?>" method="POST">
                <input id = "dosage-delete" type="submit" value="Delete" name="dosage-delete" class="pos-btn">
            </form>
            </td>                        
        </tr>   
            
        <?php }?>  
            
    </table>
</div>