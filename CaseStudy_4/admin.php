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
                <h3 style="color: rgb(46, 0, 0);">Product <br> Price <br> Update</h3>
            </div>
            <div class="content" id="content-index">
                <h1>Coffee at JavaJam</h1>
                <form action="update_prices.php" method="post" id="update-form">
                    <table class="menu">
                        <?php
                        @ $conn = new mysqli('127.0.0.1', 'javajam', 'javajam', 'javajam');

                        if (!$conn) {
                            die("Database connection failed: " . mysqli_connect_error());
                        }

                        // Fetch prices for each item
                        $queryJJ = "SELECT price FROM menu WHERE name = 'Just Java'";
                        $resultJJ = mysqli_query($conn, $queryJJ);
                        $rowJJ = mysqli_fetch_assoc($resultJJ);
                        $priceJJ = $rowJJ['price'];

                        $queryCAL = "SELECT price FROM menu WHERE name = 'Cafe au Lait'";
                        $resultCAL = mysqli_query($conn, $queryCAL);
                        $rowCAL = mysqli_fetch_assoc($resultCAL);
                        $priceCAL = $rowCAL['price'];

                        $queryCALD = "SELECT price FROM menu WHERE name = 'Cafe au Lait' and type = 'Double' ";
                        $resultCALD = mysqli_query($conn, $queryCALD);
                        $rowCALD = mysqli_fetch_assoc($resultCALD);
                        $priceCALD = $rowCALD['price'];

                        $queryIC = "SELECT price FROM menu WHERE name = 'Iced Cappuccino'";
                        $resultIC = mysqli_query($conn, $queryIC);
                        $rowIC = mysqli_fetch_assoc($resultIC);
                        $priceIC = $rowIC['price'];

                        $queryICD = "SELECT price FROM menu WHERE name = 'Iced Cappuccino' and type = 'Double'";
                        $resultICD = mysqli_query($conn, $queryICD);
                        $rowICD = mysqli_fetch_assoc($resultIC);
                        $priceICD = $rowICD['price'];
                        
                        ?>
                        <tr class="menu-item" id="odd">
                            <td>
                                <input type="checkbox" name="update_checkbox[]" value="item1">
                            </td>
                            <td class="drink">Just Java</td>
                            <td class="description">
                                Regular house blend, decaffeinated coffee, or flavor of the day.<br>
                                <b>Endless Cup $<?= $priceJJ ?></b>
                            </td>
                            <td>
                                <select name="priceitem1">
                                    <option value="Endless Cup">Endless Cup</option>
                                </select>
                                <br>
                                <br>
                                <input type="text" name="new_priceitem1" placeholder="New Price">
                                <input type="hidden" name="nameitem1" value="Just Java">
                            </td>
                        </tr>
                        <tr class="menu-item">
                            <td>
                                <input type="checkbox" name="update_checkbox[]" value="item2">
                            </td>
                            <td class="drink">Cafe au Lait</td>
                            <td class="description">
                                House blended coffee infused into a smooth steamed milk.<br>
                                <b>Single $<?= $priceCAL ?> Double $<?= $priceCALD ?></b>
                            </td>
                            <td>
                                <select name="priceitem2">
                                    <option value="Single">Single</option>
                                    <option value="Double">Double</option>
                                </select>
                                <br>
                                <br>
                                <input type="text" name="new_priceitem2" placeholder="New Price">
                                <input type="hidden" name="nameitem2" value="Cafe au Lait">
                            </td>
                        </tr>
                        <tr class="menu-item" id="odd">
                            <td>
                                <input type="checkbox" name="update_checkbox[]" value="item3">
                            </td>
                            <td class="drink">Iced Cappuccino</td>
                            <td class="description">
                                Sweetened espresso blended with icy-cold milk and served in a chilled glass.<br>
                                <b>Single $<?= $priceIC ?> Double $<?= $priceICD ?></b>
                            </td>
                            <td>
                                <select name="priceitem3">
                                    <option value="Single">Single</option>
                                    <option value="Double">Double</option>
                                </select>
                                <br>
                                <br>
                                <input type="text" name="new_priceitem3" placeholder="New Price">
                                <input type="hidden" name="nameitem3" value="Iced Cappuccino">
                            </td>
                        </tr>
                        <?php
                        
                        // Close the database connection
                        mysqli_close($conn);
                        ?>
                    </table>
                    <div style="text-align: right;">
                        <input type="submit" value="Update Prices">
                    </div>
                </form>
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
