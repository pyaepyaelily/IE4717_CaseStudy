<?php
// var_dump($_POST);

// Establish a database connection (replace with your connection details)
$conn = new mysqli('127.0.0.1', 'javajam', 'javajam', 'javajam');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check and insert data for Just Java
$javaQty = (int)$_POST["javaQty"];
$javaName = $_POST["javaName"];
$javaType = $_POST["javaType"];
$javaTotalPrice = $_POST["javaTotalPrice"];
$javaTotalPrice = str_replace('$', '', $javaTotalPrice); // Remove the "$" sign
$javaPrice = (float)$javaTotalPrice;

// Check and insert data for Cafe au Lait
$cafeQty = (int)$_POST["cafeQty"];
$cafeName = $_POST["cafeName"];
$cafeType = $_POST["cafeType"];
$cafeTotalPrice = $_POST["cafeTotalPrice"];
$cafeTotalPrice = str_replace('$', '', $cafeTotalPrice); // Remove the "$" sign
$cafePrice = (float)$cafeTotalPrice;

// Check and insert data for Iced Cappuccino
$cappQty = (int)$_POST["cappQty"];
$cappName = $_POST["cappName"];
$cappType = $_POST["cappType"];
$cappTotalPrice = $_POST["cafeTotalPrice"];
$cappTotalPrice = str_replace('$', '', $cappTotalPrice); // Remove the "$" sign
$cappPrice = (float)$cappTotalPrice;

// Retrieve the last order_id from the database and increment it
$result = $conn->query("SELECT MAX(order_id) AS max_order_id FROM orders");
$row = $result->fetch_assoc();
$order_id = $row["max_order_id"] + 1;

// Prepare a single insert statement with placeholders
$stmt = $conn->prepare("INSERT INTO orders (order_id, item_name, item_type, quantity, price, order_date) VALUES (?, ?, ?, ?, ?, NOW())");
$orderDetails = "";

if ($javaQty > 0) {
    $stmt->bind_param("dssdd", $order_id, $javaName, $javaType, $javaQty, $javaPrice);

    if ($stmt->execute()) {
        $orderDetails = "Just Java: $javaQty x $javaName ($javaType) - $" . number_format($javaPrice, 2);
    } else {
        echo "Error inserting data for $javaName: " . $stmt->error;
    }
}

if ($cafeQty > 0) {
    // $stmt = $conn->prepare("INSERT INTO orders (item_name, item_type, quantity, price, order_date) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("dssdd", $order_id, $cafeName, $cafeType, $cafeQty, $cafePrice);

    if ($stmt->execute()) {
        $orderDetails .= "<br>Cafe au Lait: $cafeQty x $cafeName ($cafeType) - $" . number_format($cafePrice, 2);
    } else {
        echo "Error inserting data for $cafeName: " . $stmt->error;
    }
}

if ($cappQty > 0) {
    $stmt->bind_param("dssdd", $order_id, $cappName, $cappType, $cappQty, $cappPrice);

    if ($stmt->execute()) {
        $orderDetails .= "<br>Iced Cappuccino: $cappQty x $cappName ($cappType) - $" . number_format($cappPrice, 2);
    } else {
        echo "Error inserting data for $cappName: " . $stmt->error;
    }
}

$stmt->close();

if ($javaQty > 0 || $cafeQty > 0 || $cappQty > 0) {
    // Get the current date and time
    $currentDateTime = date("Y-m-d H:i:s");

    // Construct the table with the order date and time at the top
    $orderDetails = "<table border='1'>
        <tr>
            <th colspan='4'>Order Date and Time: $currentDateTime</th>
        </tr>
        <tr>
            <th>Item</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>";

    if ($javaQty > 0) {
        $orderDetails .= "<tr>
            <td>$javaName</td>
            <td>$javaType</td>
            <td>$javaQty</td>
            <td>$" . number_format($javaPrice, 2) . "</td>
        </tr>";
    }

    if ($cafeQty > 0) {
        $orderDetails .= "<tr>
            <td>$cafeName</td>
            <td>$cafeType</td>
            <td>$cafeQty</td>
            <td>$" . number_format($cafePrice, 2) . "</td>
        </tr>";
    }

    if ($cappQty > 0) {
        $orderDetails .= "<tr>
            <td>$cappName</td>
            <td>$cappType</td>
            <td>$cappQty</td>
            <td>$" . number_format($cappPrice, 2) . "</td>
        </tr>";
    }

    $orderDetails .= "</table>";
}





// Close the database connection
$conn->close();

// Construct a user-friendly message and display the order details
$response = "Thank you for your order!<br>Order details:<br>$orderDetails";

echo $response;
