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
    <link rel="stylesheet" href="../style.css"></link>
    <link rel="icon" href="../favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Join CERA</title>
    <script src="https://use.fontawesome.com/1d95bf24b3.js"></script>
    <title>CERA chat</title>
</head>
<body class="reg-body" id="patient-doc-home-chat">
    <?php 
        $current_user_category = $_SESSION['category'];
    ?>
<div class="menu-bar">
    <div class="welcome-msg">
            <h3>Patient Doctor Chat</h3>
            <p>Get to know your <?php if($current_user_category == 'doctor')
            {
                echo "patient";
            }elseif($current_user_category == 'patient')
            {
                echo "doctor";
            }?>
            </p>
    </div>
    <div class="search-bar-top">
        <div class="search-bar">
            <div data-parallax = "scroll">
                <form action = "" method = "GET" class = "form-inline">
                    <input name = "keyword" type = "text" placeholder = "Search Patient here..." class = "form-control" value = "<?php echo isset($_POST['keyword'])?$_POST['keyword']:''?>"/>
                    <span class = "input-group-button"><button class="search-btn" type="submit" name = "search">SEARCH</button></span>
                </form>
                <div class = "dropdown">
                    <div style="position:absolute;">
                        <div class = "dropdown-content">
                            <div style="word-wrap:break-word;">
                                <?php
                                if(isset($_GET['search']))
                                {
                                    $keyword = $_GET['keyword'];
                                    if($current_user_category == 'doctor'){
                                        $sql = "SELECT * FROM regpatients WHERE emailAddress LIKE '$keyword' or firstName LIKE '$keyword'";
                                    }
                                    elseif($current_user_category == 'patient'){
                                        $sql = "SELECT * FROM regdoctors WHERE emailAddress LIKE '$keyword' or firstName LIKE '$keyword'";
                                    }
                                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                    while($rows = mysqli_fetch_array($result))
                                    {?>
                                        <a href = "messages-page.php?id=<?php echo $rows['id']; ?>"><h3><?php echo $rows['firstName']?></h3></a>
                                        <a href = "messages-page.php?id=<?php echo $rows['id']; ?>" ><h4><?php echo $rows['emailAddress']?></h4></a>
                                        <?php
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>
<div class="chat_list_table" id="chat_list_table"></div>

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/code.jquery.com_jquery-latest.js"></script>
    <script src="../js/jquery.timers-1.0.0.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".chat_list_table").everyTime(1000, function(i){
                $.ajax({
                    url:"all-chats-div.php",
                    cache: false,
                    success: function(html){
                        $(".chat_list_table").html(html)
                    }
                })
            })
        });
    </script>
</body>
</html>