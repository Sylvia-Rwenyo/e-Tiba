<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"></link>
    <link rel="icon" href="favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Join CERA</title>
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
                <p>CERA, your healthcare companion</p>
            </div>
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
        }
    }else{
        // show registration form
    ?>
        <div class="welcome-msg">
            <h3>Welcome to CERA</h3>
            <p>Please fill the form below with accurate information as this is imporant for future identification with your doctors.</p>
        </div>
        <form method="POST" action="controls/processing.php" id="reg-form">
            <input type="text" name="firstName" placeholder="First name" required/>
            <input type="text" name="lastName" placeholder="Last name" required/>
            <input type="number" name="age" placeholder="Your age" required/>
            <select name="gender" required>
                <option selected disabled> Select gender</option>
                <option>Female</option>
                <option>Male</option>
                <option>Prefer not to say</option>
            </select>
            <input type="email" name="emailAddress" placeholder="Email Address e.g youremail@gmail.com" required/>
            <input type="number" name="phoneNumber" placeholder="Phone number e.g 07********" required/>
            <input type="text" name="address" placeholder="Address" required/>
            <select name="institution" required>
                <option selected disabled> Select your hospital</option>
                <?php
                include_once 'conn.php';
                 $stmt = "SELECT * FROM reginstitutions ";
                 $sql = mysqli_query($conn, $stmt);
                 $specialties = array();
                 if (mysqli_num_rows($sql) > 0) {
                     while ($row = mysqli_fetch_array($sql)) {
                     ?>
                    <option><?php echo $row['institutionName'];?></option>
                <?php
                }}
                ?>
            </select>
            <!--
                condition will be determined by the doctor    
            <select name="condition[]" multiple required>
                <option selected disabled> Select your condition</option>
                <option>Condition A</option>
                <option>Condition B</option>
                <option>Condition C</option>
            </select> -->
            <div id="pswdDiv">
                <input type="password" id="reg-pw"  name="password" placeholder="password" required/>
                <span id="showPswd" onclick="pswdDisplay()">
                    <i class="fa fa-eye-slash">o</i>
                </span>
            </div>
            <div id="passwordChecker">
                <label class="pswd-warning"><i class="fa fa-check"></i>8 -20 characters long</label>
                <label class="pswd-warning"><i class="fa fa-check"></i>Includes an uppercase letter</label>
                <label class="pswd-warning"><i class="fa fa-check"></i>Includes a number</label>
                <label class="pswd-warning"><i class="fa fa-check"></i>Includes a symbol</label>
                <label class="pswd-warning"><i class="fa fa-check"></i>Does not include spaces</label>
            </div>
            <input type="submit" value="submit" name="register" class="pos-btn"/>
        </form>
    <?php
    }
    ?>
</body>
<script>

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
let poorRegExp = /[a-z]/;

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
// function isPasswordStrong(password) {
//         // Regular expressions to check for upper case letters, numbers, symbols, and spaces
//         let upperCaseRegExp = /[A-Z]/;
//         let numbersRegExp = /(?=.*?[0-9])/;
//         let symbolsRegExp = /(?=.*?[#?!@$%^&*-])/;
//         let whitespaceRegExp = /\s/;

//         // Check the password against the regular expressions
//         return (
//             password.length >= 8 &&
//             password.length <= 20 &&
//             upperCaseRegExp.test(password) &&
//             numbersRegExp.test(password) &&
//             symbolsRegExp.test(password) &&
//             !whitespaceRegExp.test(password)
//         );
//     }

//     // Function to handle form submission
//     document.getElementById('reg-form').onsubmit = () =>{
//         let isStrongPassword = isPasswordStrong(password);

//         // If the password is not strong, prevent form submission
//         if (!isStrongPassword) {
//             event.preventDefault();
//             alert('Password must be 8 - 20 characters long and include an uppercase letter, a number, and a symbol. Password must not include spaces.');
//         }
//     }
</script>
</html>