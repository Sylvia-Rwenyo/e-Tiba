<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"></link>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>CERA</title>
</head>

<body>
    <div>
        <h2>Dosage Entry, by Patient or Doctor</h2>
        <div style="display:inline-block">
            <form id="dosage-form"  action=".controls/dosage-entry.php" method="POST">
                <input type="text" id="medicine-name" name="dosage-name"  size="30" placeholder="Enter Name">
                <input type="number" id="tablets" name="tablets"  size="10"  placeholder="Tablets">
                <input type="number" id="times-a-day" name="times-a-day"  size="10"  placeholder="Times in a day">
                <input type="number" id="days" name="number-of-days"  size="10"  placeholder="Prescribed Duration in Days">
                <br/>
                <input id = "itemsubmit" type="submit" value="Submit" name="save" class="btn">
            </form>
            <h1>Dosage Details</h1>
            <table>
                <tr class="table_field_names">
                    <td>Medicine name</td>
                    <td>Number of Days</td>
                    <td>Number of Times a Day</td>
                </tr>
                <?php
                include_once "conn.php";
                $resultPost = mysqli_query($conn,"SELECT dosageId as Id, dosage-name as Name, tablets as Tablets, times-a-day as Times-a-day, number-of-days as Days FROM  dosage");
                while($row = mysqli_fetch_array($resultPost)) {
                ?>
                <tr>
                    <td>
                    <?php echo $row["Name"]; ?>
                    </td> 
                    <td>
                    <?php echo $row["Tablets"]; ?>
                    </td>
                    <td>
                    <?php echo $row["Times-a-day"]; ?>
                    </td> 
                    <td>
                    <?php echo $row["Days"]; ?>
                    </td>
                    <td>
                    <a  href="UpdateItemForm.php?id=<?php echo $row["Id"]; ?>" method="POST">
                        <button id = "dosage-update" type="button" name="update" class="btn">Update</button>
                    </a>
                    </td>   
                    <td>
                    <form id="form"  action="DeleteItem.php?id=<?php echo $row["Id"]; ?>" method="POST">
                        <input id = "dosage-submit" type="submit" value="Delete" name="delete" class="btn">
                    </form>
                    </td>                        
                </tr>    
                <?php }?>     
            </table>
        </div>
    </div>
</body>
</html>