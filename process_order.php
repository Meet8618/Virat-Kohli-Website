<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $buyerName = $_POST["buyerName"];
    $streetAddress = $_POST["streetAddress"];
    $city = $_POST["city"];
    $zipCode = $_POST["zipCode"];
    $state = $_POST["state"];

    // Retrieve product quantities
    $viratTshirtQuantity = $_POST["viratTshirt"];
    $viratCapQuantity = $_POST["viratCap"];
    $viratBatQuantity = $_POST["viratBat"];

    // Retrieve payment method
    $paymentMethod = $_POST["paymentMethod"];

    // Calculate total amount
    $viratTshirtPrice = 20.00;
    $viratCapPrice = 10.00;
    $viratBatPrice = 100.00;

    $totalAmount = ($viratTshirtPrice * $viratTshirtQuantity) + ($viratCapPrice * $viratCapQuantity) + ($viratBatPrice * $viratBatQuantity);

    // You can add further validation and sanitization here

    // Database connection (replace with your actual database credentials)
    $servername = "localhost:3306";
    $username = "root";
    $password = "MP9313";
    $dbname = "mydb";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert order details into the database
    $sql = "INSERT INTO orders (buyerName, streetAddress, city, zipCode, state, viratTshirtQuantity, viratCapQuantity, viratBatQuantity, paymentMethod, totalAmount) 
            VALUES ('$buyerName', '$streetAddress', '$city', '$zipCode', '$state', '$viratTshirtQuantity', '$viratCapQuantity', '$viratBatQuantity', '$paymentMethod', '$totalAmount')";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_bill.php"); // Redirect to view_bill.php after successful submission
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
