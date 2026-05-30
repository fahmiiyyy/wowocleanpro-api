<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\ContainerController;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')->group(function(){

    Route::post(
        '/login',
        [AuthController::class,'login']
    );

    Route::middleware('auth:api')
    ->group(function(){

        Route::get(
            '/profile',
            [AuthController::class,'profile']
        );

        Route::post(
            '/logout',
            [AuthController::class,'logout']
        );

        Route::prefix('gateway')
        ->group(function(){

            Route::get(
                '/containers',
                [GatewayController::class,'containers']
            );

            Route::get(
                '/containers/search',
                [ContainerController::class,'search']
            );

            Route::get(
                '/containers/{id}/logs',
                [ContainerController::class,'logs']
            );

            Route::middleware('role:admin')
            ->group(function(){

                Route::post(
                    '/containers',
                    [GatewayController::class,'storeContainer']
                );

                Route::patch(
                    '/containers/{id}/archive',
                    [GatewayController::class,'archive']
                );

                Route::delete(
                    '/containers/{id}',
                    [GatewayController::class,'delete']
                );

            });

        });

    });

});