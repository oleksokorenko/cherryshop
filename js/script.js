/////////////////////////kosz ilość sztuk//
let basket = [];
document.getElementById("add_to_box").onclick = function(){
    let product = {};
    let productCheck = {
        size: "Nie wybrano rozmiaru",
        color: "Nie wybrano koloru",
        quantity: "Trszeba napisać ilośc"
    };
    /////////////////////////////////////
    document.getElementById("basket_key").addEventListener("click", () => {
        document.getElementById("basket").classList.remove("hide");
    });
    ////////////////////////////////
    let errors = "";
    document.querySelectorAll(".multi_setting").forEach(item => {
        
        if (item.dataset.name !== undefined){
            if(productCheck[item.dataset.name] !== undefined && (item.dataset.value === undefined || !item.dataset.value)){
                errors += `- ${productCheck[item.dataset.name]} (${item.dataset.name})\n`; 
            }
            else{
                product[item.dataset.name] = item.dataset.value;
            }
        }
    });
        if(errors) {
        alert(`Brak danych:\n${errors}`);
        return false;
        }
    basket[product.id] = product;
    console.log(basket);
    refreshBasket();
    resetProduct();
    alert(`Product '${product.name}' w ilości '${product.quantity}'dodano do kosza`);
}
document.querySelectorAll(".closer").forEach(item =>{
        item.addEventListener("click", event =>{
        event.target.parentNode.classList.add("hide");
    })
});





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
        for (let key in colors) {
            colorTypes.innerHTML += 
                `<li title="${colors[key].color_label}" data-id="${colors[key].id}" data-color_id=${colors[key].color_id} data-color_value="${colors[key].color_value}"  data-color_amount=${colors[key].amount} style="background-color: ${colors[key].color_value};"></li>`;
        }
        document.querySelectorAll(".colors_types li").forEach(item => {
            item.addEventListener("click", event => {
                event.target.parentNode.childNodes.forEach(item => {
                    if (item.dataset !== undefined && item.dataset.choise !== undefined && item.dataset.choise == 1){
                        item.dataset.choise = 0;
                        item.classList.remove("choised_setting");
                    }
        });
        
                document.getElementById("product_id").dataset.value = event.target.dataset.id;
                event.target.dataset.choise = 1;
                event.target.parentNode.parentNode.dataset.value = event.target.dataset.color_value;
                event.target.classList.add("choised_setting");
                document.querySelector("#quantity input").max = event.target.dataset.color_amount;
                document.querySelector("#quantity input").title = "Ilość dostępna: " + event.target.dataset.color_amount;
            })
        });
    });
});  
// ////////////////////////////////////////////////
document.querySelectorAll(".multi_setting input").forEach(item => {
    item.addEventListener("input", event => {
        event.target.parentNode.dataset.value = event.target.value;
    });
});




///////////////cookie//////////////





    

