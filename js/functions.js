function refreshBasket(){
    
    let purches = "";
    let puchesCount = 0;
    let sum = 0;
    
    basket.forEach(item => {
        purches += `
            <li data-id="${item.id}">
                <h5>${item.name}</h5> 
                <h6 class="colors_types" style="background:${item.color}; display:inline-block" ></h6>
                <strong>${item.size}</strong>
                <input type="number" min=1 max=100 value=${item.quantity} oninput="productRecount(this, ${item.price})">
                <strong><span>${item.price * item.quantity}</span> zł</strong>
                <span class="pushes_deleter" onclick="deleteProduct(${item.id})">✖</span>
            </li>
        `;
        sum += item.price * item.quantity;
        puchesCount++;
    });
    document.querySelector("#basket_key span").innerText = puchesCount;
    document.querySelector("#basket > ul").innerHTML = purches;
    document.querySelector('#total span').innerHTML = sum;
    document.querySelector('#basket > form input[name="puchases"]').value = JSON.stringify(basket);
    

}
function deleteProduct(id){
    delete basket[id];
    refreshBasket();
}

function resetProduct(){
    document.querySelectorAll('div[data-name="size"] li').forEach(item => {
        if (item.dataset !== undefined && item.dataset.choise !== undefined && item.dataset.choise == 1){
            item.dataset.choise = 0;
            item.classList.remove("choised_setting");
        }
    });
    let colorTypes = document.getElementById("colors_types");
    colorTypes.innerHTML = "";
    document.querySelector("#quantity input").value = 1;
}
function productRecount(item, price){
    let id = item.parentNode.dataset.id;
    basket[id].quantity = item.value;
    refreshBasket();
}






