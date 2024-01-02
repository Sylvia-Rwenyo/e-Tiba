<?php 
    include_once 'conn.php';
    session_start();
    if($_SESSION["loggedIN"] == false)
    {
        echo ' <script> 
        window.location.href = "index.php";
        </script>';       
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"></link>
    <link rel="icon" href="favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Join nafuu</title>
    <script src="https://use.fontawesome.com/1d95bf24b3.js"></script>
</head>
<body class="reg-body">
    <?php
        $current_user_Id = $_SESSION['id'];
    ?>
    <div class="welcome-msg">
        <h3>Add Medicine To Catalog</h3>
        <h5>Welcome to nafuu</h5>
        <p>Please fill the form below with accurate information.</p>
    </div>
    <button id = "add-med-form-btn" type="button" name="add-med-form-btn" class="pos-btn" onclick="popupForm()"><i class="fa-solid fa-add"></i>Add Medicine</button>

    <span class="add-med-form" id="add-med-form">
        <form method="POST" action="controls/processing.php">
            <button type="button" class="close-btn" id="close-btn" onclick = "closeForm()"></button>
            <input type="text" id="medName" name="medName"  size="30"  placeholder="Enter Medicine Name">
            <input type="text" id="manufacturer" name="manufacturer"  size="30"  placeholder="Enter Manufacturer">
            <input type="number" id="price" name="price"  size="30"  placeholder="Enter Price">
            <select name="administration" id="administration" required>
                <option selected disabled>Select Method of Administering The Medicine</option>
                    <option>Oral tablet</option>
                    <option>Oral syrup</option>
                    <option>Oral soluble or solvent</option>
                    <option>Injection</option>
            </select>
            <input type="submit" value="submit" name="add-med" id="add-med" class="pos-btn"/>
        </form>
    </span>

    <table style="margin:5%; margin-left:20%;" id="med-table">
        <tr>
            <th>Medicine Name</th>                           
            <th>Manufacturer Name</th>
            <th>Method of Administration</th>
            <th>Price</th>
            <th><i class="fa fa-trash-o"></i></th>
        </tr>
        <?php
            $sql_query = "SELECT * FROM medicine WHERE hospId = '$current_user_Id' ORDER BY medId DESC";
            $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            while($row = mysqli_fetch_array($result))
            {?>
                <tr>
                    <td><?php echo $row["medName"];?></td>
                    <td><?php echo $row["medManufacturer"];?></td>
                    <td><?php echo $row["medAdmin"];?></td>
                    <td><?php echo $row["price"];?></td> 
                    <td>
                        <form id="form"  action="controls/processing.php?id=<?php echo $row["medId"]; ?>" method="POST">
                            <button id = "delete-med-record" type="submit" name="delete-med-record"><i class="fa fa-trash-o"></i>Delete</button>
                        </form>
                    </td>  
                </tr>
                <?php
            }
        ?>
    </table>
</body>
<script>
    function popupForm(){
        var popup = document.getElementById("add-med-form");
        popup.style.display = "block";
    }
    function closeForm(){
        var popup = document.getElementById("add-med-form");
        popup.style.display = "none";
    }
</script>
</html>