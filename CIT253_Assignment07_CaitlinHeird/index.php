<?php

require('mysqli_connect.php');

// Retrieve the products:
$q = "SELECT product_id, product_name, description, price FROM Products ORDER BY product_id ASC";

// Run the query:
$r = @mysqli_query($dbc, $q);

if (!$r) {
    die('Could not retrieve the products: ' . mysqli_error($dbc));
}

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the customer information:
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $street_address = $_POST['street_address'] ?? '';
    $city = $_POST['city'] ?? '';
    $state = $_POST['state'] ?? '';
    $zip = $_POST['zip'] ?? '';

    // Get the product quantities:
    $quantities = $_POST['quantity'] ?? array();

    // Validate the customer information:
    $valid = true;

    if (empty($first_name) ||
        empty($last_name) ||
        empty($street_address) ||
        empty($city) ||
        empty($state) ||
        empty($zip)) {

        $valid = false;
    }

    // Validate the product quantities:
    $has_order = false;

    foreach ($quantities as $product_id => $quantity) {

        if ($quantity == '') {
            $quantity = 0;
        }

        if (!is_numeric($product_id) || !is_numeric($quantity) || $quantity < 0) {
            $valid = false;
        }

        if ($quantity > 0) {
            $has_order = true;
        }
    }

    if (!$has_order) {
        $valid = false;
    }

    // If the customer clicked Calculate Total:
    if (isset($_POST['calculate']) && $valid) {

        // Calculate the order total:
        $total = 0;

        $q = "SELECT product_id, product_name, price FROM Products ORDER BY product_id ASC";

        $price_result = @mysqli_query($dbc, $q);

        if (!$price_result) {
            die('Could not retrieve product prices: ' . mysqli_error($dbc));
        }

        // Store product names and prices:
        $products = array();

        while ($row = mysqli_fetch_array($price_result, MYSQLI_ASSOC)) {

            $products[$row['product_id']] = $row;

            $product_id = $row['product_id'];

            if (isset($quantities[$product_id])) {

                $quantity = $quantities[$product_id];

                if ($quantity == '') {
                    $quantity = 0;
                }

                if ($quantity > 0) {
                    $total += $row['price'] * $quantity;
                }
            }
        }

        $show_total = true;
    }

    // If the customer clicked Place Order:
    if (isset($_POST['confirm']) && $valid) {

        // Escape the customer information:
        $first_name = mysqli_real_escape_string($dbc, $first_name);
        $last_name = mysqli_real_escape_string($dbc, $last_name);
        $street_address = mysqli_real_escape_string($dbc, $street_address);
        $city = mysqli_real_escape_string($dbc, $city);
        $state = mysqli_real_escape_string($dbc, $state);
        $zip = mysqli_real_escape_string($dbc, $zip);

        // Insert the customer:
        $q = "INSERT INTO Customers
              (first_name, last_name, street_address, city, state, zip)
              VALUES
              ('$first_name', '$last_name', '$street_address', '$city', '$state', '$zip')";

        $r = @mysqli_query($dbc, $q);

        if (!$r) {
            die('Could not add the customer: ' . mysqli_error($dbc));
        }

        // Get the new customer ID:
        $customer_id = mysqli_insert_id($dbc);

        // Insert the orders:
        foreach ($quantities as $product_id => $quantity) {

            if ($quantity == '') {
                $quantity = 0;
            }

            if ($quantity > 0) {

                $product_id = (int) $product_id;
                $quantity = (int) $quantity;

                $q = "INSERT INTO Orders
                      (product_id, quantity, customer_id)
                      VALUES
                      ($product_id, $quantity, $customer_id)";

                $r = @mysqli_query($dbc, $q);

                if (!$r) {
                    die('Could not add the order: ' . mysqli_error($dbc));
                }
            }
        }

        $order_complete = true;
    }

    // If the submitted information was invalid:
    if (!$valid) {
        $error = true;
    }
}

$page_title = "Caitlin's Clothing Store";
include('includes/header.html');

?>

