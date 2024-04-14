<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve user input
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm-password"];

        // Validation: Check if passwords match
        if ($password != $confirmPassword) {
            echo "Passwords do not match. Please try again.";
        } else {
            // Establish a database connection
            $db_host = "localhost:3306";
            $db_username = "root";
            $db_password = "MP9313";
            $db_name = "mydb";

            $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // SQL query to insert user details into the database
            $sql = "INSERT INTO users1(username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                echo "Account created successfully!";
            } else {
                echo "Error creating account: " . $conn->error;
            }

            // Close the database connection
            $stmt->close();
            $conn->close();
        }
    }
    ?>