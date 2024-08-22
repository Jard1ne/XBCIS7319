<?php
include 'db_connection.php';

$sql = "
    SELECT 
        i.id, 
        c.full_name AS username, 
        p.title AS property_title, 
        i.message, 
        i.status, 
        i.inquiry_date
    FROM 
        inquiries i
    JOIN 
        customers c ON i.customer_id = c.id
    JOIN 
        properties p ON i.property_id = p.id;
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
    <title>Enquiries Management</title>
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
                <li><a href="enquiries.php" class="active"><i class="fas fa-envelope"></i> Enquiries</a></li>
                <li><a href="analytics.html"><i class="fas fa-chart-line"></i> Analytics</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header class="topbar">
                <div class="topbar-left">
                    <h1>Enquiries Management</h1>
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

            <section class="enquiries-section">
                <h2>Manage Enquiries</h2>
                <div class="enquiry-list">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <div class="enquiry-item" data-inquiry-username="<?php echo htmlspecialchars($row['username']); ?>" data-inquiry-message="<?php echo htmlspecialchars($row['message']); ?>" data-inquiry-property="<?php echo htmlspecialchars($row['property_title']); ?>">
                                <h3><?php echo htmlspecialchars($row['username']); ?></h3>
                                <p>Message: <?php echo htmlspecialchars($row['message']); ?></p>
                                <p>Property: <?php echo htmlspecialchars($row['property_title']); ?></p>
                                <button class="reply-btn" onclick="openReplyModal(this)">Reply</button>
                                <button class="delete-btn" onclick="deleteEnquiry(<?php echo $row['id']; ?>)">Delete</button>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No enquiries found.</p>
                    <?php endif; ?>
                </div>
            </section>
        </main>
    </div>

    <!-- Reply Modal -->
    <div id="replyModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeReplyModal()">&times;</span>
            <h2>Reply to Enquiry</h2>
            <form id="addPropertyForm" method="POST" action="http://localhost/GodenRealtorsAdmin/submit_reply.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inquiryUsername">User:</label>
                    <input type="text" id="inquiryUsername" name="inquiryUsername" readonly>
                </div>
                <div class="form-group">
                    <label for="inquiryProperty">Property Inquired About:</label>
                    <input type="text" id="inquiryProperty" name="inquiryProperty" readonly>
                </div>
                <div class="form-group">
                    <label for="inquiryMessage">Original Message:</label>
                    <textarea id="inquiryMessage" name="inquiryMessage" readonly></textarea>
                </div>
                <div class="form-group">
                    <label for="replyMessage">Your Reply:</label>
                    <textarea id="replyMessage" name="replyMessage" required></textarea>
                </div>
                <button type="submit">Send Reply</button>
            </form>
        </div>
    </div>

    <script src="scripts.js"></script>
    <script>
        function deleteEnquiry(id) {
            if (confirm("Are you sure you want to delete this enquiry?")) {
                window.location.href = "delete_enquiry.php?id=" + id;
            }
        }
    </script>
</body>
</html>