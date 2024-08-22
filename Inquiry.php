<?php
session_start();

// Assuming these session variables were set during login
if (isset($_SESSION['user'])) {
    $fullName = $_SESSION['user']['fullName'] ?? 'Guest'; // Use 'Guest' as default if not set
    $email = $_SESSION['user']['email'] ?? '';
} else {
    // If user is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquire About Property - Dada Properties</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
            font-size: 18px;
        }

        header {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .logo {
            flex: 1;
        }

        .nav-container {
            flex: 2;
            display: flex;
            justify-content: center;
            margin-left: 350px;
        }

        nav ul {
            list-style-type: none;
            display: flex;
        }

        nav ul li {
            position: relative;
            margin: 0 15px;
            white-space: nowrap;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            padding: 10px 15px;
            display: block;
        }

        nav ul li a:hover,
        nav ul li:hover > a {
            background-color: #444;
        }

        nav ul li ul {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #333;
            min-width: 150px;
            z-index: 1000;
        }

        nav ul li:hover ul {
            display: block;
        }

        nav ul li ul li {
            width: 100%;
        }

        .profile {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-left: 10px;
        }

        .profile a {
            color: #fff;
            text-decoration: none;
        }

        .profile a:hover {
            color: #ddd;
        }

        main {
            padding-top: 100px; /* Adjust for the fixed header */
        }

        section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 2em;
        }

        form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        form label {
            display: block;
            margin-bottom: 0.5rem;
            text-align: left;
        }

        form input[type="text"],
        form input[type="email"],
        form textarea {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button[type="submit"] {
            margin: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button[type="submit"]:hover {
            background-color: #ff7f00;
        }

        .back-button {
            margin: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #555;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem;
            position: relative;
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .social-media {
            margin-top: 1rem;
        }

        .social-media a {
            color: #fff;
            margin: 0 10px;
            text-decoration: none;
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        .social-media a:hover {
            color: #ddd;
        }
    </style>
</head>

<body>
    <header role="banner">
        <img src="_images/aunty sue.png" alt="Golden Tigers Realtors Logo" class="logo">
        <div class="nav-container">
            <nav role="navigation">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="AboutUs.html">About Us</a>
                        <ul>
                            <li><a href="AboutUs.html#team">Our Team</a></li>
                            <li><a href="AboutUs.html#mission">Our Mission</a></li>
                        </ul>
                    </li>
                    <li><a href="Properties.html">Properties</a>
                        <ul>
                            <li><a href="Properties.html#residential">Residential</a></li>
                            <li><a href="Properties.html#commercial">Commercial</a></li>
                        </ul>
                    </li>
                    <li><a href="Realtors.html">Our Realtors</a></li>
                    <li><a href="ContactUs.html">Contact Sue</a></li>
                </ul>
            </nav>
        </div>
        <div class="profile">
            <a href="SignUp.html" aria-label="My Account"><i class="fas fa-user-circle"></i> My Account</a>
            <img src="_images/user-profile.png" alt="User Profile Picture">
        </div>
    </header>

    <main>
        <section>
            <h2>Inquire About Property</h2>
            <form id="inquiry-form" action="submit_inquiry.php" method="POST">
                <label for="property">Property:</label>
                <input type="text" id="property" name="property" value="<?php echo htmlspecialchars($property_title); ?>" readonly>

                <label for="username">Your Name:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly>

                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>

                <label for="message">Your Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Send Inquiry</button>
                <button class="back-button" type="button" onclick="goBack()">Back</button>
            </form>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Dada Properties. All rights reserved.</p>
            <div class="social-media">
                <a href="https://facebook.com" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com" target="_blank" rel="noopener" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://linkedin.com" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // Get the property ID from the URL parameter
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const propertyId = urlParams.get('id');

        // Sample property data
        const properties = {
            'property1': {
                title: 'Ruimsig House',
                // other details...
            },
            'property2': {
                title: 'Strubensvalley House',
                // other details...
            },
            // More properties...
        };

        // Load the property details into the form
        function loadPropertyDetails(propertyId) {
            const property = properties[propertyId];
            if (property) {
                document.getElementById('property').value = property.title;
            }
        }

        // Load property details when the page loads
        loadPropertyDetails(propertyId);

        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>