function filterinput(q) {
    const $cards = $(".filter-card");

    if (!q) {
        $cards.show();
        return;
    }

    $cards.each(function () {
        const hasMatch =
            $(this)
                .find("button")
                .filter(function () {
                    return $(this).text().toLowerCase().includes(q);
                }).length > 0;

        $(this).toggle(hasMatch);
    });
}

$(".search-input").on("input", function () {
    let newval = $(this).val().trim().toLowerCase();
    filterinput(newval);
});

$(".search,.search-input").on("keydown", function (e) {
    let inputval = $(this).val();
    console.log(inputval);

    if (e.keyCode == 8) {
        inputval = inputval.slice(0, inputval.length - 1);
        $(this).val(inputval);
    }
});

function openModal($overlay) {
    $overlay.removeClass("hidden").attr("aria-hidden", "false");
    $("body").css("overflow", "hidden");
}
function closeModal($overlays) {
    $overlays.addClass("hidden").attr("aria-hidden", "true");
    $("body").css("overflow", "");
}
