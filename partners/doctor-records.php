<?php 
    include_once '../conn.php';
    session_start();
    if($_SESSION["loggedIN"] == false)
    {
        echo ' <script> 
        window.location.href = "../index.php";
        </script>';       
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../favicon.ico" />
    <link rel="stylesheet" href="../style.css"></link>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>CERA</title>
</head>

<body class="dash-body">
    <?php
        $current_user_name = $_SESSION['username'];
        $bool_value = 0;
    ?>
    <div class = "records-container">
        <?php include_once '../dash-menu.php';?>
        <section>
            <div class="menu-bar">
                <h2>Doctor Records</h2>
                <p>Doctors Under <?php echo $current_user_name;?></p>
                <h4>View All Records / Search For individual Doctor</h4>
                <div class="search-bar-top">
                    <div class="search-bar">
                        <div data-parallax = "scroll">
                            <form action = "" method = "GET" class = "form-inline">
                                <input name = "keyword" type = "text" placeholder = "Search Doctor Name or Email..." class = "form-control" value = "<?php echo isset($_POST['keyword'])?$_POST['keyword']:''?>"/>
                                <span class = "input-group-button"><button class="search-btn" type="submit" name = "search"><i class="fa fa-search"></i>search</button></span>
                            </form>
                            <div class = "dropdown" id="dropdown">
                                <div style="position:absolute;">
                                    <div class = "dropdown-content">
                                        <div style="word-wrap:break-word;">
                                            <?php
                                            if(isset($_GET['search']))
                                            {   
                                                $bool_value = 1;
                                                $keyword = $_GET['keyword'];
                                                $sql = "SELECT * FROM regdoctors WHERE emailAddress LIKE '$keyword' or firstName LIKE '$keyword'";
                                                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                                while($rows = mysqli_fetch_array($result))
                                                {?>
                                                    <a href = "doctor-records.php?doc-id=<?php echo $rows['id']; ?>"><h3><?php echo $rows['firstName']?></h3></a>
                                                    <a href = "doctor-records.php?doc-id=<?php echo $rows['id']; ?>" ><h4><?php echo $rows['emailAddress']?></h4></a>
                                                    <?php
                                                }
                                            } 
                                            elseif(isset($_GET['doc-id'])){
                                                $bool_value = 2;
                                            }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </section>
        <div id="all-doctor-records">
            <?php include_once "all-doctor-records-div.php";?>
        </div>
        <div id="individual-doctor-records">
            <?php include_once "individual-doctor-records-div.php";?>
        </div>
    </div>
    <script type="text/JavaScript">
        function check_search(bool_value){
            console.log(`Bool Value:${bool_value}`);
            if(bool_value == 1){
                document.getElementById("dropdown").style.display="block";
                document.getElementById("all-doctor-records").style.display="none";
                document.getElementById("individual-doctor-records").style.display="none";
            }
            else if(bool_value == 2){
                document.getElementById("dropdown").style.display="none";
                document.getElementById("all-doctor-records").style.display="none";
                document.getElementById("individual-doctor-records").style.display="block";
            }
            else if(bool_value == 0){
                document.getElementById("all-doctor-records").style.display="block";
                document.getElementById("dropdown").style.display="none";
                document.getElementById("individual-doctor-records").style.display="none";
            }
        }
    </script>
    <?php echo "<script>check_search($bool_value)</script>";?>
</body>
</html>