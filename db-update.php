<?php
// Create regPatients table
$sqlRegPatients = "CREATE TABLE IF NOT EXISTS regPatients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    emailAddress VARCHAR(100) NOT NULL,
    institution VARCHAR(100) NOT NULL,
    password VARCHAR(50) NOT NULL,
    illness VARCHAR(200) NOT NULL,
    address VARCHAR(200) NOT NULL,
    age INT NOT NULL,
    gender VARCHAR(10) NOT NULL
)";

// Create regInstitutions table
$sqlRegInstitutions = "CREATE TABLE IF NOT EXISTS regInstitutions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    institutionName VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    emailAddress VARCHAR(100) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,
    password VARCHAR(50) NOT NULL,
    illnesses VARCHAR(200) NOT NULL,
    postalAddress VARCHAR(200) NOT NULL
)";

// Create regDoctors table
$sqlRegDoctors = "CREATE TABLE IF NOT EXISTS regDoctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    emailAddress VARCHAR(100) NOT NULL,
    institution VARCHAR(100) NOT NULL,
    password VARCHAR(50) NOT NULL,
    specialty VARCHAR(200) NOT NULL,
    address VARCHAR(200) NOT NULL,
    age INT NOT NULL,
    gender VARCHAR(10) NOT NULL
)";

// Execute the SQL queries
if (mysqli_query($conn, $sqlRegPatients) &&
    mysqli_query($conn, $sqlRegInstitutions) &&
    mysqli_query($conn, $sqlRegDoctors)
) {
    echo "Tables created successfully";
} else {
    echo "Error creating tables: " . mysqli_error($conn);
}

// Delete registration table
$sqlDeleteRegistration = "DROP TABLE IF EXISTS registration";

// Delete regpartners table
$sqlDeleteRegPartners = "DROP TABLE IF EXISTS regpartners";

// Delete regpartners2 table
$sqlDeleteRegPartners2 = "DROP TABLE IF EXISTS regpartners2";

// Execute the SQL queries to delete tables
if (mysqli_query($conn, $sqlDeleteRegistration) &&
    mysqli_query($conn, $sqlDeleteRegPartners) &&
    mysqli_query($conn, $sqlDeleteRegPartners2)
) {
    echo "Tables deleted successfully";
} else {
    echo "Error deleting tables: " . mysqli_error($conn);
}

?>
