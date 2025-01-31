<?php

namespace App\Filament\Admin\Resources\PelatihanResource\Api\Handlers;

use App\Filament\Admin\Resources\PelatihanResource;
use App\Filament\Admin\Resources\PelatihanResource\Api\Transformers\PelatihanTransformer;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

class DetailHandler extends Handlers
{
    public static ?string $uri = '/{id}';

    public static ?string $resource = PelatihanResource::class;

    /**
     * Show Pelatihan
     *
     * @return PelatihanTransformer
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

        return new PelatihanTransformer($query);
    }
}
