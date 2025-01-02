<?php
// Initialize variables for error messages
$usernameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";
$username = $email = $password = $confirmPassword = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required.";
    } else {
        $username = sanitize_input($_POST["username"]);
        // Check if username only contains letters and numbers
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $usernameErr = "Only letters and numbers are allowed.";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required.";
    } else {
        $email = sanitize_input($_POST["email"]);
        // Check if email format is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format.";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required.";
    } else {
        $password = sanitize_input($_POST["password"]);
        // Check password length
        if (strlen($password) < 6) {
            $passwordErr = "Password must be at least 6 characters long.";
        }
    }

    if (empty($_POST["confirm-password"])) {
        $confirmPasswordErr = "Please confirm your password.";
    } else {
        $confirmPassword = sanitize_input($_POST["confirm-password"]);
        // Check if passwords match
        if ($password !== $confirmPassword) {
            $confirmPasswordErr = "Passwords do not match.";
        }
    }

    // If no errors, process the form (e.g., store data, display success message)
    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
        // Here you could insert the data into a database
        // Example: $conn->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");

        // For now, let's display a success message
        echo "<h2>Sign-Up Successful</h2>";
        echo "<p>Welcome, $username! Your account has been created successfully.</p>";
    } else {
        // Display the errors
        echo "<h2>Form Errors</h2>";
        echo "<p>$usernameErr</p>";
        echo "<p>$emailErr</p>";
        echo "<p>$passwordErr</p>";
        echo "<p>$confirmPasswordErr</p>";
    }
}

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
