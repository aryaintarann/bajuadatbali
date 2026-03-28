<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;

class PaymentController extends Controller
{
    /**
     * Handle Midtrans payment notification (webhook)
     */
    public function notificationHandler(Request $request)
    {
        $notification = $request->all();

        Log::info('Midtrans Notification:', $notification);

        $orderId       = $notification['order_id'] ?? null;
        $transStatus   = $notification['transaction_status'] ?? null;
        $fraudStatus   = $notification['fraud_status'] ?? null;

        if (!$orderId || !$transStatus) {
            return response()->json(['message' => 'Invalid notification'], 400);
        }

        // Find order by midtrans order_id
        $order = Order::where('order_id_midtrans', $orderId)->first();

        if (!$order) {
            Log::warning('Order not found for notification:', ['order_id' => $orderId]);
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Update status based on transaction_status
        if ($transStatus === 'capture') {
            $order->status = ($fraudStatus === 'challenge') ? 'pending' : 'paid';
        } elseif ($transStatus === 'settlement') {
            $order->status = 'paid';
        } elseif (in_array($transStatus, ['cancel', 'deny', 'expire'])) {
            $order->status = 'cancelled';
        } elseif ($transStatus === 'pending') {
            $order->status = 'pending';
        }

        $order->save();

        Log::info('Order status updated:', ['order_id' => $orderId, 'status' => $order->status]);

        return response()->json(['message' => 'Notification handled'], 200);
    }
}
