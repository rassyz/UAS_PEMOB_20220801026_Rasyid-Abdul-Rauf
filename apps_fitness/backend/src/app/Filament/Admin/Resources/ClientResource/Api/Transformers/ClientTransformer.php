<?php

namespace App\Filament\Admin\Resources\ClientResource\Api\Transformers;

use App\Models\Client;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Client $resource
 */
class ClientTransformer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
