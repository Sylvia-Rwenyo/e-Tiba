<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"></link>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>CERA</title>
</head>
<body>
    <?php 
    session_start();
    if(isset($_SESSION['loggedIN']) || isset($_SESSION['signedIn']) ){
        ?>
    <div class="menu">
        <ul>
            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="">New log</a></li>
            <li><a href="">Your reports</a></li>
            <li><a href="about-us.php">About Us</a></li>
        </ul>
    </div> 
    <?php 
        }else{
    ?>
    <div class="menu">
        <ul>
            <li><a class="active" href="index.php">Home</a></li>
            <!-- <li><a href="">New log</a></li>
            <li><a href="">Your reports</a></li> -->
            <li><a href="about-us.php">About Us</a></li>
        </ul>
    </div>
     <?php
     } 
    ?> 
</body>
</html>