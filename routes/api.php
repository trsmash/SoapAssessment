<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserWorkspacesController;
use App\Http\Controllers\Api\UserChannelsController;
use App\Http\Controllers\Api\Auth\Controller as AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\WorkspaceChannelsController;
use App\Http\Controllers\Api\ChannelMessagesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('guest')->group(function () {
    Route::post('register', RegisterController::class);
    Route::post('login', [AuthController::class, 'authenticate']);
});
Route::middleware('auth:api')->group(function () {
    Route::get('user', function (\Illuminate\Http\Request $request) {
       return $request->user();
    });
    Route::post('update/token', [AuthController::class, 'updateToken']);
    Route::apiResource('users.workspaces', UserWorkspacesController::class)->only(['index', 'store']);
    Route::apiResource('workspace.channels', WorkspaceChannelsController::class)->only(['index', 'store']);
    Route::apiResource('channels.messages', ChannelMessagesController::class)->only('store');
    Route::get('channels/{channel}/users/{user}/invite', [UserChannelsController::class, 'invite']);
});
