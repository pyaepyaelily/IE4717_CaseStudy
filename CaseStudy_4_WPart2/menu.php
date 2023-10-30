<!doctype html>
<html lang="en">

<head>
    <title>JavaJam Coffee House</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/javajam_style.css">
</head>

<body>
    <div class="wrapper">

        <!-- Header -->
        <header>
            <img id="banner" src="assets/img/banner.png" alt="JavaJam Coffee House">
        </header>

        <div class="content-wrapper">

            <!-- Navigation -->
            <div class="navbar">
                <nav>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="menu.html" id="current">Menu</a></li>
                        <li><a href="music.html">Music</a></li>
                        <li><a href="jobs.html">Jobs</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Content -->
            <div class="content" id="content-index">
                <h1>Coffee at JavaJam</h1>
                <form action="process_order.php" method="post">
                    <table class="menu">

                        <?php
                        @$conn = new mysqli('127.0.0.1', 'javajam', 'javajam', 'javajam');

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

                        <tr class="menu-item">
                            <td></td>
                            <td></td>
                            <td class="colName"> Quantity </td>
                            <td class="colName"> Price </td>
                        </tr>

                        <tr class="menu-item" id="odd">
                            <td class="drink">Just Java</td>
                            <td class="description">
                                Regular house blend, decaffeinated coffee,
                                or flavor of the day.
                                <br>
                                <b>Endless Cup $<?= $priceJJ ?> </b>
                            </td>
                            <!-- <td> <input type="number" min="0" id="javaQty" oninput="calculateItemPrice('javaQty', 'javaPrice', <?= $priceJJ ?>)" value="0"></td> -->
                            <td> <input type="number" min="0" name="javaQty" id="javaQty" oninput="calculateItemPrice('javaQty', 'javaPrice', <?= $priceJJ ?>)" value="0"></td>
                            <td> <input type="text" readonly id="javaPrice"></td>
                            <!-- Add hidden input fields to store the name and price -->
                            <input type="hidden" name="javaName" value="Just Java">
                            <input type="hidden" name="javaPrice" value="<?= $priceJJ ?>">
                            <input type="hidden" name="javaType" value="Endless Cup">

                        </tr>

                        <tr class="menu-item">
                            <td class="drink">Cafe au Lait</td>
                            <td class="description">
                                House blended coffee infused into a smooth steamed milk.
                                <br>
                                <b>
                                    <!-- <input type="radio" id="cafeSingle" name="cafe" value="2.00" onclick="calculateItemPrice('cafeQty', 'cafePrice', <?= $priceCAL ?>)">Single $<?= $priceCAL ?> -->
                                    <!-- <input type="radio" id="cafeSingle" name="cafe" data-type="Single" value="<?= $priceCAL ?>" onclick="calculateItemPrice('cafeQty', 'cafePrice', this.value)">Single $<?= $priceCAL ?> -->
                                    <input type="radio" id="cafeSingle" name="cafe" data-type="Single" data-price="<?= $priceCAL ?>" onclick="calculateItemPrice('cafeQty', 'cafePrice', 'cafeType', 'Single', <?= $priceCAL ?>)">Single $<?= $priceCAL ?>

                                </b>
                                <b>
                                    <!-- <input type="radio" id="cafeDouble" name="cafe" value="3.00" onclick="calculateItemPrice('cafeQty', 'cafePrice', <?= $priceCALD ?>)">Double $<?= $priceCALD ?> -->
                                    <!-- <input type="radio" id="cafeDouble" name="cafe" data-type="Double" value="<?= $priceCALD ?>" onclick="calculateItemPrice('cafeQty', 'cafePrice', this.value)">Double $<?= $priceCALD ?></b> -->
                                <input type="radio" id="cafeDouble" name="cafe" data-type="Double" data-price="<?= $priceCALD ?>" onclick="calculateItemPrice('cafeQty', 'cafePrice', 'cafeType', 'Double', <?= $priceCALD ?>)">Double $<?= $priceCALD ?></b>

                                </b>


                                <!-- <input type="hidden" name="cafeType" value=""> -->


                            </td>
                            <td> <input type="number" min="0" name="cafeQty" id="cafeQty" oninput="calculateItemPrice('cafeQty', 'cafePrice', <?= $priceCALD ?>)" value="0"></td>
                            <td> <input type="text" readonly id="cafePrice"></td>

                            <!-- Add hidden input fields to store the name, price, and type -->
                            <input type="hidden" name="cafeName" value="Cafe au Lait">
                            <input type="hidden" name="cafePrice" value="<?= $priceCAL ?>">
                            <input type="hidden" name="cafeDoublePrice" value="<?= $priceCALD ?>">
                            <input type="hidden" name="cafeSingleQty" value="0">
                            <input type="hidden" name="cafeDoubleQty" value="0">

                        </tr>

                        <tr class="menu-item" id="odd">
                            <td class="drink">Iced Cappuccino</td>
                            <td class="description">
                                Sweetened espresso blended with icy-cold milk and served in a chilled glass.
                                <br>
                                <b>
                                    <!-- <input type="radio" id="cappSingle" name="capp" value="4.75" onclick="calculateItemPrice('cappQty', 'cappPrice', <?= $priceIC ?>)"> Single $<?= $priceIC ?> -->
                                    <!-- <input type="radio" id="cappSingle" name="capp" data-type="Single" value="<?= $priceIC ?>" onclick="calculateItemPrice('cafeQty', 'cafePrice', this.value)">Single $<?= $priceIC ?> -->
                                    <input type="radio" id="cappSingle" name="capp" data-type="Single" data-price="<?= $priceIC ?>" onclick="calculateItemPrice('cappQty', 'cappPrice', 'cappType', 'Single', 'Double', <?= $priceIC ?>)">Single $<?= $priceIC ?>

                                </b>
                                <b>
                                    <!-- <input type="radio" id="cappDouble" name="capp" value="5.75" onclick="calculateItemPrice('cappQty', 'cappPrice', <?= $priceICD ?>)"> Double $<?= $priceICD ?> -->
                                    <!-- <input type="radio" id="cappDouble" name="capp" data-type="Double" value="<?= $priceICD ?>" onclick="calculateItemPrice('cafeQty', 'cafePrice', this.value)">Double $<?= $priceICD ?> -->
                                    <input type="radio" id="cappDouble" name="capp" data-type="Double" data-price="<?= $priceICD ?>" onclick="calculateItemPrice('cappQty', 'cappPrice', 'cappType', 'Single', 'Double', <?= $priceICD ?>)">Double $<?= $priceICD ?></b>

                                </b>

                                <!-- <input type="hidden" name="cappType" value=""> -->

                            </td>
                            <td> <input type="number" min="0" id="cappQty" name="cappQty" oninput="calculateItemPrice('cappQty', 'cappPrice', <?= $priceIC ?>)" value="0"></td>
                            <td> <input type="text" readonly id="cappPrice"></td>


                            <!-- Add hidden input fields to store the name, price, and type -->
                            <input type="hidden" name="cappName" value="Iced Cappuccino">
                            <input type="hidden" name="cappPrice" value="<?= $priceIC ?>">
                            <input type="hidden" name="cappDoublePrice" value="<?= $priceICD ?>">
                            <input type="hidden" name="cappSingleQty" value="0">
                            <input type="hidden" name="cappDoubleQty" value="0">
                        </tr>
                        <tr class="menu-item">
                            <td></td>
                            <td></td>
                            <td class="colName"> Total Price </td>
                            <td> <input type="text" readonly id="totalPrice"></td>
                        </tr>
                    </table>
                    <input type="submit" name="checkout" value="Checkout">
                </form>
            </div>

        </div>

        <!-- Footer -->
        <footer>
            <div>
                <i>Copyright &copy; 2023 JavaJam Coffee House</i>
            </div>

            <div>
                <i><a href="mailto:pyae@sonekhin.com">pyae@sonekhin.com</a></i>
            </div>
        </footer>

    </div>
    <script>
        function calculateItemPrice(qtyId, priceId, typeId, singleType, doubleType, unitPrice) {
            // Get the input values for quantity
            var quantity = parseFloat(document.getElementById(qtyId).value) || 0;
            // Ensure the quantity is not negative
            if (quantity < 0) {
                quantity = 0; // Set it to zero to prevent negative values
                document.getElementById(qtyId).value = "0";
            }
            // Calculate the item price based on the selected radio button
            var radioType = document.querySelector(`input[name="${typeId}"]:checked`);
            if (radioType) {
                unitPrice = parseFloat(radioType.getAttribute('data-price'));
            }
            var itemPrice = quantity * unitPrice;
            // Update the item price input field
            document.getElementById(priceId).value = "$" + itemPrice.toFixed(2);
            // Calculate the overall total price
            var javaPrice = parseFloat(document.getElementById('javaPrice').value.replace("$", "")) || 0;
            var cafePrice = parseFloat(document.getElementById('cafePrice').value.replace("$", "")) || 0;
            var cappPrice = parseFloat(document.getElementById('cappPrice').value.replace("$", "")) || 0;
            var overallTotalPrice = javaPrice + cafePrice + cappPrice;
            // Update the total price input field
            document.getElementById("totalPrice").value = "$" + overallTotalPrice.toFixed(2);
            
            // Update the type-specific quantities
            if (typeId === 'cafeType') {
                if (radioType) {
                    if (radioType.value === singleType) {
                        document.getElementById('cafeSingleQty').value = quantity;
                        document.getElementById('cafeDoubleQty').value = 0;
                    } else if (radioType.value === doubleType) {
                        document.getElementById('cafeSingleQty').value = 0;
                        document.getElementById('cafeDoubleQty').value = quantity;
                    }
                }
            } else if (typeId === 'cappType') {
                if (radioType) {
                    if (radioType.value === singleType) {
                        document.getElementById('cappSingleQty').value = quantity;
                        document.getElementById('cappDoubleQty').value = 0;
                    } else if (radioType.value === doubleType) {
                        document.getElementById('cappSingleQty').value = 0;
                        document.getElementById('cappDoubleQty').value = quantity;
                    }
                }
            }
        }
    </script>
</body>

</html>