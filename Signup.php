<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password

    $sql = "INSERT INTO users (full_name, username, email, password) VALUES ('full_name','$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully. You can now log in.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>