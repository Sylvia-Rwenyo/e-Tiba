<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="../style.css"></link>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>CERA</title>
</head>

<body>
    <div>
        <h2>Dosage Entry, by Doctor</h2>
        <div style="display:inline-block">
            <form id="dosage-form"  action="../controls/dosage-entry.php" method="POST">
                <input type="text" id="dosageName" name="dosageName"  size="30" placeholder="Enter Name">
                <input type="number" id="tablets" name="tablets"  size="10"  placeholder="Tablets">
                <input type="number" id="timesADay" name="timesADay"  size="10"  placeholder="Times in a day">
                <input type="number" id="numberOfDays" name="numberOfDays"  size="10"  placeholder="Prescribed Duration in Days">
                <br/>
                <input id = "itemsubmit" type="submit" value="Submit" name="dosage-registration" class="btn">
            </form>
        </div>
    </div>
</body>
</html>