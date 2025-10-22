<x-app :title="'Online Calculators for Finance, Health & Everyday Math | QuickCalculatIt'"
    :des="'QuickCalculatIt – Free online calculators for finance, health, fitness, and everyday math. Calculate taxes, BMI, TDEE, body fat, ideal weight, conversions, and more easily and accurately.'"
    :key="'online calculators, free calculators, finance calculator, tax calculator, salary calculator, BMI calculator, TDEE calculator, body fat calculator, ideal weight calculator, conversions, math tools, QuickCalculatIt'" />




<main class="min-h-[70vh]">
    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid lg:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-head dark:text-white">
                    Calculate smarter—instantly
                </h1>
                <p class="mt-3 text-slate-600 dark:text-slate-400">
                    All your Fitness, Finance, Health, and Utility calculators in one fast, beautiful place.
                </p>
                <div class="mt-6 flex gap-3">
                    <a href="{{ url('/calculators') }}" class="rounded-xl bg-brand px-5 py-3 text-white font-semibold hover:bg-blue-600 transition">Browse Calculators</a>
                    <a href="{{ url('/builder') }}" class="rounded-xl border border-slate-200 px-5 py-3 hover:border-brand/30 hover:bg-white transition dark:border-slate-700 dark:hover:bg-slate-800">Create Your Own</a>
                </div>
            </div>
            <div class="lg:justify-self-end">
                <div class="rounded-2xl border border-slate-200 bg-white/70 p-6 shadow-card dark:bg-slate-800 dark:border-slate-700">
                    <div class="text-sm text-slate-500 mb-2">Quick Access</div>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @php
                        $quick = [
                        ['name'=>'Unit Converter','desc'=>'Universal Conversion Calculator','href'=>'math.measurement'],
                        ['name'=>'Tax & Finance','desc'=>'Smart Finance Calculator','href'=>'tax.finance'],
                        ['name'=>'Health & Fitness','desc'=>'Fitness Tracker Tool','href'=>'health.fitness'],
                        ['name'=>'Scientific Calculator','desc'=>'Scientific Calculations','href'=>'scientificcalculator'],
                        ['name'=>'Tax calculator','desc'=>'Smart Tax Calculator','href'=>'finance.income_tax'],
                        ['name'=>'BMI','desc'=>'Body Mass Index','href'=>'fitness.bmi'],

                        ];
                        @endphp
                        @foreach($quick as $c)
                        <a href="{{ route($c['href']) }}" class="group rounded-xl border border-slate-200 bg-white p-4 hover:shadow-card transition dark:bg-slate-900 dark:border-slate-700">
                            <div class="font-semibold">{{ $c['name'] }}</div>
                            <div class="text-xs text-slate-500">{{ $c['desc'] }}</div>
                            <div class="mt-3 text-brand text-sm opacity-0 group-hover:opacity-100 transition">Open →</div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Calculators -->
    {{-- your existing section (unchanged except data-open-form + href="#") --}}
    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold">Featured Calculators</h2>
            <a href="{{ url('/calculators') }}" class="text-sm text-brand hover:underline">View all</a>
        </div>

        @php
        $featured = [
        ['id'=>'openSciCalc','title'=>'Open Scientific Calculator','tag'=>'calculator','summary'=>'Open Scientific Calculator','name'=>'Open Scientific Calculator','data'=>'sciCalcModal'],
        ['id'=>'openPopupSalaryCalculator','title'=>'Salary Calculator','tag'=>'Salary','summary'=>'Salary Calculator','name'=>'Open Salary Calculator','data'=>'popupSalaryCalculator'],
        ['id'=>'openPopupRentCalculator','title'=>'Rent Calculator','tag'=>'Rent','summary'=>'Rent Category','name'=>'Open Rent Calculator','data'=>'popupRentCalculator'],
        ['id'=>'openPopupDepreciationCalculator','title'=>'Depreciation Calculator','tag'=>'Depreciation','summary'=>'Check your BMI & category','name'=>'Open Depreciation Calculator','data'=>'popupDepreciationCalculator'],
        ['id'=>'openPopupMortgageCalculator','title'=>'Mortgage Calculator','tag'=>'Mortgage','summary'=>'Mortgage Calculator','name'=>'Open Mortgage Calculator','data'=>'popupMortgageCalculator'],
        ['id'=>'openPopupVolumeConverter','title'=>'volume Calculator','tag'=>'volume','summary'=>'volume converter','name'=>'Open Volume Converter','data'=>'popupVolumeConverter'],
        ['id'=>'openPopupTimeConverter','title'=>'Time Calculator','tag'=>'Time','summary'=>'Time Converter','name'=>'Open Time Converter','data'=>'popupTimeConverter'],

        ['id'=>'openPopupTemperatureConverter','title'=>'Temperature Calculator','tag'=>'Temperature','summary'=>'Temperature Converter','name'=>'Open Temperature Converter ','data'=>'popupTemperatureConverter'],
        ['id'=>'openPopupWeightConverter','title'=>'Weight Calculator','tag'=>'Weight','summary'=>'weight converter','name'=>'Open Weight Converter','data'=>'popupWeightConverter'],
        ['id'=>'openPopupAreaConverterNew','title'=>'Area Converter','tag'=>'Area','summary'=>'Calculate area','name'=>'Open Area Converter','data'=>'popupAreaConverterNew'],
        ['id'=>"openPopupLengthConverter",'title'=>'Length Converter','tag'=>'length','summary'=>'Convert Length','name'=>'Open length Calculator','data'=>'popupLengthConverter'],
        ['id'=>'openPopupTaxCalculator','title'=>'Tax Calculator','tag'=>'Income Tax','summary'=>'Check your BMI & category','name'=>'Open tax Calculator','data'=>'popupTaxCalculator'],

        ];
        @endphp


        <x-card :featured="$featured" />


        @php

        $categories =[
        ['name'=>'Fitness','url'=>'health.fitness'],
        ['name'=>'Finance','url'=>'tax.finance'],
        ['name'=>'Converters','url'=>'math.measurement'],
        ];
        @endphp
        <!-- Categories carousel -->
        <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            <h2 class="text-xl font-bold mb-3">Categories</h2>
            <div class="flex gap-3 overflow-x-auto pb-2">
                @foreach ( $categories as $cat)
                <a href="{{ route($cat['url']) }}"
                    class="shrink-0 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm hover:border-brand/30 hover:bg-white transition dark:bg-slate-800 dark:border-slate-700">
                    {{ $cat['name'] }}
                </a>
                @endforeach
            </div>
        </section>

        <!-- Why BRAND -->
        <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
            <h2 class="text-xl font-bold mb-4">Why QuickCalculateIt</h2>
            <div class="grid gap-4 md:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-card dark:bg-slate-800 dark:border-slate-700">
                    <div class="font-semibold mb-1">Accuracy</div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Well-tested formulas and unit handling.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-card dark:bg-slate-800 dark:border-slate-700">
                    <div class="font-semibold mb-1">Speed (AJAX)</div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Instant results with debounced requests.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-card dark:bg-slate-800 dark:border-slate-700">
                    <div class="font-semibold mb-1">Privacy</div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">permanent storage for history; sync when logged in.</p>
                </div>
            </div>
        </section>
        <!-- <button id="openSciCalc" data-modal-target='sciCalcModal'>dfdfdfdfd</button> -->


        <x-scientificcalculator />

        <x-lengthmodel />
        <x-areamodel />
        <x-weightmodel />
        <x-temperaturemodel />
        <x-timemodel />
        <x-volumemodel />
        <x-depreciationmodel />
        <x-rentmodel />
        <x-salarymodel />
        <x-incometax />
        <x-mortgagemodel />


