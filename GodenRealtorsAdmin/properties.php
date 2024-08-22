<?php
include 'db_connection.php';

// Fetch all properties, sorted by newest first
$sql = "
    SELECT 
        id, 
        title, 
        description, 
        price, 
        location, 
        status, 
        created_at 
    FROM 
        properties 
    ORDER BY 
        created_at DESC
";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Management</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
        <div class="sidebar-header">
                <h2>Admin Panel</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="index.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="properties.php"><i class="fas fa-building"></i> Properties</a></li>
                <li><a href="users.php"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="enquiries.php"><i class="fas fa-envelope"></i> Enquiries</a></li>
                <li><a href="analytics.html" class="active"><i class="fas fa-chart-line"></i> Analytics</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header class="topbar">
                <div class="topbar-left">
                    <h1>Property Management</h1>
                </div>
                <div class="topbar-right">
                    <div class="notifications">
                        <i class="fas fa-bell"></i>
                        <span class="badge">3</span>
                    </div>
                    <div class="user-profile">
                        <img src="profile.jpg" alt="User">
                        <span>Admin</span>
                    </div>
                </div>
            </header>
            <section class="properties-section">
                <h2>Manage Properties</h2>
                <button class="add-btn" onclick="openAddPropertyModal()">Add Property</button>
                <div class="property-list">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <div class="property-item" data-property-id="<?php echo $row['id']; ?>">
                                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                                <p><?php echo htmlspecialchars($row['description']); ?></p>
                                <p>Price: $<?php echo htmlspecialchars($row['price']); ?></p>
                                <p>Location: <?php echo htmlspecialchars($row['location']); ?></p>
                                <p>Status: <?php echo htmlspecialchars($row['status']); ?></p>
                                <p>Added on: <?php echo htmlspecialchars($row['created_at']); ?></p>
                                <button class="edit-btn" onclick="openEditPropertyModal(<?php echo $row['id']; ?>)">Edit</button>
                                <button class="delete-btn" onclick="deleteProperty(<?php echo $row['id']; ?>)">Delete</button>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No properties found.</p>
                    <?php endif; ?>
                </div>
            </section>
        </main>
    </div>

    <!-- Modals for adding and editing properties -->
    <div id="addPropertyModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddPropertyModal()">&times;</span>
            <h2>Add Property</h2>
            <form id="addPropertyForm" method="POST" action="add_property.php">
                <label for="propertyTitle">Title:</label>
                <input type="text" id="propertyTitle" name="propertyTitle" required>
                <label for="propertyDescription">Description:</label>
                <textarea id="propertyDescription" name="propertyDescription" required></textarea>
                <label for="propertyPrice">Price:</label>
                <input type="number" id="propertyPrice" name="propertyPrice" required>
                <label for="propertyLocation">Location:</label>
                <input type="text" id="propertyLocation" name="propertyLocation" required>
                <label for="propertyStatus">Status:</label>
                <select id="propertyStatus" name="propertyStatus" required>
                    <option value="available">Available</option>
                    <option value="sold">Sold</option>
                    <option value="pending">Pending</option>
                </select>
                <button type="submit">Add Property</button>
            </form>
        </div>
    </div>

    <div id="editPropertyModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditPropertyModal()">&times;</span>
            <h2>Edit Property</h2>
            <form id="editPropertyForm" method="POST" action="edit_property.php">
                <input type="hidden" id="editPropertyId" name="editPropertyId">
                <label for="editPropertyTitle">Title:</label>
                <input type="text" id="editPropertyTitle" name="editPropertyTitle" required>
                <label for="editPropertyDescription">Description:</label>
                <textarea id="editPropertyDescription" name="editPropertyDescription" required></textarea>
                <label for="editPropertyPrice">Price:</label>
                <input type="number" id="editPropertyPrice" name="editPropertyPrice" required>
                <label for="editPropertyLocation">Location:</label>
                <input type="text" id="editPropertyLocation" name="editPropertyLocation" required>
                <label for="editPropertyStatus">Status:</label>
                <select id="editPropertyStatus" name="editPropertyStatus" required>
                    <option value="available">Available</option>
                    <option value="sold">Sold</option>
                    <option value="pending">Pending</option>
                </select>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>

<?php
$conn->close();
?>