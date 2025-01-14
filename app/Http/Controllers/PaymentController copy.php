<?php
// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\CoreApi;
use App\Models\Penyewa;
use Midtrans\Config;
use Midtrans\Midtrans;


class PaymentController extends Controller
{
    // Menampilkan halaman pembayaran
    public function index()
    {
        return view('backend.v_payment.index');
    }
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_ENV') === 'production';
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
    // Menangani proses pembayaran
    public function charge(Request $request)
    {
        $order_id = $request->input('order_id');
        $total_biaya = $request->input('total_biaya');
        $nama_penyewa = $request->input('nama_penyewa');

        // Create transaction
        $transaction_details = array(
            'order_id' => $order_id,
            'gross_amount' => $total_biaya,
        );

        $item_details = array(
            array(
                'id' => 'item1',
                'price' => $total_biaya,
                'quantity' => 1,
                'name' => 'Payment for ' . $nama_penyewa
            ),
        );

        $customer_details = array(
            'first_name'    => $nama_penyewa,
            'email'         => 'email@example.com',
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'        => $item_details,
            'customer_details'    => $customer_details,
        );

        // Get snap token
        try {
            $snapToken = Snap::getSnapToken($transaction_data);
        } catch (\Exception $e) {
            // Handle error, log it, or return a response
            return response()->json(['error' => $e->getMessage()]);
        }

        return view('backend.v_payment.payment_page', compact('snapToken'));
    }
}



