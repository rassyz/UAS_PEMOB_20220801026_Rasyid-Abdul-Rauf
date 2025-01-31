<?php

namespace App\Filament\Admin\Resources\PelatihanResource\Api;

use App\Filament\Admin\Resources\PelatihanResource;
use Rupadana\ApiService\ApiService;

class PelatihanApiService extends ApiService
{
    protected static ?string $resource = PelatihanResource::class;

    public static function handlers(): array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class,
        ];

    }
}
