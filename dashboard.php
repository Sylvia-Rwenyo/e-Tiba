<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="icon" href="favicon.ico" />
        <link rel="stylesheet" href="style.css">
    <!-- Include Chart.js library -->
    <!-- <script src="js/cdn.jsdelivr.net_npm_chart.js"></script> -->
<script src="js/cdnjs.cloudflare.com_ajax_libs_Chart.js_2.9.4_Chart.js"></script>

    <title>Your dashboard</title>
</head>
<body class="dash-body" id="dash-body">
  <div class="header">
    <?php
      include_once 'notif-menu.php';
    ?>
  </div>
  <div class="mainBody">
<?php
if (!isset($_SESSION["loggedIN"])) {
    header('location:index.php');
} else {
    // Show dashboard menu
    include_once 'dash-menu.php';
    ?>
    <section class="main-section">
        <div class="dash-intro">
            <?php include_once 'dash-nav.php'; ?>
        </div>

        <?php
        if (isset($_GET['r'])) {
            if ($_GET['r'] == 1) {
                include_once 'single-patient-records.php';
            }
        }
        if (isset($_GET['m'])) {
            if ($_GET['m'] == 1) {
                // include_once 'single-patient-records.php';
            }
        }
        if ($_SESSION["category"] != "patient") {
            include_once 'patient-progress-search-div.php';
        }

        if (isset($_GET['charts'])) {
            ?>
            <div class="progress-charts">
                <!-- Chart containers -->
                <?php
                  include_once 'charts/sleep-chart-div.php';
                  include_once 'charts/meals-chart-div.php';
                  include_once 'charts/exercise-chart-div.php';
                ?>
            </div>
            <?php
        }
        ?>
    </section>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/code.jquery.com_jquery-latest.js"></script>
    <script type="text/javascript">
        function print1patientRecord() {
            window.location.href = 'single-patient-records.php?print=1';
        }
    </script>
</body>
</html>
<?php
}
?>
