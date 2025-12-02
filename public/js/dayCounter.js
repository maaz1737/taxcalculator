$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

let startDay = $("#startDay");
let startMonth = $("#startMonth");
let startYear = $("#startYear");
let $endDay = $("#endDay");
let $endMonth = $("#endMonth");
let $endYear = $("#endYear");
let $includeLast = $("#includeLast");
let daySelectContainer = $(".day-select-container");
let resetCounter = $("#resetCounter");
let results = {};
console.log($includeLast);
function resetCounterfn() {
    startDay.val("");
    startMonth.val("1");
    startYear.val("");
    $endDay.val("");
    $endMonth.val("1");
    $endYear.val("");
    $includeLast[0].checked = false;
}

resetCounter.on("click", resetCounterfn);

function showError(message) {
    $("#errorCounter").removeClass("hidden").addClass("block");
    $("#errorCounter").text(message);
    setTimeout(() => {
        $("#errorCounter").text("");
        $("#errorCounter").addClass("hidden").addClass("hidden");
    }, 2000);
}

function createDays() {
    let $div = $("<div></div>").addClass(
        "absolute z-[15] top-8 left-0 w-full h-full grid grid-cols-4 gap-1 p-2"
    );
    let options = "";
    for (let i = 1; i <= 31; i++) {
        options += `<button class="col-span-1 py-1 bg-white rounded shadow" value="${i}">${i}</button>`;
    }
    $div.html(options);
    $(this).closest(daySelectContainer).append($div);
}

startDay.on("input focus", createDays);
$endDay.on("input focus", createDays);
startDay.on("change", function () {
    toggleBtnAfterSave();
});
$endDay.on("change", function () {
    toggleBtnAfterSave();
});
$("input,select").on("input change", function () {
    console.log("testing");
    toggleBtnAfterSave();
});

$(document).on("click", ".day-select-container button", function () {
    let value = $(this).text();
    let $container = $(this).closest(daySelectContainer);
    $container.find("input").val(value);
    $container.find("div").remove();
});

$(document).on("click", function (e) {
    const $target = $(e.target);
    const $clickedContainer = $target.closest(".day-select-container");
    if ($clickedContainer.length) {
        $(".day-select-container").not($clickedContainer).find("div").remove();
    } else {
        $(".day-select-container div").remove();
    }
});

function calculateDays() {
    const startDate =
        $("#startYear").val() +
        "-" +
        $("#startMonth").val().padStart(2, "0") +
        "-" +
        $("#startDay").val().padStart(2, "0");

    const endDate =
        $("#endYear").val() +
        "-" +
        $("#endMonth").val().padStart(2, "0") +
        "-" +
        $("#endDay").val().padStart(2, "0");

    const includeLast = $("#includeLast")[0].checked;

    return {
        startDate: startDate,
        endDate: endDate,
        includeLast: includeLast,
    };
}

const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];

const days = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
];

function showResult(result) {
    const d = new Date(result.all_dates[0]);
    const lastd = new Date(result.all_dates[result.all_dates.length - 1]);

    $("#startFrom").removeClass("hidden");
    $("#endFrom").removeClass("hidden");

    $("#startFrom").html(`
    <div>
        From and including ${days[d.getDay()]} , ${d.getDate()} ${
        months[d.getMonth()]
    } ${d.getFullYear()}
    </div>
`);

    if (result.last_day_include) {
        $("#endFrom").html(`
    <div>
     including last date ${days[lastd.getDay()]} , ${lastd.getDate()} ${
            months[lastd.getMonth()]
        } ${lastd.getFullYear()}
    </div>
`);
    } else {
        $("#endFrom").html(`
    <div>
     Not included last day ${days[lastd.getDay()]} , ${lastd.getDate()} ${
            months[lastd.getMonth()]
        } ${lastd.getFullYear()}
    </div>
`);
    }

    $("#resultTotalDays").text(result.days);
    let breakdownText = `<div>${result.weeks} <b>weeks</b></div>
    <div>${result.hours} <b>hours</b></div>
    <div>${result.minutes} <b>minutes</b></div>
    <div>${result.seconds} <b>seconds</b></div>`;
    $("#resultSubDays").html(breakdownText);
    $("#totalDays").html(result.totalDays);
}

