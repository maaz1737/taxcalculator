<?php
return [
    'length' => [
        'base' => 'm',
        'common_targets' => ['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'],
        'units' => [
            'nm' => ['name' => 'Nanometer',   'to_base' => 1e-9],
            'μm' => ['name' => 'Micrometer',  'to_base' => 1e-6], // consider 'um' as ASCII key
            'mm' => ['name' => 'Millimeter',  'to_base' => 1e-3],
            'cm' => ['name' => 'Centimeter',  'to_base' => 1e-2],
            'm'  => ['name' => 'Meter',       'to_base' => 1],
            'km' => ['name' => 'Kilometer',   'to_base' => 1e3],
            'in' => ['name' => 'Inch',        'to_base' => 0.0254],
            'ft' => ['name' => 'Foot',        'to_base' => 0.3048],
            'yd' => ['name' => 'Yard',        'to_base' => 0.9144],
            'mi' => ['name' => 'Mile',        'to_base' => 1609.344],
        ],
    ],

    'area' => [
        'base' => 'm2', // square meter
        'common_targets' => ['mm2', 'cm2', 'm2', 'km2', 'in2', 'ft2', 'yd2', 'mi2', 'acre', 'hectare'],
        'units' => [
            // metric squares
            'mm2'     => ['name' => 'Square Millimeter',  'to_base' => 1e-6],        // (1e-3)^2
            'cm2'     => ['name' => 'Square Centimeter',  'to_base' => 1e-4],        // (1e-2)^2
            'm2'      => ['name' => 'Square Meter',       'to_base' => 1],
            'km2'     => ['name' => 'Square Kilometer',   'to_base' => 1e6],         // (1e3)^2

            // US/customary (exact via (linear factor)^2)
            'in2'     => ['name' => 'Square Inch',        'to_base' => 0.00064516],      // 0.0254^2
            'ft2'     => ['name' => 'Square Foot',        'to_base' => 0.09290304],      // 0.3048^2
            'yd2'     => ['name' => 'Square Yard',        'to_base' => 0.83612736],      // 0.9144^2
            'mi2'     => ['name' => 'Square Mile',        'to_base' => 2589988.110336],  // 1609.344^2

            // land area
            'acre'    => ['name' => 'Acre',               'to_base' => 4046.8564224],
            'hectare' => ['name' => 'Hectare',            'to_base' => 10000],
            // optional
            'are'     => ['name' => 'Are',                'to_base' => 100],
        ],
    ],
    'weight' => [
        'base' => 'kg', // kilograms as canonical base
        'common_targets' => ['mg', 'g', 'kg', 't', 'ct', 'oz', 'lb', 'st', 'ton_us', 'ton_uk'],
        'units' => [
            // metric
            'ug'     => ['name' => 'Microgram',        'to_base' => 1e-9],      // 0.000001 mg
            'mg'     => ['name' => 'Milligram',        'to_base' => 1e-6],
            'g'      => ['name' => 'Gram',             'to_base' => 1e-3],
            'kg'     => ['name' => 'Kilogram',         'to_base' => 1],
            't'      => ['name' => 'Metric Tonne',     'to_base' => 1000],      // 1000 kg

            // gemstones
            'ct'     => ['name' => 'Carat',            'to_base' => 0.0002],    // 1 ct = 0.2 g = 0.0002 kg

            // avoirdupois (US/UK common)
            'oz'     => ['name' => 'Ounce (oz)',       'to_base' => 0.028349523125],      // exact
            'lb'     => ['name' => 'Pound (lb)',       'to_base' => 0.45359237],          // exact
            'st'     => ['name' => 'Stone (st)',       'to_base' => 6.35029318],          // 14 lb

            // tons
            'ton_us' => ['name' => 'US Ton (short)',   'to_base' => 907.18474],           // 2000 lb
            'ton_uk' => ['name' => 'UK Ton (long)',    'to_base' => 1016.0469088],        // 2240 lb

            // optional finer units
            'gr'     => ['name' => 'Grain (gr)',       'to_base' => 0.00006479891],       // 64.79891 mg
            'dr'     => ['name' => 'Dram (avdp)',      'to_base' => 0.0017718451953125],  // 1/16 oz
        ],
    ],
    'temperature' => [
        'base' => 'K',
        'common_targets' => ['C', 'K', 'F'],
        'units' => [
            // vK = (v + add) * mul
            'C' => ['to_base' => ['mul' => 1,   'add' => 273.15]],
            'K' => ['to_base' => ['mul' => 1,   'add' => 0]],
            'F' => ['to_base' => ['mul' => 5 / 9, 'add' => 459.67]],
        ],
    ],
    'volume' => [
        'base' => 'm3', // cubic meter
        'common_targets' => [
            'ml',
            'l',
            'm3',
            'tsp_us',
            'tbsp_us',
            'floz_us',
            'cup_us',
            'pt_us',
            'qt_us',
            'gal_us',
            'tsp_metric',
            'tbsp_metric',
            'cup_metric',
            'floz_imp',
            'pt_imp',
            'qt_imp',
            'gal_imp',
            'in3',
            'ft3',
            'yd3'
        ],
        'units' => [
            // Metric
            'ml'   => ['name' => 'Milliliter (mL)',     'to_base' => 1e-6],
            'l'    => ['name' => 'Liter (L)',           'to_base' => 1e-3],
            'm3'   => ['name' => 'Cubic Meter (m³)',    'to_base' => 1],

            // Cubic length
            'cm3'  => ['name' => 'Cubic Centimeter (cm³)', 'to_base' => 1e-6],        // = 1 mL
            'in3'  => ['name' => 'Cubic Inch (in³)',       'to_base' => 1.6387064e-5], // 0.0254^3
            'ft3'  => ['name' => 'Cubic Foot (ft³)',       'to_base' => 2.8316846592e-2], // 0.3048^3
            'yd3'  => ['name' => 'Cubic Yard (yd³)',       'to_base' => 7.64554857984e-1], // 0.9144^3

            // US customary (liquid)
            'tsp_us'   => ['name' => 'US Teaspoon',        'to_base' => 4.92892159375e-6],
            'tbsp_us'  => ['name' => 'US Tablespoon',      'to_base' => 1.478676478125e-5],
            'floz_us'  => ['name' => 'US Fluid Ounce',     'to_base' => 2.95735295625e-5],
            'cup_us'   => ['name' => 'US Cup',             'to_base' => 2.365882365e-4],
            'pt_us'    => ['name' => 'US Pint (liq)',      'to_base' => 4.73176473e-4],
            'qt_us'    => ['name' => 'US Quart (liq)',     'to_base' => 9.46352946e-4],
            'gal_us'   => ['name' => 'US Gallon (liq)',    'to_base' => 3.785411784e-3],

            // Metric culinary
            'tsp_metric'  => ['name' => 'Metric Teaspoon',     'to_base' => 5e-6],    // 5 mL
            'tbsp_metric' => ['name' => 'Metric Tablespoon',   'to_base' => 1.5e-5],  // 15 mL
            'cup_metric'  => ['name' => 'Metric Cup',          'to_base' => 2.5e-4],  // 250 mL

            // Imperial (UK)
            'floz_imp' => ['name' => 'Imperial Fluid Ounce', 'to_base' => 2.84130625e-5], // 28.4130625 mL
            'pt_imp'   => ['name' => 'Imperial Pint',        'to_base' => 5.6826125e-4],  // 568.26125 mL
            'qt_imp'   => ['name' => 'Imperial Quart',       'to_base' => 1.1365225e-3],
            'gal_imp'  => ['name' => 'Imperial Gallon',      'to_base' => 4.54609e-3],
        ],
    ],
    'time' => [
        'base' => 's', // seconds
        'common_targets' => ['ns', 'us', 'ms', 's', 'min', 'h', 'day', 'week', 'mo', 'yr'],
        'units' => [
            // SI subseconds
            'ns'  => ['name' => 'Nanosecond',   'to_base' => 1e-9],
            'us'  => ['name' => 'Microsecond',  'to_base' => 1e-6],  // display "µs" in UI
            'ms'  => ['name' => 'Millisecond',  'to_base' => 1e-3],
            // base & up
            's'   => ['name' => 'Second',       'to_base' => 1],
            'min' => ['name' => 'Minute',       'to_base' => 60],
            'h'   => ['name' => 'Hour',         'to_base' => 3600],           // 60 min
            'day' => ['name' => 'Day',          'to_base' => 86400],          // 24 h
            'week' => ['name' => 'Week',         'to_base' => 604800],         // 7 d
            // calendar (average Gregorian)
            'mo'  => ['name' => 'Month (avg)',  'to_base' => 2629746],        // 365.2425/12 d
            'yr'  => ['name' => 'Year (avg)',   'to_base' => 31556952],       // 365.2425 d
        ],
    ],


];
