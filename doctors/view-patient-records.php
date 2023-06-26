<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="style.css"></link>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>CERA</title>
</head>

<body>
    <div>
        <div style="display:inline-block">
            <h1>Dosage Details</h1>
            <table>
                <tr class="table_field_names">
                    <td>Medicine name</td>
                    <td>Number of Tablets</td>
                    <td>Number of Days</td>
                    <td>Number of Times a Day</td>
                </tr>
                <?php
                include_once "conn.php";
                $resultPost = mysqli_query($conn,"SELECT dosageId as Id, dosageName as DName, tablets as Tablets, times_a_day as TimesADay, number_of_days as NDays FROM  dosage");
                while($row = mysqli_fetch_array($resultPost)) {
                ?>
                <tr>
                    <td>
                    <?php echo $row["DName"]; ?>
                    </td> 
                    <td>
                    <?php echo $row["Tablets"]; ?>
                    </td>
                    <td>
                    <?php echo $row["TimesADay"]; ?>
                    </td> 
                    <td>
                    <?php echo $row["NDays"]; ?>
                    </td>
                    <td>
                    <a  href="dosage-update-form.php?id=<?php echo $row["Id"]; ?>" method="POST">
                        <button id = "dosage-update" type="button" name="dosage-update" class="btn">Update</button>
                    </a>
                    </td>   
                    <td>
                    <form id="form"  action="../controls/dosage-delete.php?id=<?php echo $row["Id"]; ?>" method="POST">
                        <input id = "dosage-delete" type="submit" value="Delete" name="delete" class="btn">
                    </form>
                    </td>                        
                </tr>    
                <?php }?>     
            </table>
        </div>
    </div>
</body>
</html>