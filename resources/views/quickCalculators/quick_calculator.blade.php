<x-app
    :title="'Quick Calculator - Access Most Used Calculators Instantly'"
    :des="'Use our advanced scientific calculator online for free. Perform complex calculations like trigonometric, logarithmic, and exponential functions instantly and easily.'"
    :key="'Use our Quick Calculator button for instant access to the most commonly used calculators for basic, scientific, financial, and more functions.'" />


<div class="bg-emerald-50 dark:bg-slate-900/30 min-h-[70vh] flex items-center justify-center">
    <div class="rounded-2xl border border-red-300 bg-red-100/30 p-6 shadow-card dark:bg-slate-800 dark:border-slate-700 w-[100%] lg:max-w-[70%] mx-auto">
        <div class="text-xl text-slate-500 mb-4">Quick Access</div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            @php
            $quick = [
            ['name'=>'length Converter','desc'=>'length Conversion Calculator','href'=>'length'],
            ['name'=>'Tax calculator','desc'=>'Smart Tax Calculator','href'=>'finance.income_tax'],

            ['name'=>'Wight Calculator','desc'=>'Weight Conversion Calculator','href'=>'weight'],
            ['name'=>'Scientific Calculator','desc'=>'Scientific Calculations','href'=>'scientificcalculator'],
            ['name'=>'BMI','desc'=>'Body Mass Index','href'=>'fitness.bmi'],

            ];
            @endphp
            @foreach($quick as $c)
            <a href="{{ route($c['href']) }}" class="group rounded-xl border  border-red-300 bg-red-100 p-4 hover:shadow-card transition dark:bg-slate-900 dark:border-slate-700">
                <div class="font-semibold">{{ $c['name'] }}</div>
                <div class="text-xs text-slate-500">{{ $c['desc'] }}</div>
                <div class="mt-3 text-brand text-sm opacity-0 group-hover:opacity-100 transition">Open →</div>
            </a>
            @endforeach
        </div>
    </div>
</div>


<x-appfooter></x-appfooter>