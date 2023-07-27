<div class="dash-menu">
    <ul>
        <?php
        // Function to check if the current page name matches the given link name
        function isActive($linkName)
        {
            $currentPage = basename($_SERVER['PHP_SELF']);
            $modifiedLink = prefixSet($linkName); // Get the modified link using prefixSet() function
            return ($currentPage === $modifiedLink) ? 'active' : '';
        }
        
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
     
        
        if ($_SESSION['category'] == 'hospital') {
            ?>
            <!-- add new doctor -->
            <a href="<?php echo prefixSet('partners/add-doctor.php')?>" class="<?php echo isActive('partners/add-doctor.php'); ?>"><li><i class="fa-solid fa-add"></i></li></a>

            <!-- records -->
            <a href="<?php echo prefixSet('partners/doctor-records.php')?>" class="<?php echo isActive('partners/doctor-records.php'); ?>"><li><i class="fa-solid fa-folder"></i></li></a>

            <!-- trends -->
            <a href="<?php echo prefixSet('dashboard.php?charts=1')?>" class="<?php echo isActive('dashboard.php'); ?>"><li><i class="fa-solid fa-chart-line"></i></li></a>
            <!-- settings -->
            <a href="<?php echo prefixSet('settings.php')?>" class="<?php echo isActive('settings.php'); ?>"><li><i class="fa-solid fa-gears"></i></li></a>

            <!-- patient-doctor chats -->
            <?php
        } else if ($_SESSION['category'] == 'doctor') {
            ?>
            <!-- add records -->
            <a href="<?php echo prefixSet('doctors/add-patient.php')?>" class="<?php echo isActive('doctors/add-patient.php'); ?>"><li><i class="fa fa-plus"></i></li></a>
            <!-- existing records -->
            <a href="<?php echo prefixSet('doctors/patient-records.php')?>" class="<?php echo isActive('doctors/patient-records.php'); ?>"><li><i class="fa-solid fa-folder"></i></li></a>
            <!-- schedule appointment -->
            <a href="<?php echo prefixSet('calendar.php')?>"><li><i class="fa fa-calendar"></i></li></a>
            <!-- settings -->
            <a href="<?php echo prefixSet('settings.php')?>"><li><i class="fa-solid fa-gears"></i></li></a>
            <?php
        } else {
            ?>
            <!-- records -->
            <a href="<?php echo prefixSet('patient-log.php')?>" class="<?php echo isActive('records.php'); ?>"><li><i class="fa-solid fa-folder"></i></li></a>
            <!-- trends -->
            <a href="<?php echo prefixSet('dashboard.php?charts=1')?>" class="<?php echo isActive('dashboard.php'); ?>"><li><i class="fa-solid fa-chart-line"></i></li></a>
            <!-- see set appointments or request to set one -->
            <a href="<?php echo prefixSet('calendar.php')?>"><li><i class="fa fa-calendar"></i></li></a>
            <!-- settings -->
            <a href="<?php echo prefixSet('settings.php')?>"><li><i class="fa-solid fa-gears"></i></li></a>
            <?php
        }
        ?>
    </ul>
</div>
