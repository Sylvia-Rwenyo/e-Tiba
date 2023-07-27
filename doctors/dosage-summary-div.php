<div class="dosage_records">
    <table>
        <tr class="table_field_names">
            <td>Patient Name</td>
            <td>Patient Email</td>
            <td>Dosage Name</td>
            <td>Number of Days</td>
        </tr>
        
        <?php
        $current_user_id = $_SESSION['id'];
        $resultPost = mysqli_query($conn,"SELECT * FROM dosage  WHERE attending_doctor_id = '$current_user_id'");
        while($row = mysqli_fetch_array($resultPost)) {
        ?>
        <tr class="table_field_items">
        <td>
            <?php echo $row["patientName"]; ?>
            </td>
            <td>
            <?php echo $row["patientEmail"]; ?>
            </td> 
            <td>
            <?php echo $row["dosageName"]; ?>
            </td> 
            <td>
            <?php echo $row["number_of_days"]; ?>
            </td>                    
        </tr>    
        <?php }?>  
    </table>
</div>