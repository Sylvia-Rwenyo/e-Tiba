<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"></link>
    <link rel="icon" href="favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">   
    <title>Welcome to Nafuu</title>
    <script src="https://use.fontawesome.com/1d95bf24b3.js"></script>
</head>
<body class="reg-body">
    <?php
    // show login form
    if(isset($_GET['login'])){
        if($_GET['login'] == 1){
            ?>
            <div class="welcome-msg">
                <h3>Welcome back</h3>
                <p>nafuu, your healthcare companion</p>
            </div>
            <?php
            if(isset($_GET['e'])){
                echo '<style>
                .alertDiv 
                    {
                        display: block;
                    }
                </style>';
                if($_GET['e'] == 1){  
                    ?>
                     <div id="invalidAlert" class="alertDiv">
                        <div>
                            <button  class="btn btn-lg btn-danger dialog-box-btn" onclick="logIn2()">x</button>
                        </div>
                        <p>Invalid password or email address. Please try again!</p> 
                    </div>
                    <?php
                }
                }}
            ?>
            
            <form method="POST" action="controls/processing.php">
                <input type="text" name="emailAddress" placeholder="Email Address" required/>
                <div id="pswdDiv">
                    <input type="password" id="reg-pw"  name="password" placeholder="password" required/>
                    <span id="showPswd" onclick="pswdDisplay()">
                    <i class="fa fa-eye-slash"></i>
                    </span>
                </div>
                <input type="submit" value="submit" name="logIn" class="pos-btn"/>
            </form>
 <?php
    }else{
        if(isset($_GET['e'])){
            echo '<style>
            .alertDiv 
                {
                    display: block;
                }
            </style>';
                if($_GET['e'] == 3){   
                ?>
                    <div class="alertDiv">
                        <button  class="btn btn-lg btn-danger dialog-box-btn" onclick="register2()">x</button>
                        <p>Email address already registered!</p> 
                    </div>
                    <?php
                }
                if($_GET['e'] == 4){   
                ?>
                    <div class="alertDiv">
                        <button  class="btn btn-lg btn-danger dialog-box-btn" onclick="register2()">x</button>
                        <p>Password format incorrect!</p>  
                    </div>
                <?php
                }
                if($_GET['e'] == 5){   
                    ?>
                        <div class="alertDiv">
                            <button  class="btn btn-lg btn-danger dialog-box-btn" onclick="register2()">x</button>
                            <p>Name should have more than one word!</p>  
                        </div>
                    <?php
                    }
            }
        // show registration form
    ?>
        <div class="welcome-msg">
            <h3>Welcome to nafuu</h3>
            <p>Please fill the form below with genuine information.</p>
        </div>
        <form method="POST" action="controls/processing.php" id="reg-form">
            <div id="patient-names">
                <input type="text" name="firstName" id="firstName" placeholder="First name" required/>
                <input type="text" name="lastName" id="lastName" placeholder="Last name" required/>
            </div>
            <input type="email" name="emailAddress" id="emailAddress" placeholder="Email Address e.g youremail@gmail.com" required/>
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
            <label class="check-box-container">
                <input type="checkbox" id="checkbox"/>
                <span class="checkmark"></span>
                I have read and agree to the <a href="privacy-policy.php"><i>privacy policy</i></a>
            </label>

            <input type="submit" value="submit" name="register" class="pos-btn" id="submit-btn" disabled/>
        </form>
    <?php
    } 
    ?>
</body>
<script>

// try logging in again if the password is invalid
    function logIn2(){
        window.location.href = "register.php?login=1";
    }
    
    function register2(){
        window.location.href = "register.php";
    }

    let showPswd = document.getElementById('showPswd');
    let password = document.getElementById("reg-pw");
    
function pswdDisplay(){
    if(password.type == "text"){
        password.type = "password";
        showPswd.innerHTML = '<i class="fa fa-eye-slash"></i>';
    }else{
        password.type = "text";
        showPswd.innerHTML = "<i class='fa fa-eye'></i>";
        password.style.border = "none";
    }
}
document.getElementById("pswdDiv").onclick = () => {
    document.getElementById("pswdDiv").style.border = '3px solid black';
}
document.getElementById("pswdDiv").onmouseleave = () => {
    document.getElementById("pswdDiv").style.border = 'none';
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
    let fullNameValue = document.getElementById("fullName").value;
    let wordCount = fullNameValue.trim().split(/\s+/).length;
    //if name entered has less than two words, stop operation
    if (wordCount < 2){
        event.preventDefault();
        window.location.href = "register.php?e=5";
    }

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
        window.location.href = "register.php?e=4";
    }


    //store registration information for one session
    let name = document.getElementById('fullName').value ;
    let emailAddress = document.getElementById('emailAddress').value;


    sessionStorage.setItem("name", name);
    sessionStorage.setItem("emailAddress", emailAddress);
};

const privacy_checkbox = document.getElementById('checkbox');
const submit_btn = document.getElementById('register');

const toggleBtnState = function(event){
    submit_btn.disabled = !event.target.checked;
}
privacy_checkbox.addEventListener('change', toggleBtnState)
</script>
</html>