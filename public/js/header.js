const btn = $("#categories-btn");
const menu = $("#categories-menu");
const caret = $("#caret-icon");

btn.on("click", (e) => {
    e.stopPropagation();
    menu.toggleClass("hidden");
    btn.toggleClass("active");
});

$(document).on("click", () => {
    menu.addClass("hidden");
    btn.removeClass("active");
});
