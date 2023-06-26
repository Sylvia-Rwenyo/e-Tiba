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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="dash-body">
  <div class="header">
    <h1>Dashboard</h1>
  </div>
  <div class="mainBody">
<?php
session_start();
if(!isset($_SESSION["loggedIN"])){
  header('location:index.php');
}else{
//show dashboard menu
include_once 'dash-menu.php'
?>
<section>
<?php
if(isset($_SESSION["loggedIN"])){
    echo '
    <div class="welcome-msg">
        <h3>'. $_SESSION["username"]. ', thank you for choosing CERA</h3>
        <p>Your healthcare care companion.</p>
    </div>
    ';
}
if(isset($_GET['charts'])){
  ?>
  <div class="progress-charts">

    <?php
    if($_GET['charts'] == 1){
        ?>
            <canvas id="progress1"></canvas>
            <!-- <canvas id="progress2"></canvas> -->
    <?php
        }
        ?>
  </div>
  <?php
    }}
    ?>   
</section>
</div>
</body>
<script>
  var currentDate = new Date();

// Subtract one month from the current date
currentDate.setMonth(currentDate.getMonth() - 1);

var year = currentDate.getFullYear();
var month = currentDate.getMonth() + 1;
var day = currentDate.getDate();

var formattedDate = (month < 10 ? "0" + month : month) + "-" + (day < 10 ? "0" + day : day) + "-" + year + "-";

 var ctx = document.getElementById('progress1').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [], // Initialize an empty array for labels
    datasets: [{
      label: 'Your progress since ' + formattedDate,
      data: [], // Initialize an empty array for data
      borderColor: 'rgba(255, 99, 132, 1)',
      borderWidth: 1,
      pointBackgroundColor: [], // Initialize an empty array for point background color
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
var ctx1 = document.getElementById('progress2').getContext('2d');
var myChart1 = new Chart(ctx1, {
  type: 'pie',
  data: {
    labels: ['a', 'b', 'c'], // Initialize an empty array for labels
    datasets: [{
      label: 'Your progress since ' + formattedDate,
      data: [60, 90, 210], // Initialize an empty array for data
      borderColor: 'rgba(255, 99, 132, 1)',
      borderWidth: 1,
      pointBackgroundColor: [], // Initialize an empty array for point background color
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});


// Populate labels, data, and point background color arrays dynamically
var startDate = new Date(year, month - 1, day); // Create a new date object for the start date
var currentDate = new Date(); // Get the current date

while (startDate <= currentDate) {
  myChart.data.labels.push(startDate.getDate()); // Add the day of the month as a label
  var progress = Math.floor(Math.random() * 10) + 1; // Generate random progress data (replace with your actual data)
  myChart.data.datasets[0].data.push(progress); // Add progress data

  // Set the point background color based on the value of progress
  if (progress < 3) {
    myChart.data.datasets[0].pointBackgroundColor.push('green');
  } else if (progress < 6) {
    myChart.data.datasets[0].pointBackgroundColor.push('yellow');
  } else {
    myChart.data.datasets[0].pointBackgroundColor.push('red');
  }

  startDate.setDate(startDate.getDate() + 1); // Increment the date by 1 day
}

myChart.update(); // Update the chart to reflect the new data
myChart1.update(); // Update the chart to reflect the new data


    </script>
</html>