<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JavaJam Coffee House</title>
    <link rel="stylesheet" href="assets/css/javajam_style.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <img id="banner" src="assets/img/banner.png" alt="JavaJam Coffee House">
        </header>
        <div class="content-wrapper">
            <div class="navbar">
                <h3 style="color: rgb(46, 0, 0);">Daily<br> Sales <br> Report </h3>
            </div>
            <div class="content" id="content-index">
                <h1>Coffee at JavaJam</h1>
                <form action="showSales.php" method="post">
                    <table class="menu">
                        <tr class="menu-item" id="odd">
                            <td>
                                <input type="submit" value="Generate" name="byProduct">
                            </td>
                            <td class="reportQ">
                                <h3 style="color: rgb(46, 0, 0);"> Total dollar and quantity sales by products</h3>
                            </td>
                        </tr>
                        <tr class="menu-item">
                            <td>
                                <input type="submit" value="Generate" name="byCat">
                            </td>
                            <td class="reportQ">
                                <h3 style="color: rgb(46, 0, 0);"> Total dollar and quantity sales by categories</h3>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                @$conn = new mysqli('127.0.0.1', 'javajam', 'javajam', 'javajam');

                if (!$conn) {
                    die("Database connection failed: " . mysqli_connect_error());
                }

                // Fetch prices for each item
                $query = "SELECT item_name, item_type, MAX(price) AS highest_price FROM orders GROUP BY item_name, item_type ORDER BY highest_price DESC LIMIT 1;";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $name = $row['item_name'];
                $type = $row['item_type'];
                ?>

                <h3 style="color: rgb(46, 0, 0); margin-left: 130px;"> Popular option of best selling product: <?= $name ?> - <?= $type ?></h3>

                <?php

                // Close the database connection
                mysqli_close($conn);
                ?>
            </div>
        </div>
        <footer>
            <div>
                <i>Copyright &copy; 2023 JavaJam Coffee House</i>
            </div>
            <div>
                <i><a href="mailto:pyae@sonekhin.com">pyae@sonekhin.com</a></i>
            </div>
        </footer>
    </div>
</body>

</html>