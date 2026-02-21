<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'List Orders',
            'data' => OrderResource::collection($orders)
        ]);
    }

    public function store(StoreOrderRequest $request)
    {
        // valid data dari request
        $data = $request->validated();

        // hitung total dari items (override total_price jika diberikan)
        $itemsInput = $data['items'];
        $calculatedTotal = 0;
        foreach ($itemsInput as $it) {
            $calculatedTotal += (float)$it['quantity'] * (float)$it['unit_price'];
        }

        // buat order
        $order = Order::create([
            'user_id' => $data['user_id'],
            'order_code' => $data['order_code'],
            'total_price' => $calculatedTotal,
            'status' => $data['status'] ?? 'pending',
        ]);

        // siapkan items untuk insert
        $itemsToInsert = [];
        foreach ($itemsInput as $it) {
            $itemsToInsert[] = [
                'produk_id' => $it['produk_id'],
                'quantity' => $it['quantity'],
                'unit_price' => $it['unit_price'],
                'subtotal' => (float)$it['quantity'] * (float)$it['unit_price'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // insert items via relationship
        $order->items()->createMany($itemsToInsert);

        // load items relation for response
        $order->load('items.produk');

        return response()->json([
            'success' => true,
            'message' => 'Order created',
            'data' => new OrderResource($order),
        ], 201);
    }
    
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => new OrderResource($order)
        ]);
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Order updated',
            'data' => new OrderResource($order)
        ]);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order deleted'
        ]);
    }
}