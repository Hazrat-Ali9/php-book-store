<?php
// cart.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <h1>Your Cart</h1>
    <div class="cart-items">
        <!-- Cart items will be injected by JS -->
    </div>

    <script src="./cart.js"></script>
    <script>
        // Load cart items on page load
        window.onload = loadCart;
    </script>
</body>
</html>
