const menu = $(".categories-menu");
const caret = $("#caret-icon");

const btn = $(".categories-btn");

btn.on("click", function (e) {
    e.stopPropagation();
    let showHide = $(this).closest(".relative").find(".categories-menu");
    showHide.toggleClass("hidden");
    caret.addClass("active");
});

$(".categories-menu").on("click", function (e) {
    e.stopPropagation();
});

$(document).on("click", function () {
    $(".categories-menu").addClass("hidden");
    caret.removeClass("active");
});
