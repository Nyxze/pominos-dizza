import $ from 'jquery';
$(document).ready( function (){

    let $toppingContainer = $('#pizza_toppings');
    let template = $toppingContainer.data("prototype");

    $("#btnAddItem").on('click', function (){
        let toppingNumber = 1 + $toppingContainer.children().length;
        let html = template.replaceAll("__name__label__", "Ingrédient N°"+toppingNumber)
        html = html.replaceAll("__name__",toppingNumber);

        $toppingContainer.append(html);

    })




})

