<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Models\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Stripe\Checkout\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StripePaymentController extends Controller
{
    public function checkout()
    {
        return view('stripe.payment');
    }

    public function session()
    {
        \Stripe\Stripe::setApiKey(config('stripe.secret_api_key'));

        $session = Session::create([
           'line_items' => [
               [
                   'price_data' => [
                       'currency'     => 'gbp',
                       'product_data' => [
                           'name' => 'gimme money!!!!',
                       ],
                       'unit_amount'  => 500,
                   ],
                   'quantity'   => 1,
               ],
           ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);
        return redirect()->away($session->url);
    }

    public function success()
    {
        return "Works";
    }

    public function webhook()
    {
        // Set your endpoint secret
        $endpointSecret = config('stripe.webhook_key');

        // Get the payload from the request
        $payload = @file_get_contents('php://input');
        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;
//        dd($payload);
        try {
            // Verify the webhook signature
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sigHeader, $endpointSecret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }
        Log::error('tst');

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                // Payment successful

//                $userId = $event->data->object->customer;
//                User::where('stripe_customer_id', $userId)->update(['payment' => 1]);
//                $user = Auth::user();
//
//                if ($user) {
//                    $user->update(['payment' => 1]);
//                }

                $session = $event->data->object;

                $user = User::where('session_id', $session->id)->first();
                if ($user && $user->payment === 0) {
                    $user->payment = 1;
                    $user->save();
                }

                return response('Payment Successful');

            // Add additional cases for other event types if needed

            default:
                return response('');
        }
    }
}
