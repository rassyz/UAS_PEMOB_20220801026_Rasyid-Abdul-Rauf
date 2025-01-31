<?php

namespace App\Filament\Admin\Resources\ClientResource\Api\Handlers;

use App\Filament\Admin\Resources\ClientResource;
use App\Filament\Admin\Resources\ClientResource\Api\Requests\CreateClientRequest;
use Rupadana\ApiService\Http\Handlers;

class CreateHandler extends Handlers
{
    public static ?string $uri = '/';

    public static ?string $resource = ClientResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }

    /**
     * Create Client
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateClientRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, 'Successfully Create Resource');
    }
}
