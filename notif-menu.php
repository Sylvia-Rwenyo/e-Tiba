<?php 
    include_once "conn.php";
    session_start();
    // check logged in status
    if(!isset($_SESSION["loggedIN"])){
        header('location:index.php');
        }

        $id = $_SESSION['id'];
        // Function to check if the current page name matches the given link name
    function isActive($linkName)
    {
          // get current page's name
          $currentPage = basename($_SERVER['PHP_SELF']);
        $modifiedLink = prefixSet($linkName); // Get the modified link using prefixSet() function
        return ($currentPage === $modifiedLink) ? 'active' : '';
    }

    //   set link name prefix depending on target file location in relation to the current file
        function prefixSet($linkName) {
        // Get the parent directory of the current page
        $parentDir = dirname($_SERVER['REQUEST_URI']);
        $parentDir = dirname($_SERVER['REQUEST_URI']);
        $parentDirCurrent = preg_replace('/.*nafuu\//', '', $parentDir);
    
        if ($parentDirCurrent === '/partners' && strpos($linkName, 'partners/') === 0) {
            $linkName = str_replace('partners/', '', $linkName);
            return $linkName;
        } else if ($parentDirCurrent === '/doctors' && strpos($linkName, 'partners/') === 0) {
            $linkName = '../' . $linkName;
            return $linkName;
        }else if ($parentDirCurrent === '/partners' && strpos($linkName, 'doctors/') === 0) {
            $linkName = '../' . $linkName;
            return $linkName;
        }else if ($parentDirCurrent === '/doctors' && strpos($linkName, 'doctors/') === 0) {
            $linkName = str_replace('doctors/', '', $linkName);
            return $linkName;
        }else if($parentDirCurrent === '/doctors' || $parentDirCurrent === '/partners' && strpos($linkName, '/') === 1){
            $linkName = '../' . $linkName;
            return $linkName;
        }
    
        // Add more conditions if needed for other parent directories
    
        // If none of the conditions match, return the original linkName
        return $linkName;
    }

    // set page header name based on page name
    function headerName(){
        $currentPage = basename($_SERVER['PHP_SELF']);
        $headerName = ucwords(str_replace('.php', '', $currentPage));

        if($currentPage === 'calendar.php'){
            $headerName = 'Appointments';
        }else if(strpos($currentPage, 'log') || strpos($currentPage, 'record')){
            $headerName = 'Records';
        }else if($currentPage === 'settings.php'){
            $headerName = 'Profile';
        }
        return $headerName;
    }
?>
    <span class="menuBar" id="menuBars" onClick="toggleMenu()"><i class="fa-solid fa-bars"></i></span>
    <span class="menuBar" id="menuX" onClick="toggleMenu()"><i class="fa-solid fa-x"></i></span>

    <h1><?php echo headerName()?></h1>

    <div class="menu meet-menu">
        <ul>
          
            <li><a href="<?php echo prefixSet('meet.php'); ?>"><i class="fa-solid fa-video"></i></a></li>
            <li>
                <a href = <?php 
                if($_SESSION['category'] == 'hospital')
                {
                    echo prefixSet("chats/reports-home.php");
                }
                else
                {
                    echo prefixSet("chats/chats-home.php");
                }
            ;
                ?>
                class='
                    <?php
                     if($_SESSION['category'] == 'hospital')
                     {
                         echo isActive("chats/reports-home.php");
                     }
                     else
                     {
                         echo isActive("chats/chats-home.php");
                     }
                    ?>\
                '
                >
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
                }
                $resultGetReport = mysqli_query($conn,"SELECT readStatus FROM reports WHERE sent_to = '$current_user_email'");
                while($row = mysqli_fetch_array($resultGetReport)) 
                {
                    if($row['readStatus'] == 'unread')
                    {
                        $count = $count + 1;
                    }
                }
                if(!isset($_SESSION['menuCount'])){
                    $_SESSION['menuCount'] = 0;
                }
                ?>
                
                <i class="fa fa-message"><span class="badge"><?php if($count == 0){echo "";}else{echo $count;}?></span></i>
                </a>
            </li>
            
            <!-- 
                notes functionality to be added
                <li><a href=""><i class="fa-solid fa-book"></i></a></li>
             -->
        </ul>
    </div>
    <script>
        var element = document.querySelectorAll(".meet-menu a");
        var length = element.length;
        for(var i=0; i<length;i++){
            element[i].onclick=function()
            {
                var b=document.querySelector(".menu a.active");
                if(b) b.classList.remove("active");
                this.classList.add('active');
            };
        }

    // Retrieve the menu state from local storage
    const storedMenuState = localStorage.getItem('menuState');
    let menuCount = parseInt(localStorage.getItem('menuCount')) || 0;

    // Toggle the menu based on the stored state
    function toggleMenu() {
        const dashMenu = document.querySelector(".dash-menu");
        const mainSection = document.querySelector(".main-section");
        const openMenu = document.getElementById('menuBars');
        const closeMenu = document.getElementById('menuX');

        if (menuCount % 2 === 0) {
            dashMenu.style.display = 'none';
            openMenu.style.display = 'block';
            closeMenu.style.display = 'none';
            mainSection.style.marginLeft = '10%';
        } else {
            dashMenu.style.display = 'block';
            openMenu.style.display = 'none';
            closeMenu.style.display = 'block';
            mainSection.style.marginLeft = '0';
        }
    }

    // Call the toggleMenu() function on page load
    window.onload = toggleMenu;

    // Function to update the menu count and state in local storage
    function updateMenuState() {
        localStorage.setItem('menuCount', menuCount);
        localStorage.setItem('menuState', (menuCount % 2 === 0) ? 'closed' : 'open');
    }

    // Attach click event to the menu toggle buttons
    document.getElementById('menuBars').addEventListener('click', () => {
        menuCount++;
        toggleMenu();
        updateMenuState();
    });

    document.getElementById('menuX').addEventListener('click', () => {
        menuCount++;
        toggleMenu();
        updateMenuState();
    });
</script>
