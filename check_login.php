<?php
session_start();
include("connect_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    $query = "SELECT id, username, password FROM tb_users WHERE username = ?";
    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("s", $input_username);
    $stmt->execute();

    $stmt->bind_result($db_id, $db_username, $db_password);
    if ($stmt->fetch() && password_verify($input_password, $db_password)) {
        // Save the user's id in the session
        $_SESSION['user_id'] = $db_id;
        $_SESSION['user_name'] = $db_username;
        header('Location: index.php');
        echo "Login successful. Welcome, $db_username!";
        
    } else {
        echo "Login failed. Invalid username or password.";
    }

    $stmt->close();
}

$mysqli->close();
?>
