<?php

// Set the prices:
define("SHIRT_PRICE", 20);
define("PANTS_PRICE", 30);
define("SHOES_PRICE", 50);

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validate the form data:
    if (isset($_POST['shirts'], $_POST['pants'], $_POST['shoes']) &&
        is_numeric($_POST['shirts']) &&
        is_numeric($_POST['pants']) &&
        is_numeric($_POST['shoes']) &&
        $_POST['shirts'] >= 0 &&
        $_POST['pants'] >= 0 &&
        $_POST['shoes'] >= 0) {

        // Get the quantities:
        $shirts = $_POST['shirts'];
        $pants = $_POST['pants'];
        $shoes = $_POST['shoes'];

        // Calculate the individual totals:
        $shirts_total = $shirts * SHIRT_PRICE;
        $pants_total = $pants * PANTS_PRICE;
        $shoes_total = $shoes * SHOES_PRICE;

        // Calculate the overall total:
        $order_total = $shirts_total + $pants_total + $shoes_total;

        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>Caitlin's Clothing Store</title>

            <link rel="stylesheet" href="css/style.css">
        </head>

        <body>

            <main>

                <h1>Caitlin's Clothing Store</h1>

                <p class="intro">
                    Here is the total cost of your order.
                </p>

                <div class="item">

                    <img src="img/tshirt_red.png">

                    <div class="info">

                        <h2>Shirts</h2>

                        <p>Price: $20.00</p>

                        <p>Quantity: <?php echo $shirts; ?></p>

                        <p>
                            Shirts Total: $<?php echo number_format($shirts_total, 2); ?>
                        </p>

                    </div>

                </div>


                <div class="item">

                    <img src="img/pants_denim.png">

                    <div class="info">

                        <h2>Pants</h2>

                        <p>Price: $30.00</p>

                        <p>Quantity: <?php echo $pants; ?></p>

                        <p>
                            Pants Total: $<?php echo number_format($pants_total, 2); ?>
                        </p>

                    </div>

                </div>


                <div class="item">

                    <img src="img/shoes_blue.png">

                    <div class="info">

                        <h2>Shoes</h2>

                        <p>Price: $50.00</p>

                        <p>Quantity: <?php echo $shoes; ?></p>

                        <p>
                            Shoes Total: $<?php echo number_format($shoes_total, 2); ?>
                        </p>

                    </div>

                </div>


                <h2>
                    Overall Order Total:
                    $<?php echo number_format($order_total, 2); ?>
                </h2>


                <div class="footer">
                    Images are copyright (c) to their respective owners.
                    Images pulled from Google just for this assignment.
                </div>

            </main>

        </body>

        </html>

        <?php

    } else {

        echo '<h1>Error!</h1>';
        echo '<p>Please enter valid quantities for shirts, pants, and shoes.</p>';

    }

} else {

    echo '<h1>Error!</h1>';
    echo '<p>Please submit the form first.</p>';

}

?>