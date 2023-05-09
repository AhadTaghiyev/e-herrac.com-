$(document).ready(function () {
  if ($("#home-slider").length) {
    $("#home-slider").slick({
      arrows: false,
      dots: true,
    });
  }

  if ($("#single-page-main-slider").length) {
    $("#single-page-main-slider").slick({
      arrows: false,
      asNavFor: "#single-page-thumbnail-slider",
      swipe: false,
    });
  }

  if ($("#single-page-thumbnail-slider").length) {
    $("#single-page-thumbnail-slider").slick({
      arrows: false,
      slidesToShow: 4,
      infinite: true,
      asNavFor: "#single-page-main-slider",
      slidesToScroll: 1,
      // centerMode: true,
      focusOnSelect: true,
    });
  }

  $("#header-menu-button").on("click", function () {
    $("body").toggleClass("overflow-hidden");
    $("#header-menu").toggleClass("hidden");
  });

  if ($("#auction-dates-tabs").length) {
    $("#auction-dates-tabs")
      .find("#auction-dates-buttons > button")
      .on("click", function () {
        const clickedTabIndex = $("#auction-dates-tabs")
          .find("#auction-dates-buttons > button")
          .index(this);
        $("#auction-dates-tabs")
          .find("#auction-dates-buttons > button")
          .removeClass("text-white bg-blue-500");
        $(this).addClass("text-white bg-blue-500");
        $("#auction-dates-tabs")
          .find(`#tabs-content > div:not(.hidden)`)
          .addClass("hidden");
        $("#auction-dates-tabs")
          .find(`#tabs-content > div:nth-child(${clickedTabIndex + 1})`)
          .removeClass("hidden");
      });
  }

  if ($("#header-menu").length) {
    $(".has-submenu > a").on("click", function (e) {
      e.preventDefault();
      const visibility = $(this).parent().find(".submenu").css("display");
      $("#header-menu").children(".submenu").css("display", "none");
      if (visibility === "none") {
        $(this).parent().children(".submenu").css("display", "block");
      } else {
        $(this).parent().children(".submenu").css("display", "none");
      }
    });

    $(document).on("click", function (e) {
      if (!$("#header-menu").find(e.target).length) {
        $("#header-menu").find(".submenu").css("display", "none");
      }
    });
  }
});
