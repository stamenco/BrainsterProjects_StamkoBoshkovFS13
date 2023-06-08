$(document).ready(function () {
  //FILTERS FUNCTIONALITY

  $(".list").click(function () {
    let value = $(this).attr("data-filter");

    if ($(this).hasClass("bg-active")) {
      $(".itemBox").show("1300");
    } else {
      $(".itemBox")
        .not("." + value)
        .hide("1300");
      $(".itemBox")
        .filter("." + value)
        .show("1300");
    }
  });
  //RESPONSIVE MENU OVERLAY

  $(".menu-toggler-wrapper").click(function () {
    $("body").addClass("overflow");
    $(".target-overlay").addClass("overlay");
    $(".nav-item a").addClass("text-white");
    $(".navbar-brand").addClass("invisible");
    $("nav").removeClass("nav-shadow");
  });
  $(".fa-times").click(function () {
    $("body").removeClass("overflow");
    $(".target-overlay").removeClass("overlay");
    $(".nav-item a").removeClass("text-white");
    $(".navbar-brand").removeClass("invisible");
    $("nav").addClass("nav-shadow");
  });
  //FILTER BUTTONS VISUAL

  $(".list").click(function () {
    $(this).toggleClass("bg-active").siblings().removeClass("bg-active");
    if ($("#filter-1").hasClass("bg-active")) {
      $("#filter-1").children("p").removeClass("text-white");
    } else if ($("#filter-1").not("bg-active")) {
      $("#filter-1").children("p").addClass("text-white");
    }

    if ($("#filter-2").hasClass("bg-active")) {
      $("#filter-2").children("p").removeClass("text-white");
    } else if ($("#filter-2").not("bg-active")) {
      $("#filter-2").children("p").addClass("text-white");
    }

    if ($("#filter-3").hasClass("bg-active")) {
      $("#filter-3").children("p").removeClass("text-white");
    } else if ($("#filter-3").not("bg-active")) {
      $("#filter-3").children("p").addClass("text-white");
    }
  });
  //FORM SELECT INPUT

  $(".select-wrapper").click(function () {
    $(".dropdown-container").toggleClass("select-active");
    $(".dropdown").toggleClass("dropdown-active");
  });
  $(".dropdown-container li").click(function (e) {
    var txt = $(e.target).text();
    $(".dropdown").text(txt);
    if ($(".dropdown").hasClass("select-active")) {
      $(".dropdown-container").removeClass("select-active");
    }
  });
});
