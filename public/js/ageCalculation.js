$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#openHistory").on("click", function () {
        $.ajax({
            url: window.ageHistoryUrl,
            method: "GET",
            success: function (response) {
                let $historyList = $("#historyList");
                $historyList.empty();
                if (response.history.length === 0) {
                    $historyList.append(
                        '<li class="text-gray-500 dark:text-gray-400">No history available.</li>'
                    );
                } else {
                    $.each(response.history, function (index, item) {
                        let date = new Date(item.created_at);
                        $historyList.append(
                            '<li class="p-3 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800">' +
                                '<div><span class="font-semibold text-gray-900 dark:text-white">Age:</span> ' +
                                Math.floor(item.years) +
                                " years, " +
                                item.months +
                                " months, " +
                                item.days +
                                " days</div>" +
                                '<div class="text-xs text-gray-500 dark:text-gray-400">Calculated on: ' +
                                date.toLocaleDateString("en-US") +
                                "</div>" +
                                "</li>"
                        );
                    });
                }
                $("#historySheet").removeClass(
                    "translate-y-full opacity-0 pointer-events-none"
                );
            },
            error: function (xhr) {
                console.log("Error fetching history:", xhr);
            },
        });
    });
});

$(document).ready(function () {
    $("#btnCalculateAge").on("click", function () {
        let dobMonth = $("#dobMonth").val();
        let dobDay = $("#dobDay").val();
        let dobYear = $("#dobYear").val();
        let tillMonth = $("#tillMonth").val();
        let tillDay = $("#tillDay").val();
        let tillYear = $("#tillYear").val();
        let $errorBox = $("#errorAge");
        let $resultAge = $("#resultAge");
        let $resultSubAge = $("#resultSubAge");
        let $SeprateAgeCalculation = $("#SeprateAgeCalculation");
        let $btnCalculateAge = $("#btnCalculateAge");
        let $btnContainer = $(".btn-container");
        let $reset = $("#reset");
        let results = {};

        const btn = $(this);

        btn.prop("disabled", true); // disable button

        setTimeout(() => {
            btn.prop("disabled", false); // enable button
        }, 2000);

        function showResult(response) {
            $resultAge.text(
                (Math.floor(response.result.years) || 0) +
                    " years, " +
                    response.result.months +
                    " months"
            );
            $resultSubAge.text(response.result.days + " days");
            const years = Math.floor(response.result.years);
            const months = Math.floor(response.result.months);
            const days = Math.floor(response.result.days);

            const totalMonths = Math.floor(response.result.total_months);
            const monthsRemaining = Math.floor(
                response.result.months_remaining
            );

            const totalWeeks = Math.floor(response.result.total_weeks);
            const weeksRemaining = Math.floor(response.result.weeks_remaining);

            const totalDays = Math.floor(response.result.total_days);
            const totalHours = Math.floor(response.result.total_hours);
            const totalMinutes = Math.floor(response.result.total_minutes);
            const totalSeconds = Math.floor(response.result.total_seconds);

            // BEAUTIFUL DESIGN OUTPUT
            const html = `
        <div class="">
            <div class="">

                <div class="">
                    <b>Total Months:</b>
                    ${totalMonths} Months ${
                monthsRemaining > 0 ? monthsRemaining + " Days" : ""
            }
                </div>

                <div class="">
                    <b>Total Weeks:</b>
                    ${totalWeeks} Weeks ${
                weeksRemaining > 0 ? weeksRemaining + " Days" : ""
            }
                </div>

                <div class="">
                    <b>Total Days:</b>
                    ${totalDays} Days
                </div>

                <div class="">
                    <b>Total Hours:</b>
                    ${totalHours} Hours
                </div>

                <div class="">
                    <b>Total Minutes:</b>
                    ${totalMinutes} Minutes
                </div>

                <div class="">
                    <b>Total Seconds:</b>
                    ${totalSeconds} Seconds
                </div>

            </div>
        </div>
    `;

            $SeprateAgeCalculation.html(html);
            $btnCalculateAge.addClass("hidden");

            // Create and append Save Result button
            let $button = $("<button>")
                .text("Save Result")
                .addClass(
                    "w-full save-age flex items-center w-[30%] sm:w-[20%] lg:w-[15%] justify-center gap-2 rounded-xl bg-teal-600 px-4 py-2 text-white text-sm font-medium hover:bg-teal-700 transition"
                );
            $btnContainer.prepend($button);
        }

        function showError(errors, errorMessages) {
            $.each(errors, function (key, value) {
                errorMessages.push(value[0]);
            });
            $errorBox.html(errorMessages.join("<br>")).removeClass("hidden");
            $resultAge.text("—");
            $resultSubAge.text("");
        }

        function reset() {
            $("#dobMonth").val("");
            $("#dobDay").val("");
            $("#dobYear").val("");
            $("#tillMonth").val("");
            $("#tillDay").val("");
            $("#tillYear").val("");
            $resultAge.text("—");
            $resultSubAge.text("");
        }
        $reset.on("click", function () {
            reset();
            btnToggle();
        });

        $.ajax({
            url: window.ageCalculateUrl,
            method: "POST",
            data: {
                dob_month: dobMonth,
                dob_day: dobDay,
                dob_year: dobYear,
                till_month: tillMonth,
                till_day: tillDay,
                till_year: tillYear,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                $errorBox.addClass("hidden");
                results = {
                    ...response.result,
                };
                console.log(results);
                showResult(response);
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = [];
                showError(errors, errorMessages);
                console.log(xhr);
            },
        });

        function btnToggle() {
            $(".save-age").hide().remove();
            $btnCalculateAge.removeClass("hidden").addClass("block");
        }
        $("input, select").on("input change", function () {
            btnToggle();
        });

        $(document).on("click", ".save-age", function () {
            $.ajax({
                url: window.ageSaveUrl,
                method: "POST",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify(results),
                success: function (response) {
                    btnToggle();
                    $errorBox
                        .html("Result saved successfully!")
                        .removeClass("hidden");

                    setTimeout(() => {
                        $errorBox.addClass("hidden").html("");
                    }, 2000);
                },
                error: function (xhr) {
                    console.log(xhr);
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = [];
                    showError(errorMessages);
                },
            });
        });
        yearsList;
    });
});

