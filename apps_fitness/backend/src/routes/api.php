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

// Client
use App\Filament\Admin\Resources\ClientResource\Api\Handlers\CreateHandler as ClientCreateHandler;
use App\Filament\Admin\Resources\ClientResource\Api\Handlers\DeleteHandler as ClientDeleteHandler;
use App\Filament\Admin\Resources\ClientResource\Api\Handlers\DetailHandler as ClientDetailHandler;
use App\Filament\Admin\Resources\ClientResource\Api\Handlers\PaginationHandler as ClientPaginationHandler;
use App\Filament\Admin\Resources\ClientResource\Api\Handlers\UpdateHandler as ClientUpdateHandler;

// Employee
use App\Filament\Admin\Resources\EmployeeResource\Api\Handlers\CreateHandler as EmployeeCreateHandler;
use App\Filament\Admin\Resources\EmployeeResource\Api\Handlers\DeleteHandler as EmployeeDeleteHandler;
use App\Filament\Admin\Resources\EmployeeResource\Api\Handlers\DetailHandler as EmployeeDetailHandler;
use App\Filament\Admin\Resources\EmployeeResource\Api\Handlers\PaginationHandler as EmployeePaginationHandler;
use App\Filament\Admin\Resources\EmployeeResource\Api\Handlers\UpdateHandler as EmployeeUpdateHandler;

// Pelatihan
use App\Filament\Admin\Resources\PelatihanResource\Api\Handlers\CreateHandler as PelatihanCreateHandler;
use App\Filament\Admin\Resources\PelatihanResource\Api\Handlers\DeleteHandler as PelatihanDeleteHandler;
use App\Filament\Admin\Resources\PelatihanResource\Api\Handlers\DetailHandler as PelatihanDetailHandler;
use App\Filament\Admin\Resources\PelatihanResource\Api\Handlers\PaginationHandler as PelatihanPaginationHandler;
use App\Filament\Admin\Resources\PelatihanResource\Api\Handlers\UpdateHandler as PelatihanUpdateHandler;

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

    // Client
    Route::prefix('clients')->group(function () {
        Route::post('/', [ClientCreateHandler::class, 'handler'])->name('api.clients.create');
        Route::get('/', [ClientPaginationHandler::class, 'handler'])->name('api.clients.pagination');
        Route::get('/{id}', [ClientDetailHandler::class, 'handler'])->name('api.clients.detail');
        Route::put('/{id}', [ClientUpdateHandler::class, 'handler'])->name('api.clients.update');
        Route::delete('/{id}', [ClientDeleteHandler::class, 'handler'])->name('api.clients.delete');
    });

    // Employee
    Route::prefix('employees')->group(function () {
        Route::post('/', [EmployeeCreateHandler::class, 'handler'])->name('api.employees.create');
        Route::get('/', [EmployeePaginationHandler::class, 'handler'])->name('api.employees.pagination');
        Route::get('/{id}', [EmployeeDetailHandler::class, 'handler'])->name('api.employees.detail');
        Route::put('/{id}', [EmployeeUpdateHandler::class, 'handler'])->name('api.employees.update');
        Route::delete('/{id}', [EmployeeDeleteHandler::class, 'handler'])->name('api.employees.delete');
    });

    // Pelatihan
    Route::prefix('pelatihans')->group(function () {
        Route::post('/', [PelatihanCreateHandler::class, 'handler'])->name('api.pelatihans.create');
        Route::get('/', [PelatihanPaginationHandler::class, 'handler'])->name('api.pelatihans.pagination');
        Route::get('/{id}', [PelatihanDetailHandler::class, 'handler'])->name('api.pelatihans.detail');
        Route::put('/{id}', [PelatihanUpdateHandler::class, 'handler'])->name('api.pelatihans.update');
        Route::delete('/{id}', [PelatihanDeleteHandler::class, 'handler'])->name('api.pelatihans.delete');
    });

});
