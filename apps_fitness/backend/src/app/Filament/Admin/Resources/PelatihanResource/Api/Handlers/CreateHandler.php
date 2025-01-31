<?php

namespace App\Filament\Admin\Resources\PelatihanResource\Api\Handlers;

use App\Filament\Admin\Resources\PelatihanResource;
use App\Filament\Admin\Resources\PelatihanResource\Api\Requests\CreatePelatihanRequest;
use Rupadana\ApiService\Http\Handlers;

class CreateHandler extends Handlers
{
    public static ?string $uri = '/';

    public static ?string $resource = PelatihanResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }

    /**
     * Create Pelatihan
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePelatihanRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, 'Successfully Create Resource');
    }
}
