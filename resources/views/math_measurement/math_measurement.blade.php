<x-app
    :title="'Unit Converters – Length, Weight, Volume, Temperature, Area, Time & More | QuickCalculatIt'"
    :des="'QuickCalculatIt offers free online unit converters for length, weight, volume, temperature, area, time, and more. Instantly convert between different units accurately and easily.'"
    :key="'unit converters, length converter, weight converter, volume converter, temperature converter, area converter, time converter, online tools, QuickCalculatIt'" />



<div class="min-h-[400px] bg-emerald-50 dark:bg-slate-900 py-10 px-4">

    {{-- Sticky Header --}}
    <div class="dark:bg-slate-900/80 backdrop-blur-md  mb-1 py-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">🔁 Converters</h1>
        </div>
    </div>

    <div class="max-w-6xl mx-auto text-gray-600 dark:text-gray-400 mb-10">
        <p class="text-sm mx-10">Convert between units quickly — length, weight, temperature, speed, and more.</p>
    </div>

    <div class="max-w-6xl mx-auto grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

        <?php


        $cards_info = [
            ['url' => 'length', 'logo' => '📏', 'heading' => 'Length Converter', 'text' => 'Meters ↔ feet, inches, miles, etc.', 'button' => 'Open Length Converter', 'color' => 'bg-green-100 
                            dark:bg-green-900/30'],
            ['url' => 'weight', 'logo' => '⚖️', 'heading' => 'Weight Converter', 'text' => 'Kg ↔ lb ↔ oz ↔ g.', 'button' => 'Open Weight Converter', 'color' => 'bg-purple-100 
                            dark:bg-purple-900/30'],
            ['url' => 'temperature', 'logo' => '🌡️', 'heading' => 'Temperature Converter', 'text' => '°C ↔ °F ↔ K.', 'button' => 'Open temperature Converter', 'color' => 'bg-pink-100 
                            dark:bg-pink-900/30'],
            ['url' => 'volume', 'logo' => '🧪', 'heading' => 'Volume Converter', 'text' => 'Liters, ml, gallons, cubic units.', 'button' => 'Open volume Converter', 'color' => 'bg-yellow-100 
                            dark:bg-yellow-900/30'],
            ['url' => 'area', 'logo' => '▧', 'heading' => 'Area Converter', 'text' => 'm², ft², acres, hectares.', 'button' => 'Open Area Converter', 'color' => 'bg-blue-100 
                            dark:bg-blue-900/30'],
            ['url' => 'time', 'logo' => '⏱️', 'heading' => 'Time Converter', 'text' => 'Seconds, minutes, hours, days.', 'button' => 'Open Time Converter', 'color' => 'bg-red-100 
                            dark:bg-red-900/30'],

        ];

        ?>



        @foreach ($cards_info as $card)
        <div class="filter-card relative group">
            <a type="button"
                class="fav-btn absolute top-3 right-3 z-10 rounded-full border border-red-300 dark:border-slate-700
                   bg-red-100 dark:bg-slate-900/90 p-2 shadow-sm hover:shadow transition
                   hover:scale-105"
                title="Add to favorites"
                data-id="{{ $card['url'] ?? '' }}"
                data-name="{{ $card['heading'] ?? '' }}"
                data-text="{{ $card['text'] ?? '' }}">
                <svg class="heart-solid w-5 h-5  {{ in_array($card['url'], $calculatorNames) ? 'text-red-500' : 'text-slate-500 dark:text-slate-400' }}" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11.645 20.91l-.007-.003C9.19 19.77 2.25 15.58 2.25 8.98c0-3 2.4-5.23 5.25-5.23 1.9 0 3.51.98 4.5 2.45 1-1.47 2.6-2.45 4.5-2.45 2.85 0 5.25 2.23 5.25 5.23 0 6.6-6.94 10.79-9.39 11.93l-.016.007a.75.75 0 01-.699 0z" />
                </svg>
            </a>

            <a href="{{ route( $card['url']) }}"
                class=" block p-5 rounded-xl border border-yellow-300 dark:border-slate-700
              bg-yellow-200/30 dark:bg-slate-800 hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                <div class="flex items-center gap-3 mb-1">
                    <div class="w-10 h-10 grid place-items-center rounded-lg {{ $card['color'] }}">{{ $card['logo'] }}</div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $card['heading'] }}</h3>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mx-12">{{ $card['text'] }}</p>
                <button class="mx-12 text-brand text-sm pt-4">{{ $card['button'] }} →</button>
            </a>
        </div>
        @endforeach

    </div>
</div>




<x-appfooter></x-appfooter>