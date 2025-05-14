const categoriesWrapper = document.getElementById("categoriesWrapper");
const productsWrapper = document.getElementById("productsWrapper");
const sizeWrapper = document.getElementById("sizeWrapper");
const totalLabel = document.getElementById("totalLabel");

let cart = [];
let categoriesType = [];
let products = [];
let sizes = [];

// FETCH ALL MERCH CATEGORIES
const getAllCategories = async () => {

    fetch('http://localhost/Personal/Student%20Portfolio/TrisMatt20.github.io/ADET/A06/api/categories.php')
        .then(response => response.json())
        .then(data => {
            categoriesType = data;
            loadCategories();
            getMerch('jersey');
        });
}

// FETCH MERCHANDISES
const getMerch = async (categoryType) => {

    const categoryData = {
        type: categoryType
    };

    fetch('http://localhost/Personal/Student%20Portfolio/TrisMatt20.github.io/ADET/A06/api/products.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(categoryData)
    })
        .then(response => response.json())
        .then(data => {
            products = data;
            loadMerch(categoryType);
        });
}

// FETCH MERCHANDISE SIZES
const getMerchSizes = async (productID) => {

    const productData = {
        merchID: productID
    };

    fetch('http://localhost/Personal/Student%20Portfolio/TrisMatt20.github.io/ADET/A06/api/sizes.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(productData)
    })
        .then(response => response.json())
        .then(data => {
            sizes = data;
            loadMerchSizes(productID, data);
        });
}

// LOAD THE CATEGORIES ON LOAD
function loadCategories() {

    categoriesType.forEach((categoryType, index) => {
        categoriesWrapper.innerHTML += `
            <div class="card product-type" onclick="getMerch('`+ categoryType.type + `')" id="category` + index + `">
                <img src="assets/img/ui/`+ categoryType.type + `.svg" alt="` + categoryType + `">
            </div>`;
    });
}

// LOAD THE PRODUCTS AVAILABLE IN EACH CHOSEN CATEGORY
function loadMerch(categoryType) {

    productsWrapper.innerHTML = "";

    products.forEach((product, index) => {

        const label = categoryType === 'jacket' ? product.playerTeam : product.playerName;
        productsWrapper.innerHTML += `
            <div class="card item" onclick="getMerchSizes('` + product.merchID + `')">
                <div class=" icon mx-2">
                    <img src="assets/img/merch/`+ categoryType + `/` + product.merchIcon + `">
                </div>
                <p class="p-1 mb-0 text-center lh-2">`+ label + ` ` + categoryType + `</p>
            </div>
        `;
    });

    sizeWrapper.innerHTML = '';
}

// LOAD THE SIZES OPTION FOR THE PRODUCTS
function loadMerchSizes(productID, merchSizes) {
    sizeWrapper.innerHTML = '';
    sizes = merchSizes;

    let product = null;
    for (let i = 0; i < products.length; i++) {
        if (products[i].merchID === productID) {
            product = products[i];
            break;
        }
    }

    if (!product) return;

    merchSizes.forEach((merchSize, index) => {
        sizeWrapper.innerHTML += `
            <div class="card size p-2" onclick="addItemToCart('`+ productID + `', '` + merchSize.size + `')">
               `+ merchSize.size + `
            </div>
        `;
    });
}

// ADD THE PRODUCT TO THE RECEIPT AFTER CHOOSING SIZE
function addItemToCart(productID, size) {

    let product = null;

    for (let i = 0; i < products.length; i++) {
        if (products[i].merchID === productID) {
            product = products[i];
            break;
        }
    }

    if (!product) return;

    let price = parseFloat(product.price);
    let code = product.merchCode;
    let category = product.type || 'unknown';

    let itemName = (category === 'shoes' ? 'S' + size : size.toUpperCase()) + ' ' + code;

    let itemExists = false;
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

getAllCategories();