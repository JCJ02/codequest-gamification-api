<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Services\AppResponse;
use App\Http\Resources\AdminResources\AdminResource;
use App\Http\Requests\AdminRequests\AdminRegisterRequest;
use App\Http\Requests\AdminRequests\AdminLoginRequest;
use App\Models\AdminModels\Admin;
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

            return AppResponse::success([
                'admin' => new AdminResource($admin),
            ], 'Registration Successful', 201);
        } catch (\Exception $e) {
            Log::error('Admin Registration Error: ' . $e->getMessage());
            return AppResponse::error('Registration Failed. Please try again later.', 500);
        }
    }

    // Admin Login
    public function login(AdminLoginRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            $admin = Admin::where('admin_name', $validatedData['admin_name'])->first();

            if (!$admin || !Hash::check($validatedData['admin_password'], $admin->admin_password)) {
               return AppResponse::error('Invalid name or password', 401);
            }

            $admin->tokens()->delete();
            $token = $admin->createToken($admin->admin_name)->plainTextToken;

            return AppResponse::success([
                'admin' => new AdminResource($admin),
                'token' => $token,
            ], 'Login Successful', 200);
        } catch (\Exception $e) {
            Log::error('Admin Login Error: ' . $e->getMessage());
            return AppResponse::error('An error occurred. Please try again later.', 500);
        }
    }

    // Admin Logout
    public function logout(Request $request): JsonResponse
    {
        try {
            $admin = Auth::admin();
            if ($admin) {
                return AppResponse::error('Admin not authenticated', 401);
            }

            $admin->tokens()->delete();
            return AppResponse::success('Logged out Successfully', 200);
        } catch (\Exception $e) {
            Log::error('Admin Logout Error: ' . $e->getMessage());
            return AppResponse::error('Log out failed', 500);
        }
    }
}

