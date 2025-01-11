<?php

namespace App\Http\Controllers\UserStudentControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserStudentResources\UserStudentResource;
use App\Http\Requests\UserStudentRequests\{
    UserStudentRegisterRequest,
    UserStudentLoginRequest,
};
use App\Models\UserStudentModels\UserStudent;
use App\Http\Controllers\Controller;
use App\Services\AppResponse;
use Auth;
use Log;

class UserStudentController extends Controller
{
    // User Student Registration
    public function register(UserStudentRegisterRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $validatedData['user_password'] = Hash::make($validatedData['user_password']);
            $userstudent = UserStudent::create($validatedData);

            return AppResponse::success([
                'userstudent' => new UserStudentResource($userstudent),
            ], 'Registration successful.', 201);
        } catch (\Exception $e) {
            Log::error('User Student registration error: ' . $e->getMessage());
            return AppResponse::error('Registration failed. Please try again later.', 500);
        }
    }

    // User Student Login
    public function login(UserStudentLoginRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            $userstudent = UserStudent::where('username', $validatedData['username'])->first();

            if (!$userstudent || !Hash::check($validatedData['user_password'], $userstudent->user_password)) {
                return AppResponse::error('Invalid username or password.', 401);
            }

            $userstudent->tokens()->delete();
            $token = $userstudent->createToken($userstudent->username)->plainTextToken;

            return AppResponse::success([
                'userstudent' => new UserStudentResource($userstudent),
                'token' => $token,
            ], 'Login successful.', 200);
        } catch (\Exception $e) {
            Log::error('User Student login error: ' . $e->getMessage());
            return AppResponse::error('An error occurred. Please try again later.', 500);
        }
    }

    // User Student Logout
    public function logout(Request $request): JsonResponse
    {
        try {
            $userstudent = Auth::user();
            if (!$userstudent) {
                return AppResponse::error('User student not found.', 404);
            }

            $userstudent->tokens()->delete();
            return AppResponse::success('Logged out successfully.', 200);
        } catch (\Exception $e) {
            Log::error('User Student logout error: ' . $e->getMessage());
            return AppResponse::error('Logout failed.', 500);
        }
    }
}
