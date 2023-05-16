<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href = "style.css" rel = "stylesheet">
    <title>ArlingtonSprouts</title>
</head>
<body>
    <div>
    <h1>Update Item Details</h1>
        <div style="display:inline-block">
            <form id="form"  action="UpdateItem.php?id=<?php echo $_GET['id'] ?>" method="POST">
                <input type="text" id="name" name="name"  size="30" placeholder="Enter Name">
                <input type="number" id="s_price" name="s_price"  size="10"  placeholder="Enter Price">
                <br/>
                <input id = "itemsubmit" type="submit" value="Submit" name="save" class="btn">
            </form>
        </div>
    </div>
</body>
</html>