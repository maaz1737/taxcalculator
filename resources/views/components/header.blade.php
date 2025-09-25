<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $slot }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: ui-sans-serif, system-ui, Arial;
            margin: 0;
            padding: 24px;
            background: #f7f7f8;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 12px;
        }

        label {
            display: block;
            font-size: 12px;
            color: #555;
            margin-bottom: 6px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
        }

        h1 {
            font-size: 22px;
            margin: 0 0 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th,
        td {
            padding: 10px;
            border-top: 1px solid #eee;
            text-align: left;
        }

        .muted {
            color: #6b7280;
            font-size: 13px;
        }

        .result {
            font-size: 28px;
            font-weight: 700;
        }

        .unit {
            font-size: 14px;
            color: #6b7280;
            margin-left: 6px;
        }

        .error {
            color: #b91c1c;
            background: #fee2e2;
            border: 1px solid #fecaca;
            padding: 8px 10px;
            border-radius: 8px;
            display: none;
        }
    </style>
</head>