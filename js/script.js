function showError(img) {
    const overlay = img.nextElementSibling; // Get the overlay div
    overlay.style.visibility = 'visible'; // Show the overlay
}

function searchProducts() {
    let searchInput = document.querySelector('.search');
    // let searchBtn = document.querySelector('.searchBtn');
    searchInput.classList.toggle('show')
}



function searchuserproduct() {
    let product = document.querySelector('.searchproducts').value;
    let proResults = document.querySelector('.searchResult')
        // proResults.innerHTML = product;
    let ajax = new XMLHttpRequest();
    ajax.open('POST', '/alok/dics project/pages/searchResult.php', true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4 && ajax.status === 200) {
            proResults.innerHTML = ajax.responseText;
            lazyload();
        }
    };
    if (product.length > 0) {
        ajax.send('x=' + encodeURIComponent(product)); // Properly encode the data
    } else {
        proResults.innerHTML = '';
    }
}

function add_to_cart(button) {
    let productdiv = button.closest('.product')
    let id = productdiv.querySelector('.id').textContent;
    let proResults = document.querySelector('.msg')

    let ajax = new XMLHttpRequest();
    ajax.open('POST', '/alok/dics project/pages/add_to_cart.php', true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4 && ajax.status === 200) {
            proResults.innerHTML = ajax.responseText;
            msg();
        }
    };
    ajax.send('x=' + encodeURIComponent(id)); // Properly encode the data
}

function add_to_cart_pi(button) {
    let productdiv = button.closest('.product_info_div')
    let id = productdiv.querySelector('.id').textContent;
    let proResults = document.querySelector('.msg')

    let ajax = new XMLHttpRequest();
    ajax.open('POST', '/alok/dics project/pages/add_to_cart.php', true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4 && ajax.status === 200) {
            proResults.innerHTML = ajax.responseText;
            msg();
        }
    };
    ajax.send('x=' + encodeURIComponent(id)); // Properly encode the data
}

setTimeout(function() {
    document.querySelector('.welcome').style.display = 'none';
}, 60000)


function searchuser() {
    console.log('x');
    let val = document.querySelector('#searchuser').value;
    let res = document.querySelector('.userResult');
    let ajax = new XMLHttpRequest();

    ajax.open('POST', 'searchuser.php', true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4 && ajax.status === 200) {
            res.innerHTML = ajax.responseText;
        }
    };

    ajax.send('x=' + encodeURIComponent(val));
}

function searchproduct() {
    console.log('x');
    let val = document.querySelector('#productsearch').value;
    let res = document.querySelector('.productResult');
    let ajax = new XMLHttpRequest();

    ajax.open('POST', 'searchproduct.php', true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4 && ajax.status === 200) {
            res.innerHTML = ajax.responseText;
        }
    };
    ajax.send('x=' + encodeURIComponent(val));
}

function userbtn() {
    let userbtn = document.querySelector('.user_data_btn')
    let userdata = document.querySelector('.user_data')
    userdata.classList.toggle('showme')
}

function productbtn() {
    let productbtn = document.querySelector('.product_data_btn')
    let productdata = document.querySelector('.product_data')
    productdata.classList.toggle('showme')
}

function addProductbtn() {
    let addNewProduct = document.querySelector('.add_new_product')
    let addProductbtn = document.querySelector('.add_product')

    addNewProduct.classList.toggle('showme')
}

function confirmdelete(event) {
    if (!confirm("Are you sure you want to delete this Product")) {
        event.preventDefault();
        return false;
    }
    return true;
}

function isInViewport(ele) {
    let rect = ele.getBoundingClientRect();
    let windowHeight = window.innerHeight || document.documentElement.clientHeight;
    return (
        rect.top < windowHeight - 100 &&
        rect.bottom > 100
    );
}

// isInViewport();

function lazyload() {
    document.querySelectorAll('.product').forEach(box => {
        if (isInViewport(box)) {
            box.classList.add('inView');
        } else {
            box.classList.remove('inView')
        }
    })
}

window.addEventListener('scroll', () => {
    lazyload();
})
window.addEventListener('load', () => {
    lazyload();
})

function msg() {
    // alert()
    let msg = document.querySelector('.msg')
    msg.style.display = 'block';
    msg.style.transform = 'translateX(0)'

    setTimeout(() => {
        msg.style.transform = 'translateX(110%)'
    }, 3000)
}



function chkProducts() {
    let div = document.querySelectorAll('.random>div');
    let ran = document.querySelector('.random');
    let text = document.createElement('p');
    // console.log(div.length)
    if (div.length > 1) {
        text.setAttribute('class', 'success msg')
        text.textContent = `${div.length - 1} Product Found`;
        ran.appendChild(text);
        msg()
    } else {
        text.setAttribute('class', 'warning msg')
        text.textContent = 'NO PRODUCT FOUND';
        ran.appendChild(text);
        msg()
    }
}

function cart() {
    let div = document.querySelector('.cart');
    div.style.transform = "translatex(0)"
}