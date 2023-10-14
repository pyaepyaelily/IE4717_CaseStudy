<!DOCTYPE html>
<html>
<head>
  <title>Menu Update Results</title>
</head>
<body>
<h1>Menu Update Results</h1>
<?php

  @ $conn = new mysqli('127.0.0.1', 'javajam', 'javajam', 'javajam');

  if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $update_checkbox = $_POST['update_checkbox'];

  foreach ($update_checkbox as $item) {
      $coffeeName = $_POST['name' . $item];
      $coffeeType = $_POST['price' . $item];
      $newPrice = $_POST['new_price' . $item];

      $query = "UPDATE menu SET price = '$newPrice' WHERE name = '$coffeeName' AND type = '$coffeeType'";

      if (mysqli_query($conn, $query)) {
          // Update successful
          echo "Price for Coffee Item $coffeeName - $coffeeType updated to $newPrice.<br>";
      } else {
          // Update failed
          echo "Error updating price: " . mysqli_error($conn) . "<br>";
      }
  }

  // Close the database connection
  mysqli_close($conn);

  // Redirect back to admin.php
  header('Location: admin.php');
}
?>

<p>successful</p>
</body>
</html>
