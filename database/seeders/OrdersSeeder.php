<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        $order1 = Order::create([
            'user_id' => 1,
            'order_code' => 'ORD01',
            'total_price' => 0,
            'status' => 'pending',
        ]);

        $order1->items()->create([
            'produk_id' => 1,
            'quantity' => 2,
            'unit_price' => 75000,
            'subtotal' => 2 * 75000,
        ]);

        $order1->update([
            'total_price' => $order1->items->sum('subtotal')
        ]);

        // Order 2
        $order2 = Order::create([
            'user_id' => 2,
            'order_code' => 'ORD02',
            'total_price' => 0,
            'status' => 'paid',
        ]);

        $order2->items()->create([
            'produk_id' => 2,
            'quantity' => 1,
            'unit_price' => 250000,
            'subtotal' => 250000,
        ]);

        $order2->update([
            'total_price' => $order2->items->sum('subtotal')
        ]);

        // Order 3
        $order3 = Order::create([
            'user_id' => 3,
            'order_code' => 'ORD03',
            'total_price' => 0,
            'status' => 'shipped',
        ]);

        $order3->items()->create([
            'produk_id' => 3,
            'quantity' => 1,
            'unit_price' => 350000,
            'subtotal' => 350000,
        ]);

        $order3->update([
            'total_price' => $order3->items->sum('subtotal')
        ]);
    }
}