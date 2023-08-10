<div class="welcome-msg">
          <h3><?php echo $_SESSION["username"]?>, thank you for choosing CERA</h3>
          <p>Your healthcare care companion.</p>
      </div>
<div class="dash-nav">
    <ul>
        <?php  
        // determine target page based on user category
      if($_SESSION['category'] == 'patient'){
            ?>
             <!-- progress charts -->
             <a href="dashboard.php?charts=1" class="<?php echo isActive('dashboard.php?charts=1'); ?>"><li>Progress<i class="fa-solid fa-charts"></i></li></a>
             <!-- reports -->
            <a href="dashboard.php?r=1" class="<?php echo isActive('dashboard.php?r=1'); ?>"><li>Reports<i class="fa-solid fa-note"></i></li></a>
            <?php
        }else if($_SESSION['category'] == 'doctor'){
            ?>
             <!-- progress charts -->
             <a href="dashboard.php?d=a" class="<?php if(isset($_GET['d'])){if($_GET['d'] == 'a'){echo 'active';}}; ?>"><li>Attending<i class="fa-solid fa-user-doctor"></i></li></a>
             <!-- reports -->
            <a href="dashboard.php?m=1" class="<?php if(isset($_GET['m'])){if($_GET['m'] == 1){echo 'active';}}; ?>"><li>Monitoring<i class="fa-solid fa-magnifying-glass-chart"></i></li></a>
            <?php
        }
        ?>
    </ul>
</div>
