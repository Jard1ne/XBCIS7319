<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $property = $_POST['property'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare the SQL statement
    $sql = "INSERT INTO inquiries (property_title, username, email, message) VALUES (?, ?, ?, ?)";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ssss", $property, $username, $email, $message);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Inquiry submitted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>