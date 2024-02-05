<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="style.css"></link>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>nafuu</title>
</head>
<body>
    <?php 
    @session_start();
    if(isset($_SESSION['loggedIN'])){
        ?>
    <div class="menu">
        <ul>
            <img src="images/logo.png" alt="nafuu logo"/>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="about-us.php">About Us</a></li>
            <!-- Dosage registration test link. To be removed -->
            <!-- <li><a href="dosage-registration.php">Dosage</a></li> -->
        </ul>
    </div> 
    <?php 
       }else{
    ?>
    <div class="menu">
        <ul>
            <img src="images/logo.png" alt="nafuu logo"/>
            <li><a href="register.php?login=1">Log In</a></li>
            <li><a href="about-us.php">About Us</a></li>
        </ul>
    </div>
     <?php
     } 
    ?> 
    <script>
        var element = document.querySelectorAll(".menu a");
        var length = element.length;
        for(var i=0; i<length;i++){
            element[i].onclick=function()
            {
                var b=document.querySelector(".menu a.active");
                if(b) b.classList.remove("active");
                this.classList.add('active');
            };
        }
    </script>
</body>
</html>