<main>

    <h1>Caitlin's Clothing Store</h1>

    <?php

    // If the order was completed:
    if (isset($order_complete)) {

        echo '<div class="order-message">';

        echo '<h2>Order Successful!</h2>';

        echo '<p>Thank you for your order.</p>';

        echo '<p><a href="index.php">Return to Store</a></p>';

        echo '</div>';

    // If the total was calculated:
    } elseif (isset($show_total)) {

        echo '<div class="order-message">';

        echo '<h2>Review Your Order</h2>';

        echo '<p>Please review your order before placing it.</p>';

        foreach ($quantities as $product_id => $quantity) {

            if ($quantity > 0) {

                echo '<p>'
                    . htmlspecialchars($products[$product_id]['product_name'])
                    . ' x '
                    . (int) $quantity
                    . '</p>';
            }
        }

        echo '<p><strong>Total: $' . number_format($total, 2) . '</strong></p>';

        ?>

        <form action="index.php" method="post">

            <input type="hidden" name="first_name"
                value="<?php echo htmlspecialchars($first_name); ?>">

            <input type="hidden" name="last_name"
                value="<?php echo htmlspecialchars($last_name); ?>">

            <input type="hidden" name="street_address"
                value="<?php echo htmlspecialchars($street_address); ?>">

            <input type="hidden" name="city"
                value="<?php echo htmlspecialchars($city); ?>">

            <input type="hidden" name="state"
                value="<?php echo htmlspecialchars($state); ?>">

            <input type="hidden" name="zip"
                value="<?php echo htmlspecialchars($zip); ?>">

            <?php

            foreach ($quantities as $product_id => $quantity) {

                echo '<input type="hidden" name="quantity[' . (int) $product_id . ']" value="' . (int) $quantity . '">';
            }

            ?>

            <p>
                <input type="submit" name="confirm" value="Place Order">
            </p>

        </form>

        <?php

        echo '</div>';

    // Otherwise, display the order form:
    } else {
    ?>

        <?php

        // Display the error message above the form:
        if (isset($error)) {

            echo '<div class="error-box">
                    Please enter all customer information and select at least one product with a valid quantity.
                  </div>';
        }

        ?>

        <p class="intro">
            Enter your information and the quantity of shirts, pants, and shoes you would like to purchase.
        </p>

        <form action="index.php" method="post">

            <p>
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name"
                    value="<?php echo htmlspecialchars($first_name ?? ''); ?>">
            </p>

            <p>
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name"
                    value="<?php echo htmlspecialchars($last_name ?? ''); ?>">
            </p>

            <p>
                <label for="street_address">Street Address:</label>
                <input type="text" name="street_address" id="street_address"
                    value="<?php echo htmlspecialchars($street_address ?? ''); ?>">
            </p>

            <p>
                <label for="city">City:</label>
                <input type="text" name="city" id="city"
                    value="<?php echo htmlspecialchars($city ?? ''); ?>">
            </p>

            <p>
                <label for="state">State:</label>
                <input type="text" name="state" id="state"
                    value="<?php echo htmlspecialchars($state ?? ''); ?>">
            </p>

            <p>
                <label for="zip">ZIP Code:</label>
                <input type="text" name="zip" id="zip"
                    value="<?php echo htmlspecialchars($zip ?? ''); ?>">
            </p>

            <?php

            while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

                echo '<div class="item">
                        <img src="images/';

                if ($row['product_name'] == 'Shirt') {
                    echo 'tshirt_red.png';
                } elseif ($row['product_name'] == 'Pants') {
                    echo 'pants_denim.png';
                } elseif ($row['product_name'] == 'Shoes') {
                    echo 'shoes_blue.png';
                }

                echo '">
                        <div class="info">
                            <h2>' . $row['product_name'] . '</h2>
                            <p>' . $row['description'] . '</p>
                            <p>Price: $' . number_format($row['price'], 2) . '</p>
                            <p>
                                Quantity:
                                <input type="number"
                                    name="quantity[' . $row['product_id'] . ']"
                                    min="0"
                                    value="' . (isset($quantities[$row['product_id']])
                                        ? (int) $quantities[$row['product_id']]
                                        : '') . '">
                            </p>
                        </div>
                      </div>';
            }

            ?>

            <p>
                <input type="submit" name="calculate" value="Calculate Total">
            </p>

        </form>

    <?php
    }

    ?>

</main>

<?php

include('includes/footer.html');

?>