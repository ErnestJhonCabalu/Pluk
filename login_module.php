<?php
// Start the session
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Enter your database password here
$dbname = "pluk";

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to retrieve user with the given email
    $sql = "SELECT * FROM accounts WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables and redirect
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email;
            header("location: Client.php");
            exit;
        } else {
            // Incorrect password
            echo "Invalid email or password";
        }
    } else {
        // User not found
        echo "Invalid email or password";
    }

    // Close connection
    $conn->close();
}
?>