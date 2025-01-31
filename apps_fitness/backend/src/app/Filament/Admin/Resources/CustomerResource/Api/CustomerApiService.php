<?php

namespace App\Filament\Admin\Resources\CustomerResource\Api;

use App\Filament\Admin\Resources\CustomerResource;
use Rupadana\ApiService\ApiService;

class CustomerApiService extends ApiService
{
    protected static ?string $resource = CustomerResource::class;

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
