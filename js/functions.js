function refreshBasket(){
    
    let purches = "";
    let puchesCount = 0;
    basket.forEach(item => {
        purches += `
            <li>
                <h5>${item.name}</h5> 
                <h6 class="colors_types" style="background:${item.color}; display:inline-block" ></h6>
                <strong>${item.size}</strong>
                <input type="number" value=${item.quantity}>
                <strong>${item.price} zł</strong>
                <span data-id=${item.id} class="pushes_deleter" onclick="deleteProduct(this)">✖</span>
            </li>
        `;
        puchesCount++;
    });
    document.querySelector("#basket_key span").innerText = puchesCount;
    refreshBasket();

}
function deleteProduct(element){
    delete basket[element.dataset.id];
}


