<x-app
    :title="'Age Calculator – Calculate Your Exact Age in Years, Months, and Days | QuickCalculatIt'"
    :des="'QuickCalculatIt Age Calculator helps you find your exact age in years, months, and days by entering your date of birth and the date to calculate till.'"
    :key="'age calculator, date of birth calculator, age finder, QuickCalculatIt'" />

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
                        <select id="dobMonth"
                            class="rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                            text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                            <option value="">Month</option>
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
                        <input id="dobDay" type="number" placeholder="Day" min="1" max="31"
                            class="rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                            text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                        <input id="dobYear" type="number" placeholder="Year" min="1900"
                            class="rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                            text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                    </div>
                </div>

                {{-- Till Date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Age at date</label>
                    <div class="grid grid-cols-3 gap-2">
                        <select id="tillMonth"
                            class="rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                            text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                            <option value="">Month</option>
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
                        <input id="tillDay" type="number" placeholder="Day" min="1" max="31"
                            class="rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                            text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                        <input id="tillYear" type="number" placeholder="Year" min="1900"
                            class="rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                            text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                    </div>
                </div>

                {{-- Button --}}
                <div class="flex items-end">
                    <button id="btnCalculateAge"
                        class="w-full flex items-center w-[30%] sm:w-[25%] justify-center gap-2 rounded-xl bg-teal-600 px-4 py-2 text-white text-sm font-medium hover:bg-teal-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 8v4l3 3M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20z" />
                        </svg>
                        Calculate
                    </button>
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
        </div>

        {{-- Info Section --}}
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">About This Calculator</h2>
            <div class="rounded-2xl border border-yellow-200 bg-yellow-100/30 hover:shadow-[0_4px_12px_rgba(250,204,21,0.25)] 
dark:hover:shadow-[0_4px_12px_rgba(56,189,248,0.25)]
  dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 text-sm text-gray-700 dark:text-gray-300">
                This Age Calculator helps you determine your exact age in years, months, and days between two given dates. Simply enter your date of birth and the date you want to calculate till.
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("btnCalculateAge").addEventListener("click", function() {
        let dobMonth = document.getElementById("dobMonth").value;
        let dobDay = document.getElementById("dobDay").value;
        let dobYear = document.getElementById("dobYear").value;
        let tillMonth = document.getElementById("tillMonth").value;
        let tillDay = document.getElementById("tillDay").value;
        let tillYear = document.getElementById("tillYear").value;
        let errorBox = document.getElementById("errorAge");
        let resultAge = document.getElementById("resultAge");
        let resultSubAge = document.getElementById("resultSubAge");
        // Validate DOB


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
                errorBox.classList.add("hidden");
                console.log(response);
                resultAge.textContent = Math.floor(response.result.years) + " years, " + response.result.months + " months";
                resultSubAge.textContent = response.result.days + " days total";
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                console.log(xhr);
                let errorMessages = [];
                for (let key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorMessages.push(errors[key][0]);
                    }
                }
                errorBox.innerHTML = errorMessages.join("<br>");
                errorBox.classList.remove("hidden");
                resultAge.textContent = "—";
                resultSubAge.textContent = "";
            }
        });






    });
</script>

<x-appfooter />