function toggleBtn() {
    $("#btnCalculateDays").addClass("hidden");
    let button = $("<button></button>");
    button.addClass(
        "save w-full flex items-center w-[30%] sm:w-[20%] lg:w-[15%] justify-center gap-2 rounded-xl bg-teal-600 px-4 py-2 text-white text-sm font-medium hover:bg-teal-700 transition"
    );
    button.text("Save");
    $(".btn-container").prepend(button);
}

function toggleBtnAfterSave() {
    $("#btnCalculateDays").prop("disabled", false).removeClass("hidden");
    $(".save").hide().remove();
}

$("#btnCalculateDays").on("click", function () {
    $(this).prop("disabled", true);
    toggleBtn();
    let data = calculateDays();
    $.ajax({
        type: "POST",
        url: window.dayCalculatorUrl,
        data: data,
        success: function (response) {
            console.log("Success:", response);
            showResult(response);
            results = {
                days: response.days,
                last_day_include: response.last_day_include,
                startDay: response.all_dates[0],
                endDate: response.all_dates[response.all_dates.length - 1],
            };
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        },
    });
});

$(document).on("click", ".save", function () {
    $(this).prop("disabled", true);
    $.ajax({
        type: "POST",
        url: window.SaveUrl,
        data: results,
        success: function (res) {
            showError(res.message);
        },
        error: function (xhr) {
            showError(xhr.responseJSON.message);
        },
        complete: function () {
            toggleBtnAfterSave();
        },
    });
});

function showHistory(data) {
    const list = $("#historyListCounter");
    list.empty(); // Clear old items

    data.forEach((item, index) => {
        list.append(`
            <li class="p-3 border border-gray-300 rounded-md">
                <div><strong>#${index + 1}</strong></div>
                <div><strong>Start:</strong> ${item.start_date}</div>
                <div><strong>End:</strong> ${item.end_date}</div>
                <div><strong>Total Days:</strong> ${item.total_days}</div>
                <div><strong>Last Day Included:</strong> ${
                    item.last_day_included
                }</div>
              
            </li>
        `);
    });
}

function loadHistory(HistoryUrl) {
    $.ajax({
        type: "GET",
        url: HistoryUrl,
        data: {
            perpage: 5,
        },
        success: function (res) {
            console.log(res.data);
            showHistory(res.data.data);
            showpages(res.data.links);
        },
        error: function (xhr) {
            console.log(xhr);
        },
    });
}

$("#openHistory").on("click", function () {
    loadHistory(window.HistoryUrl);
});

function showpages(links) {
    $paginationCounter = $("#paginationCounter");

    $paginationCounter.empty();

    if (links.length <= 3) {
        return 0;
    }

    links.forEach((link, i) => {
        let label = link.label ?? String(i + 1);
        if (i === 0) label = "«";
        else if (i === links.length - 1) label = "»";
        else {
            label = $("<span>").html(label).text().trim();
        }

        const $a = $("<a>", {
            text: label,
            href: link.url || "#",
            target: "_self",
            "aria-label": label,
        }).addClass(
            "inline-flex mx-1 items-center justify-center min-w-8 h-8 px-2 rounded-md text-sm " +
                "text-gray-700 dark:text-gray-200 hover:bg-gray-900 hover:text-white"
        );

        if (link.active) {
            $a.addClass(
                "bg-gray-900 text-white dark:bg-white dark:text-gray-900"
            );
        }

        if (!link.url) {
            $a.removeAttr("href")
                .addClass("opacity-50 cursor-not-allowed")
                .attr("aria-disabled", "true");
        } else {
            $a.on("click", (e) => {
                e.preventDefault();
                loadHistory(link.url);
            });
        }

        $paginationCounter.append($a);
    });
}
