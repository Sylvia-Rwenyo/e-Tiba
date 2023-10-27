<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css"></link>
    <link rel="icon" href="../favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Join nafuu</title>
    <script src="https://use.fontawesome.com/1d95bf24b3.js"></script>
    <title>Join nafuu</title>
</head>
<body class="reg-body">
    <div class="welcome-msg">
        <h3>Welcome to nafuu</h3>
        <p>Please fill the form below with accurate information as this is imporant for future identification with the platform administrators.</p>
    </div>
    <form method="POST" action="../controls/processing.php" id="reg-form">
        <input type="text" name="firstName" placeholder="First name"/>
        <input type="text" name="lastName" placeholder="Last name"/>
         <input type="number" name="years" placeholder="Years in practice"/>
         <select name="gender">
            <option selected disabled> Select your gender</option>
            <option>Female</option>
            <option>Male</option>
            <option>Prefer not to say</option>
        </select>
        <input type="text" name="emailAddress" placeholder="Email Address"/>
        <input type="text" name="phoneNumber" placeholder="Phone Number"/>
        <input type="text" name="address" placeholder="Your address"/>
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
        <div id="passwordChecker">
            <label class="pswd-warning"><i class="fa fa-check"></i>8 -20 characters long</label>
            <label class="pswd-warning"><i class="fa fa-check"></i>Includes an uppercase letter</label>
            <label class="pswd-warning"><i class="fa fa-check"></i>Includes a number</label>
            <label class="pswd-warning"><i class="fa fa-check"></i>Includes a symbol</label>
            <label class="pswd-warning"><i class="fa fa-check"></i>Does not include spaces</label>
        </div>
        <input type="hidden"  name="institution" value="<?php session_start(); if(isset($_SESSION['category']))
        {echo $_SESSION['username'];}else{ echo 'none';}
        ?>"/>
        <input type="submit" value="submit" name="register-doc" class="pos-btn"/>
    </form>
</body>
<script>
    let password = document.getElementById("reg-pw");

function pswdDisplay(){
let showpassword = document.getElementById('showPswd');
if(password.type == "text"){
  password.type = "password";
  showpassword.innerHTML = '<i class="fa fa-eye-slash"></i>';
}else{
  password.type = "text";
  showpassword.innerHTML = "<i class='fa fa-eye'></i>";
  password.style.border = "none";
}
}
document.getElementById("pswdDiv").onclick = () => {
document.getElementById("pswdDiv").style.border = '2px solid black';
}

//password checker functionality for registration form
//declare the variabes storing the element containing the password and the one containing the text indicating the passwords strength
let checker =  document.getElementById('passwordChecker');
let warnings = document.getElementsByClassName('pswd-warning');

//check for upper case letters
let poorRegExp = /[A-Z]/;

//check for numbers
let weakRegExp = /(?=.*?[0-9])/;

//check for symbols
let strongRegExp = /(?=.*?[#?!@$%^&*-])/;

//check for spaces
let whitespaceRegExp = /^$|\s+/;

// when password is entered
password.oninput = function(){
// display div containing warnings
checker.style.display = 'grid';

//store value of password in variable
let passwordValue = password.value;

if(passwordValue.length < 8 || passwordValue.length > 20){
  warnings[0].style.color = "red";
}else if(passwordValue.length > 8 || passwordValue.length < 20){
  warnings[0].style.color = "green";
}

//check for upper case letters in password
let upperCaseChecker= passwordValue.match(poorRegExp);

if(upperCaseChecker){
  warnings[1].style.color = "green";
}
else if(!upperCaseChecker  && !(passwordValue.length > 8 || passwordValue.length < 20)){
  warnings[1].style.color = "red";
}

//check for numbers in password
let numbersChecker= passwordValue.match(weakRegExp);

if(numbersChecker){
  warnings[2].style.color = "green";
}else if(!numbersChecker && !(passwordValue.length > 8 || passwordValue.length < 20)){
  warnings[2].style.color = "red";
}

//check for symbols in password
let symbolsChecker= passwordValue.match(strongRegExp);

if(symbolsChecker){
  warnings[3].style.color = "green";
}else if(!symbolsChecker  && !(passwordValue.length > 8 || passwordValue.length < 20)){
  warnings[3].style.color = "red";
}

//check for spaces in password
let whitespaceChecker= passwordValue.match(whitespaceRegExp);

if(whitespaceChecker){
  warnings[4].style.color = "red";
}else if(!whitespaceChecker && (passwordValue.length > 8 || passwordValue.length < 20)){
  warnings[4].style.color = "green";
}
}
document.getElementById('reg-form').onsubmit = (event) => {
let passwordValue = password.value;

// Regular expressions to check for upper case letters, numbers, symbols, and spaces
let upperCaseRegExp = /[A-Z]/;
let numbersRegExp = /(?=.*?[0-9])/;
let symbolsRegExp = /(?=.*?[#?!@$%^&*-])/;
let whitespaceRegExp = /\s/;

// Check if the password meets the strength criteria
let isStrongPassword = (
  passwordValue.length >= 8 &&
  passwordValue.length <= 20 &&
  upperCaseRegExp.test(passwordValue) &&
  numbersRegExp.test(passwordValue) &&
  symbolsRegExp.test(passwordValue) &&
  !whitespaceRegExp.test(passwordValue)
);

// If the password is not strong, prevent form submission and show an alert
if (!isStrongPassword) {
  event.preventDefault();
  window.location.href = "independent-reg-doc.php?e=4";
}
};
    </script>
</html>