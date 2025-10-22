<div id="popupLengthConverter" class=" scroll-skin fixed inset-0 z-[60] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center" role="dialog" aria-modal="true" aria-labelledby="lengthConverterTitle">

    <div>
        <div class=" relative z-[99999999999]">
            <div id="Length_errors"
                class=" absolute top-[80px] left-[7%] w-[50%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
        </div>



        <div class="scroll-area popup-content w-[min(960px,95vw)] max-h-[85vh] overflow-y-auto rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900 relative">
            <!-- Header -->
            <div style="z-index: 1;" class="sticky top-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur flex items-center justify-between px-5 py-3 rounded-t-2xl border-b border-slate-200 dark:border-slate-700">
                <h2 id="lengthConverterTitle" class="text-xl font-semibold text-gray-900 dark:text-white">Length Converter</h2>
                <button class="close-popup inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M6.225 4.811a1 1 0 0 1 1.414 0L12 9.172l4.361-4.361a1 1 0 1 1 1.414 1.414L13.414 10.586l4.361 4.361a1 1 0 0 1-1.414 1.414L12 12l-4.361 4.361a1 1 0 0 1-1.414-1.414l4.361-4.361-4.361-4.361a1 1 0 0 1 0-1.414Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- <div class="relative z-[99999999999]">
            <div id=""
                class="fixed top-18 left-[28%] w-[30%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
                ddd
            </div>
        </div> -->
            <!-- Body -->
            <div class="p-6 sm:p-8 pb-24 relative"> <!-- bottom padding so content doesn't hide behind action bar -->
                <!-- Error -->
                <div id="" style="z-index: 9999999999999999999;" class="absolute top-4 left-[35px] w-[85%] text-sm text-red-700 bg-red-100 border border-red-200
          dark:text-white dark:bg-red-400 dark:border-red-800 rounded-md px-3 py-2
          transform -translate-y-full opacity-0 transition-all duration-500 ease-out"></div>

                <!-- Form card -->
                <div style="z-index: -1;" class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div class="sm:col-span-1">
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Value</label>
                            <input id="value" type="number" step="any" value="1" class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">From</label>
                            <select id="from" class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                                <option value="mm">Millimeter (mm)</option>
                                <option value="cm">Centimeter (cm)</option>
                                <option value="m" selected>Meter (m)</option>
                                <option value="km">Kilometer (km)</option>
                                <option value="in">Inch (in)</option>
                                <option value="ft">Foot (ft)</option>
                                <option value="yd">Yard (yd)</option>
                                <option value="mi">Mile (mi)</option>
                            </select>
                        </div>
                        <div class="sm:col-span-1">
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">To</label>
                            <select id="to" class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                                <option value="mm">Millimeter (mm)</option>
                                <option value="cm">Centimeter (cm)</option>
                                <option value="m">Meter (m)</option>
                                <option value="km">Kilometer (km)</option>
                                <option value="in" selected>Inch (in)</option>
                                <option value="ft">Foot (ft)</option>
                                <option value="yd">Yard (yd)</option>
                                <option value="mi">Mile (mi)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Result card -->
                <div class="mt-4 rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                    <div class="text-sm text-gray-600 dark:text-gray-300">Result</div>
                    <div id="result" class="mt-1 text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">—</div>
                    <div id="toUnit" class="text-sm text-gray-400 dark:text-gray-500">in</div>
                </div>

                <!-- Table card -->
                <div class="mt-4 rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                    <div class="font-semibold text-sm mb-2 text-gray-800 dark:text-gray-200">Quick Conversion Table</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Based on current input.</div>
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full text-sm">
                            <thead class="text-gray-700 dark:text-gray-300">
                                <tr class="border-b border-slate-200 dark:border-slate-800">
                                    <th class="text-left font-medium py-2 pr-6">Unit</th>
                                    <th class="text-left font-medium py-2">Value</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody" class="divide-y divide-slate-200 dark:divide-slate-800"></tbody>

                        </table>
                    </div>
                </div>

                <!-- Info card -->
                <div class="mt-4 rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <strong class="text-gray-800 dark:text-gray-200">History (short):</strong>
                        The meter is the SI base unit of length, defined by the distance light travels in vacuum in 1/299,792,458 of a second.
                        @auth
                        <button id="openHistory" href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Read full history →</button>
                        @endauth
                    </p>
                </div>
            </div>

            <!-- Sticky action bar with Save -->
            <div class="sticky bottom-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur border-t border-slate-200 dark:border-slate-700 px-5 py-3 rounded-b-2xl flex items-center justify-end gap-2">
                <button id="btnSaveLengthss" class="inline-flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                    <!-- disk icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 7a2 2 0 0 1 2-2h9l5 5v7a2 2 0 0 1-2 2h-2v-6H7v6H5a2 2 0 0 1-2-2V7Z" />
                        <path d="M9 5h4v4H9z" />
                    </svg>
                    Save
                </button>
            </div>
        </div>
    </div>

    <!-- Bottom Sheet (History) -->
    <div id="historySheet" class=" scroll-skin fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
        <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
            <!-- Sheet header -->
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Length – Full History</h3>
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