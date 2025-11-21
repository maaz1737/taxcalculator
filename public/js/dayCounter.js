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
     Not icluded last day ${days[lastd.getDay()]} , ${lastd.getDate()} ${
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

$("#btnCalculateDays").on("click", function () {
  let data = calculateDays();
  $.ajax({
    type: "POST",
    url: window.dayCalculatorUrl,
    data: data,
    success: function (response) {
      console.log("Success:", response);
      showResult(response);
    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
    },
  });
});
