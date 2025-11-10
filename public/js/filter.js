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

const suggestions = [
    // ===== LENGTH CONVERTER =====
    { text: "cm to km", url: "/length" },
    { text: "convert cm into km", url: "/length" },
    { text: "how to convert meter to centimeter", url: "/length" },
    { text: "m to cm", url: "/length" },
    { text: "cm to m", url: "/length" },
    { text: "mm to cm", url: "/length" },
    { text: "cm to mm", url: "/length" },
    { text: "inch to cm", url: "/length" },
    { text: "cm to inch", url: "/length" },
    { text: "feet to meter", url: "/length" },
    { text: "meter to feet", url: "/length" },
    { text: "yard to meter", url: "/length" },
    { text: "mile to km", url: "/length" },
    { text: "km to mile", url: "/length" },
    { text: "convert inches into meters", url: "/length" },
    { text: "length converter online", url: "/length" },
    { text: "convert distance online", url: "/length" },
    { text: "length unit converter", url: "/length" },
    { text: "how many cm in 1 meter", url: "/length" },
    { text: "distance measurement calculator", url: "/length" },
    { text: "length conversion chart", url: "/length" },
    { text: "1 km equals how many meters", url: "/length" },
    { text: "online meter converter", url: "/length" },
    { text: "convert 100 cm to meter", url: "/length" },
    { text: "conversion of feet to yard", url: "/length" },
    { text: "convert inches to feet", url: "/length" },
    { text: "convert yard to feet", url: "/length" },
    { text: "length converter tool", url: "/length" },
    { text: "convert miles to km online", url: "/length" },
    { text: "length converter", url: "/length" },
    { text: "convert length", url: "/length" },
    { text: "cm to km", url: "/length" },
    { text: "m to cm", url: "/length" },
    { text: "inch to cm", url: "/length" },
    { text: "feet to meter", url: "/length" },
    { text: "yard to feet", url: "/length" },
    { text: "km to mile", url: "/length" },
    { text: "m to km", url: "/length" },
    { text: "cm to mm", url: "/length" },
    { text: "length calculator", url: "/length" },
    { text: "length conversion tool", url: "/length" },
    { text: "unit converter length", url: "/length" },
    { text: "online length calculator", url: "/length" },
    { text: "length conversion chart", url: "/length" },
    { text: "convert meters to centimeters", url: "/length" },
    { text: "convert kilometers to meters", url: "/length" },
    { text: "how to convert inches to cm", url: "/length" },
    { text: "easy length converter", url: "/length" },
    { text: "length converter online", url: "/length" },
    { text: "length measure calculator", url: "/length" },
    { text: "find length conversion", url: "/length" },
    { text: "fast length converter", url: "/length" },

    // ===== AREA CONVERTER =====
    { text: "sq ft to m²", url: "/area" },
    { text: "convert sq ft into sq meter", url: "/area" },
    { text: "how to calculate area in square feet", url: "/area" },
    { text: "acre to kanal", url: "/area" },
    { text: "kanal to marla", url: "/area" },
    { text: "marla to sq ft", url: "/area" },
    { text: "plot size converter", url: "/area" },
    { text: "land area converter Australia", url: "/area" },
    { text: "convert hectare to acre", url: "/area" },
    { text: "area calculator for land", url: "/area" },
    { text: "convert square meter to acre", url: "/area" },
    { text: "sq yard to m²", url: "/area" },
    { text: "sq ft to marla", url: "/area" },
    { text: "convert plot area", url: "/area" },
    { text: "area conversion chart", url: "/area" },
    { text: "land size calculator", url: "/area" },
    { text: "property area converter", url: "/area" },
    { text: "plot measurement converter", url: "/area" },
    { text: "calculate marla to square feet", url: "/area" },
    { text: "how many marla in one kanal", url: "/area" },
    { text: "convert hectare to square meter", url: "/area" },
    { text: "area converter", url: "/area" },
    { text: "convert area", url: "/area" },
    { text: "sq ft to m²", url: "/area" },
    { text: "acre to kanal", url: "/area" },
    { text: "marla to sq ft", url: "/area" },
    { text: "plot size calculator", url: "/area" },
    { text: "land converter", url: "/area" },
    { text: "area unit converter", url: "/area" },
    { text: "area calculator online", url: "/area" },
    { text: "area conversion chart", url: "/area" },
    { text: "convert acres to square feet", url: "/area" },
    { text: "convert hectares to acres", url: "/area" },
    { text: "sq ft to acres calculator", url: "/area" },
    { text: "land measurement converter", url: "/area" },
    { text: "easy area converter", url: "/area" },

    // ===== VOLUME CONVERTER =====
    { text: "litre to ml", url: "/volume" },
    { text: "ml to litre", url: "/volume" },
    { text: "convert gallon to litre", url: "/volume" },
    { text: "volume converter online", url: "/volume" },
    { text: "convert cubic meter to litre", url: "/volume" },
    { text: "cm³ to m³", url: "/volume" },
    { text: "convert litre to gallon", url: "/volume" },
    { text: "liquid volume calculator", url: "/volume" },
    { text: "convert litres to ml online", url: "/volume" },
    { text: "volume unit converter", url: "/volume" },
    { text: "convert 1 gallon to litre", url: "/volume" },
    { text: "m3 to litre converter", url: "/volume" },
    { text: "volume calculator tool", url: "/volume" },
    { text: "fluid volume converter", url: "/volume" },
    { text: "convert cubic cm to ml", url: "/volume" },
    { text: "volume converter", url: "/volume" },
    { text: "convert volume", url: "/volume" },
    { text: "litre to ml", url: "/volume" },
    { text: "gallon to litre", url: "/volume" },
    { text: "m³ to litre", url: "/volume" },
    { text: "fluid converter", url: "/volume" },
    { text: "cubic meter to litre", url: "/volume" },
    { text: "volume calculator", url: "/volume" },
    { text: "online volume converter", url: "/volume" },
    { text: "volume conversion chart", url: "/volume" },
    { text: "convert litres to millilitres", url: "/volume" },
    { text: "convert gallon to litre", url: "/volume" },
    { text: "find volume conversion", url: "/volume" },
    { text: "volume measurement calculator", url: "/volume" },

    // ===== TIME CONVERTER =====
    { text: "hr to min", url: "/time" },
    { text: "min to sec", url: "/time" },
    { text: "seconds to minutes", url: "/time" },
    { text: "convert hours to seconds", url: "/time" },
    { text: "time converter online", url: "/time" },
    { text: "days to hours", url: "/time" },
    { text: "weeks to days", url: "/time" },
    { text: "months to days", url: "/time" },
    { text: "convert time units", url: "/time" },
    { text: "convert minutes to days", url: "/time" },
    { text: "convert 3600 seconds to hours", url: "/time" },
    { text: "calculate time difference", url: "/time" },
    { text: "time converter", url: "/time" },
    { text: "convert time", url: "/time" },
    { text: "hr to min", url: "/time" },
    { text: "min to sec", url: "/time" },
    { text: "days to hours", url: "/time" },
    { text: "weeks to months", url: "/time" },
    { text: "convert seconds to hours", url: "/time" },
    { text: "time calculator online", url: "/time" },
    { text: "time difference calculator", url: "/time" },
    { text: "duration calculator", url: "/time" },
    { text: "time unit converter", url: "/time" },
    { text: "convert minutes to hours", url: "/time" },
    { text: "time conversion table", url: "/time" },
    // ===== TEMPERATURE CONVERTER =====
    { text: "celsius to fahrenheit", url: "/temperature" },
    { text: "fahrenheit to celsius", url: "/temperature" },
    { text: "c to f converter", url: "/temperature" },
    { text: "f to c converter", url: "/temperature" },
    { text: "convert kelvin to celsius", url: "/temperature" },
    { text: "temperature conversion chart", url: "/temperature" },
    { text: "weather unit converter", url: "/temperature" },
    { text: "convert c to k", url: "/temperature" },
    { text: "convert temperature online", url: "/temperature" },
    { text: "how to convert fahrenheit to kelvin", url: "/temperature" },
    { text: "temperature converter", url: "/temperature" },
    { text: "convert temperature", url: "/temperature" },
    { text: "c to f", url: "/temperature" },
    { text: "f to c", url: "/temperature" },
    { text: "convert celsius to kelvin", url: "/temperature" },
    { text: "temperature chart", url: "/temperature" },
    { text: "weather converter", url: "/temperature" },
    { text: "fahrenheit to celsius", url: "/temperature" },
    { text: "temperature calculator", url: "/temperature" },
    { text: "temperature conversion table", url: "/temperature" },

    // ===== WEIGHT CONVERTER =====
    { text: "kg to g", url: "/weight" },
    { text: "g to kg", url: "/weight" },
    { text: "lb to kg", url: "/weight" },
    { text: "kg to lb", url: "/weight" },
    { text: "convert mg to g", url: "/weight" },
    { text: "grams to milligrams", url: "/weight" },
    { text: "pounds to kilograms", url: "/weight" },
    { text: "mass converter online", url: "/weight" },
    { text: "convert stones to kg", url: "/weight" },
    { text: "weight unit conversion", url: "/weight" },
    { text: "mass measurement tool", url: "/weight" },
    { text: "weight converter", url: "/weight" },
    { text: "convert weight", url: "/weight" },
    { text: "kg to g", url: "/weight" },
    { text: "lb to kg", url: "/weight" },
    { text: "g to mg", url: "/weight" },
    { text: "stones to kg", url: "/weight" },
    { text: "mass converter", url: "/weight" },
    { text: "convert kilograms to grams", url: "/weight" },
    { text: "weight calculator online", url: "/weight" },
    { text: "body weight converter", url: "/weight" },
    { text: "easy weight converter", url: "/weight" },

    // ===== RENT CALCULATOR =====
    {
        text: "rent affordability calculator",
        url: "/rent/calculation/calculator",
    },
    { text: "how much rent can i afford", url: "/rent/calculation/calculator" },
    { text: "monthly rent budget", url: "/rent/calculation/calculator" },
    { text: "rent calculation tool", url: "/rent/calculation/calculator" },
    { text: "flat rent calculator", url: "/rent/calculation/calculator" },
    {
        text: "affordable rent based on income",
        url: "/rent/calculation/calculator",
    },
    {
        text: "rent affordability calculator",
        url: "/rent/calculation/calculator",
    },
    { text: "how much rent can i afford", url: "/rent/calculation/calculator" },
    { text: "monthly rent budget", url: "/rent/calculation/calculator" },
    { text: "flat rent calculator", url: "/rent/calculation/calculator" },
    { text: "affordable rent calculator", url: "/rent/calculation/calculator" },
    { text: "calculate my rent limit", url: "/rent/calculation/calculator" },
    { text: "apartment rent calculator", url: "/rent/calculation/calculator" },
    { text: "budget rent calculator", url: "/rent/calculation/calculator" },
    // ===== SALARY CALCULATOR =====
    { text: "salary calculator", url: "/salary/calculation/calculator" },
    { text: "monthly to yearly salary", url: "/salary/calculation/calculator" },
    { text: "gross to net salary", url: "/salary/calculation/calculator" },
    { text: "hourly wage to monthly", url: "/salary/calculation/calculator" },
    { text: "calculate income", url: "/salary/calculation/calculator" },
    { text: "pay calculator", url: "/salary/calculation/calculator" },
    {
        text: "net salary after deductions",
        url: "/salary/calculation/calculator",
    },
    { text: "salary calculator", url: "/salary/calculation/calculator" },
    { text: "gross to net salary", url: "/salary/calculation/calculator" },
    { text: "monthly to yearly salary", url: "/salary/calculation/calculator" },
    { text: "take home pay", url: "/salary/calculation/calculator" },
    { text: "net salary calculator", url: "/salary/calculation/calculator" },
    { text: "salary tax calculator", url: "/salary/calculation/calculator" },
    { text: "calculate income", url: "/salary/calculation/calculator" },
    { text: "paycheck calculator", url: "/salary/calculation/calculator" },
    // ===== DEPRECIATION =====
    { text: "asset depreciation calculator", url: "/depreciation" },
    { text: "straight line depreciation", url: "/depreciation" },
    { text: "declining balance method", url: "/depreciation" },
    { text: "car depreciation calculator", url: "/depreciation" },
    { text: "machine depreciation value", url: "/depreciation" },
    { text: "book value calculator", url: "/depreciation" },
    { text: "depreciation calculator", url: "/depreciation" },
    { text: "asset depreciation", url: "/depreciation" },
    { text: "car depreciation calculator", url: "/depreciation" },
    { text: "book value calculator", url: "/depreciation" },
    { text: "straight line method calculator", url: "/depreciation" },
    { text: "machinery depreciation calculator", url: "/depreciation" },
    { text: "value decrease calculator", url: "/depreciation" },

    // ===== MORTGAGE =====
    { text: "mortgage calculator", url: "/mortgage" },
    { text: "loan repayment calculator", url: "/mortgage" },
    { text: "emi calculator", url: "/mortgage" },
    { text: "home loan interest", url: "/mortgage" },
    { text: "monthly mortgage payment", url: "/mortgage" },
    { text: "property loan calculator", url: "/mortgage" },
    { text: "mortgage calculator", url: "/mortgage" },
    { text: "loan repayment calculator", url: "/mortgage" },
    { text: "home loan calculator", url: "/mortgage" },
    { text: "emi calculator", url: "/mortgage" },
    { text: "property loan calculator", url: "/mortgage" },
    { text: "mortgage interest calculator", url: "/mortgage" },
    { text: "monthly payment calculator", url: "/mortgage" },

    // ===== TAX =====
    { text: "income tax calculator", url: "/income-tax" },
    { text: "fbr tax calculator 2025", url: "/income-tax" },
    { text: "salary tax calculator Australia", url: "/income-tax" },
    { text: "calculate income after tax", url: "/income-tax" },
    { text: "tax slab 2025 Australia", url: "/income-tax" },
    { text: "tax refund estimator", url: "/income-tax" },
    { text: "net salary after tax", url: "/income-tax" },
    { text: "fbr salary calculator", url: "/income-tax" },
    { text: "how to calculate tax on salary", url: "/income-tax" },
    { text: "monthly tax calculator", url: "/income-tax" },

    // ===== BMI =====
    { text: "bmi calculator", url: "/fitness/bmi-calculator" },
    { text: "check bmi online", url: "/fitness/bmi-calculator" },
    { text: "bmi chart", url: "/fitness/bmi-calculator" },
    { text: "bmi for men", url: "/fitness/bmi-calculator" },
    { text: "bmi for women", url: "/fitness/bmi-calculator" },
    { text: "bmi by height and weight", url: "/fitness/bmi-calculator" },

    // ===== BMR =====
    { text: "bmr calculator", url: "/fitness/bmr-calculator" },
    { text: "basal metabolic rate", url: "/fitness/bmr-calculator" },
    { text: "daily calorie burn", url: "/fitness/bmr-calculator" },
    { text: "resting calories calculator", url: "/fitness/bmr-calculator" },
    { text: "bmr calculator for men", url: "/fitness/bmr-calculator" },
    { text: "bmr calculator for women", url: "/fitness/bmr-calculator" },

    // ===== TDEE =====
    { text: "tdee calculator", url: "/fitness/tdee-calculator" },
    { text: "total daily energy expenditure", url: "/fitness/tdee-calculator" },
    { text: "daily calories needed", url: "/fitness/tdee-calculator" },
    {
        text: "how many calories to maintain weight",
        url: "/fitness/tdee-calculator",
    },

    // ===== IDEAL WEIGHT =====
    {
        text: "ideal weight calculator",
        url: "/fitness/ideal-weight-calculator",
    },
    {
        text: "healthy weight for height",
        url: "/fitness/ideal-weight-calculator",
    },
    {
        text: "perfect weight calculator",
        url: "/fitness/ideal-weight-calculator",
    },
    { text: "weight goal calculator", url: "/fitness/ideal-weight-calculator" },

    // ===== BODY FAT =====
    { text: "body fat calculator", url: "/fitness/body-fat-calculator" },
    { text: "fat percentage calculator", url: "/fitness/body-fat-calculator" },
    { text: "lean body mass", url: "/fitness/body-fat-calculator" },
    { text: "body fat level", url: "/fitness/body-fat-calculator" },
    { text: "calculate fat ratio", url: "/fitness/body-fat-calculator" },

    // ===== AGE CALCULATOR =====
    { text: "age calculator", url: "/agecalculator" },
    { text: "age in years months days", url: "/agecalculator" },
    { text: "date of birth to age", url: "/agecalculator" },
    { text: "find my age today", url: "/agecalculator" },
    { text: "calculate age from dob", url: "/agecalculator" },
    { text: "what is my age", url: "/agecalculator" },
    { text: "birthday to age converter", url: "/agecalculator" },
    { text: "online age calculator", url: "/agecalculator" },
    { text: "current age finder", url: "/agecalculator" },
    { text: "how to know my age", url: "/agecalculator" },
    { text: "date difference age calculator", url: "/agecalculator" },
    { text: "calculate age from birthdate", url: "/agecalculator" },
    { text: "how many years old am i", url: "/agecalculator" },
    { text: "age gap calculator", url: "/agecalculator" },
    { text: "year month day age calculator", url: "/agecalculator" },
    { text: "age calculator by date of birth", url: "/agecalculator" },
    { text: "my birthday age calculator", url: "/agecalculator" },
    { text: "accurate age finder", url: "/agecalculator" },
    { text: "tax calculator", url: "/income-tax" },
    { text: "income tax calculator", url: "/income-tax" },
    { text: "fbr tax calculator", url: "/income-tax" },
    { text: "salary tax calculator", url: "/income-tax" },
    { text: "Australia income tax", url: "/income-tax" },
    { text: "calculate income after tax", url: "/income-tax" },
    { text: "yearly tax calculator", url: "/income-tax" },
    { text: "tax on salary Australia", url: "/income-tax" },
    { text: "income after tax", url: "/income-tax" },

    // ===== BMI CALCULATOR =====
    { text: "bmi calculator", url: "/fitness/bmi-calculator" },
    { text: "body mass index calculator", url: "/fitness/bmi-calculator" },
    { text: "bmi chart", url: "/fitness/bmi-calculator" },
    { text: "check bmi online", url: "/fitness/bmi-calculator" },
    { text: "healthy weight calculator", url: "/fitness/bmi-calculator" },
    { text: "bmi calculator for men", url: "/fitness/bmi-calculator" },
    { text: "bmi calculator for women", url: "/fitness/bmi-calculator" },

    // ===== BMR CALCULATOR =====
    { text: "bmr calculator", url: "/fitness/bmr-calculator" },
    { text: "calculate bmr", url: "/fitness/bmr-calculator" },
    { text: "basal metabolic rate calculator", url: "/fitness/bmr-calculator" },
    { text: "resting calories calculator", url: "/fitness/bmr-calculator" },
    { text: "body metabolism calculator", url: "/fitness/bmr-calculator" },

    // ===== TDEE CALCULATOR =====
    { text: "tdee calculator", url: "/fitness/tdee-calculator" },
    { text: "total daily energy expenditure", url: "/fitness/tdee-calculator" },
    { text: "daily calorie needs calculator", url: "/fitness/tdee-calculator" },
    {
        text: "maintenance calories calculator",
        url: "/fitness/tdee-calculator",
    },
    { text: "how many calories i burn", url: "/fitness/tdee-calculator" },

    // ===== IDEAL WEIGHT CALCULATOR =====
    {
        text: "ideal weight calculator",
        url: "/fitness/ideal-weight-calculator",
    },
    {
        text: "perfect weight calculator",
        url: "/fitness/ideal-weight-calculator",
    },
    {
        text: "healthy weight calculator",
        url: "/fitness/ideal-weight-calculator",
    },
    { text: "weight goal calculator", url: "/fitness/ideal-weight-calculator" },
    {
        text: "ideal body weight calculator",
        url: "/fitness/ideal-weight-calculator",
    },

    // ===== BODY FAT CALCULATOR =====
    { text: "body fat calculator", url: "/fitness/body-fat-calculator" },
    {
        text: "body fat percentage calculator",
        url: "/fitness/body-fat-calculator",
    },
    { text: "lean body mass calculator", url: "/fitness/body-fat-calculator" },
    { text: "fat ratio calculator", url: "/fitness/body-fat-calculator" },
    {
        text: "body composition calculator",
        url: "/fitness/body-fat-calculator",
    },

    // ===== AGE CALCULATOR =====
    { text: "how old am i", url: "/agecalculator" },
    { text: "age from date of birth", url: "/agecalculator" },
    { text: "calculate age in years", url: "/agecalculator" },
    { text: "birthday age calculator", url: "/agecalculator" },
    { text: "date to age converter", url: "/agecalculator" },
    { text: "find my age", url: "/agecalculator" },
    { text: "current age calculator", url: "/agecalculator" },
    { text: "online age calculator", url: "/agecalculator" },
];

