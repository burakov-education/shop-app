<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    /**
     * Buy product
     *
     * @param Product $product
     * @return null[]
     */
    public function buy(Product $product): array
    {
        /** @var Order $order */
        $order = auth()->user()->orders()->create([
            'product_id' => $product->id,
            'status' => 'pending',
        ]);
        $payUrl = null;

        try {
            $result = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post('http://kabyvdc-m2.web.ru/public/api/payments', [
                'price' => $product->price,
                'webhook_url' => route('payment-webhook'),
            ])->json();

            $payUrl = $result['pay_url'];

            $order->order_id = $result['order_id'];
            $order->save();
        } catch (\Throwable $th) {}

        return [
            'pay_url' => $payUrl,
        ];
    }

    /**
     * Payment webhook
     *
     * @return Response
     */
    public function webhook(): Response
    {
        /** @var Order $order */
        $order = Order::query()->where('order_id', request()->input('order_id', ''))->first();

        if ($order) {
            $order->status = request()->input('status');
            $order->save();
        }

        return response()->noContent();
    }

    /**
     * Get orders
     *
     * @return AnonymousResourceCollection
     */
    public function orders(): AnonymousResourceCollection
    {
        return OrderResource::collection(auth()->user()->orders);
    }
}
