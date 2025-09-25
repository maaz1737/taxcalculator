<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Fitness & Health</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <div class="container mx-auto max-w-3xl px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Fitness & Health Calculators</h1>
        <ul class="list-disc pl-6 space-y-2">
            <li><a class="text-blue-600 underline" href="{{ route('fitness.bmi') }}">BMI & Healthy Weight</a></li>
            {{-- Add more links as you build pages --}}
        </ul>
    </div>
</body>

</html>