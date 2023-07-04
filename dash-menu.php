<div class="dash-menu">
    <ul>
        <?php
        // Function to check if the current page name matches the given link name
        function isActive($linkName)
        {
            $currentPage = basename($_SERVER['PHP_SELF']);
            return ($currentPage === $linkName) ? 'active' : '';
        }

        if ($_SESSION['category'] == 'hospital') {
            ?>
            <!-- records -->
            <a href="doctor-records.php" class="<?php echo isActive('doctor-records.php'); ?>"><li><i class="fa-solid fa-folder"></i></li></a>
            <a href="patient-records.php" class="<?php echo isActive('patient-records.php'); ?>"><li><i class="fa-solid fa-folder"></i></li></a>
            <!-- trends -->
            <a href="dashboard.php?charts=1" class="<?php echo isActive('dashboard.php'); ?>"><li><i class="fa-solid fa-chart-line"></i></li></a>
            <!-- settings -->
            <a href="settings.php" class="<?php echo isActive('settings.php'); ?>"><li><i class="fa-solid fa-gears"></i></li></a>
            <?php
        } else if ($_SESSION['category'] == 'doctor') {
            ?>
            <!-- add records -->
            <a href="add-patient.php" class="<?php echo isActive('register.php'); ?>"><li><i class="fa fa-plus"></i></li></a>
           <!-- existing records -->
            <a href="patient-records.php" class="<?php echo isActive('patient-records.php'); ?>"><li><i class="fa-solid fa-folder"></i></li></a>
            <!-- schedule appointment -->
            <a href="calendar.php" class="<?php echo isActive('calendar.php'); ?>"><li><i class="fa fa-calendar"></i></li></a>
           <!-- settings -->
            <a href="settings.php" class="<?php echo isActive('settings.php'); ?>"><li><i class="fa-solid fa-gears"></i></li></a>
            <?php
        } else {
            ?>
            <!-- records -->
            <a href="patient-log.php" class="<?php echo isActive('records.php'); ?>"><li><i class="fa-solid fa-folder"></i></li></a>
           <!-- trends -->
            <a href="dashboard.php?charts=1" class="<?php echo isActive('dashboard.php'); ?>"><li><i class="fa-solid fa-chart-line"></i></li></a>
            <!-- see set appointments or request to set one -->
            <a href="calendar.php" class="<?php echo isActive('calendar.php'); ?>"><li><i class="fa fa-calendar"></i></li></a>
            <!-- settings -->
            <a href="settings.php" class="<?php echo isActive('settings.php'); ?>"><li><i class="fa-solid fa-gears"></i></li></a>
            <?php
        }
        ?>
    </ul>
</div>

