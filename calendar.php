<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Your dashboard</title>
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/peerjs@1.4.7/dist/peerjs.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="dash-body">
    <div class="header">
        <h1>Appointments</h1>
        <?php include_once 'notif-menu.php'; ?>
    </div>
    <div class="mainBody" id="calendarBody">
        <?php
        session_start();
        if (!isset($_SESSION["loggedIN"])) {
            header('location:index.php');
        } else {
            //show dashboard menu
            include_once 'dash-menu.php';
            include_once 'conn.php';
            $id = $_SESSION['id'];
            $today = new DateTime(); // Get the current date and time
            $today->setTime(0, 0, 0); // Set the time to the beginning of the day (midnight)
            
            $firstDayOfWeek = clone $today; // Clone the current date object
            $firstDayOfWeek->modify('monday this week'); // Get the date of the first day (Monday) of the current week
            $firstDayName = $firstDayOfWeek->format('l'); // Get the day name of the first day of the week
            
            $firstDayOfWeekString = $firstDayOfWeek->format('Y-m-d'); // Convert the DateTime object to a string
            $lastDayOfWeek = clone $firstDayOfWeek; // Clone the first day of the week object
            $lastDayOfWeek->modify('+6 days'); // Get the last day of the week as 6 days after the first day
            $lastDayOfWeekString = $lastDayOfWeek->format('Y-m-d'); // Convert the DateTime object to a string
            
            ?>
    <section>
    <span class="week-indicator"><i class="fa fa-arrow-left"></i> <?php echo substr($firstDayOfWeekString, 5, 5) . ' - ' . substr($lastDayOfWeekString, 5, 5); ?> <i class="fa fa-arrow-right"></i></span>
    <div class="calendar">
        <?php
        $currentDay = clone $firstDayOfWeek;
        $currentDayString = $currentDay->format('Y-m-d');

        while ($currentDayString <= $lastDayOfWeekString) {
            // Output the day and date
            $dayName = $currentDay->format('l');
            $dateString = $currentDay->format('m/d/Y');
            echo '<div class="day">';
            echo '<div class="day-name">' . $dayName . ' (' . $dateString . ')</div>';
            // Loop over the hours of the day (assuming working hours from 9:00 AM to 5:00 PM with 30-minute intervals)
            for ($hour = 9; $hour <= 16; $hour++) {
                for ($minute = 0; $minute < 60; $minute += 30) {
                    $timeString = sprintf('%02d:%02d', $hour, $minute);
        
                    // Check if the appointment exists for this date and time
                    $appointmentExists = false;
                    $appointmentDuration = 0; // Initialize the appointment duration for this time slot
        
                    // Fetch the appointments for the current date from the database
                    $stmt = "SELECT * FROM appointments WHERE patientID='$id' AND appointmentDate='$currentDayString'";
                    $sql = mysqli_query($conn, $stmt);
        
                    if (mysqli_num_rows($sql) > 0) {
                        while ($row = mysqli_fetch_array($sql)) {
                            // Check if the appointment exists for this time slot
                            if ($row['appointmentTime'] === $timeString) {
                                $appointmentExists = true;
                                $appointmentDuration = $row['appointmentDuration'];
                                break;
                            }
                        }
                    }
        
                    if ($appointmentExists) {
                        // Mark the time slots as booked for the duration of the appointment
                        $durationInSlots = ceil($appointmentDuration / 30);
                        for ($i = 0; $i < $durationInSlots; $i++) {
                            $hour += floor(($minute + $i * 30) / 60); // Update the hour if needed
                            $minute = ($minute + $i * 30) % 60; // Update the minute
                            $timeString = sprintf('%02d:%02d', $hour, $minute);
        
                            // Output the booked time slot
                            echo '<div class="booked">' . $timeString . '</div>';
                        }
                        // Skip to the next available time slot
                        $minute += 30;
                        $timeString = sprintf('%02d:%02d', $hour, $minute);
                        continue;
                    }
        
                    // Check if the appointment duration is greater than 30 minutes
                   

    if ($appointmentDuration > 30) {
        $durationInSlots = ceil($appointmentDuration / 30);
        $isAvailable = true;

        for ($i = 0; $i < $durationInSlots; $i++) {
            $hour += floor(($minute + $i * 30) / 60); // Update the hour if needed
            $minute = ($minute + $i * 30) % 60; // Update the minute
            $timeString = sprintf('%02d:%02d', $hour, $minute);

            // Check if the extended time slot is available
            $stmt = "SELECT * FROM appointments WHERE patientID='$id' AND appointmentDate='$currentDayString' AND appointmentTime='$timeString'";
            $sql = mysqli_query($conn, $stmt);
            if (mysqli_num_rows($sql) > 0) {
                $isAvailable = false;
                break;
            }
        }

        if ($isAvailable){
            // Output the extended booked time slot
            echo '<div class="booked" onclick="startMeeting('. $timeString.')">' . $timeString . '</div>';
        } else {
            // Output the available time slot
            echo '<div class="available">' . $timeString . '</div>';
        }
    }else {
                        // Output the available time slot
                        echo '<div class="available">' . $timeString . '</div>';
                    }
                }
            }
        
            echo '</div>'; // Close the day div
            $currentDay->modify('+1 day');
            $currentDayString = $currentDay->format('Y-m-d');
        }}
        ?>
    </div>
</section>     
    </div>
</body>
<script>
    function startMeeting(time) {
        // Get the current time in HH:mm format
        const currentTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const bookedTime = time;

        // Convert the booked time and current time to minutes for easier comparison
        const getTimeInMinutes = (timeString) => {
            const [hours, minutes] = timeString.split(':').map(Number);
            return hours * 60 + minutes;
        };

        const bookedTimeInMinutes = getTimeInMinutes(bookedTime);
        const currentTimeInMinutes = getTimeInMinutes(currentTime);
        const endTimeInMinutes = bookedTimeInMinutes + <?php echo $appointmentDuration; ?>;

        // Check if the current time is within the appointment duration
        if (currentTimeInMinutes >= bookedTimeInMinutes && currentTimeInMinutes <= endTimeInMinutes) {
            window.location.href = 'meet.php';
        }
    }
</script>

</html>