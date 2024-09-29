<?php
// process_order.php

session_start();

// Ensure that the content-type is application/json
header('Content-Type: application/json');

// Include the database connection
include 'db_connect.php';

// Get the book ID from the JSON request
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['id'])) {
    $bookId = $input['id'];

    // Check if the book exists in the database
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();

        // Add the book to the session cart
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add the selected book to the cart session
        $_SESSION['cart'][$bookId] = [
            'title' => $book['title'],
            'price' => $book['price'],
            'quantity' => (isset($_SESSION['cart'][$bookId]['quantity'])) ? $_SESSION['cart'][$bookId]['quantity'] + 1 : 1
        ];

        // Send success response
        echo json_encode(['success' => true, 'message' => 'Book added to cart']);
    } else {
        // Send failure response if book not found
        echo json_encode(['success' => false, 'message' => 'Book not found']);
    }
} else {
    // Send failure response if no ID is provided
    echo json_encode(['success' => false, 'message' => 'No book ID provided']);
}
?>
