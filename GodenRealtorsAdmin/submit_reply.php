<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inquiryId = $_POST['inquiryId'];
    $replyMessage = $_POST['replyMessage'];

    $sql = "UPDATE inquiries SET response = '$replyMessage', status = 'responded' WHERE id = '$inquiryId'";

    if ($conn->query($sql) === TRUE) {
        echo "Reply submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>