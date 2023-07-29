<div class="dosage_records">
    <h5>Summary of Prescriptions For <?php $result['firstName'] ?></h5>
    <table>
        <tr class="table_field_names">
            <th>Patient Name</th>
            <th>Patient Email</th>
            <th>Dosage Name</th>
            <th>Number of Days</th>
        </tr>
        
        <?php
        $current_user_id = $_SESSION['id'];
        $resultPost = mysqli_query($conn,"SELECT * FROM dosage  WHERE patient_id = '$pID'");
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