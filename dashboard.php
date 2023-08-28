<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"></link>
    <link rel="icon" href="favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Your dashboard</title>
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
</head>
<body class="dash-body" id="dash-body">
  <div class="header">
    <?php
      include_once 'notif-menu.php';
    ?>
  </div>
  <div class="mainBody">
<?php
if(!isset($_SESSION["loggedIN"])){
  header('location:index.php');
}else{
//show dashboard menu
include_once 'dash-menu.php'
?>
<section class="main-section">

   <div class="dash-intro">
     <?php include_once 'dash-nav.php';?>
   </div>

   <?php
if(isset($_GET['r'])){
  if($_GET['r'] == 1){
    include_once 'single-patient-records.php';
  }
}
if(isset($_GET['m'])){
  if($_GET['m'] == 1){
    // include_once 'single-patient-records.php';
  }
}
if($_SESSION["category"] != "patient"){
  include_once 'patient-progress-search-div.php';
}

if(isset($_GET['charts'])){
  ?>
  <div class="progress-charts">
    <div class="sleep_chart" id="sleep_chart"></div>
    <div class="meals_chart" id="meals_chart"></div>
  </div>
<?php
}
?>   
</div>
 
</section>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/code.jquery.com_jquery-latest.js"></script>
<script type="text/javascript">
  function print1patientRecord(){
                        window.location.href = 'single-patient-records.php?print=1';
                    }
                    
  var sections = [{
    divclass: ".sleep_chart",
    urlname:"charts/sleep-chart-div.php"
  },
  {
    divclass: ".meals_chart",
    urlname:"charts/meals-chart-div.php"
  }];
    $(document).ready(function(){
        $.each(sections, function(index, value){
          $(value.divclass).everyTime(10000, function(i){
            $.ajax({
                url:value.urlname,
                data: {
                    p_id:<?php echo $_SESSION['id'];?>,
                },
                cache: false,
                success: function(html){
                    $(value.divclass).html(html)
                }
            })
        })
        });
    });
</script>
</body>
</html>
<?php    
}
?>  