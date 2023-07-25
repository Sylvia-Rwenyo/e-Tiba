<ul>
    <?php
    // Function to check if the current page name matches the given link name
    function isActive($linkName)
    {
        $currentPage = basename($_SERVER['PHP_SELF']);
        return ($currentPage === $linkName) ? 'active' : '';
    }?>
    <!-- search records -->
    <a href="view-patient-records.php" class="<?php echo isActive('view-patient-records.php'); ?>"><li><i class="fa fa-search"></i></li></a>
    <!-- existing records -->
    <a href="view-dosage-records.php" class="<?php echo isActive('view-dosage-records.php'); ?>"><li><i class="fa-solid fa-folder"></i></li></a>
        <!-- register new dosage -->
    <a href="dosage-registration.php" class="<?php echo isActive('dosage-registration.php'); ?>"><li><i class="fa fa-plus"></i></li></a>
    <!-- check patient progress -->
    <a href="patient-progress.php" class="<?php echo isActive('patient-progress.php'); ?>"><li><i class="fa fa-plus"></i></li></a>
    <!-- schedule appointment -->
    <a href="calendar.php" class="<?php echo isActive('calendar.php'); ?>"><li><i class="fa fa-calendar"></i></li></a>
</ul>

