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
    console.log(inputval);

    if (e.keyCode == 8) {
        inputval = inputval.slice(0, inputval.length - 1);
        $(this).val(inputval);
        filterinput();
        suggestions();
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

const calculators = [
    // ======= CONVERSION CALCULATORS =======
    {
        name: "Length Converter",
        route: "/length",
        keywords: [
            "length",
            "convert length",
            "m",
            "meter",
            "meters",
            "cm",
            "centimeter",
            "centimeters",
            "mm",
            "millimeter",
            "millimeters",
            "km",
            "kilometer",
            "kilometers",
            "m to cm",
            "cm to m",
            "mm to cm",
            "cm to mm",
            "km to m",
            "m to km",
            "inch",
            "inches",
            "ft",
            "foot",
            "feet",
            "yard",
            "yards",
            "mile",
            "miles",
            "inch to cm",
            "cm to inch",
        ],
    },
    {
        name: "Area Converter",
        route: "/area",
        keywords: [
            "area",
            "convert area",
            "square",
            "sq",
            "m²",
            "cm²",
            "mm²",
            "km²",
            "ft²",
            "yard²",
            "square meter",
            "square centimeter",
            "square kilometer",
            "acre",
            "hectare",
            "m2 to cm2",
            "cm2 to m2",
            "sq ft to m2",
            "convert area units",
        ],
    },
    {
        name: "Volume Converter",
        route: "/volume",
        keywords: [
            "volume",
            "convert volume",
            "litre",
            "liter",
            "ml",
            "millilitre",
            "milliliter",
            "gallon",
            "cubic meter",
            "m³",
            "cm³",
            "cc",
            "convert litres",
            "l to ml",
            "ml to l",
            "m3 to l",
        ],
    },
    {
        name: "Time Converter",
        route: "/time",
        keywords: [
            "time",
            "convert time",
            "second",
            "seconds",
            "minute",
            "minutes",
            "hour",
            "hours",
            "day",
            "days",
            "week",
            "weeks",
            "month",
            "months",
            "year",
            "years",
            "hr to min",
            "min to sec",
            "convert seconds to hours",
        ],
    },
    {
        name: "Temperature Converter",
        route: "/temperature",
        keywords: [
            "temperature",
            "convert temperature",
            "celsius",
            "fahrenheit",
            "kelvin",
            "c to f",
            "f to c",
            "c to k",
            "k to c",
            "fahrenheit to celsius",
            "celsius to fahrenheit",
        ],
    },
    {
        name: "Weight Converter",
        route: "/weight",
        keywords: [
            "weight",
            "convert weight",
            "kg",
            "kilogram",
            "kilograms",
            "g",
            "gram",
            "grams",
            "mg",
            "milligram",
            "milligrams",
            "lb",
            "pound",
            "pounds",
            "ton",
            "tons",
            "kg to g",
            "g to kg",
            "kg to lb",
            "lb to kg",
            "convert mass",
        ],
    },

    // ======= FINANCE CALCULATORS =======
    {
        name: "Rent Affordability Calculator",
        route: "/rent/calculation/calculator",
        keywords: [
            "rent",
            "afford rent",
            "rental cost",
            "monthly rent",
            "how much rent can i afford",
            "budget rent",
            "finance",
            "flat rent",
            "apartment rent",
            "calculate rent limit",
            "house rent",
        ],
    },
    {
        name: "Salary Calculator",
        route: "/salary/calculation/calculator",
        keywords: [
            "salary",
            "monthly salary",
            "yearly salary",
            "income",
            "finance",
            "gross salary",
            "net salary",
            "deductions",
            "pay calculator",
            "take home pay",
            "hourly wage",
            "calculate income",
        ],
    },
    {
        name: "Depreciation Calculator",
        route: "/depreciation",
        keywords: [
            "depreciation",
            "asset value",
            "decline value",
            "ddb",
            "finance",
            "straight line method",
            "book value",
            "asset depreciation",
            "value decrease",
            "calculate depreciation",
            "machinery depreciation",
            "vehicle depreciation",
        ],
    },
    {
        name: "Mortgage Calculator",
        route: "/mortgage",
        keywords: [
            "mortgage",
            "home loan",
            "loan repayment",
            "monthly payment",
            "emi",
            "finance",
            "interest",
            "principal",
            "property loan",
            "house loan",
            "mortgage interest",
            "loan amount",
            "mortgage calculator",
        ],
    },
    {
        name: "Tax Calculator",
        route: "/income-tax",
        keywords: [
            "tax",
            "income tax",
            "finance",
            "taxable income",
            "tax rate",
            "salary tax",
            "fbr tax",
            "calculate tax",
            "pakistan tax",
            "annual tax",
            "deductions",
            "income after tax",
        ],
    },

    // ======= FITNESS & HEALTH CALCULATORS =======
    {
        name: "BMI Calculator",
        route: "/fitness/bmi-calculator",
        keywords: [
            "bmi",
            "body mass index",
            "weight height ratio",
            "check bmi",
            "fitness",
            "bmi chart",
            "healthy weight",
            "calculate bmi",
            "fat level",
            "underweight",
            "overweight",
        ],
    },
    {
        name: "BMR Calculator",
        route: "/fitness/bmr-calculator",
        keywords: [
            "bmr",
            "basal metabolic rate",
            "metabolism",
            "fitness",
            "calories burned at rest",
            "daily energy",
            "calculate bmr",
            "resting calories",
            "body metabolism",
        ],
    },
    {
        name: "TDEE Calculator",
        route: "/fitness/tdee-calculator",
        keywords: [
            "tdee",
            "total daily energy expenditure",
            "calorie needs",
            "fitness",
            "daily calories",
            "maintenance calories",
            "caloric intake",
            "burn calories",
            "how many calories i burn",
        ],
    },
    {
        name: "Ideal Weight Calculator",
        route: "/fitness/ideal-weight-calculator",
        keywords: [
            "ideal weight",
            "perfect weight",
            "fitness",
            "target weight",
            "healthy weight",
            "weight goal",
            "normal weight for height",
            "ideal body weight",
            "correct weight",
        ],
    },
    {
        name: "Body Fat Calculator",
        route: "/fitness/body-fat-calculator",
        keywords: [
            "body fat",
            "fat percentage",
            "fitness",
            "fat level",
            "measure fat",
            "body composition",
            "fat calculator",
            "fat ratio",
            "lean mass",
            "fat index",
        ],
    },
];

function suggestions() {
    const $input = $(this);
    const $wrapper = $input.closest("#testing, .search-wrapper");
    const $suggestionsBox = $wrapper.find(".suggestion");

    const query = $input.val().toLowerCase().trim();
    $suggestionsBox.empty();

    if (!query) return $suggestionsBox.hide();

    const matches = calculators.filter((calc) =>
        calc.keywords.some((keyword) => keyword.toLowerCase().includes(query))
    );

    if (!matches.length) return $suggestionsBox.hide();

    const url = new URL(window.location);

    $.each(matches, function (_, calc) {
        const $link = $("<a></a>")
            .text(calc.name)
            .attr("href", url.origin + calc.route)
            .css({
                padding: "5px",
                display: "block",
                cursor: "pointer",
            })
            .on("click", function (e) {
                $input.val(calc.name);
                $suggestionsBox.hide();
                history.replaceState(null, "", calc.route);
                console.log("Open calculator:", calc.name);
            });

        $suggestionsBox.append($link);
    });

    $suggestionsBox.show();
}
$(document).on("input keyup", ".sea", suggestions);

$(document).on("click", function (e) {
    if (!$(e.target).closest(".sea, .suggestion").length) {
        $(".suggestion").empty().hide();
    }
});
