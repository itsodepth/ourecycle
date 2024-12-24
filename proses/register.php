<?php
session_start();
require_once 'koneksi.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process registration
if (isset($_POST['register'])) {
    $username = $_POST['username-register'];
    $password = $_POST['password-register'];
    $confirm_password = $_POST['confirm-password-register'];

    // Validate password and confirm password
    if ($password === $confirm_password) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username is already taken
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Username already taken!";
        } else {
            // Insert user into the database
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);
            if ($stmt->execute()) {
                // Redirect to main page with success message
                header("Location: ../index.php?registration=success");
                exit;
            } else {
                echo "Error occurred during registration!";
            }
        }
        // Close the statement
        $stmt->close();
    } else {
        echo "Passwords do not match!";
    }
}
// Close the connection
$conn->close();
?>
