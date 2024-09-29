// cart.js
function addToCart(bookId) {
    // Fetch existing cart data from localStorage
    let cart = localStorage.getItem('cart');
    
    // Parse the cart or create a new one if it doesn't exist
    cart = cart ? JSON.parse(cart) : {};

    // Check if the book is already in the cart
    if (cart[bookId]) {
        // Increment quantity if book is already in the cart
        cart[bookId].quantity += 1;
    } else {
        // Get book information from the DOM (title, price)
        const bookItem = document.querySelector(`[data-book-id='${bookId}']`);
        const title = bookItem.querySelector('h2').innerText;
        const price = parseFloat(bookItem.querySelector('.book-price').innerText.replace('Price: $', '')); // Extract price correctly
        
        // Add new book to the cart
        cart[bookId] = {
            title: title,
            price: price,
            quantity: 1
        };
    }

    // Save the updated cart back to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));

    alert('Book added to cart!');
}

// Function to load cart data and display it
function loadCart() {
    const cartContainer = document.querySelector('.cart-items');
    let cart = localStorage.getItem('cart');
    cart = cart ? JSON.parse(cart) : {};

    // Clear the cart display area
    cartContainer.innerHTML = '';

    // Loop through the cart items and display them
    if (Object.keys(cart).length > 0) {
        for (const bookId in cart) {
            const cartItem = cart[bookId];
            cartContainer.innerHTML += `
                <div class="cart-item">
                    <h2>${cartItem.title}</h2>
                    <p>Quantity: ${cartItem.quantity}</p>
                    <p>Price: $${cartItem.price}</p>
                </div>
            `;
        }
    } else {
        cartContainer.innerHTML = 'Your cart is empty.';
    }
}
