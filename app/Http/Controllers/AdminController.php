<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Auth;
use Log;

class AdminController extends Controller
{
    // Admin Registration
    public function register(AdminRegisterRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $validatedData['admin_password'] = Hash::make($validatedData['admin_password']);
            $admin = Admin::create($validatedData);

            return response()->json([
                'message' => 'Admin Created Successfully',
                'admin' => $admin,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Admin Login
    public function login(AdminLoginRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            $admin = Admin::where('admin_name', $validatedData['admin_name'])->first();

            if (!$admin || !Hash::check($validatedData['admin_password'], $admin->admin_password)) {
                return response()->json([
                    'message' => 'Invalid credentials.',
                ], 401);
            }

            $token = $admin->createToken($admin->admin_name)->plainTextToken;
            Log::info("Token created for admin: {$admin->admin_name}");

            return response()->json([
                'message' => 'Login successful.',
                'admin' => $admin,
                'token' => $token,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Admin Logout
    public function logout(Request $request): JsonResponse
    {
        try {
            $admin = $request->user(); 
            if (!$admin) {
                return response()->json([
                    'message' => 'Admin not found.',
                ], 404);
            }

            $admin->tokens->each(function ($token) {
                $token->delete();
            });

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

