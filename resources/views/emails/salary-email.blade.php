<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Calculation Result</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            text-align: center;
            padding: 40px 25px;
        }

        .header img {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
            border-radius: 50%;
            background-color: white;
            padding: 5px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 25px 30px;
        }

        .content h2 {
            font-size: 18px;
            color: #111827;
            margin-bottom: 15px;
        }

        .content p {
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #f9fafb;
            border-radius: 8px;
            overflow: hidden;
        }

        .data-table th,
        .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .data-table th {
            background-color: #f3f4f6;
            color: #374151;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .data-table td {
            font-size: 15px;
            color: #1f2937;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: #f3f4f6;
            font-size: 13px;
            color: #6b7280;
        }

        .footer a {
            color: #10b981;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="header">
            <img src="http://quickcalculateit.com/images/staticimages/logo_2.png" alt="QuickCalculateIt Logo">
            <h1>Salary Calculation Summary</h1>
        </div>

        <div class="content">
            <h2>Hello {{ $username ?? 'User' }},</h2>
            <p>Here’s the detailed summary of your recent salary calculation:</p>

            <table class="data-table">
                <tr>
                    <th>Annual Gross Salary</th>
                    <td>Rs. {{ number_format($salaryResult->annual_amount ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <th>After Tax</th>
                    <td>Rs. {{ number_format($salaryResult->after_tax ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <th>Hourly Rate</th>
                    <td>Rs. {{ number_format($salaryResult->hourly ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <th>Weekly Salary</th>
                    <td>Rs. {{ number_format($salaryResult->weekly ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <th>Bi-Weekly Salary</th>
                    <td>Rs. {{ number_format($salaryResult->biweekly ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <th>Monthly Salary</th>
                    <td>Rs. {{ number_format($salaryResult->monthly ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <th>Semi-Monthly Salary</th>
                    <td>Rs. {{ number_format($salaryResult->semimonthly ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <th>Tax</th>
                    <td>Rs. {{ number_format($salaryResult->tax ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <th>Medicare Levy</th>
                    <td>Rs. {{ number_format($salaryResult->medicare_levy ?? 0, 2) }}</td>
                </tr>

            </table>
        </div>

        <div class="footer">
            <p>Thank you for using <strong>QuickCalculateIt</strong> 💡</p>
            <p><a href="quickcalculateit.com/">Visit Website</a></p>
        </div>
    </div>
</body>

</html>