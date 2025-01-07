<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserStudentRegisterRequest;
use App\Http\Requests\UserStudentLoginRequest;
use App\Models\UserStudent;
use App\Http\Controllers\Controller;
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

            return response()->json([
                'message' => 'Student Created Successfully',
                'userstudent' => $userstudent,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // User Student Login
    public function login(UserStudentLoginRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            $userstudent = UserStudent::where('username', $validatedData['username'])->first();

            if ($userstudent && Hash::check($validatedData['user_password'], $userstudent->user_password)) {
                $existingToken = $userstudent->tokens()->first();
                if ($existingToken) {
                    Log::info("Revoking existing token for user: {$userstudent->username}");
                    $existingToken->delete();
                }

                $token = $userstudent->createToken($userstudent->username)->plainTextToken;
                Log::info("Token created for user: {$userstudent->username}");

                return response()->json([
                    'message' => 'Login successful.',
                    'token' => $token,
                ], 200);
            }

            return response()->json([
                'message' => 'Invalid credentials.',
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // User Student Logout
    public function logout(Request $request): JsonResponse
    {
        try {
            $userstudent = Auth::user();
            if (!$userstudent) {
                return response()->json([
                    'message' => 'User Student not found.',
                ], 404);
            }

            $userstudent->tokens()->delete();
            return response()->json([
                'message' => 'Logout successful.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
