<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"></link>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Join CERA</title>
</head>
<body class="reg-body">
    <form method="POST" action="processing.php">
        <input type="text" name="firstName" placeholder="First name"/>
        <input type="text" name="lastName" placeholder="Last name"/>
        <input type="text" name="emailAddress" placeholder="Email Address"/>
        <select name="institution">
            <option selected disabled> Select your Hospital</option>
            <option>Institution A</option>
            <option>Institution B</option>
            <option>Institution C</option>
        </select>
        <select name="condition">
            <option selected disabled> Select your condition</option>
            <option>Condition A</option>
            <option>Condition B</option>
            <option>Condition C</option>
        </select>
        <input type="password" id="reg-pw"  name="password" placeholder="password"/>
        <input type="submit" value="submit" name="register" class="pos-btn"/>
    </form>
</body>
</html>