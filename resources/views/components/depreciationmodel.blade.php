  <div id="popupDepreciationCalculator"
      class="scroll-skin fixed inset-0 z-[60] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center"
      aria-hidden="true" role="dialog" aria-modal="true">

      <!-- Outer container: no scroll; inner body scrolls -->
      <div class="popup-content bg-white dark:bg-gray-900 rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 w-[min(960px,95vw)] max-h-[85vh] overflow-hidden p-0">

          <!-- Header -->
          <div class="sticky top-0 left-0 z-10 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur
                  flex items-center justify-between px-5 py-3 rounded-t-2xl border-b border-slate-200 dark:border-slate-700">
              <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Depreciation Calculator</h2>
              <div class="flex items-center gap-2">
                  <button id="closePopupDepreciationCalculator"
                      class="close-popup inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300
                         hover:bg-gray-200/70 dark:hover:bg-gray-700/70 hover:text-gray-700 dark:hover:text-gray-100
                         focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900"
                      aria-label="Close">✕</button>
              </div>
          </div>

          <!-- Body (single scroll container) -->
          <div class="px-6 sm:px-8 py-6 overflow-y-auto max-h-[calc(85vh-48px-56px)] scroll-area">
              <div class="container">
                  <!-- Error -->
                  <div id="errorDepreciation" role="alert"
                      class="hidden text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2 mb-4"></div>

                  <!-- Form -->
                  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                      <!-- Inputs -->
                      <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                              <div class="sm:col-span-2">
                                  <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Cost</label>
                                  <input id="costDepreciation" type="number" step="any" value="10000"
                                      class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white
                                focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                              </div>
                              <div class="sm:col-span-2">
                                  <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Method</label>
                                  <select id="methodDepreciation"
                                      class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white
                                 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                                      <option value="straight_line">Straight-Line</option>
                                      <option value="double_declining" selected>Double-Declining (DDB)</option>
                                      <option value="sum_of_years_digits">Sum-of-Years-Digits (SYD)</option>
                                  </select>
                              </div>
                              <div>
                                  <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Salvage Value</label>
                                  <input id="salvageValueDepreciation" type="number" step="any" value="1000"
                                      class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white
                                focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                              </div>
                              <div>
                                  <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Life (years)</label>
                                  <input id="lifeYearsDepreciation" type="number" value="5" min="1"
                                      class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white
                                focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                              </div>
                          </div>
                      </div>

                      <!-- Results -->
                      <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                          <div class="text-sm text-gray-600 dark:text-gray-300">Total Depreciation</div>
                          <div class="mt-1 text-3xl font-semibold tracking-tight text-gray-900 dark:text-white" id="deprSumDepreciation">—</div>
                          <div class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                              End Book Value: <span id="endBookValueDepreciation">—</span>
                          </div>
                          <div class="text-xs text-gray-500 dark:text-gray-400">Book value should equal salvage at the end (within rounding).</div>
                      </div>
                  </div>

                  <!-- Switch & Rounding -->
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                      <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                          <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">DDB: Switch to SL when higher?</label>
                          <select id="ddbSwitchToSlDepreciation"
                              class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white
                             focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                              <option value="true" selected>Yes</option>
                              <option value="false">No</option>
                          </select>
                      </div>
                      <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                          <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Rounding (decimals)</label>
                          <input id="roundDepreciation" type="number" min="0" max="4" value="2"
                              class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white
                            focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                      </div>
                  </div>

                  <!-- Schedule (scroll after ~6 rows + sticky header) -->
                  <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5 mt-4">
                      <div class="font-semibold text-sm mb-2 text-gray-800 dark:text-gray-200">Schedule (yearly)</div>

                      <div class="ring-1 ring-slate-200/60 dark:ring-slate-700/60 rounded-lg overflow-hidden">
                          <table class="min-w-full text-sm">
                              <thead class="text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-800/60">
                                  <tr class="border-b border-slate-200 dark:border-slate-800">
                                      <th class="text-left font-medium py-2 pr-6">Year</th>
                                      <th class="text-left font-medium py-2 pr-6">Depreciation</th>
                                      <th class="text-left font-medium py-2 pr-6">Accumulated</th>
                                      <th class="text-left font-medium py-2 pr-6">Book Value</th>
                                      <th class="text-left font-medium py-2">Note</th>
                                  </tr>
                              </thead>
                          </table>

                          <!-- Scrollable body only -->
                          <div class="scroll-area max-h-72 overflow-y-auto">
                              <table class="min-w-full text-sm">
                                  <tbody id="tableBodyDepreciation"
                                      class="divide-y divide-slate-200 dark:divide-slate-800"></tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Sticky action bar -->
          <div class="sticky bottom-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur border-t border-slate-200 dark:border-slate-700 px-5 py-3 rounded-b-2xl flex items-center justify-end gap-2">
              <button id="openHistoryDep"
                  class="inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200
                       focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 dark:focus:ring-slate-600">
                  History
              </button>
              <button id="btnSaveDepreciation"
                  class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800
                       focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100
                       dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M3 7a2 2 0 0 1 2-2h9l5 5v7a2 2 0 0 1-2 2h-2v-6H7v6H5a2 2 0 0 1-2-2V7Z" />
                      <path d="M9 5h4v4H9z" />
                  </svg>
                  Save
              </button>
          </div>
      </div>

      <!-- Bottom Sheet (History) -->
      <div id="historySheetDep"
          class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
          <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
              <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Depreciation – History</h3>
                  <button id="closeHistoryDep"
                      class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300
                         hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                      aria-label="Close history">✕</button>
              </div>
              <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                  <ol id="historyListDep" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
              </div>
              <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                  <button id="closeHistoryDep2"
                      class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200
                         focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">
                      Close
                  </button>
              </div>
          </div>
      </div>
  </div>







  <script>
      (function() {
          const openHistory = document.getElementById('openHistoryDep');
          const sheet = document.getElementById('historySheetDep');
          const close1 = document.getElementById('closeHistoryDep');
          const close2 = document.getElementById('closeHistoryDep2');
          const saveBtn = document.getElementById('btnSaveDepreciation');

          function showSheet() {
              sheet.classList.remove('pointer-events-none', 'opacity-0', 'translate-y-full');
          }

          function hideSheet() {
              sheet.classList.add('pointer-events-none', 'opacity-0', 'translate-y-full');
          }
          if (openHistory) openHistory.addEventListener('click', (e) => {
              e.preventDefault();
              showSheet();
          });
          if (close1) close1.addEventListener('click', hideSheet);
          if (close2) close2.addEventListener('click', hideSheet);

          if (saveBtn) {
              saveBtn.addEventListener('click', async () => {
                  const original = saveBtn.innerHTML;
                  saveBtn.disabled = true;
                  saveBtn.classList.add('opacity-70', 'cursor-wait');
                  saveBtn.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10h-2a8 8 0 1 1-8-8V2z"/></svg>
        Saving...
      `;
                  try {
                      // TODO: your save logic…
                      await new Promise(r => setTimeout(r, 800));
                  } finally {
                      saveBtn.disabled = false;
                      saveBtn.classList.remove('opacity-70', 'cursor-wait');
                      saveBtn.innerHTML = original;
                  }
              });
          }
      })();
  </script>