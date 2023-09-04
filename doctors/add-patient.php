<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css"></link>
    <link rel="icon" href="../favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Join CERA</title>
    <script src="https://use.fontawesome.com/1d95bf24b3.js"></script>
    <title>CERA</title>
</head>
<body class="reg-body">
    <div class="welcome-msg">
        <h3>Patient registration</h3>
        <p>Please fill the form below with accurate information as this is imporant for future identification of your patients.</p>
    </div>
    <form method="POST" action="../controls/processing.php">
    <input type="text" name="firstName" placeholder="Patient first name" required/>
            <input type="text" name="lastName" placeholder="Patient last name" required/>
            <input type="number" name="age" placeholder="Patient age" required/>
            <select name="gender" required>
                <option selected disabled> Select Patient gender</option>
                <option>Female</option>
                <option>Male</option>
                <option>Other</option>
            </select>
            <input type="text" name="emailAddress" placeholder="Patient Email Address" required/>
            <input type="number" name="phoneNumber" placeholder="Patient phone number" required/>
            <input type="text" name="address" placeholder="Patient address" required/>
            <select name="institution" required>
                <option selected disabled> Select Patient Hospital</option>
                <?php
                include_once '../conn.php';
                 $stmt = "SELECT * FROM reginstitutions ";
                 $sql = mysqli_query($conn, $stmt);
                 if (mysqli_num_rows($sql) > 0) {
                     while ($row = mysqli_fetch_array($sql)) {
                     ?>
                    <option><?php echo $row['institutionName'];?></option>
                <?php
                }}
                ?>
            </select>
            <select name="condition[]" multiple required>
                <option selected disabled> Select Patient condition</option>
                <option>Condition A</option>
                <option>Condition B</option>
                <option>Condition C</option>
            </select>
            <input type="submit" value="submit" name="add-patient" class="pos-btn"/>
    </form>
</body>
</html>