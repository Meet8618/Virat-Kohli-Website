<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Bill</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        h1 {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            margin: 0;
        }

        p {
            margin-bottom: 10px;
        }

        .container {
            width: 80%;
            margin: auto;
            background-color: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        strong {
            font-weight: bold;
        }

        .confirmation-message {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Order Bill</h1>

    <div class="container">
    <?php
    // Retrieve order details from the database
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

    // Retrieve the latest order details
    $sql = "SELECT * FROM orders ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display order details
        echo "<p><strong>Order ID:</strong> " . $row["id"] . "</p>";
        echo "<p><strong>Buyer's Name:</strong> " . $row["buyerName"] . "</p>";
        echo "<p><strong>Street Address:</strong> " . $row["streetAddress"] . "</p>";
        echo "<p><strong>City:</strong> " . $row["city"] . "</p>";
        echo "<p><strong>Zip Code:</strong> " . $row["zipCode"] . "</p>";
        echo "<p><strong>State:</strong> " . $row["state"] . "</p>";
        echo "<p><strong>Virat Kohli Autographed T-shirt Quantity:</strong> " . $row["viratTshirtQuantity"] . "</p>";
        echo "<p><strong>Virat Kohli Autographed Cap Quantity:</strong> " . $row["viratCapQuantity"] . "</p>";
        echo "<p><strong>Virat Kohli Autographed Bat Quantity:</strong> " . $row["viratBatQuantity"] . "</p>";
        echo "<p><strong>Payment Method:</strong> " . $row["paymentMethod"] . "</p>";
        echo "<p><strong>Total Amount:</strong> $" . number_format($row["totalAmount"], 2) . "</p>";
        echo "<p><strong>Order Date:</strong> " . $row["orderDate"] . "</p>";

        // Display a confirmation message
        echo "<p><strong>Your order has been successfully placed!</strong></p>";
    } else {
        echo "<p>No order details found.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>

        <div class="confirmation-message">
            <p>Your order has been successfully placed!</p>
        </div>
    </div>
</body>
</html>
