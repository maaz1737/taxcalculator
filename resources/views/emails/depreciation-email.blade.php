<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depreciation Calculation Result</title>
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
            max-width: 700px;
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
            margin-top: 8px;
            color: #6b7280;
            font-size: 14px;
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

        th,
        td {
            padding: 12px 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            text-align: left;
        }

        th {
            background-color: #2563eb;
            color: white;
            font-weight: 600;
        }

        td:first-child {
            font-weight: 600;
            color: #374151;
        }

        tr:last-child td {
            border-bottom: none;
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

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <h1>📉 Depreciation Calculation Result</h1>
            <p>Hello <strong>{{ $username ?? 'User' }}</strong>, here’s the summary of your depreciation calculation.</p>
            <span class="badge">Depreciation Calculator</span>
        </div>

        <h3>Calculation Details</h3>
        <table>
            <tr>
                <td>Asset Cost</td>
                <td>Rs. {{ number_format($depreciationResult->cost ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td>Salvage Value</td>
                <td>Rs. {{ number_format($depreciationResult->salvage ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td>Method</td>
                <td>{{ ucfirst(str_replace('_', ' ', $depreciationResult->method ?? 'N/A')) }}</td>
            </tr>
            <tr>
                <td>Useful Life (Years)</td>
                <td>{{ $depreciationResult->years ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Switch to Straight Line</td>
                <td>{{ $depreciationResult->ddb_switch_to_sl ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <td>Rounding</td>
                <td>{{ $depreciationResult->round ?? 'N/A' }}</td>
            </tr>
        </table>

        @if(!empty($yearlyResult['schedule']))
        <h3>Yearly Depreciation Schedule</h3>
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Depreciation</th>
                    <th>Accumulated</th>
                    <th>Book Value</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach($yearlyResult['schedule'] as $year)
                <tr>
                    <td>{{ $year['year'] ?? '—' }}</td>
                    <td>Rs. {{ number_format($year['depreciation'] ?? 0, 2) }}</td>
                    <td>Rs. {{ number_format($year['accumulated'] ?? 0, 2) }}</td>
                    <td>Rs. {{ number_format($year['book_value'] ?? 0, 2) }}</td>
                    <td>{{ $year['note'] ?? '—' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <div class="footer">
            Sent on {{ $depreciationResult->created_at->format('d M Y, h:i A') }}
        </div>
    </div>
</body>

</html>