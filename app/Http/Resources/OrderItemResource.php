<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'produk_id' => $this->produk_id,
            'produk' => $this->whenLoaded('produk', function () {
                return [
                    'nama' => $this->produk->namaBarang ?? null,
                ];
            }),
            'quantity' => (int) $this->quantity,
            'unit_price' => (float) $this->unit_price,
            'subtotal' => (float) $this->subtotal,
        ];
    }
}