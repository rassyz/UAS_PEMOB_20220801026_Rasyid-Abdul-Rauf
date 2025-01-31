<?php

namespace App\Filament\Admin\Resources\ClientResource\Api\Handlers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\ClientResource;
use App\Filament\Admin\Resources\ClientResource\Api\Transformers\ClientTransformer;

class PaginationHandler extends Handlers
{
    public static ?string $uri = '/';

    public static ?string $resource = ClientResource::class;

    /**
     * List of Client
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query->where('user_id', Auth::id()))
            ->with(['user', 'pelatihans', 'hasilpertandingans', 'rankings'])
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->allowedIncludes($this->getAllowedIncludes() ?? [])
            ->paginate(request()->query('per_page'))
            ->appends(request()->query());

        return ClientTransformer::collection($query);
    }
}
