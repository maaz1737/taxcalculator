<x-app
    :title="'Age Calculator – Calculate Your Exact Age in Years, Months, and Days | online calculator'"
    :des="'online Age Calculator helps you find your exact age in years, months, and days by entering your date of birth and the date to calculate till.'"
    :key="'age calculator, date of birth calculator, age finder, online calculator'" />

<div class="min-h-screen bg-emerald-50 dark:bg-slate-900 py-10">
    <div class="container mx-auto max-w-5xl px-4">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-violet-100 text-violet-700 dark:bg-violet-900/30 dark:text-violet-300">🎂</div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Age Calculator</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Find your exact age in years, months, and days.</p>
                </div>
            </div>
            <span class="hidden sm:block text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </div>

        {{-- Error Banner --}}
        <div id="errorAge"
            class="hidden mb-4 rounded-xl border border-red-200/70 bg-red-50 text-red-700 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-200 px-3 py-2">
        </div>
        {{-- Inputs --}}
        <div class="relative rounded-2xl border border-yellow-200 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800 hover:shadow-[0_4px_12px_rgba(250,204,21,0.25)] 
dark:hover:shadow-[0_4px_12px_rgba(56,189,248,0.25)]

 shadow-sm px-5 pt-5 pb-3">
            <div class="grid grid-cols-1 sm:grid-cols-1 gap-3">

                {{-- DOB --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date of Birth</label>
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <select id="dobMonth"
                                class="rounded-xl w-full border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                            text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="relative col-span-1">
                            <select id="dobDay" type="text" placeholder="Day" min="1" max="31"
                                class="rounded-xl w-full search border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                            text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40 max-h-[40vh]"> </select>
                        </div>
                        <div class="relative col-span-1">
                            <input id="dobYear" type="text" placeholder="Year" min="1900"
                                class="rounded-xl search w-[100%] border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                            text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                            <datalist class="test absolute max-h-[50vh] bg-white overflow-y-auto text-black z-[10] " id="yearsList"></datalist>
                        </div>

                    </div>
                </div>

                {{-- Till Date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Age at date</label>
                    <div class="grid grid-cols-3 gap-2">
                        <div class="col-span-1">
                            <select id="tillMonth"
                                class="rounded-xl w-full border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                            text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">

                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="relative col-span-1">
                            <select id="tillDay" type="text" placeholder="Day" min="1" max="31"
                                class="rounded-xl border w-full search border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                            text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40"></select>
                            <datalist id="tillDay_days" class="test bg-white max-h-[40vh] left-2 overflow-y-auto absolute z-[20] w-[20%] text-center"></datalist>
                        </div>

                        <div class="relative col-span-1">
                            <input id="tillYear" type="text" placeholder="Year" min="1900"
                                class="rounded-xl w-[100%] search border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                            text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                            <datalist class="test absolute max-h-[50vh] bg-white overflow-y-auto text-black z-[10] " id="yearsList2"></datalist>
                        </div>

                    </div>
                </div>

                {{-- Button --}}
                <div class="flex items-end btn-container gap-2">
                    <button id="btnCalculateAge"
                        class="w-full flex items-center w-[30%] sm:w-[20%] lg:w-[15%] justify-center gap-2 rounded-xl bg-teal-600 px-4 py-2 text-white text-sm font-medium hover:bg-teal-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 8v4l3 3M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20z" />
                        </svg>
                        Calculate
                    </button>
                    <button
                        id="reset" class="rounded-xl bg-red-500 px-4 py-2 text-white text-sm font-medium hover:bg-red-600 transition">Reset</button>
                </div>
            </div>
        </div>

        {{-- Result --}}
        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center justify-between rounded-2xl border border-yellow-200 bg-yellow-100/30 hover:shadow-[0_4px_12px_rgba(250,204,21,0.25)] 
dark:hover:shadow-[0_4px_12px_rgba(56,189,248,0.25)]

  dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
            <div>
                <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Result</div>
                <div class="mt-1 flex flex-col sm:flex-row sm:items-baseline sm:gap-2">
                    <div id="resultAge" class="text-3xl font-semibold text-gray-900 dark:text-white">—</div>
                    <div id="resultSubAge" class="text-sm text-gray-500 dark:text-gray-400"></div>
                </div>
            </div>
            <div>
                <button id="openHistory"
                    class="inline-flex w-[110px] items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium
            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300
            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900
            shadow-sm transition">
                    🕓 History
                </button>
            </div>
        </div>

        {{-- Info Section --}}
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">About This Calculator</h2>
            <div
                class="rounded-2xl border border-yellow-200 bg-yellow-100/30 hover:shadow-[0_4px_12px_rgba(250,204,21,0.25)] 
dark:hover:shadow-[0_4px_12px_rgba(56,189,248,0.25)]
  dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 text-sm text-gray-700 dark:text-gray-300">
                This Age Calculator helps you determine your exact age in years, months, and days between two given dates.
                Simply enter your date of birth and the date you want to calculate till.<br><br>

                🕒 <span class="font-semibold text-gray-900 dark:text-white">Smart Date Handling:</span><br>
                • If you leave the <strong>“Till Date”</strong> fields empty, the calculator will automatically use today’s date.<br>
                • If you enter only the <strong>year</strong> (e.g., 2020), it will use the <strong>current month and day</strong> with your given year.<br>
                • If you enter the <strong>day and year</strong> but skip the month, it will use the <strong>current month</strong> with your given day and year.<br>
                • If you enter the <strong>month and year</strong> but skip the day, it will use the <strong>current day</strong> for calculation.<br><br>

                This makes it easier to calculate your age even if you don’t provide a complete till date.
            </div>
        </div>

    </div>
    <div id="historySheet" class=" scroll-skin fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
        <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
            <!-- Sheet header -->
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Age – Full History</h3>
                <button id="closeHistory" class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" aria-label="Close history">✕</button>
            </div>
            <!-- Sheet body -->
            <div class="scroll-area p-5 overflow-y-auto max-h-[70vh]">
                <!-- Example content; replace with your real history -->
                <ol id="historyList" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>

                <div class="my-3" id="length_pagination"></div>

            </div>
            <!-- Sheet footer -->
            <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                <button id="closeHistory2" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {


        $("#openHistory").on("click", function() {
            $.ajax({
                url: "{{ route('age.history') }}",
                method: "GET",
                success: function(response) {
                    let $historyList = $("#historyList");
                    $historyList.empty();
                    if (response.history.length === 0) {
                        $historyList.append('<li class="text-gray-500 dark:text-gray-400">No history available.</li>');
                    } else {
                        $.each(response.history, function(index, item) {
                            let date = new Date(item.created_at)
                            $historyList.append('<li class="p-3 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800">' +

                                '<div><span class="font-semibold text-gray-900 dark:text-white">Age:</span> ' + Math.floor(item.years) + ' years, ' + item.months + ' months, ' + item.days + ' days</div>' +
                                '<div class="text-xs text-gray-500 dark:text-gray-400">Calculated on: ' + date.toLocaleDateString('en-US') + '</div>' +
                                '</li>');
                        });
                    }
                    $("#historySheet").removeClass("translate-y-full opacity-0 pointer-events-none");
                },
                error: function(xhr) {
                    console.log("Error fetching history:", xhr);
                }
            });
        });






    });







    $(document).ready(function() {
        $("#btnCalculateAge").on("click", function() {
            let dobMonth = $("#dobMonth").val();
            let dobDay = $("#dobDay").val();
            let dobYear = $("#dobYear").val();
            let tillMonth = $("#tillMonth").val();
            let tillDay = $("#tillDay").val();
            let tillYear = $("#tillYear").val();
            let $errorBox = $("#errorAge");
            let $resultAge = $("#resultAge");
            let $resultSubAge = $("#resultSubAge");
            let $btnCalculateAge = $("#btnCalculateAge");
            let $btnContainer = $(".btn-container");
            let $reset = $("#reset");
            let results = {};

            function showResult(response) {
                $resultAge.text((Math.floor(response.result.years) || 0) + " years, " + response.result.months + " months");
                $resultSubAge.text(response.result.days + " days");
                $btnCalculateAge.addClass("hidden");

                // Create and append Save Result button
                let $button = $("<button>")
                    .text("Save Result")
                    .addClass("w-full save-age flex items-center w-[30%] sm:w-[20%] lg:w-[15%] justify-center gap-2 rounded-xl bg-teal-600 px-4 py-2 text-white text-sm font-medium hover:bg-teal-700 transition");
                $btnContainer.prepend($button);
            }

            function showError(errors, errorMessages) {
                $.each(errors, function(key, value) {
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
            $reset.on("click", function() {
                reset();
                btnToggle();
            });
            $.ajax({
                url: "{{ route('age.calculate') }}",
                method: "POST",
                data: {
                    dob_month: dobMonth,
                    dob_day: dobDay,
                    dob_year: dobYear,
                    till_month: tillMonth,
                    till_day: tillDay,
                    till_year: tillYear,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $errorBox.addClass("hidden");
                    results = {
                        ...response.result
                    };
                    console.log(results);
                    showResult(response);
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = [];
                    showError(errors, errorMessages);
                }
            });

            function btnToggle() {
                $('.save-age').hide().remove();
                $btnCalculateAge.removeClass("hidden").addClass('block');
            }
            $('input, select').on('input change', function() {
                btnToggle();
            });

            $(document).on("click", ".save-age", function() {
                $.ajax({
                    url: "{{ route('age.save') }}",
                    method: "POST",
                    contentType: "application/json",
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    data: JSON.stringify(results),
                    success: function(response) {

                        btnToggle();
                        reset();

                    },
                    error: function(xhr) {
                        console.log(xhr);
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = [];
                        showError(errorMessages);
                    }
                });
            });
            yearsList



        });
    });

    $('#dobYear,#tillYear').on('input focus', function() {
        let currentYear = new Date().getFullYear();
        $(this).closest('div').find('datalist').empty();
        for (let y = currentYear; y >= 1900; y--) {
            $(this).closest('div').find('datalist').addClass('block').append(`<option value="${y}">${y}</option>`);
        }
    });
    $("datalist").on('click', 'option', function() {
        $(this).closest('div').find('input').val($(this).val());
        $(this).closest('div').find('datalist').removeClass('block').empty();
    });


    $(document).on('click', function(e) {
        if (!$(e.target).closest('#dobYear').length) {
            $('#yearsList').removeClass('block').empty();
        }
        if (!$(e.target).closest('#tillYear').length) {
            $('#yearsList2').removeClass('block').empty();
        }
    });

    function dobForm() {
        let month = $('#dobMonth').val();
        let day = $('#dobDay').val();
        let year = $('#dobYear').val() || new Date().getFullYear();
        if (!month) return;

        let daysInMonth = new Date(year, month, 0).getDate();
        let $dayInput = $('#dobDay').empty();
        $dayInput.attr('max', daysInMonth);
        for (let d = 1; d <= daysInMonth; d++) {
            if (d == day) {
                $dayInput.append(`<option value="${d}" selected>${d}</option>`);
            } else {
                $dayInput.append(`<option value="${d}">${d}</option>`);
            }
        }
    }
    dobForm();
    $('#dobMonth, #dobYear,#dobDay').on('input change click', dobForm);

    function tillForm() {
        let month = $('#tillMonth').val();
        let day = $('#tillDay').val();
        let year = $('#tillYear').val() || new Date().getFullYear();
        if (!month) return;
        let daysInMonth = new Date(year, month, 0).getDate();
        let $dayInput = $('#tillDay').empty();
        $dayInput.attr('max', daysInMonth);
        let $datalist = $dayInput.closest('div').find('datalist');
        $datalist.empty().addClass('block');
        for (let d = 1; d <= daysInMonth; d++) {
            if (d == day) {
                $dayInput.append(`<option value="${d}" selected>${d}</option>`);
            } else {
                $dayInput.append(`<option value="${d}">${d}</option>`);
            }
        }
    }
    tillForm();
    $('#tillYear, #tillMonth,#tillDay').on('input change click', tillForm);
</script>


<x-appfooter />