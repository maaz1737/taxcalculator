const btn = $("#categories-btn");
const menu = $("#categories-menu");
const caret = $("#caret-icon");

btn.on("click", (e) => {
    e.stopPropagation();
    menu.toggleClass("show");
    btn.toggleClass("active");
});

$(document).on("click", () => {
    menu.removeClass("show");
    btn.removeClass("active");
});
