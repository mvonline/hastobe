<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class rateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'overall' => $request['overall'],
            'components' => [
                'energy' => $request['energyPrice'],
                'time' => $request['timePrice'],
                'transaction' => $request['transactionPrice'],
            ],
        ];
    }
}
