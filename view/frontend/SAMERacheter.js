function changeButtonColorOnPress() {
    const buyButton = document.querySelector('.buy-button');
    buyButton.classList.add('active');
}

function revertButtonColorOnRelease() {
    const buyButton = document.querySelector('.buy-button');
    buyButton.classList.remove('active');
}

function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    let currentQuantity = parseInt(quantityInput.value, 10);
    quantityInput.value = currentQuantity + 1;
}

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    let currentQuantity = parseInt(quantityInput.value, 10);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
}

// ajouter la quantité dans le localStorage
function addToCart() {
    const quantityInput = document.getElementById('quantity');
    const cartCounter = document.getElementById('cart-counter');
    
    // Convertir les valeurs en nombre entier
    let quantityToAdd = parseInt(quantityInput.value, 10);
    let currentCount = parseInt(cartCounter.textContent, 10);
    
    // Ajouter la quantité actuelle au compteur
    cartCounter.textContent = currentCount + quantityToAdd;

    // Sauvegarder le produit et la quantité dans le localStorage
    localStorage.setItem('cart', JSON.stringify({
        productName: "Graine de kedhe",
        quantity: currentCount + quantityToAdd,
        pricePerItem: 43
    }));
}
