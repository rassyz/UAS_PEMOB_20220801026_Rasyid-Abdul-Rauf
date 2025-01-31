<?php

namespace App\Filament\Admin\Resources\PelatihanResource\Api\Transformers;

use App\Models\Pelatihan;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Pelatihan $resource
 */
class PelatihanTransformer extends JsonResource
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
