<?php

namespace App\Http\Resources\V1\Auth;

use App\Http\Resources\V1\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticatesSessions extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->user->id,
            'name' => $this->name,
            'rol' => $this->rol,
            'orders' => OrderResource::collection($this->orders)
        ];
    }
}
