<x-app

    :title="'Day Counter Calculator – Calculate Days, Hours & Minutes Between Dates Easily'"
    :des="'Quickly calculate the exact number of days, hours, and minutes between two dates with our easy-to-use Day Counter Calculator. Perfect for planning, tracking, and time management.'"
    :key="'date duration calculator, days between dates calculator, calculate days hours minutes between dates, date duration calculator, days calculator online, date difference calculator, time difference calculator, time interval calculator, date interval calculator, day counter tool'"
    :titleTwitter="'Day Counter Calculator – Get Days, Hours & Minutes Between Any Two Dates Instantly'" />



<div class="min-h-screen bg-emerald-50 dark:bg-slate-900 py-10">
    <div class="container mx-auto max-w-5xl px-4">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-violet-100 text-violet-700 dark:bg-violet-900/30 dark:text-violet-300">📅</div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Day Counter</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Calculate total days, weeks, hours, minutes, and seconds between two dates.</p>
                </div>
            </div>
            <span class="hidden sm:block text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </div>

        {{-- Error Banner --}}
        <div id="errorCounter"
            class="hidden mb-4 rounded-xl border border-red-200/70 bg-red-50 text-red-700 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-200 px-3 py-2">
        </div>

        {{-- Inputs --}}
        <div class="relative rounded-2xl border border-yellow-200 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800 hover:shadow-[0_4px_12px_rgba(250,204,21,0.25)]
        dark:hover:shadow-[0_4px_12px_rgba(56,189,248,0.25)]
        shadow-sm px-5 pt-5 pb-3">

            <div class="grid grid-cols-1 sm:grid-cols-1 gap-3">

                {{-- START DATE --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Date</label>
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <select id="startMonth"
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

                        <div class="relative col-span-1 day-select-container">
                            <input id="startDay" type="text" placeholder="Year"
                                class="rounded-xl search w-full border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                                text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                        </div>

                        <div class="relative col-span-1">
                            <input id="startYear" type="text" placeholder="Year"
                                class="rounded-xl search w-full border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                                text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                        </div>
                    </div>
                </div>

                {{-- END DATE --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Date</label>
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <select id="endMonth"
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

                        <div class="relative col-span-1 day-select-container">
                            <input id="endDay" type="text" placeholder="Year"
                                class="rounded-xl search w-full border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                                text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                        </div>

                        <div class="relative col-span-1">
                            <input id="endYear" type="text" placeholder="Year"
                                class="rounded-xl search w-full border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                                text-gray-900 dark:text-gray-100 px-2 py-2 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                        </div>
                    </div>
                    <label for="includeLast" class="flex items-center gap-3 cursor-pointer select-none my-4 mx-2">
                        <input
                            type="checkbox"
                            id="includeLast"
                            class="h-5 w-5  rounded-md border-gray-400 text-purple-600
               focus:ring-2 focus:ring-purple-400 focus:ring-offset-1
               dark:border-gray-600 dark:bg-gray-700">
                        <span class="text-sm font-medium text-gray-800 dark:text-gray-200">
                            Include the end date in the calculation
                        </span>
                    </label>


                </div>

                {{-- Buttons --}}
                <div class="flex items-end btn-container gap-2">
                    <button id="btnCalculateDays"
                        class="w-full flex items-center w-[30%] sm:w-[20%] lg:w-[15%] justify-center gap-2 rounded-xl bg-teal-600 px-4 py-2 text-white text-sm font-medium hover:bg-teal-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 8v4l3 3M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20z" />
                        </svg>
                        Calculate
                    </button>

                    <button id="resetCounter"
                        class="rounded-xl bg-red-500 px-4 py-2 text-white text-sm font-medium hover:bg-red-600 transition">Reset</button>
                </div>

            </div>
        </div>

        {{-- Result --}}
        <div class="mt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center 
     gap-4 rounded-2xl border border-yellow-200 bg-yellow-100/30 
     hover:shadow-[0_4px_12px_rgba(250,204,21,0.25)]
     dark:hover:shadow-[0_4px_12px_rgba(56,189,248,0.25)]
     dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">

            <!-- LEFT SIDE RESULT -->
            <div class="flex-1">
                <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Result</div>

                <div class="mt-1 grid grid-cols-3 gap-1">
                    <div class="col-span-3">
                        <div id="resultTotalDays" class="text-3xl font-semibold text-gray-900 dark:text-white">-</div>
                        <div id="startFrom" class="text-lg text-gray-500 font-semibold dark:text-gray-400 hidden">

                        </div>
                        <div id="endFrom" class="text-lg text-gray-500 font-semibold dark:text-gray-400 hidden">

                        </div>

                        <div id="resultSubDays" class="text-sm text-gray-500 font-semibold dark:text-gray-400">
                            -
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE BUTTON -->
            <div class="flex-shrink-0">
                <button id="openHistoryCounter"
                    class="inline-flex w-[110px] items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium
                text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 
                focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 
                dark:hover:bg-gray-200 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900
                shadow-sm transition">
                    🕓 History
                </button>
            </div>

        </div>


        <div>
            {{-- Info Section --}}
            <div class="mt-8 rounded-2xl border border-yellow-200 bg-yellow-100/30 hover:shadow-[0_4px_12px_rgba(250,204,21,0.25)] 
                dark:hover:shadow-[0_4px_12px_rgba(56,189,248,0.25)]
                dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 text-sm text-gray-700 dark:text-gray-300">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Day Counter Calculator – Calculate Days, Weeks, Hours, Minutes & Seconds Between Two Dates</h2>
                <div
                    class="">
                    Welcome to the Day Counter Calculator, your easy-to-use online tool designed to quickly find the total number of days between any two dates. Simply enter a start date and an end date to get an accurate, detailed breakdown including weeks, hours, minutes, and seconds.
                </div>
            </div>

            <div class="mt-6 rounded-2xl border border-yellow-200 bg-yellow-100/30 hover:shadow-[0_4px_12px_rgba(250,204,21,0.25)] 
                dark:hover:shadow-[0_4px_12px_rgba(56,189,248,0.25)]
                dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 text-sm text-gray-700 dark:text-gray-300">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">How to Use the Day Counter Calculator
                </h2>
                <div
                    class="">
                    Enter the Start Date – The beginning date of your time period.
                    Enter the End Date – The ending date you want to calculate up to.
                    Click the Calculate button to instantly see the difference broken down into days, weeks, hours, minutes, and seconds.
                </div>
            </div>
            <div class="mt-6 rounded-2xl border border-yellow-200 bg-yellow-100/30 hover:shadow-[0_4px_12px_rgba(250,204,21,0.25)] 
                dark:hover:shadow-[0_4px_12px_rgba(56,189,248,0.25)]
                dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 text-sm text-gray-700 dark:text-gray-300">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Why Use Our Day Counter Calculator?</h2>
                <div>
                    Accurate Results: Get precise calculations for days and every time unit in between, helping with scheduling, planning, and time management.
                    Fast and Simple: No complicated forms—just enter two dates and get instant results.
                    Free and Accessible: Use this tool anytime on any device without registration or cost.
                    Perfect for Various Uses: Ideal for project planning, vacation countdowns, event durations, or age calculations.
                </div>
            </div>
            <div class="mt-6 rounded-2xl border border-yellow-200 bg-yellow-100/30 hover:shadow-[0_4px_12px_rgba(250,204,21,0.25)] 
                dark:hover:shadow-[0_4px_12px_rgba(56,189,248,0.25)]
                dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 text-sm text-gray-700 dark:text-gray-300">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3"> Features of Our Date Difference Calculator
                </h2>
                <div>
                    Calculates the exact number of days between two dates.
                    Provides additional breakdowns in weeks, hours, minutes, and seconds.
                    User-friendly interface for easy navigation.
                    Supports all valid date formats to ensure flexibility.
                </div>
            </div>
            <div class="mt-6 rounded-2xl border border-yellow-200 bg-yellow-100/30 hover:shadow-[0_4px_12px_rgba(250,204,21,0.25)] 
                dark:hover:shadow-[0_4px_12px_rgba(56,189,248,0.25)]
                dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 text-sm text-gray-700 dark:text-gray-300">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Use Cases for the Day Counter Calculator</h2>
                <div>

                    Whether you need to know how many days are left until an important event, or you want to calculate the total time spent on a project, our calculator simplifies these tasks with a reliable and detailed time breakdown.
                </div>
            </div>
            <div class="mt-6 rounded-2xl border border-yellow-200 bg-yellow-100/30 hover:shadow-[0_4px_12px_rgba(250,204,21,0.25)] 
                dark:hover:shadow-[0_4px_12px_rgba(56,189,248,0.25)]
                dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 text-sm text-gray-700 dark:text-gray-300">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Enter Your Dates and Calculate Now
                </h2>
                <div>

                    Enter a start date and an end date to get a detailed breakdown of the time between them in days, weeks, hours, minutes, and seconds.
                </div>
            </div>

        </div>

        {{-- HISTORY DRAWER --}}
        <div id="historySheetCounter" class="scroll-skin fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">

            <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">

                <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Day Counter – Full History</h3>
                    <button id="closeHistoryCounter" class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">✕</button>
                </div>

                <div class="scroll-area p-5 overflow-y-auto max-h-[70vh]">
                    <ol id="historyListCounter" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                    <div class="my-3" id="paginationCounter"></div>
                </div>

                <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                    <button id="closeHistoryCounter2" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700">Close</button>
                </div>

            </div>
        </div>
    </div>

</div>


@if (request()->routeIs('dayCounter.*'))
<script>
    window.dayCalculatorUrl = "{{ route('dayCounter.calculate') }}";
</script>
@endif

<x-appfooter></x-appfooter>