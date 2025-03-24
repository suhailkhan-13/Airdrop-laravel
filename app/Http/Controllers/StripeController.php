<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        Log::info('Payment intent request received', $request->all());

        $request->validate([
            'amount' => 'required|numeric|min:50', // Minimum $0.50 USD in cents
            'metadata' => 'sometimes|array', // Optional metadata
            'currency' => 'required|string' // Add currency validation
        ]);

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $paymentIntent = PaymentIntent::create([
                'amount' => round($request->amount), // Ensure integer cents
                'currency' => $request->currency,
                'payment_method_types' => ['card'],
                'metadata' => $request->metadata ?? [],
            ]);

            Log::info('Payment intent created', [
                'id' => $paymentIntent->id,
                'amount' => $paymentIntent->amount,
                'currency' => $paymentIntent->currency
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
                'paymentIntentId' => $paymentIntent->id
            ]);
        } catch (\Exception $e) {
            Log::error('Stripe error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}