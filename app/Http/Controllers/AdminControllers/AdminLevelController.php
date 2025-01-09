<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\AdminModels\AdminLevel;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequests\AdminLevelRequest;
use Illuminate\Http\JsonResponse;

class AdminLevelController extends Controller
{
    // Get all admin levels
    public function index(): JsonResponse
    {
        try {
            $adminLevel = AdminLevel::with(['admin', 'language'])->get();

            return response()->json([
                'admin_level' => $adminLevel,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Store a new admin level
    public function store(AdminLevelRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $validatedData['admin_id'] = auth()->id(); 

            $adminLevel = AdminLevel::create($validatedData);

            return response()->json([
                'message' => 'Admin level created successfully.',
                'admin_level' => $adminLevel,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Show a single admin level
    public function show($id): JsonResponse
    {
        try {
            $adminLevel = AdminLevel::with(['admin', 'language'])->find($id);

            if (!$adminLevel) {
                return response()->json([
                    'message' => 'Admin level not found.',
                ], 404);
            }

            return response()->json([
                'admin_level' => $adminLevel,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Update an admin level
    public function update(AdminLevelRequest $request, $id): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $adminLevel = AdminLevel::find($id);

            if (!$adminLevel) {
                return response()->json([
                    'message' => 'Admin level not found.',
                ], 404);
            }

            $adminLevel->update($validatedData);

            return response()->json([
                'message' => 'Admin level updated successfully.',
                'admin_level' => $adminLevel,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Delete an admin level
    public function destroy($id): JsonResponse
    {
        try {
            $adminLevel = AdminLevel::find($id);

            if (!$adminLevel) {
                return response()->json([
                    'message' => 'Admin level not found.',
                ], 404);
            }

            $adminLevel->delete();

            return response()->json([
                'message' => 'Admin level deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
