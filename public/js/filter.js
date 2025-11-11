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
    { text: "CM To KM", url: "/length-converter" },
    { text: "Convert CM Into KM", url: "/length-converter" },
    { text: "How To Convert METER To CENTIMETER", url: "/length-converter" },
    { text: "M To CM", url: "/length-converter" },
    { text: "CM To M", url: "/length-converter" },
    { text: "MM To CM", url: "/length-converter" },
    { text: "CM To MM", url: "/length-converter" },
    { text: "INCH To CM", url: "/length-converter" },
    { text: "CM To INCH", url: "/length-converter" },
    { text: "FEET To METER", url: "/length-converter" },
    { text: "METER To FEET", url: "/length-converter" },
    { text: "YARD To METER", url: "/length-converter" },
    { text: "MILE To KM", url: "/length-converter" },
    { text: "KM To MILE", url: "/length-converter" },
    { text: "Convert INCHES Into METERS", url: "/length-converter" },
    { text: "Length Converter Online", url: "/length-converter" },
    { text: "Convert Distance Online", url: "/length-converter" },
    { text: "Length Unit Converter", url: "/length-converter" },
    { text: "How Many CM In 1 METER", url: "/length-converter" },
    { text: "Distance Measurement Calculator", url: "/length-converter" },
    { text: "Length Conversion Chart", url: "/length-converter" },
    { text: "1 KM Equals How Many Meters", url: "/length-converter" },
    { text: "Online METER Converter", url: "/length-converter" },
    { text: "Convert 100 CM To METER", url: "/length-converter" },
    { text: "Conversion Of FEET To YARD", url: "/length-converter" },
    { text: "Convert INCHES To FEET", url: "/length-converter" },
    { text: "Convert YARD To FEET", url: "/length-converter" },
    { text: "Length Converter Tool", url: "/length-converter" },
    { text: "Convert MILES To KM Online", url: "/length-converter" },
    { text: "Length Converter", url: "/length-converter" },
    { text: "Convert Length", url: "/length-converter" },
    { text: "M To KM", url: "/length-converter" },
    { text: "Length Calculator", url: "/length-converter" },
    { text: "Length Conversion Tool", url: "/length-converter" },
    { text: "Unit Converter Length", url: "/length-converter" },
    { text: "Online Length Calculator", url: "/length-converter" },
    { text: "Convert Meters To Centimeters", url: "/length-converter" },
    { text: "Convert Kilometers To Meters", url: "/length-converter" },
    { text: "How To Convert INCHES To CM", url: "/length-converter" },
    { text: "Easy Length Converter", url: "/length-converter" },
    { text: "Length Measure Calculator", url: "/length-converter" },
    { text: "Find Length Conversion", url: "/length-converter" },
    { text: "Fast Length Converter", url: "/length-converter" },

    // ===== AREA CONVERTER =====
    { text: "SQ FT TO M²", url: "/area" },
    { text: "CONVERT SQ FT INTO SQ METER", url: "/area" },
    { text: "HOW TO CALCULATE AREA IN SQUARE FEET", url: "/area" },
    { text: "ACRE TO KANAL", url: "/area" },
    { text: "KANAL TO MARLA", url: "/area" },
    { text: "MARLA TO SQ FT", url: "/area" },
    { text: "PLOT SIZE CONVERTER", url: "/area" },
    { text: "LAND AREA CONVERTER AUSTRALIA", url: "/area" },
    { text: "CONVERT HECTARE TO ACRE", url: "/area" },
    { text: "AREA CALCULATOR FOR LAND", url: "/area" },
    { text: "CONVERT SQUARE METER TO ACRE", url: "/area" },
    { text: "SQ YARD TO M²", url: "/area" },
    { text: "SQ FT TO MARLA", url: "/area" },
    { text: "CONVERT PLOT AREA", url: "/area" },
    { text: "AREA CONVERSION CHART", url: "/area" },
    { text: "LAND SIZE CALCULATOR", url: "/area" },
    { text: "PROPERTY AREA CONVERTER", url: "/area" },
    { text: "PLOT MEASUREMENT CONVERTER", url: "/area" },
    { text: "CALCULATE MARLA TO SQUARE FEET", url: "/area" },
    { text: "HOW MANY MARLA IN ONE KANAL", url: "/area" },
    { text: "CONVERT HECTARE TO SQUARE METER", url: "/area" },
    { text: "AREA CONVERTER", url: "/area" },
    { text: "CONVERT AREA", url: "/area" },
    { text: "PLOT SIZE CALCULATOR", url: "/area" },
    { text: "LAND CONVERTER", url: "/area" },
    { text: "AREA UNIT CONVERTER", url: "/area" },
    { text: "AREA CALCULATOR ONLINE", url: "/area" },
    { text: "CONVERT ACRES TO SQUARE FEET", url: "/area" },
    { text: "CONVERT HECTARES TO ACRES", url: "/area" },
    { text: "SQ FT TO ACRES CALCULATOR", url: "/area" },
    { text: "LAND MEASUREMENT CONVERTER", url: "/area" },
    { text: "EASY AREA CONVERTER", url: "/area" },

    // ===== VOLUME CONVERTER =====
    { text: "LITRE TO ML", url: "/volume" },
    { text: "ML TO LITRE", url: "/volume" },
    { text: "CONVERT GALLON TO LITRE", url: "/volume" },
    { text: "VOLUME CONVERTER ONLINE", url: "/volume" },
    { text: "CONVERT CUBIC METER TO LITRE", url: "/volume" },
    { text: "CM³ TO M³", url: "/volume" },
    { text: "CONVERT LITRE TO GALLON", url: "/volume" },
    { text: "LIQUID VOLUME CALCULATOR", url: "/volume" },
    { text: "CONVERT LITRES TO ML ONLINE", url: "/volume" },
    { text: "VOLUME UNIT CONVERTER", url: "/volume" },
    { text: "CONVERT 1 GALLON TO LITRE", url: "/volume" },
    { text: "M3 TO LITRE CONVERTER", url: "/volume" },
    { text: "VOLUME CALCULATOR TOOL", url: "/volume" },
    { text: "FLUID VOLUME CONVERTER", url: "/volume" },
    { text: "CONVERT CUBIC CM TO ML", url: "/volume" },
    { text: "VOLUME CONVERTER", url: "/volume" },
    { text: "CONVERT VOLUME", url: "/volume" },
    { text: "GALLON TO LITRE", url: "/volume" },
    { text: "M³ TO LITRE", url: "/volume" },
    { text: "FLUID CONVERTER", url: "/volume" },
    { text: "CUBIC METER TO LITRE", url: "/volume" },
    { text: "VOLUME CALCULATOR", url: "/volume" },
    { text: "ONLINE VOLUME CONVERTER", url: "/volume" },
    { text: "VOLUME CONVERSION CHART", url: "/volume" },
    { text: "CONVERT LITRES TO MILLILITRES", url: "/volume" },
    { text: "FIND VOLUME CONVERSION", url: "/volume" },
    { text: "VOLUME MEASUREMENT CALCULATOR", url: "/volume" },

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
    { text: "CONVERT YEARS TO DAYS", url: "/time" },
    { text: "CALCULATE TIME IN SECONDS", url: "/time" },
    { text: "CALCULATE HOURS FROM SECONDS", url: "/time" },
    { text: "CONVERT 24 HOURS TO MINUTES", url: "/time" },
    { text: "CONVERT 7 DAYS TO HOURS", url: "/time" },
    { text: "CONVERT 1 WEEK TO DAYS", url: "/time" },
    { text: "CONVERT 12 MONTHS TO DAYS", url: "/time" },
    { text: "ONLINE HOURS MINUTES CALCULATOR", url: "/time" },
    { text: "TIME FORMAT CONVERTER", url: "/time" },
    { text: "CONVERT 12 HOUR TO 24 HOUR", url: "/time" },
    { text: "CONVERT 24 HOUR TO 12 HOUR", url: "/time" },
    { text: "TIME ZONE CONVERTER", url: "/time" },
    { text: "WORLD CLOCK CONVERSION", url: "/time" },
    { text: "CALCULATE DURATION BETWEEN TWO TIMES", url: "/time" },
    { text: "TIME PERIOD CALCULATOR", url: "/time" },
    { text: "DATE AND TIME CONVERTER", url: "/time" },
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
    // ===== AGE CALCULATOR =====
    { text: "age calculator", url: "/age-calculator" },
    { text: "age in years months days", url: "/age-calculator" },
    { text: "date of birth to age", url: "/age-calculator" },
    { text: "find my age today", url: "/age-calculator" },
    { text: "calculate age from dob", url: "/age-calculator" },
    { text: "what is my age", url: "/age-calculator" },
    { text: "birthday to age converter", url: "/age-calculator" },
    { text: "online age calculator", url: "/age-calculator" },
    { text: "current age finder", url: "/age-calculator" },
    { text: "how to know my age", url: "/age-calculator" },
    { text: "date difference age calculator", url: "/age-calculator" },
    { text: "calculate age from birthdate", url: "/age-calculator" },
    { text: "how many years old am i", url: "/age-calculator" },
    { text: "age gap calculator", url: "/age-calculator" },
    { text: "year month day age calculator", url: "/age-calculator" },
    { text: "age calculator by date of birth", url: "/age-calculator" },
    { text: "my birthday age calculator", url: "/age-calculator" },
    { text: "accurate age finder", url: "/age-calculator" },
    { text: "Tax Calculator", url: "/income-tax-calculator" },
    { text: "income Tax calculator", url: "/income-tax-calculator" },
    { text: "fbr tax calculator", url: "/income-tax-calculator" },
    { text: "salary tax calculator", url: "/income-tax-calculator" },
    { text: "Australia income tax", url: "/income-tax-calculator" },
    { text: "calculate income after tax", url: "/income-tax-calculator" },
    { text: "yearly tax calculator", url: "/income-tax-calculator" },
    { text: "tax on salary Australia", url: "/income-tax-calculator" },
    { text: "income after tax", url: "/income-tax-calculator" },
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
    { text: "income tax calculator", url: "/income-tax-calculator" },
    { text: "fbr tax calculator 2025", url: "/income-tax-calculator" },
    { text: "salary tax calculator Australia", url: "/income-tax-calculator" },
    { text: "calculate income after tax", url: "/income-tax-calculator" },
    { text: "tax slab 2025 Australia", url: "/income-tax-calculator" },
    { text: "tax refund estimator", url: "/income-tax-calculator" },
    { text: "net salary after tax", url: "/income-tax-calculator" },
    { text: "fbr salary calculator", url: "/income-tax-calculator" },
    { text: "how to calculate tax on salary", url: "/income-tax-calculator" },
    { text: "monthly tax calculator", url: "/income-tax-calculator" },

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
