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
                <nav>
                    <ul>
                        <li><a href="index.html" id="current">Home</a></li>
                        <li><a href="menu3.php">Menu</a></li>
                        <li><a href="music.html">Music</a></li>
                        <li><a href="jobs.html">Jobs</a></li>
                    </ul>
                </nav>
            </div>
            <div class="content" id="content-index">
                <h1>Coffee at JavaJam</h1>
                <form action="order.php" method="post">
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
                                <b>Endless Cup $<?= $priceJJ ?></b>
                            </td>
                            <td> <input type="number" min="0" id="javaQty" name="javaQty" oninput="calculateItemPrice('javaQty', 'javaPrice', <?= $priceJJ ?>)" value="0"></td>
                            <td> <input type="text" readonly id="javaPrice" name="javaTotalPrice"></td>
                            <input type="hidden" name="javaName" value="Just Java">
                            <input type="hidden" name="javaType" value="Endless Cup">

                        </tr>

                        <!-- <tr class="menu-item">
                            <td class="drink">Cafe au Lait</td>
                            <td class="description">
                                House blended coffee infused into a smooth steamed milk.
                                <br>
                                <b><input type="radio" id="cafeSingle" name="cafe" name="cafeSingle" value="<?= $priceCAL ?>" onclick="calculateItemPrice('cafeQty', 'cafePrice', <?= $priceCAL ?>)">Single $<?= $priceCAL ?></b>
                                <b><input type="radio" id="cafeDouble" name="cafe" name="cafeDouble" value="<?= $priceCALD ?>" onclick="calculateItemPrice('cafeQty', 'cafePrice', <?= $priceCALD ?>)">Double $<?= $priceCALD ?></b>
                            </td>


                            <td> <input type="number" min="0" id="cafeQty" oninput="calculateItemPrice('cafeQty', 'cafePrice', <?= $priceCAL ?>)" value="0"></td>
                            <td> <input type="text" readonly id="cafePrice" name="cafeTotalPrice" ></td>
                            <input type="hidden" name="cafeName" value="Cafe au Lait">
                            <input type="hidden" name="cafeType" value="">
                        </tr> -->

                        <tr class="menu-item">
                            <td class="drink">Cafe au Lait</td>
                            <td class="description">
                                House blended coffee infused into a smooth steamed milk.
                                <br>
                                <b><input type="radio" id="cafeSingle" name="cafe" value="<?= $priceCAL ?>" onclick="calculateItemPrice('cafeQty', 'cafePrice', <?= $priceCAL ?>)"> Single $<?= $priceCAL ?></b>
                                <b><input type="radio" id="cafeDouble" name="cafe" value="<?= $priceCALD ?>" onclick="calculateItemPrice('cafeQty', 'cafePrice', <?= $priceCALD ?>)"> Double $<?= $priceCALD ?></b>
                            </td>
                            <td> <input type="number" min="0" id="cafeQty" name="cafeQty" oninput="updateCafeTypeAndCalculate('cafeSingle', 'cafeDouble', 'cafeQty', 'cafePrice', <?= $priceCAL ?>, <?= $priceCALD ?>)" value="0"></td>
                            <td> <input type="text" readonly id="cafePrice" name="cafeTotalPrice"></td>
                            <input type="hidden" name="cafeName" value="Cafe au Lait">
                            <input type="hidden" name="cafeType" value="">
                        </tr>



                        <!-- <tr class="menu-item" id="odd">
                            <td class="drink">Iced Cappuccino</td>
                            <td class="description">
                                Sweetened espresso blended with icy-cold milk and served in a chilled glass.
                                <br>
                                <b><input type="radio" id="cappSingle" name="capp" value="<?= $priceIC ?>" onclick="calculateItemPrice('cappQty', 'cappPrice', <?= $priceIC ?>)"> Single $<?= $priceIC ?></b>
                                <b><input type="radio" id="cappDouble" name="capp" value="<?= $priceICD ?>" onclick="calculateItemPrice('cappQty', 'cappPrice', <?= $priceICD ?>)"> Double $<?= $priceICD ?></b>
                            </td>
                            <td> <input type="number" min="0" id="cappQty" oninput="calculateItemPrice('cappQty', 'cappPrice', <?= $priceIC ?>)" value="0"></td>
                            <td> <input type="text" readonly id="cappPrice"></td>
                        </tr> -->

                        <tr class="menu-item" id="odd">
                            <td class="drink">Iced Cappuccino</td>
                            <td class="description">
                                Sweetened espresso blended with icy-cold milk and served in a chilled glass.
                                <br>
                                <b><input type="radio" id="cappSingle" name="capp" value="<?= $priceIC ?>" onclick="calculateItemPrice('cappQty', 'cappPrice', <?= $priceIC ?>)"> Single $<?= $priceIC ?></b>
                                <b><input type="radio" id="cappDouble" name="capp" value="<?= $priceICD ?>" onclick="calculateItemPrice('cappQty', 'cappPrice', <?= $priceICD ?>)"> Double $<?= $priceICD ?></b>
                            </td>
                            <td> <input type="number" min="0" id="cappQty" name="cappQty" oninput="updateCappTypeAndCalculate('cappSingle', 'cappDouble', 'cappQty', 'cappPrice', <?= $priceIC ?>, <?= $priceICD ?>)" value="0"></td>
                            <td> <input type="text" readonly id="cappPrice" name="cappTotalPrice"></td>
                            <input type="hidden" name="cappName" value="Iced Cappuccino">
                            <input type="hidden" name="cappType" value="">
                        </tr>



                        <tr class="menu-item">
                            <td></td>
                            <td></td>
                            <td class="colName"> Total Price </td>
                            <td> <input type="text" readonly id="totalPrice"></td>
                        </tr>
                        <?php

                        // Close the database connection
                        mysqli_close($conn);
                        ?>
                    </table>
                    <div style="text-align: right;">
                        <input type="submit" value="checkout" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; cursor: pointer; margin-right: 100px;">
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

    <!-- <script>
        function calculateItemPrice(qtyId, priceId, unitPrice) {
            // Get the input values for quantity
            var quantity = parseFloat(document.getElementById(qtyId).value) || 0;

            // Ensure the quantity is not negative
            if (quantity < 0) {
                quantity = 0; // Set it to zero to prevent negative values
                document.getElementById(qtyId).value = "0";
            }

            // Calculate the item price based on the selected radio button
            var radioName = qtyId === 'cafeQty' ? 'cafe' : 'capp';
            var selectedRadio = document.querySelector(`input[name="${radioName}"]:checked`);
            if (selectedRadio) {
                unitPrice = parseFloat(selectedRadio.value);
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
        }
    </script> -->

    <script>
        function calculateItemPrice(qtyId, priceId, unitPrice) {
            // Get the input values for quantity
            var quantity = parseFloat(document.getElementById(qtyId).value) || 0;

            // Ensure the quantity is not negative
            if (quantity < 0) {
                quantity = 0; // Set it to zero to prevent negative values
                document.getElementById(qtyId).value = "0";
            }

            // Calculate the item price based on the selected radio button
            var radioName = qtyId === 'cafeQty' ? 'cafe' : 'capp';
            var selectedRadio = document.querySelector(`input[name="${radioName}"]:checked`);
            if (selectedRadio) {
                unitPrice = parseFloat(selectedRadio.value);
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
        }


        function updateCafeTypeAndCalculate(singleRadioId, doubleRadioId, qtyId, priceId, singlePrice, doublePrice) {
            var singleRadio = document.getElementById(singleRadioId);
            var doubleRadio = document.getElementById(doubleRadioId);
            var selectedType = singleRadio.checked ? "Single" : doubleRadio.checked ? "Double" : "";

            document.getElementsByName("cafeType")[0].value = selectedType;

            calculateItemPrice(qtyId, priceId, selectedType === "Single" ? singlePrice : doublePrice);
        }

        function updateCappTypeAndCalculate(singleRadioId, doubleRadioId, qtyId, priceId, singlePrice, doublePrice) {
            var singleRadio = document.getElementById(singleRadioId);
            var doubleRadio = document.getElementById(doubleRadioId);
            var selectedType = singleRadio.checked ? "Single" : doubleRadio.checked ? "Double" : "";

            document.getElementsByName("cappType")[0].value = selectedType;

            calculateItemPrice(qtyId, priceId, selectedType === "Single" ? singlePrice : doublePrice);
        }
    </script>




</body>

</html>