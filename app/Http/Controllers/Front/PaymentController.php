<?php

namespace App\Http\Controllers\Front;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index(Request $request, $bookingId)
    {
        $booking = Booking::with(['item.brand', 'item.type'])->findOrFail($bookingId);

        return view('payment', [
            'booking' => $booking
        ]);
    }

    public function update(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->payment_method = $request->payment_method;

        if ($request->payment_method == 'midtrans') {
            \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
            \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
            \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
            \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

            $totalPrice = (int) $booking->total_price;

            $midtransParams = [
                'transaction_details' => [
                    'order_id' => 'TESTING-' . $booking->id . '-' . uniqid(),
                    'gross_amount' => $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => $booking->name,
                    'email' => $booking->user->email,
                ],
                'enabled_payments' => ['gopay', 'bank_transfer'],
                'vtweb' => []
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($midtransParams);

            $booking->save();

            return response()->json([
                'snapToken' => $snapToken
            ]);
        }

        return redirect()->route('front.index');
    }


    public function success(Request $request)
    {
        return view('success');
    }
}
