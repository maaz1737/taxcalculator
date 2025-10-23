<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Stripe Checkout</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f0f4ff, #e1ecff);
            font-family: 'Inter', sans-serif;
        }

        .checkout-box {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            padding: 40px 50px;
            text-align: center;
            max-width: 380px;
            width: 90%;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(200, 200, 255, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .checkout-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.12);
        }

        h2 {
            margin-bottom: 10px;
            font-size: 22px;
            color: #1e293b;
        }

        p {
            font-size: 14px;
            color: #475569;
            margin-bottom: 30px;
        }

        #checkout-button {
            padding: 12px 28px;
            font-size: 15px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: white;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        #checkout-button:hover {
            background: linear-gradient(135deg, #4338ca, #4f46e5);
            transform: scale(1.03);
        }

        #checkout-button:active {
            transform: scale(0.98);
        }
    </style>
</head>

<body>
    <div class="checkout-box">
        <h2>Buy <span style="color:#4f46e5;">QuickCalculateIt Pro </span> Plan</h2>
        <p>Get full access to advanced features for just <strong>$4.89</strong></p>
        <button id="checkout-button">Pay Now</button>
    </div>

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