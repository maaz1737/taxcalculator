<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pricing – $4.89 Plan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.stripe.com/v3/"></script>


</head>

<body class="bg-gradient-to-br from-emerald-50 to-slate-100 dark:from-slate-900 dark:to-slate-800 text-gray-900 dark:text-gray-100">

    <!-- Pricing Section -->
    <section class="max-w-6xl mx-auto px-6 py-20">

        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-extrabold mb-4">Simple & Transparent Pricing</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                One affordable plan with everything you need. No hidden fees, cancel anytime.
            </p>
        </div>

        <!-- Pricing Card -->
        <div class="flex justify-center">
            <div class="relative bg-white dark:bg-slate-700 rounded-3xl shadow-xl border border-emerald-200 dark:border-slate-600 w-full max-w-md p-8">

                <!-- Badge -->
                <span class="absolute -top-4 left-1/2 -translate-x-1/2 bg-emerald-500 text-white text-sm font-semibold px-4 py-1 rounded-full shadow">
                    Most Popular
                </span>

                <!-- Plan Name -->
                <h2 class="text-2xl font-bold text-center mb-2">Premium Access</h2>
                <p class="text-center text-gray-500 dark:text-gray-300 mb-6">
                    Perfect for individuals & small teams
                </p>

                <!-- Price -->
                <div class="text-center mb-8">
                    <span class="text-5xl font-extrabold">$4.89</span>
                    <span class="text-gray-500 dark:text-gray-300">/month</span>
                </div>

                <!-- Features -->
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center gap-3">
                        <span class="text-emerald-500">✔</span>
                        <span>Unlimited access to all tools</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-emerald-500">✔</span>
                        <span>Real-time updates & features</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-emerald-500">✔</span>
                        <span>High-speed performance</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-emerald-500">✔</span>
                        <span>Email support</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-emerald-500">✔</span>
                        <span>Cancel anytime</span>
                    </li>
                </ul>

                <!-- CTA Button -->
                <button id="checkout-button" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-lg transition">
                    Get Started for $4.89
                </button>

                <!-- Small Note -->
                <p class="text-center text-sm text-gray-500 dark:text-gray-400 mt-4">
                    Secure payment • Instant access
                </p>
            </div>
        </div>

    </section>

</body>

</html>


<script>
    const stripe = Stripe("{{ config('services.stripe.key') }}");

    document.getElementById("checkout-button").addEventListener("click", function() {
        fetch("/create-checkout-session", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
            })
            .then(response => response.json())
            .then(session => {
                console.log(session);
                return stripe.redirectToCheckout({
                    sessionId: session.id
                })
            })
            .catch(error => alert("Error: " + error.message));
    });
</script>