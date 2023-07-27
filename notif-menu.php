<?php 
                include_once "conn.php";
                session_start();
                function prefixSet($linkName) {
                    // Get the parent directory of the current page
                    $parentDir = dirname($_SERVER['REQUEST_URI']);
                    $parentDir = dirname($_SERVER['REQUEST_URI']);
                    $parentDirCurrent = str_replace('/work/CERA', '', $parentDir); // Remove trailing slash
                
                    if ($parentDirCurrent === '/partners' && strpos($linkName, 'partners/') === 0) {
                        $linkName = str_replace('partners/', '', $linkName);
                        return $linkName;
                    } else if ($parentDirCurrent === '/doctors' && strpos($linkName, 'partners/') === 0) {
                        // If the parent directory is "doctors" and the link starts with "partners",
                        // keep the link as it is without adding any prefix or removing any part.
                        $linkName = '../' . $linkName;
                        return $linkName;
                    }else if($parentDirCurrent === '/doctors' || $parentDirCurrent === '/partners' && strpos($linkName, '/') === 1){
                        $linkName = '../' . $linkName;
                        return $linkName;
                    }
                
                    // Add more conditions if needed for other parent directories
                
                    // If none of the conditions match, return the original linkName
                    return $linkName;
                }
                ?>
    <div class="menu meet-menu">
        <ul>
            <li><a href="<?php echo prefixSet('meet.php')?>"><i class="fa-solid fa-video"></i></a></li>
            <li>
                <a href = <?php
                // call the prefixSet() function appropriately.
                //  echo prefixSet(
                if($_SESSION['category'] == 'doctor')
                {
                    echo "doctors/patient-doctor-chat.php";
                }
                elseif($_SESSION['category'] == 'patient')
                {
                    echo "patient-doctor-chat-by-patient.php";
                }else if($_SESSION['category'] == 'hospital')
                {
                    echo "partners/patient-doctor-chat.php";
                }
            // )
            ;
                ?>>
                <?php
                $current_user_email = $_SESSION['email'];
                $resultPost = mysqli_query($conn,"SELECT readStatus FROM chat WHERE sent_to = '$current_user_email'");
                $count = 0;
                while($row = mysqli_fetch_array($resultPost)) 
                {
                    if($row['readStatus'] == 'unread')
                    {
                        $count = $count + 1;
                    }
                }?>
                <i class="fa fa-message"><span class="badge"><?php if($count == 0){echo "";}else{echo $count;}?></span></i>
                </a>
                </li>
            
            <!-- <li><a href=""><i class="fa-solid fa-book"></i></a></li> -->
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