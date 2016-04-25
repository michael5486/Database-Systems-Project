$(document).ready(function () {

    $("#breakfastList").show();
    $("#lunchList").hide();
    $("#dinnerList").hide();
    $("#sidesList").hide();
    $("#beveragesList").hide();
    $("#dessertList").hide();

    $("#breakfastNav").click(function () {
        $("#breakfastList").show();
        $("#lunchList").hide();
        $("#dinnerList").hide();
        $("#sidesList").hide();
        $("#beveragesList").hide();
        $("#dessertList").hide();
    });
    
    $("#lunchNav").click(function () {
        $("#breakfastList").hide();
        $("#lunchList").show();
        $("#dinnerList").hide();
        $("#sidesList").hide();
        $("#beveragesList").hide();
        $("#dessertList").hide();
    });    
    
    $("#dinnerNav").click(function () {
        $("#breakfastList").hide();
        $("#lunchList").hide();
        $("#dinnerList").show();
        $("#sidesList").hide();
        $("#beveragesList").hide();
        $("#dessertList").hide();
    });    
    
    $("#sidesNav").click(function () {
        $("#breakfastList").hide();
        $("#lunchList").hide();
        $("#dinnerList").hide();
        $("#sidesList").show();
        $("#beveragesList").hide();
        $("#dessertList").hide();
    });    
    
    $("#beveragesNav").click(function () {
        $("#breakfastList").hide();
        $("#lunchList").hide();
        $("#dinnerList").hide();
        $("#sidesList").hide();
        $("#beveragesList").show();
        $("#dessertList").hide();
    });    
    
    $("#dessertNav").click(function () {
        $("#breakfastList").hide();
        $("#lunchList").hide();
        $("#dinnerList").hide();
        $("#sidesList").hide();
        $("#beveragesList").hide();
        $("#dessertList").show();
    });



});
