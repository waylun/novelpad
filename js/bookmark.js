$(document).ready(function ($) {
  // detect mark exist or not...
  let cachedval = localStorage.getItem("sixstone-mark") || null;
  if (cachedval) {
    $("#mark").val(cachedval);
  }
  //detect scroll location...
  $(".mk-top").on("click", function () {
    var markval = $(document).scrollTop();
    // store mark into localstorage
    localStorage.setItem("sixstone-mark", markval);
    alert("Bookmark Number Saved: " + markval);
    $("#mark").val(markval);
  });
  $("#gotomark").on("click", function () {
    window.scrollTo(0, $("#mark").val());
  });

  // browser window scroll (in pixels) after which the "back to top" link is shown
  var offset = 300,
    //grab the "back to top" link
    $back_to_top = $(".mk-top");
  //hide or show the "back to top" link
  $(window).scroll(function () {
    $(this).scrollTop() > offset
      ? $back_to_top.addClass("mk-is-visible")
      : $back_to_top.removeClass("mk-is-visible mk-fade-out");
  });
});