$(".sea").on("input change keyup", function () {
    const $input = $(this);
    const query = $input.val().trim().toLowerCase();
    const $wrapper = $input.closest("#testing, #testing2");
    const $box = $wrapper.find(".suggestion");

    $box.empty();
    if (query.length < 1) {
        $box.addClass("hidden");
        return;
    }

    const matched = suggestions.filter((item) =>
        item.text.trim().toLowerCase().includes(query)
    );

    if (matched.length > 0) {
        matched.forEach((item) => {
            $box.append(`
        <li 
          class="px-4 rounded-lg py-2 hover:bg-emerald-100 dark:hover:bg-emerald-900/30 
                 cursor-pointer text-gray-800 dark:text-gray-900 transition-colors duration-150"
          data-url="${item.url}"
        >
          ${item.text}
        </li>
      `);
        });
        $box.removeClass("hidden");
    }
});

$(document).on("click", ".suggestion li", function (e) {
    e.preventDefault(); // stop link behavior if any
    e.stopPropagation(); // stop bubbling if other click handlers exist

    const url = $(this).data("url");
    console.log(url);
    window.location.href = url;
});

$(document).on("click", function (e) {
    if (!$(e.target).closest(".suggestion").length) {
        $(".suggestion").addClass("hidden");
    }
});

