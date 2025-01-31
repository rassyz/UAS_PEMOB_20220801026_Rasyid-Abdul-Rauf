<?php

namespace App\Filament\Admin\Resources\EmployeeResource\Api\Transformers;

use App\Models\Employee;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Employee $resource
 */
class EmployeeTransformer extends JsonResource
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
