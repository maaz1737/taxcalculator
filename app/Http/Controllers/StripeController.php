<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function checkout()
    {
        return view('stripe.checkout');
    }

    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => 'Pro Calculator Plan'],
                    'unit_amount' => 4.89 * 100,

                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/success?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => url('/cancel'),
        ]);

        return response()->json(['id' => $session->id]);
    }

    public function success(Request $request)
    {
        $user = Auth::user();


        // Store payment record
        Payment::create([
            'user_id' => $user->id,
            'stripe_payment_id' => $request->get('session_id'),
            'plan_name' => 'Pro Calculator Plan',
            'amount' => 4.89,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'is_active' => true,
        ]);

        return 'successfully created';
    }

    public function cancel()
    {
        return response()->json([
            'message' => '❌ Payment cancelled.'
        ]);
    }
}
