
<section id="records-search-container">
<?php
    $current_user_name = $_SESSION['username'];
    $bool_value = 0;
?>
    <div class="menu-bar">
        <div class="search-bar-top">
            <div class="search-bar">
                <div data-parallax = "scroll">
                <h4>Search For Patient To View Records</h4>
                    <form action = "" method = "GET" class = "form-inline">
                        <input name = "keyword" id="search" type = "text" placeholder = "Search Patient here..." class = "form-control" value = "<?php echo isset($_POST['keyword'])?$_POST['keyword']:''?>"/>
                        <span><button class="search-btn" type="submit" name = "search"><i class="fa fa-search"></i>search</button></span>
                    </form>
                    <div id="suggestion" class="suggestion" style="position:absolute;margin-top:10%; background-color:#fff;">

                    </div>
                    <div class = "dropdown" id="dropdown">
                        <div style="position:absolute;">
                            <div class = "dropdown-content">
                                <div style="word-wrap:break-word;">
                                    <?php
                                    if(isset($_GET['search']))
                                    {
                                        $bool_value = 1;
                                        $keyword = $_GET['keyword'];
                                        $sql = "SELECT * FROM regpatients WHERE emailAddress LIKE '$keyword' or firstName LIKE '$keyword'";
                                        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                        while($rows = mysqli_fetch_array($result))
                                        {?>
                                            <a href = "single-patient-records.php?p=<?php echo $rows['id']; ?>"><h3><?php echo $rows['firstName']?></h3></a>
                                            <a style="text-decoration:none; color:black;"  href = "single-patient-records.php?p=<?php echo $rows['id']; ?>" ><h4><?php echo $rows['emailAddress']?></h4></a>
                                            <?php
                                        }
                                    }
                                    else{
                                        $bool_value = 0;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <script>
        function check_search(bool_value){
            console.log(`Bool Value:${bool_value}`);
            if(bool_value == 1){
                document.getElementById("dropdown").style.display="block";
            }
            else{
                document.getElementById("dropdown").style.display="none";
            }
        }
    </script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/code.jquery.com_jquery-latest.js"></script>
    <script src="js/jquery.timers-1.0.0.js"></script>
    <script type="text/javascript">
        //autocomplete 1
        $(document).ready(function(){
            $("#search").keyup(function(e){
                var search_query = $(this).val();
                if(search_query != ""){
                    $.ajax({
                        url:"patient-records-return-list.php",
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
</section>
