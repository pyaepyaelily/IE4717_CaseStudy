<?php
// var_dump($_POST);

@$conn = new mysqli('127.0.0.1', 'javajam', 'javajam', 'javajam');

if (isset($_POST['byProduct'])) {
    echo '<div style="text-align: center; margin-bottom: 20px;">';
    echo '<h3>Total dollar and quantity sales by products</h3>';
    echo '</div>';
    $query = "SELECT item_name, SUM(quantity) AS total_quantity, SUM(price) AS total_dollar_sales FROM orders GROUP BY item_name;";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo '<div style="text-align: center;">';
        echo '<table style="border-collapse: collapse; width: 50%; margin: 0 auto;">';
        echo '<tr>';
        echo '<th style="border: 1px solid #000; padding: 8px;">Item Name</th>';
        echo '<th style="border: 1px solid #000; padding: 8px;">Total Quantity</th>';
        echo '<th style="border: 1px solid #000; padding: 8px;">Total Dollar Sales</th>';
        echo '</tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td style="border: 1px solid #000; padding: 8px;">' . $row['item_name'] . '</td>';
            echo '<td style="border: 1px solid #000; padding: 8px;">' . $row['total_quantity'] . '</td>';
            echo '<td style="border: 1px solid #000; padding: 8px;">' . $row['total_dollar_sales'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</div>';
    } else {
        echo "No results found.";
    }
}

if (isset($_POST['byCat'])) {
    echo '<div style="text-align: center; margin-bottom: 20px;">';
    echo '<h3>Total dollar and quantity sales by categories</h3>';
    echo '</div>';
    $query = "SELECT 
    CASE 
        WHEN item_type = 'Endless Cup' THEN 'NULL'
        ELSE item_type
    END AS modified_item_type, 
    SUM(quantity) AS total_quantity, 
    SUM(price) AS total_dollar_sales
    FROM orders
    GROUP BY modified_item_type;";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo '<div style="text-align: center;">';
        echo '<table style="border-collapse: collapse; width: 50%; margin: 0 auto;">';
        echo '<tr>';
        echo '<th style="border: 1px solid #000; padding: 8px;">Category</th>';
        echo '<th style="border: 1px solid #000; padding: 8px;">Total Quantity</th>';
        echo '<th style="border: 1px solid #000; padding: 8px;">Total Dollar Sales</th>';
        echo '</tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td style="border: 1px solid #000; padding: 8px;">' . $row['modified_item_type'] . '</td>';
            echo '<td style="border: 1px solid #000; padding: 8px;">' . $row['total_quantity'] . '</td>';
            echo '<td style="border: 1px solid #000; padding: 8px;">' . $row['total_dollar_sales'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</div>';
    } else {
        echo "No results found.";
    }
}



// Close the database connection
mysqli_close($conn);
