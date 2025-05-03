const categoriesWrapper = document.getElementById("categoriesWrapper");
const productsWrapper = document.getElementById("productsWrapper");
const sizeWrapper = document.getElementById("sizeWrapper");
const totalLabel = document.getElementById("totalLabel");
let cart = [];

const categories = [
    'jersey',
    'shorts',
    'jacket',
    'shoes'
]

// LOAD THE CATEGORIES ON LOAD
function loadCategories() {

    categories.forEach((category, index) => {
        categoriesWrapper.innerHTML += `
        <div class="card product-type" onclick="loadMerch('`+ index + `')" id="category` + index + `">
            <img src="assets/img/ui/`+ category + `.svg" alt="` + category + `">
        </div>`;
    });

    loadMerch(0);
}

// LOAD THE PRODUCTS AVAILABLE IN EACH CHOSEN CATEGORY
function loadMerch(categoryIndex) {

    productsWrapper.innerHTML = "";

    const categoryKey = categories[categoryIndex];

    players.forEach(player => {
        const merch = player.merch[categoryKey];

        if (!merch) return;

        const icon = merch.displayIcon;
        const label = categoryKey === 'jacket' ? player.team : player.name;

        productsWrapper.innerHTML += `
            <div class="card item" onclick="loadMerchSizes('` + categoryKey + `', '` + player.name + `')">
                <div class=" icon mx-2">
                    <img src="assets/img/merch/`+ categoryKey + `/` + icon + `">
                </div>
                <p class="p-1 mb-0 text-center lh-2">`+ label + ` ` + categoryKey + `</p>
            </div>
        `;
    });

    sizeWrapper.innerHTML = '';
}

// LOAD THE SIZES OPTION FOR THE PRODUCTS
function loadMerchSizes(categoryKey, playerName) {
    sizeWrapper.innerHTML = '';

    let player = null;
    for (let i = 0; i < players.length; i++) {
        if (players[i].name === playerName) {
            player = players[i];
            break;
        }
    }

    if (!player) return;

    const merch = player.merch[categoryKey];
    if (!merch) return;

    const sizes = merch.sizes;

    sizes.forEach((size, index) => {
        sizeWrapper.innerHTML += `
            <div class="card size p-2" onclick="addItemToCart('`+ categoryKey + `', '` + merch.code + `',` + merch.price + `,'` + size + `')">
               `+ size + `
            </div>
        `;
    });
}

// ADD THE PRODUCT TO THE RECEIPT AFTER CHOOSING SIZE
function addItemToCart(category, code, price, size) {
    let itemName = '';
    let itemExists = false;

    if (category === 'shoes') {
        size = 'S' + size;
    }

    itemName = size.toUpperCase() + ' ' + code;

    for (let i = 0; i < cart.length; i++) {
        if (cart[i].name === itemName) {
            cart[i].quantity += 1;
            itemExists = true;
            break;
        }
    }

    if (!itemExists) {
        const product = {
            name: itemName,
            price: price,
            size: size,
            quantity: 1
        }

        cart.push(product);
    }

    updateCartReceipt();
}

// UPDATE THE RECEIPT EVERY CHANGES THE USER MADE
function updateCartReceipt() {
    const cartItems = document.getElementById('cartItems');
    cartItems.innerHTML = '';
    let total = 0;

    cart.forEach((product) => {
        const subtotal = product.price * product.quantity;
        cartItems.innerHTML += ` 
            <div class="item">
                <span>`+ product.quantity + `</span>
                <div class="ms-4 pe-4 item-name">`+ product.name + `</div>
                <span class="ms-auto pe-2">` + subtotal.toFixed(2) + `</span>
            </div>`
        total += subtotal;
    });

    // FORMAT THE TOTAL
    totalLabel.innerText = "₱" + total.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    sizeWrapper.innerHTML = '';
}

// CONTROL FUNCTIONS 
function clearItemFromReceipt() {
    cart.pop();
    updateCartReceipt();
}

function clearAllFromReceipt() {
    cart.length = 0;
    updateCartReceipt();
}

function increaseQuantity() {
    cart[cart.length - 1].quantity += 1;
    updateCartReceipt();
}

function decreaseQuantity() {
    if (cart.length > 0 && cart[cart.length - 1].quantity > 1) {
        cart[cart.length - 1].quantity -= 1;
    }
    updateCartReceipt();
}

loadCategories();


