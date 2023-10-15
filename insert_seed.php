<?php
 
 include ('connect_db.php');

$insert_sql = "INSERT INTO tb_users (name, username, password, status) VALUES (?, ?, ?, ?)";

// Prepare the statement
$stmt = $mysqli->prepare($insert_sql);

if (!$stmt) {
    die("Error in preparing statement: " . $mysqli->error);
}

// Example seed data
$name1 = "administrator";
$username1 = "admin";
$password1 = password_hash("Sciform@dru", PASSWORD_DEFAULT);
$status1 = "active";


// Bind parameters and execute the statement for User 1
$stmt->bind_param("ssss", $name1, $username1, $password1, $status1);
if ($stmt->execute()) {
    echo "User 1 inserted successfully.<br>";
} else {
    echo "Error inserting User 1: " . $stmt->error . "<br>";
}

$stmt->close();
$mysqli->close();
?>
