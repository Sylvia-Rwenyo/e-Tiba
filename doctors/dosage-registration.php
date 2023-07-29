
<section class = "records-container" id="records-search-container">
<?php
    $current_user_name = $_SESSION['username'];
?>
    <div class="menu-bar">
        <h4>Search For Patient To Assign Dosage</h4>
        <div class="search-bar-top">
            <div class="search-bar">
                <div data-parallax = "scroll">
                    <form action = "" method = "GET" class = "form-inline">
                        <input name = "keyword" type = "text" placeholder = "Search Patient here..." class = "form-control" value = "<?php echo isset($_POST['keyword'])?$_POST['keyword']:''?>"/>
                        <span class = "input-group-button"><button class="search-btn" type="submit" name = "search"><i class="fa fa-search"></i>search</button></span>
                    </form>
                    <div class = "dropdown" id="dropdown">
                        <div style="position:absolute;">
                            <div class = "dropdown-content">
                                <div style="word-wrap:break-word;">
                                    <?php
                                    if(isset($_GET['search']))
                                    {
                                        $keyword = $_GET['keyword'];
                                        $sql = "SELECT * FROM regpatients WHERE emailAddress LIKE '$keyword' or firstName LIKE '$keyword'";
                                        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                        while($rows = mysqli_fetch_array($result))
                                        {?>
                                            <a href = "dosage-registration-form.php?id=<?php echo $rows['id']; ?>"><h3><?php echo $rows['firstName']?></h3></a>
                                            <a href = "dosage-registration-form.php?id=<?php echo $rows['id']; ?>" ><h4><?php echo $rows['emailAddress']?></h4></a>
                                            <?php
                                        }
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
</section>
