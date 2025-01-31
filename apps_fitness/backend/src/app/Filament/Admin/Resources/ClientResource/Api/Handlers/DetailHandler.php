<?php

namespace App\Filament\Admin\Resources\ClientResource\Api\Handlers;

use App\Filament\Admin\Resources\ClientResource;
use App\Filament\Admin\Resources\ClientResource\Api\Transformers\ClientTransformer;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

class DetailHandler extends Handlers
{
    public static ?string $uri = '/{id}';

    public static ?string $resource = ClientResource::class;

    /**
     * Show Client
     *
     * @return ClientTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');

        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (! $query) {
            return static::sendNotFoundResponse();
        }

        return new ClientTransformer($query);
    }
}