let $backdrop, $newSearchBox;

$("#browse-cal").on("click", function (e) {
    e.preventDefault();
    if (!$backdrop) {
        $backdrop = $(
            '<div class="fixed inset-0 bg-black/40 backdrop-blur-md z-[60]"></div>'
        );
        $("body").append($backdrop);
        $("body").css("overflow", "hidden");
    }
    $("#testing2").removeClass("hidden").addClass("block");
    $("#testing2").find("input").focus();
});

// close handler for popup
function closeSearch() {
    $("#testing2").removeClass("block").addClass("hidden");
    $("#testing2").find("input").val("");
    $("#testing2").find(".suggestion").addClass("hidden").empty();

    if ($backdrop) {
        $backdrop.remove();
        $backdrop = null;
        $("body").css("overflow", "");
    }
    if ($newSearchBox) {
        $newSearchBox.remove();
        $newSearchBox = null;
    }
}

$(".close-x").on("click", closeSearch);
$(document).on("click", function (e) {
    const $target = $(e.target);
    const isInsideTesting2 = $target.closest("#testing2").length;
    const isInsideBrowseCal = $target.closest("#browse-cal").length;
    const isVisible = $("#testing2").hasClass("block");

    if (!isInsideTesting2 && !isInsideBrowseCal && isVisible) {
        closeSearch();
    }
});

$(".sea").on("input", function () {
    const query = $(this).val().trim();
    if (query.length < 3) return;

    $.ajax({
        url: "/ai-suggest",
        method: "GET",
        data: { q: query },
        success: function (res) {
            console.log(res);
        },
    });
});

$(document).on("click", "#suggestionBox li", function () {
    window.location.href = $(this).data("url");
});
