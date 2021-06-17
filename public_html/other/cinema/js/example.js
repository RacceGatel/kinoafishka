$( document ).ready(function(){
    var price = 0;
    var idf =  $(".container .row").attr('id'); //айди фильма по тупому вложена в атрибут "айди" в блоке названия фильма на странице
    var idc = 0; //айди кинотеатра
    var place = []; //массив выбранных мест
    console.log(idf,idc);
    $(".price_place .text").css('display', 'none');
    $(".price_place button").css('display', 'none');

    $(".place_box .row_place").on("click", "div", function () {

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

            $(this).css('background-color' , 'rgb(176, 0, 0)'); 

            place.push({                    
                "id": $(this).text(),
                "row": $(this).attr('id')
            });
        }
        else
        if($(this).css('background-color') == 'rgb(176, 0, 0)')
        {
            if($(this).parent().hasClass("row1"))
                price = price - 150;
            if($(this).parent().hasClass("row2"))
                price = price - 160;
            if($(this).parent().hasClass("row3"))
                price = price - 190;
            if($(this).parent().hasClass("row4"))
                price = price - 200;

            $(this).css('background-color' , 'rgb(48, 219, 0)');

            place.splice(place.indexOf({
                "id": $(this).text(),
                "row": $(this).attr('id')
            }, 0));
        }

        $(".price_place div h4").text("Цена билета:" + price);
        
    });

    $(".dropdown-item").click(function () {
       
        $(".kino_place .dropdown button").text($(this).text());
        switch($(this).text()) {
            case "Искра": idc = 1;
            break;
            case "Синема парк": idc = 2;
            break;
            case "Семья" : idc = 3;
            break;
        }
        console.log(idc);
        place = [];
        price = 0;
        $(".price_place div h4").text("Цена билета:" + price);
        fillplaces();
        $(".price_place .text").css('display', 'inline-block');
        $(".price_place button").css('display', 'inline-block');
    });
    
    function fillplaces()
    {
        $('.row1 div').remove();
        for (let i = 1; i <= 7; i++) {
            var div = $('<div>', {
                "class" : "unselectable",
                "id" : 1,
                "text" : i
            });
            $(".row1").append(div);
            
            checkityplace(div,i,1,idc,idf);
        }
        $('.row2 div').remove();
        for (let i = 1; i <= 8; i++) {
            var div = $('<div>', {
                "class" : "unselectable",
                "id" : 2,
                "text" : i
            });
            $(".row2").append(div);
            
            checkityplace(div,i,2,idc,idf);
        }
        $('.row3 div').remove();
        for (let i = 1; i <= 10; i++) {
            var div = $('<div>', {
                "class" : "unselectable",
                "id" : 3,
                "text" : i
            });
            $(".row3").append(div);
            
            checkityplace(div,i,3,idc,idf);
        }
        $('.row4 div').remove();
        for (let i = 1; i <= 10; i++) {
            var div = $('<div>', {
                "class" : "unselectable",
                "id" : 4,
                "text" : i
            });
            $(".row4").append(div);
            
            checkityplace(div,i,4,idc,idf);
        }
    }

    function checkityplace(place, id, row, idcin, idfilm)//проверка каждого места на занятость
    {   
        $.ajax({
            type: "POST",
            url: "../../includes/checkplace.php",
            data: { param1 : id,
                param2 : row,
                param3 : idcin,
                param4 : idfilm
            },
            dataType: 'text',
            success: function(resp)
            {
                console.log(resp);
                if(resp == 0)
                    place.css('background-color' , 'rgb(204, 204, 204)');
            },
            error: function(){
                console.log("!checkplaces");
            }
        });
        
    }
    
    $(".price_place .but").click(function() //купить билет
    {
        for(let i = 0; i < place.length; i++)
        {
            $.ajax({
                type: "POST",
                url: "../../includes/buyticket.php",
                data: { param1 : place[i].id,
                    param2 : place[i].row,
                    param3 : idc,
                    param4 : idf
                },
                dataType: 'text',
                success: function()
                {
                    fillplaces();
                },
                error: function(){
                    console.log("!buyticket");
                }
        });
        }
        place = [];
        price = 0;
        $(".price_place div h4").text("Цена билета:" + price);
    });
});