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
            <!-- add new doctor -->
            <a href="partners/add-doctor.php" class="<?php echo isActive('partners/add-doctor.php'); ?>"><li><i class="fa-solid fa-folder"></i></li></a>

            <!-- records -->
            <a href="partners/doctor-records.php" class="<?php echo isActive('partners/doctor-records.php'); ?>"><li><i class="fa-solid fa-folder"></i></li></a>
            <a href="partners/patient-records.php" class="<?php echo isActive('partners/patient-records.php'); ?>"><li><i class="fa-solid fa-folder"></i></li></a>

            <!-- trends -->
            <a href="dashboard.php?charts=1" class="<?php echo isActive('dashboard.php'); ?>"><li><i class="fa-solid fa-chart-line"></i></li></a>
            <!-- settings -->
            <a href="settings.php" class="<?php echo isActive('settings.php'); ?>"><li><i class="fa-solid fa-gears"></i></li></a>

            <!-- patient-doctor chats -->
            <a href="partners/patient-doctor-chat.php" class="<?php echo isActive('partners/patient-doctor-chat.php'); ?>"><li><i class="fa-solid fa-gears"></i></li></a>
            <?php
        } else if ($_SESSION['category'] == 'doctor') {
            ?>
            <!-- add records -->
            <a href="doctors/add-patient.php" class="<?php echo isActive('doctors/add-patient.php'); ?>"><li><i class="fa fa-plus"></i></li></a>
           <!-- existing records -->
            <a href="doctors/view-patient-records.php" class="<?php echo isActive('doctors/view-patient-records.php'); ?>"><li><i class="fa-solid fa-folder"></i></li></a>
                <!-- register new dosage -->
            <a href="doctors/dosage-registration.php" class="<?php echo isActive('doctors/dosage-registration.php'); ?>"><li><i class="fa fa-plus"></i></li></a>
            <!-- check patient progress -->
            <a href="doctors/patient-progress.php" class="<?php echo isActive('doctors/patient-progress.php'); ?>"><li><i class="fa fa-plus"></i></li></a>
            <!-- talk to your patients -->
            <a href="doctors/patient-doctor-chat.php" class="<?php echo isActive('doctors/patient-doctor-chat.php'); ?>"><li><i class="fa fa-plus"></i></li></a>
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
            <!-- see chats page -->
            <a href ="patient-doctor-chat-by-patient.php"class="<?php echo isActive('patient-doctor-chat-by-patient.php'); ?>"><li><i class="fa-solid fa-gears"></i></li></a>
            <?php
        }
        ?>
    </ul>
</div>

