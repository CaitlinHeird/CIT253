<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Caitlin's Clothing Store</title>

    <style>
        h1 {
            font-size: 40px;
            text-align: center;
            color: #000;
        }

        h2 {
            font-size: 30px;
            color: #000;
        }

        p {
            font-size: 16px;
            color: #000;
        }

        body {
            margin: 0;
            padding: 35px 0;
            background-color: #EAEDED;
            font-family: Arial, sans-serif;
        }

        main {
            width: 85%;
            max-width: 950px;
            margin: auto;
            padding: 30px;
            background-color: white;
            border: 1px solid #DDD;
        }

        .intro {
            font-size: 16px;
            color: #000;
            text-align: center;
        }
        
        .item {
            display: flex;
            align-items: center;
            gap: 30px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #DDD;
            background-color: #fffafa;
        }

        .item img {
            width: 200px;
            height: 150px;
            object-fit: contain;
        }

        .info h2 {
            margin-top: 0;
        }

        .info p {
            margin: 8px 0;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #D0D0D0;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <main>

        <h1>Caitlin's Clothing Store</h1>

        <p class ="intro"> This program randomly selects the quantity of shirts, pants, and shoes in your cart and calculates the total cost of each item.</p>

        <div class="item">

            <img src="img/tshirt_red.png">

            <div class="info">

                <h2>Shirts</h2>

                <?php

                define("SHIRT_PRICE", 20);
                $shirts = rand(1, 10);
                $shirts_total = $shirts * SHIRT_PRICE;

                echo "<p>Price: $" . number_format(SHIRT_PRICE, 2) . "</p>";
                echo "<p>Quantity: " . $shirts . "</p>";
                echo "<p>Total: $" . number_format($shirts_total, 2) . "</p>";

                ?>

            </div>

        </div>


        <div class="item">

            <img src="img/pants_denim.png">

            <div class="info">

                <h2>Pants</h2>

                <?php

                define("PANTS_PRICE", 30);
                $pants = rand(1, 10);
                $pants_total = $pants * PANTS_PRICE;

                echo "<p>Price: $" . number_format(PANTS_PRICE, 2) . "</p>";
                echo "<p>Quantity: " . $pants . "</p>";
                echo "<p>Total: $" . number_format($pants_total, 2) . "</p>";

                ?>

            </div>

        </div>


        <div class="item">

            <img src="img/shoes_blue.png">

            <div class="info">

                <h2>Shoes</h2>

                <?php

                define("SHOES_PRICE", 50);
                $shoes = rand(1, 10);
                $shoes_total = $shoes * SHOES_PRICE;

                echo "<p>Price: $" . number_format(SHOES_PRICE, 2) . "</p>";
                echo "<p>Quantity: " . $shoes . "</p>";
                echo "<p>Total: $" . number_format($shoes_total, 2) . "</p>";

                ?>

            </div>

        </div>


        <div class="footer">
            Images are copyright (c) to their respective owners. Images pulled from Google just for this assignment.
        </div>

    </main>

</body>

</html>