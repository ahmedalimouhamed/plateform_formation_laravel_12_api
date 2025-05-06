<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\MediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::post('/login', function(Request $request){
    $user = User::where('email', $request->email)->first();

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $token = $user->createToken('auth-token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ]);
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user/notifications', function () {return Auth::user()->notifications; });

    Route::apiResource('courses', CourseController::class);
    Route::apiResource('tags', TagController::class)->only(['index', 'store']);
    
    Route::post('courses/{course}/lessons', [LessonController::class, 'store']);
    Route::post('courses/{course}/tags', [CourseController::class, 'attachTags']);
    Route::post('comments', [CommentController::class, 'store']);
    Route::post('media', [MediaController::class, 'store']);
});


