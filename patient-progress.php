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
    <title>CERA Patient Progress</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Your dashboard</title>
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="profileBody" id="profileBody">
    <div class="header">
        <?php include_once 'notif-menu.php';?>
    </div>
    <div class="mainBody" id="patient-records-section">
        <?php 
            include_once 'dash-menu.php';
        ?>
        <section>
            <div class="chart1" id="chart1"></div>
        </section>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/code.jquery.com_jquery-latest.js"></script>
    <script src="js/jquery.timers-1.0.0.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".chart1").everyTime(1000, function(i){
                $.ajax({
                    url:"chart1-div.php",
                    cache: false,
                    success: function(html){
                        $(".chart1").html(html)
                    }
                })
            })
        });
    </script>
</body>
</html>