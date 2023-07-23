    <div class="menu meet-menu">
        <ul>
            <li><a href="meet.php"><i class="fa fa-bell"></i></a></li>
            <li><a href=""><i class="fa fa-message"></i></a></li>
            <li>
                <?php 
                session_start();
                ?>
                <a href = <?php 
                if($_SESSION['category'] == 'doctor')
                {
                    echo "doctors/patient-doctor-chat.php";
                }
                elseif($_SESSION['category'] == 'patient')
                {
                    echo "individual-patient-chat.php";
                }?>>
                <?php
                $current_user_email = $_SESSION['email'];
                $resultPost = mysqli_query($conn,"SELECT readStatus FROM chat WHERE sent_to = '$current_user_email'");
                $count = 0;
                while($row = mysqli_fetch_array($resultPost)) 
                {
                    if($row['readStatus'] == 'unread')
                    {
                        $count = $count + 1;
                    }?>
                    <i class="fa-solid fa-video"><?php if($count == 0){echo "";}else{echo $count;}?></i><?php 
                }?>
                </a>
                </li>
            
            <li><a href=""><i class="fa-solid fa-book"></i></a></li>
        </ul>
    </div>
    <script>
        var element = document.querySelectorAll(".menu a");
        var length = element.length;
        for(var i=0; i<length;i++){
            element[i].onclick=function()
            {
                var b=document.querySelector(".menu a.active");
                if(b) b.classList.remove("active");
                this.classList.add('active');
            };
        }
    </script>