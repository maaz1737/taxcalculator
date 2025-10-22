// filter input function
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
// filter function is being called on filter input change
$(".search-input").on("input", function () {
    let newval = $(this).val().trim().toLowerCase();
    filterinput(newval);
});
// this is code to delete a single letter in this input and if that is filter input its also call the filter function
$(".search,.search-input").on("keydown", function (e) {
    let inputval = $(this).val();
    if (e.keyCode == 8) {
        inputval = inputval.slice(0, inputval.length - 1);
        $(this).val(inputval);
        filterinput();
    }
});
// to open model
function openModal($overlay) {
    $overlay.removeClass("hidden").attr("aria-hidden", "false");
    $("body").css("overflow", "hidden");
}
//  to close model
function closeModal($overlays) {
    $overlays.addClass("hidden").attr("aria-hidden", "true");
    $("body").css("overflow", "");
}

// this is the code to save favorite button to database
$(".fav-btn").on("click", function () {
    let id = $(this).data("id");
    let name = $(this).data("name");
    let text = $(this).data("text");
    const $btn = $(this);
    const $heart = $btn.find(".heart-solid");

    if (
        $heart.hasClass("text-slate-500") ||
        $heart.hasClass("dark:text-slate-400")
    ) {
        // Set to favorite (red)
        $heart
            .removeClass("text-slate-500 dark:text-slate-400")
            .addClass("text-red-500");
    } else {
        $heart
            .removeClass("text-red-500")
            .addClass("text-slate-500 dark:text-slate-400");
    }

    let data = {
        id: id,
        name: name,
        text: text,
    };

    $.ajax({
        url: "/favorites/calculators/store",
        type: "post",
        dataType: "json",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        data: JSON.stringify(data),
        success: function (response) {
            console.log("Success:", response);
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        },
        complete: function () {
            console.log("Request complete.");
        },
    });
});

function showErrors($err, msg) {
    console.log(msg);
    $err.removeClass("-translate-y-full opacity-0 ");
    $err.text(msg);
    setTimeout(() => {
        $err.addClass("-translate-y-full opacity-0 ");
    }, 2000);
}
function clearError() {}

function showSuccessMessage($err, msg) {
    $err.removeClass(
        "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
    );
    $err.addClass(
        "text-green-700 bg-green-100 border-green-200 dark:text-green-300 dark:bg-green-900/30 dark:border-green-800"
    );
    $err.text(msg);
    setTimeout(() => {
        $err.addClass(
            "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
        );
        $err.removeClass(
            "text-green-700 bg-green-100 border-green-200 dark:text-green-300 dark:bg-green-900/30 dark:border-green-800"
        );
    }, 2000);
}

const logo = `<svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-4 w-4"
            viewBox="0 0 24 24"
            fill="currentColor"
        >
            <path d="M3 7a2 2 0 0 1 2-2h9l5 5v7a2 2 0 0 1-2 2h-2v-6H7v6H5a2 2 0 0 1-2-2V7Z" />
            <path d="M9 5h4v4H9z" />
        </svg>`;
