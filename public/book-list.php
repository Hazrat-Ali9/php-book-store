<?php
// book-list.php
include '../src/db_connect.php';

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <h1>Welcome to the Online Bookstore</h1>
    <div class="book-list">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='book-item' data-book-id='" . $row["id"] . "'>";
                echo "<h2>" . $row["title"] . "</h2>";
                echo "<p>" . $row["description"] . "</p>";
                echo "<p class='book-price'>Price: $" . $row["price"] . "</p>"; // Wrap price with 'book-price' class
                echo "<button onclick='addToCart(" . $row["id"] . ")'>Add to Cart</button>";
                echo "</div>";
            }
        } else {
            echo "No books available.";
        }
        ?>
    </div>
    <script src="./cart.js"></script>
</body>
</html>
