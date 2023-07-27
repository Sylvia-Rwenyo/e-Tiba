<div>
    <div class="dosage_records">
        <h3>Dosage Records</h3>
        <table>
            <tr class="table_field_names">
                <td>Patient Name</td>
                <td>Patient Email</td>
                <td>Attending Doctor's Name</td>
                <td>Attending Doctor's Email</td>
                <td>Dosage Name</td>
                <td>Number of Days</td>
            </tr>
            
            <?php
            $current_user_name = $_SESSION['username'];
            if(isset($_GET['doc-id'])){
                $requested_doctor = $_GET['doc-id'];
            }
            $resultPost = mysqli_query($conn,"SELECT * FROM dosage  WHERE attending_doctor_id IN (SELECT id FROM regdoctors WHERE id = '$requested_doctor' AND institution = '$current_user_name')");
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
                <?php echo $row["attending_doctor_name"]; ?>
                </td>
                <td>
                <?php echo $row["attending_doctor_email"]; ?>
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
</div>