<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\VoyageController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:api', 'role'])->group(function () {

    // List users
    Route::middleware(['scope:admin,moderator,basic'])->get('/users', function (Request $request) {

        return User::get();
    });

    // Add/Edit User
    Route::middleware(['scope:admin,moderator'])->post('/user', function(Request $request) {

        return User::create($request->all());
    });

    Route::middleware(['scope:admin,moderator'])->put('/user/{userId}', function(Request $request, $userId) {

        try {
            $user = User::findOrFail($userId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found.'
            ], 403);
        }

        $user->update($request->all());

        return response()->json(['message'=>'User updated successfully.']);
    });

    // Delete User
    Route::middleware(['scope:admin'])->delete('/user/{userId}', function(Request $request, $userId) {

        try {
            $user = User::findOfFail($userId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found.'
            ], 403);
        }

        $user->delete();

        return response()->json(['message'=>'User deleted successfully.']);
    });



});


/*
Route::apiResource('voyages', VoyageController::class)->middleware('auth:api');
*/

