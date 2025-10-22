<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Calculation Result</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 20px;
        }

        .wrapper {
            background: #ffffff;
            border-radius: 12px;
            max-width: 650px;
            margin: 0 auto;
            padding: 25px 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #e5e7eb;
        }

        .header h1 {
            margin: 0;
            color: #2563eb;
            font-size: 26px;
        }

        .header p {
            margin-top: 4px;
            color: #6b7280;
            font-size: 14px;
        }

        h3 {
            margin-top: 30px;
            font-size: 18px;
            color: #111827;
            border-left: 4px solid #2563eb;
            padding-left: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            background: #f9fafb;
            border-radius: 8px;
            overflow: hidden;
        }

        td {
            padding: 12px 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        td:first-child {
            font-weight: 600;
            color: #374151;
            width: 45%;
            text-transform: capitalize;
        }

        td:last-child {
            color: #111827;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            color: #fff;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            margin-top: 8px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #9ca3af;
        }

        .highlight-box {
            background: linear-gradient(90deg, #eff6ff, #dbeafe);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
        }

        .highlight-box span {
            font-size: 16px;
            font-weight: bold;
            color: #1d4ed8;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <h1>🏋️‍♂️ Fitness Calculator Result</h1>
            <h3 style="margin-top: 4px;">Hello {{ $username }}</h3>
            <p>Here are your personalized fitness results.</p>
            <span class="badge">{{ ucfirst($fitnessResult->calc_type ?? 'Unknown') }}</span>
        </div>

        @if(!empty($fitnessResult->inputs))
        <h3>Inputs</h3>
        <table>
            @foreach($fitnessResult->inputs as $key => $value)
            <tr>
                <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                <td>{{ $value ?? '—' }}</td>
            </tr>
            @endforeach
        </table>
        @endif

        @if(!empty($fitnessResult->outputs))
        <h3>Results</h3>
        <table>
            @foreach($fitnessResult->outputs as $key => $value)
            <tr>
                <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                <td>{{ $value ?? '—' }}</td>
            </tr>
            @endforeach
        </table>

        {{-- Optional highlight section for main result --}}
        @php
        $mainValue = collect($fitnessResult->outputs)->first();
        @endphp

        @if($mainValue)
        <div class="highlight-box">
            <span>✨ Main Result: {{ $mainValue }}</span>
        </div>
        @endif
        @endif

        <div class="footer">
            Sent on {{ $fitnessResult->created_at->format('d M Y, h:i A') }}
        </div>
    </div>
</body>

</html>