$("#dobYear,#tillYear").on("input focus", function () {
    let currentYear = new Date().getFullYear();
    $(this).closest("div").find("datalist").empty();
    for (let y = currentYear; y >= 1900; y--) {
        $(this)
            .closest("div")
            .find("datalist")
            .addClass("block")
            .append(`<option value="${y}">${y}</option>`);
    }
});
$("datalist").on("click", "option", function () {
    $(this).closest("div").find("input").val($(this).val());
    $(this).closest("div").find("datalist").removeClass("block").empty();
});

$(document).on("click", function (e) {
    if (!$(e.target).closest("#dobYear").length) {
        $("#yearsList").removeClass("block").empty();
    }
    if (!$(e.target).closest("#tillYear").length) {
        $("#yearsList2").removeClass("block").empty();
    }
});

function dobForm() {
    let month = $("#dobMonth").val();
    let day = $("#dobDay").val();
    let year = $("#dobYear").val() || new Date().getFullYear();
    if (!month) return;

    let daysInMonth = new Date(year, month, 0).getDate();
    let $dayInput = $("#dobDay").empty();
    $dayInput.attr("max", daysInMonth);
    for (let d = 1; d <= daysInMonth; d++) {
        if (d == day) {
            $dayInput.append(`<option value="${d}" selected>${d}</option>`);
        } else {
            $dayInput.append(`<option value="${d}">${d}</option>`);
        }
    }
}
dobForm();
$("#dobMonth, #dobYear,#dobDay").on("input change click", dobForm);

function tillForm() {
    let month = $("#tillMonth").val();
    let day = $("#tillDay").val();
    let year = $("#tillYear").val() || new Date().getFullYear();
    if (!month) return;
    let daysInMonth = new Date(year, month, 0).getDate();
    let $dayInput = $("#tillDay").empty();
    $dayInput.attr("max", daysInMonth);
    let $datalist = $dayInput.closest("div").find("datalist");
    $datalist.empty().addClass("block");
    for (let d = 1; d <= daysInMonth; d++) {
        if (d == day) {
            $dayInput.append(`<option value="${d}" selected>${d}</option>`);
        } else {
            $dayInput.append(`<option value="${d}">${d}</option>`);
        }
    }
}
tillForm();
$("#tillYear, #tillMonth,#tillDay").on("input change click", tillForm);
