<div id="popupTimeConverter" class="scroll-skin fixed inset-0 z-[60] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="timeConverterTitle">
    <div class="scroll-area popup-content w-[min(960px,95vw)] max-h-[85vh] overflow-y-auto rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900 relative">
        <!-- Sticky header (same style as weight) -->
        <div class="sticky top-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur flex items-center justify-between px-5 py-3 rounded-t-2xl border-b border-slate-200 dark:border-slate-700" style="z-index:1;">
            <h2 id="timeConverterTitle" class="text-xl font-semibold text-gray-900 dark:text-white">Time Converter</h2>
            <button id="closePopupTimeConverter" class="close-popup inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900" aria-label="Close">✕</button>
        </div>

        <!-- Body -->
        <div class="p-6 sm:p-8 pb-24">
            <!-- Error Message (matched red palette) -->
            <div id="time_error" class="error hidden text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2 mb-4"></div>

            <!-- Converter Form (matched card + borders) -->
            <div class="card bg-white/70 dark:bg-gray-900/60 backdrop-blur p-4 rounded-lg border border-slate-200/70 dark:border-slate-700/60">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">Value</label>
                        <input id="time_value" type="number" step="any" value="1" class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">From</label>
                        <select id="time_from" class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                            <option value="ns">Nanosecond (ns)</option>
                            <option value="us">Microsecond (µs)</option>
                            <option value="ms">Millisecond (ms)</option>
                            <option value="s" selected>Second (s)</option>
                            <option value="min">Minute (min)</option>
                            <option value="h">Hour (h)</option>
                            <option value="day">Day</option>
                            <option value="week">Week</option>
                            <option value="mo">Month (avg)</option>
                            <option value="yr">Year (avg)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">To</label>
                        <select id="time_to" class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                            <option value="ns">Nanosecond (ns)</option>
                            <option value="us">Microsecond (µs)</option>
                            <option value="ms">Millisecond (ms)</option>
                            <option value="s">Second (s)</option>
                            <option value="min" selected>Minute (min)</option>
                            <option value="h">Hour (h)</option>
                            <option value="day">Day</option>
                            <option value="week">Week</option>
                            <option value="mo">Month (avg)</option>
                            <option value="yr">Year (avg)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Result Display (matched styles) -->
            <div class="card bg-white/70 dark:bg-gray-900/60 backdrop-blur p-4 rounded-lg mt-4 border border-slate-200/70 dark:border-slate-700/60">
                <div class="text-sm text-gray-600 dark:text-gray-300">Result</div>
                <div class="text-2xl font-semibold text-gray-900 dark:text-white" id="time_result">—</div>
                <div class="text-sm text-gray-400 dark:text-gray-500" id="time_toUnit">min</div>
            </div>

            <!-- Conversion Table (matched table borders/dividers) -->
            <div class="card bg-white/70 dark:bg-gray-900/60 backdrop-blur p-4 rounded-lg mt-4 border border-slate-200/70 dark:border-slate-700/60">
                <div class="font-semibold text-sm mb-2 text-gray-800 dark:text-gray-200">Quick Conversion Table</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Based on current input.</div>
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-slate-200 dark:border-slate-800">
                                <th class="text-left text-sm font-medium text-gray-800 dark:text-gray-200">Unit</th>
                                <th class="text-left text-sm font-medium text-gray-800 dark:text-gray-200">Value</th>
                            </tr>
                        </thead>
                        <tbody id="time_tableBody" class="divide-y divide-slate-200 dark:divide-slate-800"></tbody>
                    </table>
                </div>
            </div>

            <!-- Note card (kept subtle) -->
            <div class="card bg-white/60 dark:bg-gray-900/50 backdrop-blur p-4 rounded-lg mt-4 border border-slate-200/50 dark:border-slate-700/50">
                <div class="text-sm text-gray-700 dark:text-gray-300">
                    <strong>Note:</strong> “mo” and “yr” use average Gregorian lengths (not calendar-specific).
                </div>
            </div>
        </div>

        <!-- Sticky bottom action bar (same as weight) -->
        <div class="sticky bottom-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur border-t border-slate-200 dark:border-slate-700 px-5 py-3 rounded-b-2xl flex items-center justify-end gap-2">

            @auth
            <button id="btnOpenTimeHistory" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">
                <!-- clock icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2a10 10 0 1 0 .001 20.001A10 10 0 0 0 12 2Zm.75 5a.75.75 0 0 0-1.5 0v5c0 .199.079.389.22.53l3 3a.75.75 0 0 0 1.06-1.06l-2.78-2.78V7Z" />
                </svg>
                History
            </button>

            @endauth

            <button id="btnSaveTime" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                <!-- disk icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3 7a2 2 0 0 1 2-2h9l5 5v7a2 2 0 0 1-2 2h-2v-6H7v6H5a2 2 0 0 1-2-2V7Z" />
                    <path d="M9 5h4v4H9z" />
                </svg>
                Save
            </button>
        </div>
    </div>

    <!-- Bottom Sheet (History for time) -->
    <div id="timeHistorySheet" class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
        <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
            <!-- Sheet header -->
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Time – Full History</h3>
                <button id="closeTimeHistory" class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" aria-label="Close history">✕</button>
            </div>
            <!-- Sheet body -->
            <div class="p-5 overflow-y-auto max-h-[70vh]">
                <ol id="timeHistoryList" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
            </div>
            <!-- Sheet footer -->
            <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                <button id="closeTimeHistory2" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- <script>
    (function() {


        //history model ids 


        let timeHistorySheet = document.getElementById('timeHistorySheet');
        let closeTimeHistory = document.getElementById('closeTimeHistory');
        let timeHistoryList = document.getElementById('timeHistoryList');
        let closeTimeHistory2 = document.getElementById('closeTimeHistory2');
        let btnOpenTimeHistory = document.getElementById('btnOpenTimeHistory');

        //inputs ids 

        let btnSaveTime = document.getElementById('btnSaveTime');
        let timeValue = document.getElementById('time_value');
        let timeFrom = document.getElementById('time_from');
        let timeTo = document.getElementById('time_to');
        let timeResult = document.getElementById('time_result');
        let timeError = document.getElementById('time_error');

        function openTimeHistory() {

            timeHistorySheet.classList.remove("opacity-0", "translate-y-full", "pointer-events-none");

        }

        function closeTimeHis() {
            timeHistorySheet.classList.add("opacity-0", "translate-y-full", "pointer-events-none");

        }

        function showError(msg) {
            timeError.textContent = msg || "Something went wrong.";
            timeError.style.display = "block";
        }

        btnOpenTimeHistory.addEventListener('click', openTimeHistory);
        btnOpenTimeHistory.addEventListener('click', loadTimeHistory);
        closeTimeHistory.addEventListener('click', closeTimeHis);
        closeTimeHistory2.addEventListener('click', closeTimeHis);


        async function saveTimeConversion() {


            const value = parseFloat(timeValue.value);
            if (Number.isNaN(value)) {
                showError("Please enter a numeric value.");
                return;
            }
            const from = timeFrom.value;
            const to = timeTo.value;
            const resultValue = parseFloat(timeResult.textContent);

            const category = "time";

            btnSaveTime.disabled = true;
            const original = btnSaveTime.innerHTML;
            btnSaveTime.innerHTML = "Saving…";

            // Put this once in your JS
            async function postJson(url, data, opts = {}) {
                const token = document.querySelector('meta[name="csrf-token"]')?.content;

                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json', // tells Laravel to reply JSON (not redirect HTML)
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest', // AJX hint for JSON responses
                        ...(token ? {
                            'X-CSRF-TOKEN': token
                        } : {})
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(data),
                    signal: opts.signal
                });

                const text = await res.text();
                let json = null;
                try {
                    json = text ? JSON.parse(text) : null;
                } catch {}

                if (res.ok) {
                    showError('data saved successfully')

                }

                if (!res.ok) {
                    const err = new Error(json?.message || res.statusText || `HTTP ${res.status}`);
                    err.status = res.status; // <-- carry status to catch()
                    err.data = json;
                    err.responseText = text;
                    throw err;
                }

                return json;
            }

            try {
                const resp = await postJson('/lenghtsave', {
                    from,
                    to,
                    value,
                    category,
                    resultValue
                });

                btnSaveTime.innerHTML = 'Saved ✓';
                setTimeout(() => (btnSaveTime.innerHTML = original), 1500);
            } catch (e) {
                if (e.status === 419) {
                    console.log('Unauthenticated (419):', e.data?.message || e.message);
                    showError('you are not authenticated')
                } else if (e.status === 401) {
                    console.log('Unauthorized (401):', e.data?.message || e.message);

                    showError('you are not authorized')

                    // window.location.href = '/login';
                } else {
                    console.error('Save failed:', e.status, e.message, e.data || e.responseText);
                }

                btnSaveTime.innerHTML = 'Error ✗';
            } finally {
                btnSaveTime.disabled = false;
                setTimeout(() => {
                    timeError.style.display = "none";

                }, 3000)
            }


        }

        btnSaveTime.addEventListener('click', saveTimeConversion);


        async function loadTimeHistory(page = 1) {
            try {
                // Use relative URL if app is in a subfolder (XAMPP)
                const res = await fetchJson("/lenghts", {
                    category: "time",
                    per_page: 10,
                    page,
                    sort: "created_at",
                    order: "desc",
                });

                const items = res.data ?? res; // paginator returns .data
                timeHistoryList.innerHTML = "";


                let timeKeyObj = {
                    yr: 'Year',
                    mo: 'Month',
                    week: 'Week',
                    day: 'Day',
                    h: "Hour",
                    min: 'Minute',
                    s: 'Second',
                    ms: 'Milisecond',
                    us: 'Microsecond',
                    ns: 'Nanosecond',
                };

                items.forEach((r) => {
                    const li = document.createElement("li");
                    li.className = "flex items-start gap-3";
                    li.innerHTML = `
        <span class="mt-1 h-2 w-2 rounded-full bg-slate-400 dark:bg-slate-600"></span>
        <div>
          <div class="font-medium text-gray-900 dark:text-gray-200">
            ${timeKeyObj[r.from_unit]} → ${timeKeyObj[r.to_unit]}
          </div>
          <div class="text-xs text-gray-500 dark:text-gray-400">
               value: ${parseFloat(Number(r.value).toFixed(2))} • 
               Result: ${parseFloat(Number(r.result).toFixed(2))} • ${
                            r.category
                        } • ${new Date(r.created_at).toLocaleString()}
          </div>
        </div>
      `;
                    timeHistoryList.appendChild(li);
                });

                // (optional) build simple next/prev using res.meta/res.links
                // console.log(res.meta, res.links);
            } catch (e) {
                showError(e.message);
            }
        }


    })();
</script> -->