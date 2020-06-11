$(function() {
  $("#menuOpen").click(function() {
    $("#spMenu").animate({opacity:1, left:0}, 700);
  });
  $("#menuClose").click(function() {
    $("#spMenu").animate({opacity:0, left:"-100%"}, 700);
  });
});