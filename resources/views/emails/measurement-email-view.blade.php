<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculation Result</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background-color: #ffffff;
            margin: 40px auto;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid #eaeaea;
        }

        .header {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
            padding: 24px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 32px 28px;
            text-align: center;
        }

        .content h3 {
            color: #6b7280;
            margin-bottom: 8px;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .content h2 {
            color: #111827;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .result-box {
            background-color: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            margin-top: 25px;
        }

        .result-value {
            font-size: 26px;
            color: #2563eb;
            font-weight: bold;
        }

        .footer {
            background-color: #f3f4f6;
            padding: 16px;
            text-align: center;
            color: #9ca3af;
            font-size: 14px;
        }

        .unit {
            color: #374151;
            font-weight: 500;
        }
    </style>
</head>

<body>
    @php
    $Conversion_units = [
    'mm' => 'Millimeter',
    'cm' => 'Centimeter',
    'm' => 'Meter',
    'km' => 'Kilometer',
    'in' => 'Inch',
    'ft' => 'Foot',
    'yd' => 'Yard',
    'mi' => 'Mile',
    'mm2' => 'Square Millimeter',
    'cm2' => 'Square Centimeter',
    'm2' => 'Square Meter',
    'km2' => 'Square Kilometer',
    'in2' => 'Square Inch',
    'ft2' => 'Square Foot',
    'yd2' => 'Square Yard',
    'mi2' => 'Square Mile',
    'acre' => 'Acre',
    'hectare' => 'Hectare',
    'C' => 'Celsius',
    'F' => 'Fahrenheit',
    'K' => 'Kelvin',
    'ug' => 'Microgram',
    'mg' => 'Milligram',
    'g' => 'Gram',
    'kg' => 'Kilogram',
    't' => 'Metric Tonne',
    'ct' => 'Carat',
    'oz' => 'Ounce',
    'lb' => 'Pound',
    'st' => 'Stone',
    'ton_us' => 'US Ton',
    'ton_uk' => 'UK Ton',
    'gr' => 'Grain',
    'dr' => 'Dram',
    'yr' => 'Year',
    'mo' => 'Month',
    'week' => 'Week',
    'day' => 'Day',
    'h' => 'Hour',
    'min' => 'Minute',
    's' => 'Second',
    'ms' => 'Millisecond',
    'us' => 'Microsecond',
    'ns' => 'Nanosecond',
    'ml' => 'Milliliter',
    'l' => 'Liter',
    'm3' => 'Cubic Meter',
    'tsp_us' => 'US Teaspoon',
    'tbsp_us' => 'US Tablespoon',
    'floz_us' => 'US Fluid Ounce',
    'cup_us' => 'US Cup',
    'pt_us' => 'US Pint',
    'qt_us' => 'US Quart',
    'gal_us' => 'US Gallon',
    'tsp_metric' => 'Metric Teaspoon',
    'tbsp_metric' => 'Metric Tablespoon',
    'cup_metric' => 'Metric Cup',
    'floz_imp' => 'Imp Fluid Ounce',
    'pt_imp' => 'Imp Pint',
    'qt_imp' => 'Imp Quart',
    'gal_imp' => 'Imp Gallon',
    'in3' => 'Cubic Inch (in³)',
    'ft3' => 'Cubic Foot (ft³)',
    'yd3' => 'Cubic Yard (yd³)',
    ];
    @endphp

    <div class="container">
        <div class="header flex items-center">
            <img width='40px' src="{{ $message->embed(public_path('images/staticimages/logo_2.png')) }}" alt="Logo">
            <h1>Quick Calculate It</h1>
        </div>

        <div class="content">
            <h3>Conversion Summary</h3>
            <h2>
                {{ $Conversion_units[$result->from_unit] ?? $result->from_unit }}
                →
                {{ $Conversion_units[$result->to_unit] ?? $result->to_unit }}
            </h2>

            <div class="result-box">
                <p class="result-value">
                    {{ $result->value }}
                    <span class="unit">{{ $Conversion_units[$result->from_unit] ?? $result->from_unit }}</span>
                    =
                    {{ round($result->result,2) }}
                    <span class="unit">{{ $Conversion_units[$result->to_unit] ?? $result->to_unit }}</span>
                </p>
            </div>
        </div>

        <div class="footer">
            <p>Thank you for using <strong>QuickCalculateIt</strong> 💡</p>
            <p><a href="{{ url('/') }}">Visit Website</a></p>
        </div>
    </div>
</body>

</html>