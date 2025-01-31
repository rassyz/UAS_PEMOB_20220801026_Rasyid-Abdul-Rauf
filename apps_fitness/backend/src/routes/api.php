<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Product
use App\Filament\Admin\Resources\ProductResource\Api\Handlers\CreateHandler;
use App\Filament\Admin\Resources\ProductResource\Api\Handlers\DeleteHandler;
use App\Filament\Admin\Resources\ProductResource\Api\Handlers\DetailHandler;
use App\Filament\Admin\Resources\ProductResource\Api\Handlers\PaginationHandler;
use App\Filament\Admin\Resources\ProductResource\Api\Handlers\UpdateHandler;

// Customer
use App\Filament\Admin\Resources\CustomerResource\Api\Handlers\CreateHandler as CustomerCreateHandler;
use App\Filament\Admin\Resources\CustomerResource\Api\Handlers\DeleteHandler as CustomerDeleteHandler;
use App\Filament\Admin\Resources\CustomerResource\Api\Handlers\DetailHandler as CustomerDetailHandler;
use App\Filament\Admin\Resources\CustomerResource\Api\Handlers\PaginationHandler as CustomerPaginationHandler;
use App\Filament\Admin\Resources\CustomerResource\Api\Handlers\UpdateHandler as CustomerUpdateHandler;

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->group(function () {
    // Protected route
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Product
    Route::prefix('products')->group(function () {
            Route::post('/', [CreateHandler::class, 'handler'])->name('api.products.create');
            Route::get('/', [PaginationHandler::class, 'handler'])->name('api.products.pagination');
            Route::get('/{id}', [DetailHandler::class, 'handler'])->name('api.products.detail');
            Route::put('/{id}', [UpdateHandler::class, 'handler'])->name('api.products.update');
            Route::delete('/{id}', [DeleteHandler::class, 'handler'])->name('api.products.delete');
    });

    // Customer
    Route::prefix('Customers')->group(function () {
        Route::post('/', [CustomerCreateHandler::class, 'handler'])->name('api.Customers.create');
        Route::get('/', [CustomerPaginationHandler::class, 'handler'])->name('api.Customers.pagination');
        Route::get('/{id}', [CustomerDetailHandler::class, 'handler'])->name('api.Customers.detail');
        Route::put('/{id}', [CustomerUpdateHandler::class, 'handler'])->name('api.Customers.update');
        Route::delete('/{id}', [CustomerDeleteHandler::class, 'handler'])->name('api.Customers.delete');
    });
});