</main>



<script>
    // --- helpers ---
    const toSel = (id) => (id && id[0] === '#') ? id : ('#' + id);

    const showModal = (id) => {
        const $el = $(toSel(id));
        if (!$el.length) return;
        $el.removeClass("hidden opacity-0 pointer-events-none").attr("aria-hidden", "false");
        $("body").css("overflow", "hidden");
    };

    const hideModal = ($el) => {
        if (!$el || !$el.length) return;
        $el.addClass('hidden opacity-0 pointer-events-none').attr("aria-hidden", "true");
        $('body').css('overflow', '');
    };

    // --- open from any button with data-modal-target ---
    $(document).on('click', '[data-modal-target]', function(e) {
        e.preventDefault();
        const id = $(this).attr('data-modal-target');
        console.log(id)
        showModal(id);
    });

    // --- close on any element with data-close-modal ---
    $(document).on('click', '[data-close-modal]', function() {
        const $wrapper = $(this).closest('.fixed.inset-0.z-\\[999\\]');
        hideModal($wrapper);
    });

    // --- close on backdrop click (click exactly on the wrapper) ---
    $(document).on('click', '.fixed.inset-0.z-\\[999\\]', function(e) {
        // if you clicked the wrapper itself (not inner content), close it
        if ($(e.target).is(this)) {
            hideModal($(this));
        }
    });

    // --- ESC to close the topmost open modal ---
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            const $open = $('.fixed.inset-0.z-\\[999\\]').not('.hidden').first();
            if ($open.length) hideModal($open);
        }
    });
</script>



<script src="assets/js/header.js"></script>



<x-appfooter></x-appfooter>