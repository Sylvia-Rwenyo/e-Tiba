<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css"></link>
    <link rel="icon" href="favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Join CERA</title>
    <script src="https://use.fontawesome.com/1d95bf24b3.js"></script>
</head>
<body class="reg-body">
    <div class="welcome-msg">
        <h3>Welcome to CERA</h3>
        <p>Please fill the form below with accurate information as this is imporant for future identification with your patients.</p>
    </div>
    <form method="POST" action="controls/processing.php">
        <input type="text" name="institutionName" placeholder="Your institution's name" required/>
        <input type="text" name="location" placeholder="location" required/>
        <input type="number" name="phoneNumber" placeholder="Phone number" required/>
        <input type="text" name="emailAddress" placeholder="Email address" required/>
        <input type="text" name="postalAddress" placeholder="Postal Address" required/>
        <select name="conditions[]" required multiple>
            <option selected disabled> Which of the following conditions do you cater to?</option>
            <option>Condition A</option>
            <option>Condition B</option>
            <option>Condition C</option>
        </select>
        <div id="pswdDiv">
            <input type="password" id="reg-pw"  name="password" placeholder="password" required/>
            <span id="showPswd" onclick="pswdDisplay()">
            <i class="fa fa-eye-slash"></i>
            </span>
        </div>
        <input type="submit" value="submit" name="reg-partner" class="pos-btn"/>
    </form>
</body>
<script>
      function pswdDisplay(){
    let showPswd = document.getElementById('showPswd');
    let pswd = document.getElementById("reg-pw");
    if(pswd.type == "text"){
        pswd.type = "password";
        showPswd.innerHTML = '<i class="fa fa-eye-slash"></i>';
    }else{
        pswd.type = "text";
        showPswd.innerHTML = "<i class='fa fa-eye'></i>";
        pswd.style.border = "none";
    }
}
document.getElementById("pswdDiv").onclick = () => {
    document.getElementById("pswdDiv").style.border = '2px solid black';
}
</script>
</html>