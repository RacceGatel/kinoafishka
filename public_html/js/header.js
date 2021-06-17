$(".dropdown-menu li a").click(function () {
    $(".btn-secondary").text($(this).text());
});