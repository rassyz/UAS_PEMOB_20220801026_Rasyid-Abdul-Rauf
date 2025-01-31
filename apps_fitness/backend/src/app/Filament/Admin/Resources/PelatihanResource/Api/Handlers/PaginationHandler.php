<?php

namespace App\Filament\Admin\Resources\PelatihanResource\Api\Handlers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\PelatihanResource;
use App\Filament\Admin\Resources\PelatihanResource\Api\Transformers\PelatihanTransformer;

class PaginationHandler extends Handlers
{
    public static ?string $uri = '/';

    public static ?string $resource = PelatihanResource::class;

    /**
     * List of Pelatihan
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
            ->whereHas('client.user', function ($query) {
                $query->where('id', Auth::id());
            })
            ->with(['client', 'employee'])
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->allowedIncludes($this->getAllowedIncludes() ?? [])
            ->paginate(request()->query('per_page'))
            ->appends(request()->query());

        return PelatihanTransformer::collection($query);
    }
}
