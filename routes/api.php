<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\UserAttachmentController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    $user = User::query()->get();

    return response()->json([
        'data' => $user
    ]);
})->name('user.test');

Route::name('user.')->group(function () {
    Route::prefix('user')->group(function () {
        Route::post('/{id}/attachment', [UserAttachmentController::class, 'store']);
        Route::delete('/{id}/attachment/{attachmentId}', [UserAttachmentController::class, 'delete']);
        Route::get('/{id}/list-image', [UserAttachmentController::class, 'list']);
    });

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});
Route::post('/message', [MessageController::class, 'store']);
Route::get('/location', [MessageController::class, 'location']);
Route::get('/chat', [ChatController::class, 'fetchMessages']);
Route::post('/{id}/chat', [ChatController::class, 'sendMessage']);

