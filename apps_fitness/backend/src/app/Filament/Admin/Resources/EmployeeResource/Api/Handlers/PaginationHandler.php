<?php

namespace App\Filament\Admin\Resources\EmployeeResource\Api\Handlers;

use App\Filament\Admin\Resources\EmployeeResource;
use App\Filament\Admin\Resources\EmployeeResource\Api\Transformers\EmployeeTransformer;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

class PaginationHandler extends Handlers
{
    public static ?string $uri = '/';

    public static ?string $resource = EmployeeResource::class;

    /**
     * List of Employee
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
            ->with(['user'])
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->allowedIncludes($this->getAllowedIncludes() ?? [])
            ->paginate(request()->query('per_page'))
            ->appends(request()->query());

        return EmployeeTransformer::collection($query);
    }
}
