<div id="calcModal" class="fixed inset-0 z-[60] hidden">
    <div id="calcBackdrop"
        class="absolute inset-0 bg-black/40 backdrop-blur-sm opacity-0 transition-opacity duration-300"></div>
    <div class="absolute inset-0 flex items-start justify-center sm:items-center">
        <div id="calcPanel"
            class="mt-10 sm:mt-0 w-[min(960px,95vw)] rounded-2xl border border-slate-200 dark:border-slate-700
                bg-slate-50 dark:bg-slate-900 shadow-2xl
                opacity-0 scale-95 translate-y-3 transition-[opacity,transform] duration-300 will-change-transform">
            <div class="p-5 sm:p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 id="calcTitle" class="text-lg font-semibold">Fitness Calculator</h3>
                        <p class="text-xs text-slate-500">Pick a tab and calculate instantly.</p>
                    </div>
                    <button id="calcCloseBtn"
                        class="rounded-md px-2 py-1 text-slate-500 hover:text-slate-900 hover:bg-slate-200 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-brand">
                        ✕
                    </button>
                </div>
                <div id="calcContent" class="mt-4"></div>
            </div>
        </div>
    </div>
</div>