<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $title = $_POST['propertyTitle'];
    $location = $_POST['propertyLocation'];
    $address = $_POST['propertyAddress'];
    $price = $_POST['propertyPrice'];
    $bedrooms = $_POST['propertyBedrooms'];
    $garages = $_POST['propertyGarages'];
    $size = $_POST['propertySize'];
    $description = $_POST['propertyDescription'];

    // Insert property data into the 'properties' table
    $sql = "INSERT INTO properties (title, location, address, price, bedrooms, garage, size, description)
            VALUES ('$title', '$location', '$address', '$price', '$bedrooms', '$garages', '$size', '$description')";

    if ($conn->query($sql) === TRUE) {
        $property_id = $conn->insert_id; // Get the last inserted ID

        // Handle multiple image uploads
        $target_dir = "uploads/";  // Ensure this directory is writable and exists
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $image_name = basename($_FILES['images']['name'][$key]);
            $target_file = $target_dir . $image_name;

            if (move_uploaded_file($tmp_name, $target_file)) {
                // Store the image path in the database
                $sql_image = "INSERT INTO property_images (property_id, image_path) 
                              VALUES ('$property_id', '$target_file')";
                if (!$conn->query($sql_image)) {
                    echo "Error uploading image: " . $conn->error;
                }
            } else {
                echo "Error moving file: " . $image_name;
            }
        }

        echo "Property added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();