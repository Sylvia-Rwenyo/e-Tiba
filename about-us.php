<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"></link>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>About CERA</title>
</head>
<body class="home">
    <?php include_once "menu.php" ?>
    <div class="intro">
        <div class="c-phrase-section">
            <div class="c-phrase">
                <h3>Cancer care made seamless,&nbsp;<b>for you</b></h3>
            </div>
            <p>Let us help you track your health and treatment process</p>
        </div>
        <div class="banner">
          <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <!-- <div class="carousel-item active">
                <img src="images/" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Connect directly to your doctor</h5>
                  <p>Call and direct messaging enabled</p>
                </div>
              </div> -->
              <div class="carousel-item active">
                <img src="images/vitals.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block" id="carousel1">
                  <h5 class="top-text">Track your health status</h5>
                  <p class="top-text">Log in how you feel at any time</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="images/pills.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block" id="carousel2">
                  <h5 class="top-text">Be on top of your medication intake</h5>
                  <p class="top-text">Reminders are autoscheduled for you</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
    </div>
</body>
</html>