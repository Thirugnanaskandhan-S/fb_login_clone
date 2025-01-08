<?php
// Enable error reporting
ini_set('display_errors', 1);  // Enable error display
error_reporting(E_ALL);        // Report all errors

// Database credentials
$host = 'sql103.infinityfree.com';
$username = 'if0_37985291';
$password = 'JZhJ4ZZ0h2okQ4';
$dbname = 'if0_37985291_usernames';

// Create a connection to the MySQL database
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from the form
    $email = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL query to insert the user data
    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";

    // Prepare and bind the query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $email, $password);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect back to index.html after successful insertion
            header("Location: index.html");
            exit();  // Ensure no further code is executed after the redirection
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
