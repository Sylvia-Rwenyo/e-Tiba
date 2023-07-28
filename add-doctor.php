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
        <p>Please fill the form below with accurate information as this is imporant for future identification with the platform administrators.</p>
    </div>
    <form method="POST" action="controls/processing.php">
        <input type="text" name="firstName" placeholder="Doctor first name"/>
        <input type="text" name="lastName" placeholder="Doctor last name"/>
         <input type="number" name="years" placeholder="Years in practice"/>
         <select name="gender">
            <option selected disabled> Select your gender</option>
            <option>Female</option>
            <option>Male</option>
            <option>None</option>
        </select>
        <input type="text" name="emailAddress" placeholder="Email Address"/>
        <input type="text" name="institution" placeholder="Institution Name"/>
        <input type="text" name="phoneNumber" placeholder="Phone Number"/>
        <input type="text" name="address" placeholder="Your address"/>
        <input type="submit" value="submit" name="register-doc-by-partner" class="pos-btn"/>
    </form>
</body>
</html>