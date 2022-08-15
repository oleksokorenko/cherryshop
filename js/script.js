/////////////////////////kosz ilość sztuk//
let basket = [];
document.getElementById("add_to_box").onclick = function(){
    let product = {};
    document.querySelectorAll(".multi_setting").forEach(item => {
        if (item.dataset.name !== undefined){
            product[item.dataset.name] = 
                (item.dataset.value !== undefined) ? item.dataset.value : null;
        }
    });
    basket.push(product);
    document.querySelector("#basket_key span").innerText = basket.length;
    console.log(basket);
}
////////////////////////////////
document.querySelectorAll(".multi_setting li").forEach(item => {
    item.addEventListener("click", event => {
        event.target.parentNode.childNodes.forEach(item=>{
            if (item.dataset !== undefined && item.dataset.choise !== undefined && item.dataset.choise == 1){
                item.dataset.choise = 0;
                item.classList.remove("choised_setting");
            }
        });
        event.target.dataset.choise = 1;
        event.target.parentNode.parentNode.dataset.value = event.target.title;
        event.target.classList.add("choised_setting");
        
        let colorTypes = document.getElementById("colors_types");
        colorTypes.innerHTML = "";
        let colors = JSON.parse(event.target.dataset.colors);
        console.log(colors);
        for (let key in colors) {
            colorTypes.innerHTML += 
                `<li title="${colors[key].color_label}" data-color_id=${colors[key].color_id}  data-color_amount=${colors[key].amount} style="background-color: ${colors[key].color_value};"></li>`;
        } 
    });
});  
// ////////////////////////////////////////////////
document.querySelectorAll(".multi_setting input").forEach(item => {
    item.addEventListener("input", event => {
        event.target.parentNode.dataset.value = event.target.value;
    });
});



    

