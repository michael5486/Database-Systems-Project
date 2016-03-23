$('.message').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});

$(".login_page").click(function() {
    $("#content").animate(
            {"width": "500px"},
            "fast");
});