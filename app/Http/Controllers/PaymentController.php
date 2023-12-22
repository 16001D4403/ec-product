<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // protected $razorpay;

    // public function __construct()
    // {
    //     $this->razorpay = new Api(config('services.razorpay.key_id'), config('services.razorpay.key_secret'));
    // }
    

    public function createOrder()
    {
        return view('payments.create');
        // try {
        //     // Debug statement 1
        //     Log::info('Attempting to create order...');

        //     // Your logic to create an order on Razorpay and return the order ID
        //     $orderData = [
        //         'amount' => 1000, // Amount in paise (100 paise = 1 INR)
        //         'currency' => 'INR',
        //         'receipt' => 'order_receipt_' . time(),
        //         'payment_capture' => 1, // Auto-capture payment after order creation
        //     ];

        //     // Debug statement 2
        //     Log::info('Order data: ' . json_encode($orderData));

        //     $order = $this->razorpay->order->create($orderData);

        //     // Debug statement 3
        //     Log::info('Order created successfully: ' . json_encode($order));

        //     return view('payments.create', ['order' => $order]);
        // } catch (\Exception $e) {
        //     Log::error('Razorpay API Error: ' . $e->getMessage());
        //     Log::error('Stack Trace: ' . $e->getTraceAsString());
        //     Log::error('Request Data: ' . json_encode($orderData));
        
        //     // Check if the exception has a response
        //     if ($e instanceof \GuzzleHttp\Exception\RequestException && $e->hasResponse()) {
        //         Log::error('Response Data: ' . $e->getResponse()->getBody()->getContents());
        //     }
        
        //     return view('payments.failure', ['error' => 'Error creating order']);
        // }
        
        
    }

    public function handlePayment()
    {
        
        // Your logic to handle the payment response from Razorpay
        // $paymentId = $request->input('razorpay_payment_id');
        // $orderId = $request->input('razorpay_order_id');
        // $signature = $request->input('razorpay_signature');

        // // Verify the payment signature
        // $attributes = [
        //     'razorpay_order_id' => $orderId,
        //     'razorpay_payment_id' => $paymentId,
        //     'razorpay_signature' => $signature,
        // ];

        // try {
        //     $this->razorpay->utility->verifyPaymentSignature($attributes);
        //     // Payment successful, update your database or perform other actions

            return view('payments.success');
        // } catch (\Exception $e) {
        //     // Payment failed, handle the error
        //     return view('payments.failure', ['error' => $e->getMessage()]);
        // }
    }
}

