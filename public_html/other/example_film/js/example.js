$( document ).ready(function(){
    var price = 0;
    $(".place_box .row_place div").click(function () {

        if($(this).css('background-color') == 'rgb(48, 219, 0)')
        {
            if($(this).parent().hasClass("row1"))
                price = price + 150;
            if($(this).parent().hasClass("row2"))
                price = price + 160;
            if($(this).parent().hasClass("row3"))
                price = price + 190;
            if($(this).parent().hasClass("row4"))
                price = price + 200;
        }
        else
        {
            if($(this).parent().hasClass("row1"))
                price = price - 150;
            if($(this).parent().hasClass("row2"))
                price = price - 160;
            if($(this).parent().hasClass("row3"))
                price = price - 190;
            if($(this).parent().hasClass("row4"))
                price = price - 200;
        }

        if($(this).css('background-color') == 'rgb(48, 219, 0)')
            $(this).css('background-color' , '#b00000');
        else
            $(this).css('background-color' , 'rgb(48, 219, 0)');

        $(".price_place div h4").text("Цена билета:" + price);
    });

    $(".kino_place button").click(function (){
        $(".kino_place ul").hidden = false;
    });
});