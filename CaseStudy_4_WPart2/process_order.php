<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Processing</title>
</head>
<body>
<?php
  var_dump($_POST);
// Check if the form is submitted
if (isset($_POST['checkout'])) {
    // Establish a database connection (modify these with your own database credentials)
    $conn = new mysqli('127.0.0.1', 'javajam', 'javajam', 'javajam');

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Initialize an array to store the items
    $items = [];

    // Process "Just Java" item
    if (isset($_POST['javaQty']) && $_POST['javaQty'] > 0) {
        $items[] = [
            'name' => $_POST['javaName'],
            'type' => $_POST['javaType'],
            'quantity' => $_POST['javaQty'],
            'price' => $_POST['javaPrice']
        ];
    }

    // Process "Cafe au Lait" item
    if (isset($_POST['cafeQty']) && $_POST['cafeQty'] > 0) {
        $items[] = [
            'name' => $_POST['cafeName'],
            'type' => $_POST['cafeType'],
            'quantity' => $_POST['cafeQty'],
            'price' => $_POST['cafeQty'] == $_POST['cafeDoubleQty'] ? $_POST['cafeDoublePrice'] : $_POST['cafePrice']
        ];
    }

    // Process "Iced Cappuccino" item
    if (isset($_POST['cappQty']) && $_POST['cappQty'] > 0) {
        $items[] = [
            'name' => $_POST['cappName'],
            'type' => $_POST['cappType'],
            'quantity' => $_POST['cappQty'],
            'price' => $_POST['cappQty'] == $_POST['cappDoubleQty'] ? $_POST['cappDoublePrice'] : $_POST['cappPrice']
        ];
    }

    // Insert items into the "orders" table
    foreach ($items as $item) {
        $stmt = $conn->prepare("INSERT INTO orders (item_name, item_type, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdd", $item['name'], $item['type'], $item['quantity'], $item['price']);

        if ($stmt->execute()) {
            echo "Order for " . $item['name'] . " with " . $item['type'] . " type successfully placed!<br>";
        } else {
            echo "Error placing order for " . $item['name'] . ": " . $conn->error . "<br>";
        }
    }

    // Close the database connection
    $conn->close();
}
?>
</body>
</html>
