<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Establish a database connection
    $db_host = "localhost:3306";
    $db_username = "root";
    $db_password = "MP9313";
    $db_name = "mydb";

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to retrieve the user's hashed password based on the provided username
    $sql = "SELECT username, password FROM users1 WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($dbUsername, $dbPassword);

    if ($stmt->fetch()) {
        // Verify the provided password against the stored hashed password
        if (password_verify($password, $dbPassword)) {
            // Password is correct, so redirect to chatter.html
            header("Location: Virat_Kohli_Merchandise.html");
            exit; // Ensure no further code is executed after the redirect
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "User not found. Please check your username or register a new account.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
