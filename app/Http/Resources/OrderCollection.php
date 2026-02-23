<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => 'List Orders',
            'data' => OrderResource::collection($this->collection),
        ];
    }
}
