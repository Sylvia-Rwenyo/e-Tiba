<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"></link>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Your dashboard</title>
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
</head>
<body class="dash-body">
<?php
// include_once 'menu.php';
?>
<div class="dash-menu">
        <ul>
            <li><a class="active" href="reg-partners.php"><i class="fa fa-plus"></i></a></li>
            <li><a class="active" href=""><i class="fa-solid fa-folder"></i></a></li>
            <li><a class="active" href=""><i class="fa-solid fa-chart-line"></i></a></li>
            <li><a class="active" href=""><i class="fa-solid fa-gears"></i></a></li>
        </ul>
    </div> 
<section>
<?php
if(isset($_SESSION["signedIn"])){
    echo '
    <div class="welcome-msg">
        <h3>'. $_SESSION["username"]. ', thank you for choosing CERA</h3>
        <p>Your cancer care companion.</p>
    </div>
    ';
}
?>   
</section>
</body>
</html>