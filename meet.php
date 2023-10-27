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
    <script src="https://unpkg.com/peerjs@1.4.7/dist/peerjs.min.js"></script>
</head>
<body class="dash-body">
  <div class="header">
    <?php
      include_once 'notif-menu.php';
    ?>
  </div>
  <!-- <div class="mainBody" id="videoChat"> -->
<?php
//show dashboard menu
include_once 'dash-menu.php'
?>
<!-- <section class="main-section"> -->
<script crossorigin src="https://unpkg.com/@daily-co/daily-js"></script>
<script>
       callFrame = window.DailyIframe.createFrame({
  showLeaveButton: true,
  iframeStyle: {
    position: 'fixed',
    top: '15%',
    left: '15%',
    width: '80%',
    height: '80%',
  },
});
      callFrame.join({ url: 'https://nafuu-beta.daily.co/NGlSp1Ls8us1AhRwTi67'});
</script>
<!-- </section> -->
<!-- </div> -->
</body>
<script>



</script>
 
</html>