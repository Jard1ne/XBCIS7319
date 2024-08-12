<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['editUserId'];
    $name = $_POST['editName'];
    $username = $_POST['editUserName'];
    $email = $_POST['editEmail'];
    $role = $_POST['editUserRole'];

    $sql = "UPDATE users SET full_name = '$name', username = '$username', email = '$email', role = '$role' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>