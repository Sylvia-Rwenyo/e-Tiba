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
    <script src="https://use.fontawesome.com/1d95bf24b3.js"></script>
    <title>CERA</title>
</head>

<body class="dash-body" id="dosage-reg-home">
    <?php
        $current_user_name = $_SESSION['username'];
        $bool_value = 0;
    ?>
    <div class = "records-container">
        <section>
            <div class="menu-bar">
                <h2>Prescription Entry, by Doctor <?php echo $current_user_name;?></h2>
                <h4>Search For Patient To Assign Dosage</h4>
                <div class="search-bar-top">
                    <div class="search-bar">
                        <div data-parallax = "scroll">
                            <form action = "" method = "GET" class = "form-inline">
                                <input name = "keyword" type = "text" id="search" placeholder = "Search Patient here..." class = "form-control" value = "<?php echo isset($_POST['keyword'])?$_POST['keyword']:''?>"/>
                                <span class = "input-group-button"><button class="search-btn" type="submit" name = "search"><i class="fa fa-search"></i>search</button></span>
                            </form>
                            <div id="suggestion" class="suggestion">

                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </section>
        <div id="dosage-summary">
            <?php include_once "dosage-summary-div.php";?>
        </div>
    </div>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/code.jquery.com_jquery-latest.js"></script>
    <script src="../js/jquery.timers-1.0.0.js"></script>
    <script type="text/javascript">
        //autocomplete 1
        $(document).ready(function(){
            $("#search").keyup(function(e){
                var search_query = $(this).val();
                if(search_query != ""){
                    $.ajax({
                        url:"return-list.php",
                        type: "POST",
                        data: {search: search_query},
                        success: function($data){
                            $("#suggestion").fadeIn('fast').html($data);
                        }
                    });
                }
                else{
                    $("#suggestion").fadeOut();
                }
            })
        });
    </script>
    <?php echo "<script>check_search($bool_value)</script>";?>
</body>
</html>