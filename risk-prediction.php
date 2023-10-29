<?php
require_once __DIR__ . '/vendor/autoload.php';

use Phpml\Classification\KNearestNeighbors;

include_once 'conn.php';

// Initialize empty arrays to store data for each day
$dayData = array();
$sleepData = array();
$mealsData = array();
$exerciseData = array();
$riskLevels = array();
$userID = $_SESSION['id'];
$sleepPercentage = 0;
$mealsPercentage = 0;
$exercisePercentage = 0;
$totalExercise = 0;
$totalMeals = 0;
$totalSleep = 0;

// Initialize data variables for the current day
$sleepTime = 0;
$mealNumbers = 0;
$exerciseTime = 0;
$predictedRiskLevel = 0;

// Fetch and calculate data for each day here

// Sleep data
$sql2 = "SELECT * FROM patientsleeplog WHERE userID = '$userID'";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_array($result2)) {
        $sleepTime = $row['sleepTime'];
        $totalSleep += $sleepTime;
    }

    $targetSleep = 12;
    $sleepPercentage = 100 * $sleepTime / $targetSleep;

    // Store sleep data for this day
    $sleepData[] = $sleepTime;
}

// Meals data
$stmt = "SELECT * FROM patientsmeallog WHERE userID='$userID'  ";
$sql3 = mysqli_query($conn, $stmt);

if (mysqli_num_rows($sql3) > 0) {
    while ($row = mysqli_fetch_array($sql3)) {
        $mealNumbers += 1;
        $totalMeals += $mealNumbers;
    }

    $targetMeals = 3;
    $mealsPercentage = 100 * $mealNumbers / $targetMeals;

    // Store meals data for this day
    $mealsData[] = $mealNumbers;
}

// Exercise data
$stmt = "SELECT * FROM patientsexerciselog WHERE userID='$userID'  ";
$sql3 = mysqli_query($conn, $stmt);

if (mysqli_num_rows($sql3) > 0) {
    while ($row = mysqli_fetch_array($sql3)) {
        $exerciseTime = $row['exerciseDuration'];
        $totalExercise += $exerciseTime;
    }

    $targetExercise = 60;
    $exercisePercentage = 100 * $exerciseTime / $targetExercise;

    // Store exercise data for this day
    $exerciseData[] = $exerciseTime;
}

// Check if there is no data in any of the tables and return null for predictedRiskLevel
if (empty($sleepData) && empty($mealsData) && empty($exerciseData)) {
    $predictedRiskLevel = null;
} else {
    // Calculate and store risk levels (0, 1, or 2) based on your criteria
    $riskLevel = calculateRiskLevel($sleepPercentage, $mealsPercentage, $exercisePercentage);
    $riskLevels[] = $riskLevel;

    // Now, use the KNearestNeighbors classifier to predict the risk level
    $samples = [[$sleepPercentage, $mealsPercentage, $exercisePercentage]];
    $labels = [0]; // Use a placeholder label, as it's not relevant for prediction

    $classifier = new KNearestNeighbors();
    $classifier->train($samples, $labels);

    // Use the classifier to predict the risk level for the latest data
    $latestData = [$sleepPercentage, $mealsPercentage, $exercisePercentage];
    $predictedRiskLevel = $classifier->predict($latestData);
}

// Define a function to calculate the risk level based on criteria
function calculateRiskLevel($sleepPercentage, $mealsPercentage, $exercisePercentage) {
    // Define your criteria and calculations here to determine the risk level (0, 1, or 2)
    // Example criteria:
    if ($sleepPercentage >= 80 && $mealsPercentage >= 80 && $exercisePercentage >= 80) {
        return 0; // Low risk
    } elseif ($sleepPercentage >= 60 && $mealsPercentage >= 60 && $exercisePercentage >= 60) {
        return 1; // Moderate risk
    } else {
        return 2; // High risk
    }
}

// You can now use $predictedRiskLevel as the predicted risk level for the latest data or null if there is no data.
?>
