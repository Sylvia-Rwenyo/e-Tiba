<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="style.css"></link>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/1d95bf24b3.js"></script>
    <title>CERA</title>
</head>
<body class="home">
    <div class="partners-CTA">
       
    </div>
    <?php include_once "menu.php" ?>
    <div class="intro">
        <div class="c-phrase-section">
            <div class="c-phrase">
                <h3>Mobile Health care made seamless,&nbsp;<b>for you</b></h3>
            </div>
            <p>Let us help you track your health and treatment process</p>
        </div>
        <div class="CTA">
            <button class="pos-btn" id="join-us" onclick="popupFunc()" style="position:relative;display:block;cursor:pointer;">Join Us
                <span class="popuplinks" id="popuplinks">
                    Select To Join Us As:
                    <a href="register.php">
                        <p>Patient</p>
                    </a>
                    <a href="partners/reg-partner.php"> 
                        <p>Partner Hospital</p>
                    </a>
                    <a href="doctors/independent-reg-doc.php">
                        <p>Independent Medical Practitioner</p>
                    </a>
                </span>
            </button>
            <a href="about-us.php"><button class="neg-btn">Learn More</button></a>
        </div>
    </div>
    <script>
        function popupFunc(){
            var popup = document.getElementById("popuplinks");
            popup.classList.toggle("show");
        }
    </script>
</body>
</html>